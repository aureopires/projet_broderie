<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach (['prenom' => 'Prénom', 'nom' => 'Nom'] as $name => $label) {
            $builder->add($name, TextType::class, ['label' => $label, 'constraints' => [new NotBlank(message: 'Veuillez renseigner ce champ.', normalizer: 'trim'), new Length(max: 100)]]);
        }
        $builder
            ->add('entite', TextType::class, ['label' => 'Entité', 'required' => false, 'constraints' => [new Length(max: 255)]])
            ->add('email', EmailType::class, ['label' => 'Adresse mail', 'constraints' => [new NotBlank(message: 'Veuillez renseigner votre adresse e-mail.'), new Email(message: 'Veuillez renseigner une adresse e-mail valide.'), new Length(max: 180)]])
            ->add('message', TextareaType::class, ['label' => 'Votre message', 'attr' => ['rows' => 5], 'constraints' => [new NotBlank(message: 'Veuillez écrire votre message.', normalizer: 'trim'), new Length(max: 10000)]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['csrf_token_id' => 'contact']);
    }
}
