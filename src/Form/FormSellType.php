<?php

namespace App\Form;

use App\Entity\ProductSell;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormSellType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque')
            ->add('nom')
            ->add('etat')
            ->add('prix')
            ->add('description')
            ->add('category', CheckboxType::class, ['use','bon','excellent']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductSell::class,
        ]);
    }
}
