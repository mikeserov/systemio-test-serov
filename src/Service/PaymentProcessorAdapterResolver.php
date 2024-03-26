<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\PaymentProcessorEnum;

readonly class PaymentProcessorAdapterResolver
{
    public function __construct(
        private PaypalPaymentProcessorAdapter $paypalPaymentProcessorAdapter,
        private StripePaymentProcessorAdapter $stripePaymentProcessorAdapter,
    ) {
    }

    public function getAdapterByEnum(PaymentProcessorEnum $paymentProcessorEnum): PaymentProcessorAdapterInterface
    {
        return match ($paymentProcessorEnum) {
            PaymentProcessorEnum::PAYPAL => $this->paypalPaymentProcessorAdapter,
            PaymentProcessorEnum::STRIPE => $this->stripePaymentProcessorAdapter,
        };
    }
}
