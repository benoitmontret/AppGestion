<?php

namespace App\Entity;

use App\Repository\AvoirNoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvoirNoteRepository::class)]
class AvoirNote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2, nullable: true)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'avoirNotes')]
    private ?Utilisateur $apprenants = null;

    #[ORM\ManyToOne(inversedBy: 'avoirNotes')]
    private ?Matiere $matieres = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getApprenants(): ?Utilisateur
    {
        return $this->apprenants;
    }

    public function setApprenants(?Utilisateur $apprenants): static
    {
        $this->apprenants = $apprenants;

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
}
