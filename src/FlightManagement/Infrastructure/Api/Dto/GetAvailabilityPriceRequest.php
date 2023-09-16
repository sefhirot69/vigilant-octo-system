<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Api\Dto;

use App\FlightManagement\Application\Query\GetAvailabilityPriceQuery;

final class GetAvailabilityPriceRequest
{
    public function __construct(
        private readonly string $origin,
        private readonly string $destination,
        private readonly \DateTimeImmutable $date,
    ) {
    }

    public function mapToGetAvailabilityQuery(): GetAvailabilityPriceQuery
    {
        return GetAvailabilityPriceQuery::create(
            $this->origin,
            $this->destination,
            $this->date
        );
    }
}
