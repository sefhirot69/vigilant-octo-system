<?php

declare(strict_types=1);

namespace App\Tests\Unit\FlightManagement\Domain\ValueObject;

use App\FlightManagement\Domain\ValueObject\TransportNumber;
use App\Tests\Common\FakerCreator;

final class TransportNumberMother
{
    public static function create(string $value): TransportNumber
    {
        return TransportNumber::fromString($value);
    }

    public static function random(): TransportNumber
    {
        return self::create(FakerCreator::random()->buildingNumber());
    }
}
