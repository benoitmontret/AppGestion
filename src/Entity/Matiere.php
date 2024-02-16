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

    #[ORM\OneToOne(mappedBy: 'matiere', cascade: ['persist', 'remove'])]
    private ?Programme $programme = null;


    public function __construct()
    {
        $this->avoirNotes = new ArrayCollection();
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

    public function getProgramme(): ?Programme
    {
        return $this->programme;
    }

    public function setProgramme(?Programme $programme): static
    {
        // unset the owning side of the relation if necessary
        if ($programme === null && $this->programme !== null) {
            $this->programme->setMatiere(null);
        }

        // set the owning side of the relation if necessary
        if ($programme !== null && $programme->getMatiere() !== $this) {
            $programme->setMatiere($this);
        }

        $this->programme = $programme;

        return $this;
    }


}
