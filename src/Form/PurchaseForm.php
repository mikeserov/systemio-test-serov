<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Product;
use App\Enum\PaymentProcessorEnum;
use App\Form\FormType\CouponCodeType;
use App\Form\FormType\TaxNumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class PurchaseForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
                'invalid_message' => 'Product with id {{ value }} does not exists.',
            ])
            ->add('taxNumber', TaxNumberType::class, [
                'required' => true,
            ])
            ->add('couponCode', CouponCodeType::class)
            ->add('paymentProcessor', EnumType::class, ['class' => PaymentProcessorEnum::class])
        ;
    }
}
