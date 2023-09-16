<?php

declare(strict_types=1);

namespace App\Tests\Unit\FlightManagement\Domain\ValueObject;

use App\FlightManagement\Domain\ValueObject\Code;
use App\Tests\Common\FakerCreator;
use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    /** @test */
    public function itShouldEqualsCode(): void
    {
        $code = FakerCreator::random()->countryCode();
        self::assertTrue(
            Code::fromString($code)
                ->isEqualTo(Code::fromString($code))
        );
    }
}
