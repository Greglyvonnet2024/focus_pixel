<?php

namespace App\Entity;

use App\Repository\ProductBuyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductBuyRepository::class)]
class ProductBuy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $prix_estimer = null;

    #[ORM\Column(length: 255)]
    private ?string $etat_estimer = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
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

    public function getPrixEstimer(): ?float
    {
        return $this->prix_estimer;
    }

    public function setPrixEstimer(float $prix_estimer): static
    {
        $this->prix_estimer = $prix_estimer;

        return $this;
    }

    public function getEtatEstimer(): ?string
    {
        return $this->etat_estimer;
    }

    public function setEtatEstimer(string $etat_estimer): static
    {
        $this->etat_estimer = $etat_estimer;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
