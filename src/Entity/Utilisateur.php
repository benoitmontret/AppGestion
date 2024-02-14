<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 55)]
    private ?string $nom = null;

    #[ORM\Column(length: 55)]
    private ?string $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'apprenants')]
    private ?Formation $formation = null;

    #[ORM\OneToMany(targetEntity: Matiere::class, mappedBy: 'formateurs')]
    private Collection $matieres;

    #[ORM\OneToMany(targetEntity: AvoirNote::class, mappedBy: 'apprenants')]
    private Collection $avoirNotes;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'apprentis')]
    private ?self $tuteur = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'tuteur')]
    private Collection $apprentis;

    public function __construct()
    {
        $this->matieres = new ArrayCollection();
        $this->avoirNotes = new ArrayCollection();
        $this->apprentis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): static
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres->add($matiere);
            $matiere->setFormateurs($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): static
    {
        if ($this->matieres->removeElement($matiere)) {
            // set the owning side to null (unless already changed)
            if ($matiere->getFormateurs() === $this) {
                $matiere->setFormateurs(null);
            }
        }

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
            $avoirNote->setApprenants($this);
        }

        return $this;
    }

    public function removeAvoirNote(AvoirNote $avoirNote): static
    {
        if ($this->avoirNotes->removeElement($avoirNote)) {
            // set the owning side to null (unless already changed)
            if ($avoirNote->getApprenants() === $this) {
                $avoirNote->setApprenants(null);
            }
        }

        return $this;
    }

    public function getTuteur(): ?self
    {
        return $this->tuteur;
    }

    public function setTuteur(?self $tuteur): static
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getApprentis(): Collection
    {
        return $this->apprentis;
    }

    public function addApprenti(self $apprenti): static
    {
        if (!$this->apprentis->contains($apprenti)) {
            $this->apprentis->add($apprenti);
            $apprenti->setTuteur($this);
        }

        return $this;
    }

    public function removeApprenti(self $apprenti): static
    {
        if ($this->apprentis->removeElement($apprenti)) {
            // set the owning side to null (unless already changed)
            if ($apprenti->getTuteur() === $this) {
                $apprenti->setTuteur(null);
            }
        }

        return $this;
    }
}
