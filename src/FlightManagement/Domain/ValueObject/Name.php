<?php

declare(strict_types=1);

namespace App\FlightManagement\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;

final class Name extends StringValueObject
{
    public static function fromString(string $value): StringValueObject
    {
        return new self($value);
    }
}