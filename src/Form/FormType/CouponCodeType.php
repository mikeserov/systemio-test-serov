<?php

declare(strict_types=1);

namespace App\Form\FormType;

use App\Enum\FixAmountCouponEnum;
use App\Enum\PercentCouponEnum;
use BackedEnum;
use Closure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CouponCodeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('choices', static fn (Options $options): array => array_merge(FixAmountCouponEnum::cases(), PercentCouponEnum::cases()))
            ->setDefault('choice_value', static function (Options $options): ?Closure {
                return static function (?BackedEnum $coupon): ?string {
                    if (null === $coupon) {
                        return null;
                    }

                    return (string) $coupon->value;
                };
            })
            ->setDefault('required', true)
            ->setDefault('invalid_message', 'Coupon {{ value }} does not exists.')
        ;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
