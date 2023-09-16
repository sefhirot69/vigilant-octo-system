<?php

declare(strict_types=1);

namespace App\FlightManagement\Application\Query\Response;

use App\FlightManagement\Domain\Segment;
use App\Shared\Domain\Bus\Query\QueryResponse;

final class GetAvailabilityPriceResponse implements QueryResponse, \JsonSerializable
{
    private function __construct(
        private readonly string $originCode,
        private readonly string $originName,
        private readonly string $destinationCode,
        private readonly string $destinationName,
        private readonly \DateTimeImmutable $start,
        private readonly \DateTimeImmutable $end,
        private readonly string $transportNumber,
        private readonly string $companyCode,
        private readonly string $companyName,
    ) {
    }

    public static function createFromSegment(Segment $segment): self
    {
        return new self(
            $segment->getOriginCode(),
            $segment->getOriginName(),
            $segment->getDestinationCode(),
            $segment->getDestinationName(),
            $segment->getStart(),
            $segment->getEnd(),
            $segment->getTransportNumber(),
            $segment->getCompanyCode(),
            $segment->getCompanyName()
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
