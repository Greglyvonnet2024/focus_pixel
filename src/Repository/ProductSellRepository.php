<?php

namespace App\Repository;

use App\Entity\ProductSell;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductSell>
 */
class ProductSellRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductSell::class);
    }

    //    /**
    //     * @return ProductSell[] Returns an array of ProductSell objects
    //     */
    public function findByCategory($category): array
    {
        return $this->createQueryBuilder(alias: 'p')
            ->andWhere('p.category = :category')
            ->setParameter('category', $category)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


// activer pour le bouton boleen en vente ou en attente 

    // public function findAvailableProducts(): array
    // {
    //     return $this->createQueryBuilder('p')
    //     ->where("p.isAvailable = true")
    //     ->getQuery()
    //         ->getResult();
    // }


}
