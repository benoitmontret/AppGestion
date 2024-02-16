<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'matieres')]
    private ?Utilisateur $formateurs = null;

    #[ORM\OneToMany(targetEntity: AvoirNote::class, mappedBy: 'matieres')]
    private Collection $avoirNotes;

    #[ORM\ManyToMany(targetEntity: FairePartie::class, mappedBy: 'matieres')]
    private Collection $faireParties;


    public function __construct()
    {
        $this->avoirNotes = new ArrayCollection();
        $this->faireParties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getFormateurs(): ?Utilisateur
    {
        return $this->formateurs;
    }

    public function setFormateurs(?Utilisateur $formateurs): static
    {
        $this->formateurs = $formateurs;

        return $this;
    }

    /**
     * @return Collection<int, AvoirNote>
     */
    public function getAvoirNotes(): Collection
    {
        return $this->avoirNotes;
    }

    public function addAvoirNote(AvoirNote $avoirNote): static
    {
        if (!$this->avoirNotes->contains($avoirNote)) {
            $this->avoirNotes->add($avoirNote);
            $avoirNote->setMatieres($this);
        }

        return $this;
    }

    public function removeAvoirNote(AvoirNote $avoirNote): static
    {
        if ($this->avoirNotes->removeElement($avoirNote)) {
            // set the owning side to null (unless already changed)
            if ($avoirNote->getMatieres() === $this) {
                $avoirNote->setMatieres(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FairePartie>
     */
    public function getFaireParties(): Collection
    {
        return $this->faireParties;
    }

    public function addFaireParty(FairePartie $faireParty): static
    {
        if (!$this->faireParties->contains($faireParty)) {
            $this->faireParties->add($faireParty);
            $faireParty->addMatiere($this);
        }

        return $this;
    }

    public function removeFaireParty(FairePartie $faireParty): static
    {
        if ($this->faireParties->removeElement($faireParty)) {
            $faireParty->removeMatiere($this);
        }

        return $this;
    }

}
