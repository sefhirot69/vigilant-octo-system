<?php

declare(strict_types=1);

namespace App\Tests\Unit\FlightManagement\Domain\ValueObject;

use App\FlightManagement\Domain\ValueObject\Code;
use App\FlightManagement\Domain\ValueObject\Name;
use App\Shared\Domain\ValueObject\Email;
use App\Tests\Common\FakerCreator;
use PHPUnit\Framework\TestCase;

final class NameTest extends TestCase
{
    /** @test */
    public function itShouldEqualsName(): void
    {
        $name = FakerCreator::random()->name();

        self::assertTrue(
            Name::fromString($name)
                ->isEqualTo(Name::fromString($name))
        );
    }
}