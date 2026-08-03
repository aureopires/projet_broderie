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

class AdminReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'pending' => 'pending',
                    'approved' => 'approved',
                    'rejected' => 'rejected',
                ],
            ])            ->add('rating')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'title',
                'required' => false, // Permite que o campo não seja obrigatório
                'placeholder' => 'Général (Site)', // Cria a opção vazia com esse texto no select
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
