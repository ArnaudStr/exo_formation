<?php

namespace App\Entity;

use App\Entity\Module;
use DateTimeInterface;
use App\Entity\Stagiaire;
use App\Entity\DureeModule;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlaces;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stagiaire", inversedBy="formations")
     */
    private $stagiaires;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DureeModule", mappedBy="formation", orphanRemoval=true, cascade={"persist"})
     */
    private $dureeModules;

    public function __construct()
    {
        $this->stagiaires = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->dureeModules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): self
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * @return Collection|Stagiaire[]
     */
    public function getStagiaires(): Collection
    {
        return $this->stagiaires;
    }

    public function addStagiaire(Stagiaire $stagiaire): self
    {
        if (!$this->stagiaires->contains($stagiaire)) {
            $this->stagiaires[] = $stagiaire;
        }

        return $this;
    }

    public function removeStagiaire(Stagiaire $stagiaire): self
    {
        if ($this->stagiaires->contains($stagiaire)) {
            $this->stagiaires->removeElement($stagiaire);
        }

        return $this;
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

        /**
     * toString
     * @return string
     */
    public function __toString(){
        return $this->getNom();
    }

    /**
     * @return Collection|DureeModule[]
     */
    public function getDureeModules(): Collection
    {
        return $this->dureeModules;
    }

    public function addDureeModule(DureeModule $dureeModule): self
    {
        if (!$this->dureeModules->contains($dureeModule)) {
            $this->dureeModules[] = $dureeModule;
            $dureeModule->setFormation($this);
        }

        return $this;
    }

    public function removeDureeModule(DureeModule $dureeModule): self
    {
        if ($this->dureeModules->contains($dureeModule)) {
            $this->dureeModules->removeElement($dureeModule);
            // set the owning side to null (unless already changed)
            if ($dureeModule->getFormation() === $this) {
                $dureeModule->setFormation(null);
            }
        }

        return $this;
    }

    public function setStagiaires(?string $stagiaires): self
    {
        $this->stagiaires = $stagiaires;

        return $this;
    }

}
