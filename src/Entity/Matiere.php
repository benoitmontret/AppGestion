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


    #[ORM\OneToMany(targetEntity: Module::class, mappedBy: 'matiere')]
    private Collection $modules;


    public function __construct()
    {
        $this->avoirNotes = new ArrayCollection();
        $this->formation = new ArrayCollection();
        $this->modules = new ArrayCollection();
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
     * @return Collection<int, Module>
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(Module $formation): static
    {
        if (!$this->formation->contains($formation)) {
            $this->formation->add($formation);
            $formation->setMatiere($this);
        }

        return $this;
    }

    public function removeFormation(Module $formation): static
    {
        if ($this->formation->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getMatiere() === $this) {
                $formation->setMatiere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): static
    {
        if (!$this->modules->contains($module)) {
            $this->modules->add($module);
            $module->setMatiere($this);
        }

        return $this;
    }

    public function removeModule(Module $module): static
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getMatiere() === $this) {
                $module->setMatiere(null);
            }
        }

        return $this;
    }


}
