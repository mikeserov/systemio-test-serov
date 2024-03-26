<?php

declare(strict_types=1);

namespace App\Service;

interface PaymentProcessorAdapterInterface
{
    public function processPayment(float $priceEuro): void;
}
