<?php

namespace App\Form;

use App\Entity\QuoteRequest;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                'constraints' => [new NotBlank(message: 'Veuillez préciser le type d’article souhaité.', normalizer: 'trim')],
            ])
            ->add('articleOrigin', ChoiceType::class, [
                'label' => "Origine de l'article",
                'required' => true,
                'placeholder' => 'Choisissez une option',
                'choices' => [
                    'Je fournis l’article' => 'client',
                    'Vous fournissez l’article' => 'atelier',
                ],
                'constraints' => [new NotBlank(message: 'Veuillez choisir l’origine de l’article.')],
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
                'constraints' => [new NotBlank(message: 'Veuillez choisir le type de marquage.')],
            ])
            ->add('logoFile', QuoteLogoType::class)
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité à personnaliser',
                'required' => true,
                'attr' => ['placeholder' => 'Saisissez la quantité', 'min' => 1],
                'constraints' => [
                    new NotBlank(message: 'Veuillez indiquer une quantité.'),
                    new GreaterThanOrEqual(1),
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'mapped' => false,
                'required' => true,
                'constraints' => [new NotBlank(message: 'Veuillez renseigner votre prénom.', normalizer: 'trim')],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'mapped' => false,
                'required' => true,
                'constraints' => [new NotBlank(message: 'Veuillez renseigner votre nom.', normalizer: 'trim')],
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
                'constraints' => [new NotBlank(message: 'Veuillez choisir le type d’organisme.')],
            ])
            ->add('organizationName', TextType::class, [
                'label' => "Nom de l'organisme",
                'required' => false,
                'attr' => ['placeholder' => 'Ajouter réponse ici'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'constraints' => [
                    new NotBlank(message: 'Veuillez renseigner votre adresse e-mail.', normalizer: 'trim'),
                    new Email(message: 'Veuillez renseigner une adresse e-mail valide.'),
                ],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'required' => true,
                'attr' => ['placeholder' => 'Téléphone'],
                'constraints' => [new NotBlank(message: 'Veuillez renseigner votre téléphone.', normalizer: 'trim')],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Décrivez-nous votre projet',
                'required' => true,
                'attr' => ['placeholder' => 'Ajouter réponse ici', 'rows' => 5],
                'constraints' => [new NotBlank(message: 'Veuillez décrire votre projet.', normalizer: 'trim')],
            ])
            -> add ('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn btn-gold quote-submit'],
                
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
