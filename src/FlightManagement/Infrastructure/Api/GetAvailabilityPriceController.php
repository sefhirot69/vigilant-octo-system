<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Api;

use App\FlightManagement\Application\Query\GetAvailabilityPriceQuery;
use App\FlightManagement\Infrastructure\Api\Dto\GetAvailabilityPriceRequest;
use App\Shared\Infrastructure\Api\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetAvailabilityPriceController extends BaseController
{
    public function __invoke(Request $request): Response
    {
        // TODO refactor deserialize dto and validation
        $originCode      = $request->query->get('origin');
        $destinationCode = $request->query->get('destination');
        $start           = $request->query->get('date');

        /** @var GetAvailabilityPriceRequest $availabilityPriceRequest */
        $availabilityPriceRequest = $this->deserialize(
            $request,
            GetAvailabilityPriceRequest::class,
        );

        $queryResult = $this->ask(
            $availabilityPriceRequest->mapToGetAvailabilityQuery()
        );

        return new Response();
    }

    protected function exceptions(): array
    {
        return [];
    }
}
