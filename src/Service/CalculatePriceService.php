<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Enum\FixAmountCouponEnum;
use App\Enum\PercentCouponEnum;
use DomainException;

class CalculatePriceService
{
    public function calculate(
        Product $product,
        string $taxNumber,
        FixAmountCouponEnum|PercentCouponEnum|null $couponEnum,
    ): float {
        $price = $product->price;
        $discountSum = $this->calculateDiscountSum(price: $price, couponEnum: $couponEnum);
        $priceWithDiscount = max(0, $price - $discountSum);
        $taxSum = $this->calculateTaxSum(taxNumber: $taxNumber, priceWithDiscount: $priceWithDiscount);

        return $priceWithDiscount + $taxSum;
    }

    private function calculateDiscountSum(
        int $price,
        FixAmountCouponEnum|PercentCouponEnum|null $couponEnum,
    ): float {
        if (null === $couponEnum) {
            return 0;
        }

        if ($couponEnum instanceof FixAmountCouponEnum) {
            return match ($couponEnum) {
                FixAmountCouponEnum::EURO_1 => 1.0,
                FixAmountCouponEnum::EURO_3 => 3.0,
                FixAmountCouponEnum::EURO_5 => 5.0,
            };
        }

        $discountPercent = match ($couponEnum) {
            PercentCouponEnum::PERCENT_10 => 0.10,
            PercentCouponEnum::PERCENT_20 => 0.20,
            PercentCouponEnum::PERCENT_30 => 0.30,
        };

        return $price * $discountPercent;
    }

    private function calculateTaxSum(string $taxNumber, float $priceWithDiscount): float
    {
        $country = substr($taxNumber, 0, 2);
        $taxPercent = match ($country) {
            'DE' => 0.19,
            'IT' => 0.22,
            'FR' => 0.20,
            'GR' => 0.24,
            default => throw new DomainException('Invalid country.'),
        };

        return $priceWithDiscount * $taxPercent;
    }
}
