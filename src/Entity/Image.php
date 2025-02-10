<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $images = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?ProductSell $productSell = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): static
    {
        $this->images = $images;

        return $this;
    }

    public function getProductSell(): ?ProductSell
    {
        return $this->productSell;
    }

    public function setProductSell(?ProductSell $productSell): static
    {
        $this->productSell = $productSell;

        return $this;
    }
}
