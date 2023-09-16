<?php

declare(strict_types=1);

namespace App\FlightManagement\Application\Query;

use App\FlightManagement\Application\Query\Response\GetAvailabilityPriceCollectionResponse;
use App\FlightManagement\Domain\SegmentFindRepository;
use App\FlightManagement\Domain\ValueObject\Code;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\QueryResponse;
use App\Shared\Domain\Exceptions\NotFoundException;

final class GetAvailabilityPriceQueryHandler implements QueryHandler
{
    public function __construct(
        private SegmentFindRepository $segmentFindRepository,
    ) {
    }

    public function __invoke(GetAvailabilityPriceQuery $query): QueryResponse
    {
        $originCode      = Code::fromString($query->getOriginCode());
        $destinationCode = Code::fromString($query->getDestinationCode());
        $start           = $query->getStart();

        $segments = $this->segmentFindRepository->findBy($originCode, $destinationCode, $start);

        if (empty($segments)) {
            throw new NotFoundException('No availability price');
        }

        return GetAvailabilityPriceCollectionResponse::createFromSegments($segments);
    }
}
