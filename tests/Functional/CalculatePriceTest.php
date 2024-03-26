<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\BaseTestCase;

final class CalculatePriceTest extends BaseTestCase
{
    public function testSuccess(): void
    {
        $client = self::createClient();
        $client->request('POST', '/calculate-price', [
            'product' => 1,
            'taxNumber' => 'IT12345678910',
            'couponCode' => 'percent_10',
        ]);

        $this->assertResponseIsSuccessful();
    }
}
