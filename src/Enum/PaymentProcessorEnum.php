<?php

declare(strict_types=1);

namespace App\Enum;

enum PaymentProcessorEnum: string
{
    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
}
