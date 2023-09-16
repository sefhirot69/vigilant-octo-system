<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Api\Dto;

use App\FlightManagement\Application\Query\GetAvailabilityPriceQuery;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\Constraints as Assert;

final class GetAvailabilityPriceRequest
{
    public function __construct(
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        private readonly ?string $origin = null,
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        private readonly ?string $destination = null,
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        #[Assert\DateTime(format: 'Y-m-d')]
        private readonly ?string $date = null,
    ) {
    }

    public function mapToGetAvailabilityQuery(): GetAvailabilityPriceQuery
    {
        if (
            null === $this->origin ||
            null === $this->destination ||
            null === $this->date
        ) {
            throw new BadRequestException('Fields origin|destination|date are required');
        }

        return GetAvailabilityPriceQuery::create(
            $this->origin,
            $this->destination,
            new \DateTimeImmutable($this->date)
        );
    }
}
