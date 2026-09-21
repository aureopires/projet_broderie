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
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminQuoteRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ['label' => 'Nom'])
            ->add('email', null, ['label' => 'Adresse e-mail'])
            ->add('message', TextareaType::class, ['label' => 'Message'])
            ->add('articleType', TextType::class, ['label' => "Type d'article", 'required' => false])
            ->add('articleOrigin', TextType::class, ['label' => "Origine de l'article", 'required' => false])
            ->add('markingType', TextType::class, ['label' => 'Type de marquage', 'required' => false])
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
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité',
                'required' => false,
                'constraints' => [new GreaterThanOrEqual(1)],
            ])
            ->add('organizationType', TextType::class, ['label' => "Type d'organisme", 'required' => false])
            ->add('organizationName', TextType::class, ['label' => "Nom de l'organisme", 'required' => false])
            ->add('phone', TextType::class, ['label' => 'Téléphone', 'required' => false])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Nouveau' => QuoteRequest::STATUS_NEW,
                    'En traitement' => QuoteRequest::STATUS_PROCESSING,
                    'Terminé' => QuoteRequest::STATUS_FINISHED,
                ],
            ])
            ->add('createdAt', null, [
                'label' => 'Date de création',
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
