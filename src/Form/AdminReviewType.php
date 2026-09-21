<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Review;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class AdminReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', null, ['label' => 'Contenu'])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En attente' => Review::STATUS_PENDING,
                    'Approuvé' => Review::STATUS_APPROVED,
                    'Rejeté' => Review::STATUS_REJECTED,
                ],
            ])
            ->add('rating', null, [
                'label' => 'Note',
                'constraints' => [new Range(min: 1, max: 5)],
            ])
            ->add('createdAt', null, [
                'label' => 'Date de création',
                'widget' => 'single_text',
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'title',
                'required' => false,
                'placeholder' => 'Général (site)',
                'label' => 'Produit (Optionnel)'
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
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
