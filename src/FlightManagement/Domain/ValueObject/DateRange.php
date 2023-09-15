<?php

declare(strict_types=1);

namespace App\FlightManagement\Domain\ValueObject;

use DateTimeImmutable;

final readonly class DateRange
{

    private function __construct(
        private DateTimeImmutable $start,
        private DateTimeImmutable $end,
    )
    {
    }
    
    public static function create(
        DateTimeImmutable $start,
        DateTimeImmutable $end,
    ) : self {
        return new self($start, $end);
    }

    public function getStart(): DateTimeImmutable
    {
        return $this->start;
    }

    public function getEnd(): DateTimeImmutable
    {
        return $this->end;
    }
}