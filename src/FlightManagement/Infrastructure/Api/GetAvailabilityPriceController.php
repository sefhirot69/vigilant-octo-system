<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Api;

use App\FlightManagement\Application\Query\Response\GetAvailabilityPriceCollectionResponse;
use App\FlightManagement\Infrastructure\Api\Dto\GetAvailabilityPriceRequest;
use App\Shared\Domain\Exceptions\NotFoundException;
use App\Shared\Infrastructure\Api\BaseController;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetAvailabilityPriceController extends BaseController
{
    public function __invoke(Request $request): Response
    {
        /** @var GetAvailabilityPriceRequest $availabilityPriceRequest */
        $availabilityPriceRequest = $this->deserialize(
            $request,
            GetAvailabilityPriceRequest::class,
        );

        /** @var GetAvailabilityPriceCollectionResponse $queryResult */
        $queryResult = $this->ask(
            $availabilityPriceRequest->mapToGetAvailabilityQuery()
        );

        return new JsonResponse(
            $queryResult->items()
        );
    }

    protected function exceptions(): array
    {
        return [
            NotFoundException::class => Response::HTTP_NOT_FOUND,
            RuntimeException::class => Response::HTTP_INTERNAL_SERVER_ERROR,
        ];
    }
}
