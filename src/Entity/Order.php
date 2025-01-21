<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?float $quantity = null;

    /**
     * @var Collection<int, Productbuy>
     */
    #[ORM\OneToMany(targetEntity: Productbuy::class, mappedBy: 'command')]
    private Collection $productbuys;

    public function __construct()
    {
        $this->productbuys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection<int, Productbuy>
     */
    public function getProductbuys(): Collection
    {
        return $this->productbuys;
    }

    public function addProductbuy(Productbuy $productbuy): static
    {
        if (!$this->productbuys->contains($productbuy)) {
            $this->productbuys->add($productbuy);
            $productbuy->setCommand($this);
        }

        return $this;
    }

    public function removeProductbuy(Productbuy $productbuy): static
    {
        if ($this->productbuys->removeElement($productbuy)) {
            // set the owning side to null (unless already changed)
            if ($productbuy->getCommand() === $this) {
                $productbuy->setCommand(null);
            }
        }

        return $this;
    }
}
