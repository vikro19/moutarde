<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
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
    private $num_commande;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=CommandeQuantite::class, mappedBy="commande")
     */
    private $commandeQuantites;

    public function __construct()
    {
        $this->commandeQuantites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCommande(): ?string
    {
        return $this->num_commande;
    }

    public function setNumCommande(string $num_commande): self
    {
        $this->num_commande = $num_commande;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|CommandeQuantite[]
     */
    public function getCommandeQuantites(): Collection
    {
        return $this->commandeQuantites;
    }

    public function addCommandeQuantite(CommandeQuantite $commandeQuantite): self
    {
        if (!$this->commandeQuantites->contains($commandeQuantite)) {
            $this->commandeQuantites[] = $commandeQuantite;
            $commandeQuantite->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeQuantite(CommandeQuantite $commandeQuantite): self
    {
        if ($this->commandeQuantites->removeElement($commandeQuantite)) {
            // set the owning side to null (unless already changed)
            if ($commandeQuantite->getCommande() === $this) {
                $commandeQuantite->setCommande(null);
            }
        }

        return $this;
    }
}
