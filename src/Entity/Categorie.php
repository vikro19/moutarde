<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $bancs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $barres_et_disques;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $halteres_et_poids;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tapis_de_course;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $steppers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $balles_et_ballons_gym;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $corde_a_sauter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tapis_de_gym;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $autres;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="categorie")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBancs(): ?string
    {
        return $this->bancs;
    }

    public function setBancs(string $bancs): self
    {
        $this->bancs = $bancs;

        return $this;
    }

    public function getBarresEtDisques(): ?string
    {
        return $this->barres_et_disques;
    }

    public function setBarresEtDisques(string $barres_et_disques): self
    {
        $this->barres_et_disques = $barres_et_disques;

        return $this;
    }

    public function getHalteresEtPoids(): ?string
    {
        return $this->halteres_et_poids;
    }

    public function setHalteresEtPoids(string $halteres_et_poids): self
    {
        $this->halteres_et_poids = $halteres_et_poids;

        return $this;
    }

    public function getTapisDeCourse(): ?string
    {
        return $this->tapis_de_course;
    }

    public function setTapisDeCourse(string $tapis_de_course): self
    {
        $this->tapis_de_course = $tapis_de_course;

        return $this;
    }

    public function getSteppers(): ?string
    {
        return $this->steppers;
    }

    public function setSteppers(string $steppers): self
    {
        $this->steppers = $steppers;

        return $this;
    }

    public function getBallesEtBallonsGym(): ?string
    {
        return $this->balles_et_ballons_gym;
    }

    public function setBallesEtBallonsGym(string $balles_et_ballons_gym): self
    {
        $this->balles_et_ballons_gym = $balles_et_ballons_gym;

        return $this;
    }

    public function getCordeASauter(): ?string
    {
        return $this->corde_a_sauter;
    }

    public function setCordeASauter(string $corde_a_sauter): self
    {
        $this->corde_a_sauter = $corde_a_sauter;

        return $this;
    }

    public function getTapisDeGym(): ?string
    {
        return $this->tapis_de_gym;
    }

    public function setTapisDeGym(string $tapis_de_gym): self
    {
        $this->tapis_de_gym = $tapis_de_gym;

        return $this;
    }

    public function getAutres(): ?string
    {
        return $this->autres;
    }

    public function setAutres(string $autres): self
    {
        $this->autres = $autres;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }

        return $this;
    }

   
}
