<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

final class QuoteLogoType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Logo (optionnel)',
            'mapped' => false,
            'required' => false,
            'help' => 'PNG, JPEG ou WebP uniquement (max. 15 Mo).',
            'attr' => ['accept' => '.png,.jpg,.jpeg,.webp'],
            'constraints' => [new File(
                maxSize: '15M',
                extensions: ['png', 'jpg', 'jpeg', 'webp'],
                extensionsMessage: 'Veuillez sélectionner une image PNG, JPEG ou WebP valide.',
            )],
        ]);
    }

    public function getParent(): string
    {
        return FileType::class;
    }
}
