<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]

#[ORM\Table(name: 'orders')] 
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
    #[ORM\OneToMany(targetEntity: ProductBuy::class, mappedBy: 'command')]
    private Collection $productbuys;


    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, ProductSell>
     */
    #[ORM\OneToMany(targetEntity: ProductSell::class, mappedBy: 'command')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $productSell;

    public function __construct()
    {
        $this->productbuys = new ArrayCollection();
        $this->productSell = new ArrayCollection();
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
    public function setQuantity(float $quantity=1): static
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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut="confirmé"): static
    {
        $this->statut = $statut;

        return $this;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date=new \DateTime()): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, ProductSell>
     */
    public function getProductSell(): Collection
    {
        return $this->productSell;
    }

    public function addProductSell(ProductSell $productSell): static
    {
        if (!$this->productSell->contains($productSell)) {
            $this->productSell->add($productSell);
            $productSell->setCommand($this);
        }

        return $this;
    }

    public function removeProductSell(ProductSell $productSell): static
    {
        if ($this->productSell->removeElement($productSell)) {
            // set the owning side to null (unless already changed)
            if ($productSell->getCommand() === $this) {
                $productSell->setCommand(null);
            }
        }

        return $this;
    }
}
