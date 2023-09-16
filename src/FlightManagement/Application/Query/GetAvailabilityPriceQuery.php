<?php

declare(strict_types=1);

namespace App\FlightManagement\Application\Query;

use App\Shared\Domain\Bus\Query\Query;

final class GetAvailabilityPriceQuery implements Query
{
    private function __construct(
        private readonly string $originCode,
        private readonly string $destinationCode,
        private readonly \DateTimeImmutable $start,
    ) {
    }

    public static function create(
        string $originCode,
        string $destinationCode,
        \DateTimeImmutable $start,
    ): self {
        return new self(
            $originCode,
            $destinationCode,
            $start
        );
    }

    public function getOriginCode(): string
    {
        return $this->originCode;
    }

    public function getDestinationCode(): string
    {
        return $this->destinationCode;
    }

    public function getStart(): \DateTimeImmutable
    {
        return $this->start;
    }
}
