<?php

declare(strict_types=1);


namespace App\FlightManagement\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;

final class Code extends StringValueObject
{
    public static function fromString(string $value): StringValueObject
    {
        return new self($value);
    }
}