<?php

declare(strict_types=1);

namespace App\Service;

use Exception;
use Systemeio\TestForCandidates\PaymentProcessor as Systemeio;

class StripePaymentProcessorAdapter implements PaymentProcessorAdapterInterface
{
    public function __construct(
        private Systemeio\StripePaymentProcessor $systemeioStripePaymentProcessor,
    ) {
    }

    public function processPayment(float $priceEuro): void
    {
        $isSuccessPayment = $this->systemeioStripePaymentProcessor->processPayment(price: $priceEuro);

        if (!$isSuccessPayment) {
            throw new Exception();
        }
    }
}
