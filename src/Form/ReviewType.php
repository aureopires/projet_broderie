<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Review;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rating', IntegerType::class, [
                'label' => 'Note (1 à 5)',
                'attr' => ['min' => 1, 'max' => 5]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Votre commentaire'
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'title',
                'required' => false, // Opcional, caso queira deixar um review geral do site
                'placeholder' => 'Avis général sur le site (Optionnel)',
                'label' => 'Concerne un produit ?'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
