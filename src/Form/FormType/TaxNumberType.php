<?php

declare(strict_types=1);

namespace App\Form\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class TaxNumberType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('constraints', [
                new Regex('/^(DE[0-9]{9}|IT[0-9]{11}|GR[0-9]{9}|FR[A-Z]{2}[0-9]{9})$/'),
                new NotBlank(),
            ])
        ;
    }

    public function getParent(): string
    {
        return TextType::class;
    }
}
