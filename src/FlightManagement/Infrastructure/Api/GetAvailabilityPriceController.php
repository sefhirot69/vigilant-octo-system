<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Api;

use App\Controller\Shared\BaseController;
use Symfony\Component\HttpFoundation\Response;

final class GetAvailabilityPriceController extends BaseController
{

    public function __invoke(): Response
    {

        $xmlContent = file_get_contents('/var/www/html/var/sopa.xml');

        $xmlData = new \SimpleXMLElement($xmlContent);

        return new Response();
    }

    protected function exceptions(): array
    {
        return [];
    }
}