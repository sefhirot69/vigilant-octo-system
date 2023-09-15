<?php

declare(strict_types=1);

namespace App\Tests\Functional\FlightManagement\Infrastructure\Api;


use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetAvailabilityPriceControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    /** @test */
    public function itShouldReturnAnOk(): void
    {
        // GIVEN

        // WHEN

        $this->client
            ->request(
                'GET',
                'api/avail',
            );

        $response = $this->client->getResponse();

        // THEN

        self::assertResponseIsSuccessful();
    }
}