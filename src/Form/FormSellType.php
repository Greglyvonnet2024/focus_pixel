<?php

namespace App\Form;

use App\Entity\ProductBuy;
use App\Entity\ProductSell;
use App\Repository\ProductBuyRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FormSellType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque', TextType::class, [
                "label" => "Marque:"
            ])
            ->add('nom', TextType::class)
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Usé' => 'use',
                    'Bon' => 'bon',
                    'Excellent' => 'excellent',
                ],
                'multiple' => false,
                'expanded' => true,
                'label' => 'Etat',
            ])
            ->add('prix', NumberType::class)
            ->add('description', TextareaType::class)
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Boitiers' => 'boitiers',
                    'Optiques' => 'optiques',
                    'Flashs' => 'flashs',
                    'Accessoires' => 'accessoires',
                ],
                'multiple' => false,
                'expanded' => true,
                'label' => 'Catégories',
            ])
            ->add('vente', SubmitType::class, []);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductBuy::class,
        ]);
    }
}
