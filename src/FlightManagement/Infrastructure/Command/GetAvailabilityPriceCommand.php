<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Command;

use App\FlightManagement\Application\Query\Response\GetAvailabilityPriceCollectionResponse;
use App\FlightManagement\Infrastructure\Api\Dto\GetAvailabilityPriceRequest;
use App\Shared\Domain\Exceptions\NotFoundException;
use App\Shared\Infrastructure\Command\BaseCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'lleego:avail',
    description: 'Availability Price.',
    hidden: false,
)]
final class GetAvailabilityPriceCommand extends BaseCommand
{
    protected static $defaultName = 'lleego:avail';

    protected function configure(): void
    {
        $this->setDescription('Description of your command')
            ->setHelp('Help for your command')
            ->addArgument(
                'origin',
                InputArgument::REQUIRED,
                'Origin code'
            )
            ->addArgument(
                'destination',
                InputArgument::REQUIRED,
                'Destination code'
            )
            ->addArgument(
                'date',
                InputArgument::REQUIRED,
                'Date'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $origin      = $input->getArgument('origin');
            $destination = $input->getArgument('destination');
            $date        = $input->getArgument('date');
            /** @var GetAvailabilityPriceRequest $availabilityPriceRequest */
            $availabilityPriceRequest = $this->deserialize(
                [
                    'origin'      => $origin,
                    'destination' => $destination,
                    'date'        => $date,
                ],
                GetAvailabilityPriceRequest::class,
            );
            /** @var GetAvailabilityPriceCollectionResponse $response */
            $response = $this->ask(
                $availabilityPriceRequest->mapToGetAvailabilityQuery()
            );

            $output->writeln(
                '<info>'.
                json_encode($response->items(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT)
                .'</info>'
            );

            return Command::SUCCESS;
        } catch (\Exception|\RuntimeException|NotFoundException $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');

            return Command::FAILURE;
        }
    }
}
