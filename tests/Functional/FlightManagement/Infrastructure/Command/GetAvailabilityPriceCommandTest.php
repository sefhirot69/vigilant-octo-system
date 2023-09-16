<?php

declare(strict_types=1);

namespace App\Tests\Functional\FlightManagement\Infrastructure\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class GetAvailabilityPriceCommandTest extends KernelTestCase
{
    /**
     * @test
     *
     * @dataProvider dataProvider
     */
    public function itExecuteCommand(
        bool $success,
        string $origin,
        string $destination,
        string $date,
    ): void {
        $kernel      = self::bootKernel();
        $application = new Application($kernel);

        $command       = $application->find('lleego:avail');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'origin'      => $origin,
            'destination' => $destination,
            'date'        => $date,
        ]);

        if ($success) {
            $commandTester->assertCommandIsSuccessful();

            // the output of the command in the console
            $output = $commandTester->getDisplay();
            $this->assertStringContainsString('Iberia', $output);
            $this->assertStringContainsString('Bilbao', $output);
            $this->assertStringContainsString('Madrid', $output);
        } else {
            $this->assertNotSame(0, $commandTester->getStatusCode());
        }
    }

    public static function dataProvider(): \Iterator
    {
        yield 'when not found availability price' => [
            'success'     => false,
            'origin'      => 'MAD',
            'destination' => 'BIO',
            'date'        => '2023-06-01',
        ];

        yield 'when found availability price' => [
            'success'     => true,
            'origin'      => 'MAD',
            'destination' => 'BIO',
            'date'        => '2022-06-01',
        ];
    }
}
