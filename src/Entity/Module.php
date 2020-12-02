<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModuleRepository::class)
 */
class Module
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
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="modules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Duree::class, mappedBy="modules")
     */
    private $durees;

    public function __construct()
    {
        $this->durees = new ArrayCollection();
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

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
            $duree->setModules($this);
        }

        return $this;
    }

    public function removeDuree(Duree $duree): self
    {
        if ($this->durees->removeElement($duree)) {
            // set the owning side to null (unless already changed)
            if ($duree->getModules() === $this) {
                $duree->setModules(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
