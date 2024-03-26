<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Enum\FixAmountCouponEnum;
use App\Enum\PercentCouponEnum;
use App\Exception\PurchaseFailException;
use Exception;

readonly class PurchaseService
{
    public function __construct(
        private PaymentProcessorAdapterResolver $paymentProcessorAdapterResolver,
        private CalculatePriceService $calculatePriceService,
    ) {
    }

    public function purchase(
        Product $product,
        string $taxNumber,
        FixAmountCouponEnum|PercentCouponEnum|null $couponEnum,
        $paymentProcessorAdapterEnum,
    ): void {
        $price = $this->calculatePriceService->calculate(
            product: $product,
            taxNumber: $taxNumber,
            couponEnum: $couponEnum,
        );

        try {
            $this->paymentProcessorAdapterResolver->getAdapterByEnum($paymentProcessorAdapterEnum)->processPayment($price);
        } catch (Exception $exception) {
            throw new PurchaseFailException(sprintf('Unable to pay sum %s by %s payment processor', $price, $paymentProcessorAdapterEnum->value));
        }
    }
}
