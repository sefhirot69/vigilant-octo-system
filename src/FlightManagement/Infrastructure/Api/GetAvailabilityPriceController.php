<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Api;

use App\Controller\Shared\BaseController;
use Symfony\Component\HttpFoundation\Response;

final class GetAvailabilityPriceController extends BaseController
{

    public function __invoke(): Response
    {

        return new Response();
    }

    protected function exceptions(): array
    {
        return [];
    }
}