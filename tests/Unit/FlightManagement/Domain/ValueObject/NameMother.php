<?php

declare(strict_types=1);

namespace App\Tests\Unit\FlightManagement\Domain\ValueObject;

use App\FlightManagement\Domain\ValueObject\Name;
use App\Tests\Common\FakerCreator;

final class NameMother
{
    public static function create(string $value): Name
    {
        return Name::fromString($value);
    }

    public static function random(): Name
    {
        return self::create(FakerCreator::random()->name());
    }
}
