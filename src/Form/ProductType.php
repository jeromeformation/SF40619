<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Tag;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('description', CKEditorType::class)
            ->add('price', null, [
                'label' => 'Prix',
                'attr' => [
                    'class' => 'bg-info'
                ]
            ])
            ->add('isPublished', null, [
                'label' => 'Le produit doit-il être publié ?',
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Choisir une image'
            ])
            ->add('category', null, [
                'label' => 'Catégorie associée'
            ])
            ->add('tags', CollectionType::class, [
                'entry_type' => TagType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy',
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
