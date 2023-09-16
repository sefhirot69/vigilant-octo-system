<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Api;

use App\FlightManagement\Application\Query\GetAvailabilityPriceQuery;
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

        $queryResult = $this->ask(
            GetAvailabilityPriceQuery::create(
                $originCode,
                $destinationCode,
                new \DateTimeImmutable($start)
            )
        );

        return new Response();
    }

    protected function exceptions(): array
    {
        return [];
    }
}
