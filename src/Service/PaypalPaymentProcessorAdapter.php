<?php

declare(strict_types=1);

namespace App\Service;

use Systemeio\TestForCandidates\PaymentProcessor as Systemeio;

class PaypalPaymentProcessorAdapter implements PaymentProcessorAdapterInterface
{
    public function __construct(
        private Systemeio\PaypalPaymentProcessor $systemeioPaypalPaymentProcessor,
    ) {
    }

    public function processPayment(float $majorUnitPrice): void
    {
        $minorUnitPrice = (int) round($majorUnitPrice * 100, 0, \PHP_ROUND_HALF_EVEN);

        $this->systemeioPaypalPaymentProcessor->pay(price: $minorUnitPrice);
    }
}
