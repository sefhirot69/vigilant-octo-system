<?php

declare(strict_types=1);

namespace App\Tests\Unit\FlightManagement\Domain\ValueObject;

use App\FlightManagement\Domain\ValueObject\Code;
use App\FlightManagement\Domain\ValueObject\CodeName;
use App\FlightManagement\Domain\ValueObject\Name;

final class CodeNameMother
{
    public static function create(Code $code, Name $name): CodeName
    {
        return CodeName::create($code->value(), $name->value());
    }

    public static function random(): CodeName
    {
        return self::create(
            CodeMother::random(),
            NameMother::random(),
        );
    }
}
