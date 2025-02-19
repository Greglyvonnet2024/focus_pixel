<?php

namespace App\Controller\Admin;

use App\Entity\ProductBuy;
use App\Entity\ProductSell;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductBuyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductBuy::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Marque'),
            TextField::new('Nom'),
            NumberField::new('Prix'),
            TextareaField::new('Description'),
            TextField::new('Etat'),
        
            TextField::new('Category'),
    // ça tu mets dans la méthode configureFields() dans le return
        // BooleanField::new('accepted', 'Accepté ?')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $acceptAction = Action::new('accept', 'Accepter')
            ->linkToCrudAction('acceptProduct') // Appelle une fonction qu'on va créer
            ->setCssClass('btn btn-success'); // Style du bouton

        $rejectAction = Action::new('reject', 'Refuser')
            ->linkToCrudAction('rejectProduct')
            ->setCssClass('btn btn-danger');

        return $actions
            ->add(Crud::PAGE_INDEX, $acceptAction)  // Bouton affiché sur la liste
            ->add(Crud::PAGE_INDEX, $rejectAction)
            ->add(Crud::PAGE_DETAIL, $acceptAction) // Bouton sur le détail d'un produit
            ->add(Crud::PAGE_DETAIL, $rejectAction);   
    }


    public function acceptProduct(AdminContext $context, EntityManagerInterface $entityManager): RedirectResponse
    {
        // Récupérer l'ID de l'entité en cours
        $productBuy = $context->getEntity()->getInstance();

        if (!$productBuy) {
            $this->addFlash('danger', 'Produit non trouvé.');
            return $this->redirect($this->generateUrl('admin'));
        }

        // 2. Créer un nouvel objet ProductSell et lui attribuer les infos du produit acheté
        $productSell = new ProductSell();
        $productSell->setMarque($productBuy->getMarque());
        $productSell->setNom($productBuy->getNom());
        $productSell->setDescription($productBuy->getDescription());
        $productSell->setPrix($productBuy->getPrix());
        $productSell->setEtat($productBuy->getEtat());
        $productSell->setStock(1);
        $productSell->setCategory($productBuy->getCategory());

        // 3. Mettre à jour le produit dans ProductBuy pour indiquer qu'il est accepté
        $productBuy->setAccepted('oui');

        // 4. Sauvegarder les changements en base de données
        $entityManager->persist($productSell);
        $entityManager->flush();

        $this->addFlash('success', 'Produit accepté et ajouté à la vente.');

        return $this->redirect($this->generateUrl('admin'));
    }

}

