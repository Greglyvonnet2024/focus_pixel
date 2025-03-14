<?php

namespace App\Controller\Admin;

use App\Form\ImagesType;
use App\Entity\ProductSell;
// use Doctrine\DBAL\Types\BooleanType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Validator\Constraints\Choice;

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

            // TextField::new('Category'),

            ChoiceField::new ('Category')
            ->setChoices([
                'Boitier' => 'boitiers',
                'Optiques' => 'optiques',
                'Flashs' => 'flashs',
                'Accessoires' => 'accessoires',
                'Promotions' => 'promotions',
            ])
            ->setHelp('Sélectionnez une categorie'),


            CollectionField::new('Images')
            ->setEntryType(ImagesType::class)
                ->setFormTypeOptions([
                    'by_reference' => false,

                ])
                ->setEntryIsComplex(true)
                ->showEntryLabel(false)
                ->onlyOnForms(),

            BooleanField::new('isAvailable', 'En vente'),
            BooleanField::new('isSold', 'Vendu'),

            ChoiceField::new('promotions', 'Reduction en (%)')
            ->setChoices([
                '0'=> 0,
                '5%' => 5,
                '10%' => 10,
                '15%' => 15,
                '20%' => 20,
            ])
            ->setHelp('Sélectionnez un pourcentage de réduction à appliquer au produit'),
            ];
    }
}




