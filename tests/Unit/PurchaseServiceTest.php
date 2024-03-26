<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Enum\PaymentProcessorEnum;
use App\Enum\PercentCouponEnum;
use App\Repository\ProductRepository;
use App\Service\CalculatePriceService;
use App\Service\PaymentProcessorAdapterResolver;
use App\Service\PaypalPaymentProcessorAdapter;
use App\Service\PurchaseService;
use App\Tests\BaseTestCase;

final class PurchaseServiceTest extends BaseTestCase
{
    public function testSuccess(): void
    {
        $calculatedPrice = 100.0;
        $paymentProcessorAdapterEnum = PaymentProcessorEnum::PAYPAL;
        $product = $this->getService(ProductRepository::class)->find(id: 1);
        $taxNumber = 'IT12345678999';

        $paymentProcessorAdapterResolver = $this->createMock(PaymentProcessorAdapterResolver::class);
        $calculatePriceService = $this->createMock(CalculatePriceService::class);
        $paypalPaymentProcessorAdapter = $this->createMock(PaypalPaymentProcessorAdapter::class);

        $calculatePriceService
            ->expects(self::once())
            ->method('calculate')
            ->willReturn($calculatedPrice)
        ;

        $paymentProcessorAdapterResolver
            ->expects(self::once())
            ->method('getAdapterByEnum')
            ->with($paymentProcessorAdapterEnum)
            ->willReturn($paypalPaymentProcessorAdapter)
        ;

        $paypalPaymentProcessorAdapter
            ->expects(self::once())
            ->method('processPayment')
            ->with($calculatedPrice)
        ;

        (new PurchaseService(
            paymentProcessorAdapterResolver: $paymentProcessorAdapterResolver,
            calculatePriceService: $calculatePriceService,
        ))->purchase(
            product: $product,
            taxNumber: $taxNumber,
            couponEnum: PercentCouponEnum::PERCENT_10,
            paymentProcessorAdapterEnum: $paymentProcessorAdapterEnum,
        );
    }
}
