<?php

namespace App\Entity;

use App\Repository\FairePartieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FairePartieRepository::class)]
class FairePartie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $programme = null;

    #[ORM\ManyToOne(inversedBy: 'faireParties')]
    private ?Matiere $matieres = null;

    #[ORM\ManyToOne(inversedBy: 'faireParties')]
    private ?Formation $formations = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(?string $programme): static
    {
        $this->programme = $programme;

        return $this;
    }

    public function getMatieres(): ?Matiere
    {
        return $this->matieres;
    }

    public function setMatieres(?Matiere $matieres): static
    {
        $this->matieres = $matieres;

        return $this;
    }

    public function getFormations(): ?Formation
    {
        return $this->formations;
    }

    public function setFormations(?Formation $formations): static
    {
        $this->formations = $formations;

        return $this;
    }
}
