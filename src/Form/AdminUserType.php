<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, ['label' => 'Adresse e-mail'])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Utilisateur' => 'ROLE_USER',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Nouveau mot de passe',
                'mapped' => false,
                'required' => $options['password_required'],
                'attr' => ['autocomplete' => 'new-password'],
                'help' => $options['password_required'] ? 'Au moins 12 caractères.' : 'Laissez vide pour conserver le mot de passe actuel.',
                'constraints' => array_merge(
                    [new Length(min: 12, max: 4096, minMessage: 'Utilisez au moins {{ limit }} caractères.')],
                    $options['password_required'] ? [new NotBlank(message: 'Veuillez saisir un mot de passe.')] : [],
                ),
            ])
            ->add('firstName', null, ['label' => 'Prénom'])
            ->add('lastName', null, ['label' => 'Nom'])
            ->add('createdAt', null, [
                'label' => 'Date de création',
                'widget' => 'single_text',
            ])
            ->add('isVerified', null, ['label' => 'Compte vérifié'])
        ;

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesAsArray) {
                    return is_array($rolesAsArray) ? $rolesAsArray : [];
                },
                function ($rolesAsString) {
                    return is_array($rolesAsString) ? $rolesAsString : [$rolesAsString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'password_required' => false,
        ]);
        $resolver->setAllowedTypes('password_required', 'bool');
    }
}
