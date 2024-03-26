<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Enum\PercentCouponEnum;
use App\Repository\ProductRepository;
use App\Service\CalculatePriceService;
use App\Tests\BaseTestCase;
use DomainException;

final class CalculatePriceServiceTest extends BaseTestCase
{
    public function testException(): void
    {
        $product = $this->getService(ProductRepository::class)->find(id: 1);
        $invalidTaxNumber = 'RU12345678999';

        $calculatePriceService = $this->getService(CalculatePriceService::class);
        $this->expectException(DomainException::class);
        $calculatePriceService->calculate(
            product: $product,
            taxNumber: $invalidTaxNumber,
            couponEnum: PercentCouponEnum::PERCENT_10,
        );
    }

    public function testSuccess(): void
    {
        $product = $this->getService(ProductRepository::class)->find(id: 1);

        $calculatePriceService = $this->getService(CalculatePriceService::class);
        $price = $calculatePriceService->calculate(
            product: $product,
            taxNumber: 'IT12345678999',
            couponEnum: PercentCouponEnum::PERCENT_10,
        );

        self::assertSame(expected: 109.8, actual: $price);
    }
}
