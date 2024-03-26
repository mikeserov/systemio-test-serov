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

    public function processPayment(float $majorUnitPrice): void
    {
        $isSuccessPayment = $this->systemeioStripePaymentProcessor->processPayment(price: $majorUnitPrice);

        if (!$isSuccessPayment) {
            throw new Exception();
        }
    }
}
