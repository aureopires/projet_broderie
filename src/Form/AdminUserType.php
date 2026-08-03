<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Administrator' => 'ROLE_ADMIN',
                    'Standard User' => 'ROLE_USER',
                ],
                'multiple' => true,
                'expanded' => true, // Cria checkboxes para facilitar a seleção
            ])
            ->add('password')
            ->add('firstName')
            ->add('lastName')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('isVerified')
        ;

        // Adiciona o transformador logo após o encadeamento principal
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesAsArray) {
                    // Garante que o valor que vai para o form seja um array
                    return is_array($rolesAsArray) ? $rolesAsArray : [];
                },
                function ($rolesAsString) {
                    // Garante que o valor que volta do form para o banco seja um array
                    return is_array($rolesAsString) ? $rolesAsString : [$rolesAsString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
