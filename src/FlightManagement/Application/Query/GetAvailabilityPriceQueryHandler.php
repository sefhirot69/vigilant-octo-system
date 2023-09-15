<?php

declare(strict_types=1);

use App\FlightManagement\Domain\SegmentFindRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\QueryResponse;

final class GetAvailabilityPriceQueryHandler implements QueryHandler
{

    public function __construct(
        private SegmentFindRepository $segmentFindRepository,
    )
    {
    }

    public function __invoke(GetAvailabilityPriceQuery $query): QueryResponse
    {
        $originCode = $query->getOriginCode();
        $destinationCode = $query->getDestinationCode();
        $start = $query->getStart();
    }
}