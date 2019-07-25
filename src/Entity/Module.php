<?php

namespace App\Entity;

use App\Entity\Formation;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 */
class Module
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="modules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DureeModule", mappedBy="module", orphanRemoval=true)
     */
    private $durees;

    public function __construct()
    {
        $this->durees = new ArrayCollection();
    }

    /**
     * toString
     * @return string
     */
    public function __toString(){
        return $this->getNom();
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
     * @return Collection|DureeModule[]
     */
    public function getDurees(): Collection
    {
        return $this->durees;
    }

    public function addDuree(DureeModule $duree): self
    {
        if (!$this->durees->contains($duree)) {
            $this->durees[] = $duree;
            $duree->setModule($this);
        }

        return $this;
    }

    public function removeDuree(DureeModule $duree): self
    {
        if ($this->durees->contains($duree)) {
            $this->durees->removeElement($duree);
            // set the owning side to null (unless already changed)
            if ($duree->getModule() === $this) {
                $duree->setModule(null);
            }
        }

        return $this;
    }

}
