<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Duree::class, mappedBy="formation", cascade={"persist"})
     */
    private $durees;

    /**
     * @ORM\OneToMany(targetEntity=Session::class, mappedBy="formation")
     */
    private $sessions;

    public function __construct()
    {
        $this->durees = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Duree[]
     */
    public function getDurees(): Collection
    {
        return $this->durees;
    }

    public function addDuree(Duree $duree): self
    {
        if (!$this->durees->contains($duree)) {
            $this->durees[] = $duree;
            $duree->setFormation($this);
        }

        return $this;
    }

    public function removeDuree(Duree $duree): self
    {
        if ($this->durees->removeElement($duree)) {
            // set the owning side to null (unless already changed)
            if ($duree->getFormation() === $this) {
                $duree->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setFormation($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getFormation() === $this) {
                $session->setFormation(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nom . " " . $this->description;
    }
}
