<?php

namespace App\Entity;

use App\Repository\DureeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DureeRepository::class)
 */
class Duree
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbJours;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="durees", cascade={"persist"})
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="durees", cascade={"persist"})
     */
    private $modules;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbJours(): ?int
    {
        return $this->nbJours;
    }

    public function setNbJours(int $nbJours): self
    {
        $this->nbJours = $nbJours;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getModules(): ?Module
    {
        return $this->modules;
    }

    public function setModules(?Module $modules): self
    {
        $this->modules = $modules;

        return $this;
    }

    public function __toString()
    {
        return $this->modules . "";
    }
}
