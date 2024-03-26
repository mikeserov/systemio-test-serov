<?php

declare(strict_types=1);

namespace App\Tests;

use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * @internal
 */
abstract class BaseTestCase extends WebTestCase
{
    /**
     * @template TService of object
     *
     * @psalm-param class-string<TService> $serviceId
     *
     * @psalm-return TService
     *
     * @throws ServiceNotFoundException
     */
    protected function getService(string $serviceId): object
    {
        $service = static::getContainer()->get($serviceId);

        if (!$service instanceof $serviceId) {
            throw new RuntimeException();
        }

        return $service;
    }
}
