<?php

namespace App\Form;

use App\Entity\QuoteRequest;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminQuoteRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('message', TextareaType::class)
            ->add('articleType', TextType::class, ['required' => false])
            ->add('articleOrigin', TextType::class, ['required' => false])
            ->add('markingType', TextType::class, ['required' => false])
            ->add('logoFile', FileType::class, [
                'label' => 'Logo (image)',
                'mapped' => false,
                'required' => false,
                'help' => 'Fichiers images uniquement (max. 15 Mo)',
                'attr' => ['accept' => 'image/*'],
                'constraints' => [
                    new File([
                        'maxSize' => '15M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'],
                        'mimeTypesMessage' => 'Veuillez sélectionner une image valide.',
                    ]),
                ],
            ])
            ->add('quantity', IntegerType::class, ['required' => false])
            ->add('organizationType', TextType::class, ['required' => false])
            ->add('organizationName', TextType::class, ['required' => false])
            ->add('phone', TextType::class, ['required' => false])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Nouveau' => 'new',
                    'En attente' => 'pending',
                    'En traitement' => 'processing',
                    'Traité' => 'processed',
                    'Approuvé' => 'approved',
                ],
            ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuoteRequest::class,
        ]);
    }
}
