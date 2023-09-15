<?php

declare(strict_types=1);

namespace App\Tests\Unit\FlightManagement\Domain\ValueObject;

use App\FlightManagement\Domain\ValueObject\Code;
use App\Tests\Common\FakerCreator;

final class CodeMother
{
public static function create(string $value): Code
{
    return Code::fromString($value);
}

public static function random(): Code
{
    return self::create(FakerCreator::random()->countryCode());
}
}