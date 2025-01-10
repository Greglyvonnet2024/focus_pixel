<?php

namespace App\Controller\Admin;

use App\Entity\ProductSell;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductSellCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductSell::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('Marque'),
           TextField::new('Nom'),
           NumberField::new('Prix'),
           TextareaField::new('Description'),
           TextField::new('Etat'),
           ImageField::new('img')->setBasePath('public/assets/img')
            ->setUploadDir('public/assets/img')
            ->setRequired(true),
           NumberField::new('Stock'),
           TextField::new('Category')
        ];
    }

}
