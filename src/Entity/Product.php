<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Entity]
class Product
{
    #[ORM\Id]
    #[GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: Types::BIGINT)]
    public int $id;

    #[ORM\Column(type: Types::STRING)]
    public string $name;

    #[ORM\Column(type: Types::INTEGER)]
    public int $price;

    public function __construct(
        int $id,
        int $price,
        string $name,
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->name = $name;
    }
}
