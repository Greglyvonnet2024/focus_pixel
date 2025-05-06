<?php

namespace App\Entity;

use App\Repository\ProductSellRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductSellRepository::class)]
class ProductSell
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Marque = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $img = null;

    #[ORM\Column]
    private ?float $stock = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\ManyToOne(inversedBy: 'productSell')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Order $command = null;
    

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'productSell', cascade:['persist'])]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'productSells')]
    private ?User $user = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isAvailable = false;

    #[ORM\Column]
    private ?bool $isSold = null;

    #[ORM\Column(length: 255)]
    private ?int $promotions = null;
    private ?string $originalCategory = null;

    /**
     * @var Collection<int, User>
     */


    // ***** ici effacement 
    // #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'favoris')]
    // private Collection $users;
    // ****** fin de l'effacement 

      // ***** ici rajout
    #[ORM\OneToMany(targetEntity: Favorite::class, mappedBy: 'product', cascade: ['remove'], orphanRemoval: true)]
    private Collection $favorites;
// ****** fin rajout 


    /**
     * @var Collection<int, Favorite>
     */
    // #[ORM\OneToMany(targetEntity: Favorite::class, mappedBy: 'product')]
    // private Collection $favorites;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        // $this->users = new ArrayCollection();>>> fais erreur controler
        $this->favorites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->Marque;
    }

    public function setMarque(string $Marque): static
    {
        $this->Marque = $Marque;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImg(): ?string
    {
        if ($this->img==null){
            $this->img = 'attente.jpg';
        }
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getStock(): ?float
    {
        return $this->stock;
    }

    public function setStock(float $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCommand(): ?Order
    {
        return $this->command;
    }

    public function setCommand(?Order $command): static
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setProductSell($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProductSell() === $this) {
                $image->setProductSell(null);
            }
        }

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

    public function getIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable=true): static
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    public function getIsSold(): ?bool
    {
        return $this->isSold;
    }

    public function setIsSold(bool $isSold): static
    {
        $this->isSold = $isSold;

        return $this;
    }

    public function getPromotions(): ?int
    {
        return $this->promotions;
    }

    public function setPromotions(?int $promotions): self
    {
        $this->promotions = $promotions;

if ($promotions >0) {
            $this->category = 'Promotions';
}else{
            $this->category = $this->originCategory ?? $this->category;
}
 return $this;
    }

    public function saveOriginCategory(){
        $this->originalCategory = $this->category;
    }

    public function getNewPrice(): ?float
{
    if ($this->promotions && $this->promotions  > 0) {
        return round ($this->prix - ($this->prix * $this->promotions / 100), 2);
    }
    return $this->prix;
}

    public function getPrixPromo(): float
    {
        if ($this->promotions !== null && $this->promotions > 0) {
            return $this->prix - ($this->prix * $this->promotions / 100);
        }

        return $this->prix;
    }

    /**
     * @return Collection<int, Favorite>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setProduct($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            if ($favorite->getProduct() === $this) {
                $favorite->setProduct(null);
            }
        }

        return $this;
    }



}


