<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $nom = null;

    #[ORM\OneToMany(targetEntity: Utilisateur::class, mappedBy: 'formation')]
    private Collection $apprenants;

    #[ORM\OneToMany(targetEntity: FairePartie::class, mappedBy: 'formations')]
    private Collection $faireParties;


    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
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

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Utilisateur $apprenant): static
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants->add($apprenant);
            $apprenant->setFormation($this);
        }

        return $this;
    }

    public function removeApprenant(Utilisateur $apprenant): static
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getFormation() === $this) {
                $apprenant->setFormation(null);
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
            $faireParty->setFormations($this);
        }

        return $this;
    }

    public function removeFaireParty(FairePartie $faireParty): static
    {
        if ($this->faireParties->removeElement($faireParty)) {
            // set the owning side to null (unless already changed)
            if ($faireParty->getFormations() === $this) {
                $faireParty->setFormations(null);
            }
        }

        return $this;
    }

}
