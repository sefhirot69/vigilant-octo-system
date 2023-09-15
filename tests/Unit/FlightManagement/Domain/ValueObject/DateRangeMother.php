<?php

declare(strict_types=1);

namespace App\Tests\Unit\FlightManagement\Domain\ValueObject;

use App\FlightManagement\Domain\ValueObject\DateRange;

final class DateRangeMother
{
    public static function create(\DateTimeImmutable $start, \DateTimeImmutable $end): DateRange
    {
        return DateRange::create($start, $end);
    }

    public static function random(): DateRange
    {
        $start = new \DateTimeImmutable();
        $end   = $start->add(new \DateInterval('PT2H'));

        return self::create(
            $start,
            $end
        );
    }
}
