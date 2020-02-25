<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $module;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $renduType;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreEtudiant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="sessions")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CreneauHoraire", inversedBy="sessions")
     */
    private $creneaux;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getModule(): ?string
    {
        return $this->module;
    }

    public function setModule(string $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getRenduType(): ?string
    {
        return $this->renduType;
    }

    public function setRenduType(string $renduType): self
    {
        $this->renduType = $renduType;

        return $this;
    }

    public function getNombreEtudiant(): ?int
    {
        return $this->nombreEtudiant;
    }

    public function setNombreEtudiant(int $nombreEtudiant): self
    {
        $this->nombreEtudiant = $nombreEtudiant;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setSessions($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getSessions() === $this) {
                $user->setSessions(null);
            }
        }

        return $this;
    }

    public function getCreneaux(): ?CreneauHoraire
    {
        return $this->creneaux;
    }

    public function setCreneaux(?CreneauHoraire $creneaux): self
    {
        $this->creneaux = $creneaux;

        return $this;
    }
}
