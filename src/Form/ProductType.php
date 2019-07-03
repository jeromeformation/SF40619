<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
                'help' => "Min : 4 caractères"
            ])
            ->add('description')
            ->add('price', null, [
                'label' => 'Prix'
            ])
            ->add('isPublished', null, [
                'label' => 'Le produit doit-il être publié ?',
            ])
            ->add('imageName', null, [
                'label' => 'Upload d\'image à venir'
            ])
            ->add('category', null, [
                'label' => 'Catégorie associée'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer le produit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
