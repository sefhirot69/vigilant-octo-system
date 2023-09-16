<?php

declare(strict_types=1);

namespace App\FlightManagement\Application\Query\Response;

use App\FlightManagement\Domain\Segment;
use App\Shared\Domain\Bus\Query\QueryResponse;

final class GetAvailabilityPriceCollectionResponse implements QueryResponse
{
    /**
     * @param array<int, GetAvailabilityPriceResponse> $responses
     */
    private function __construct(private array $responses = [])
    {
    }

    /**
     * @return GetAvailabilityPriceResponse[]
     */
    public function items(): array
    {
        return $this->responses;
    }

    /**
     * @param array<int, Segment> $segments
     *
     * @return self
     */
    public static function createFromSegments(array $segments): self
    {
        $collection = new self();

        foreach ($segments as $segment) {
            $response = GetAvailabilityPriceResponse::createFromSegment($segment);
            $collection->addResponse($response);
        }

        return $collection;
    }

    private function addResponse(GetAvailabilityPriceResponse $response): void
    {
        $this->responses[] = $response;
    }
}
