<?php

namespace App\Form;

use App\Entity\QuoteRequest;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('articleType', TextType::class, [
                'label' => "Type d'article souhaité",
                'required' => true,
                'attr' => ['placeholder' => 'Casquette, écusson...'],
            ])
            ->add('articleOrigin', ChoiceType::class, [
                'label' => "Origine de l'article",
                'required' => true,
                'placeholder' => 'Choisissez une option',
                'choices' => [
                    'Je fournis l’article' => 'client',
                    'Vous fournissez l’article' => 'atelier',
                ],
            ])
            ->add('markingType', ChoiceType::class, [
                'label' => 'Type de marquage',
                'required' => true,
                'placeholder' => 'Choisissez une option',
                'choices' => [
                    'Broderie' => 'broderie',
                    'Flocage' => 'flocage',
                    'Sublimation' => 'sublimation',
                ],
            ])
            ->add('logoFile', FileType::class, [
                'label' => 'Logo (optionnel)',
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
                'label' => 'Quantité à personnaliser',
                'required' => true,
                'attr' => ['placeholder' => 'Saisissez la quantité', 'min' => 1],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'mapped' => false,
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'mapped' => false,
                'required' => true,
            ])
            ->add('organizationType', ChoiceType::class, [
                'label' => "Type d'organisme",
                'required' => true,
                'placeholder' => 'Choisissez une option',
                'choices' => [
                    'Particulier' => 'particulier',
                    'Entreprise' => 'entreprise',
                    'Association' => 'association',
                    'Collectivité' => 'collectivite',
                ],
            ])
            ->add('organizationName', TextType::class, [
                'label' => "Nom de l'organisme",
                'required' => false,
                'attr' => ['placeholder' => 'Ajouter réponse ici'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'required' => true,
                'attr' => ['placeholder' => 'Téléphone'],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Décrivez-nous votre projet',
                'required' => true,
                'attr' => ['placeholder' => 'Ajouter réponse ici', 'rows' => 5],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuoteRequest::class,
        ]);
    }
}
