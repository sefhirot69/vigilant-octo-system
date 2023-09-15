<?php

declare(strict_types=1);

namespace App\FlightManagement\Domain;

use App\FlightManagement\Domain\ValueObject\CodeName;
use App\FlightManagement\Domain\ValueObject\DateRange;
use App\FlightManagement\Domain\ValueObject\TransportNumber;

final readonly class Segment
{
    private function __construct(
        private CodeName $originCodeName,
        private CodeName $destinationCodeName,
        private DateRange $dateRange,
        private TransportNumber $transportNumber,
        private CodeName $companyCodeName,
    ) {
    }

    public function getOriginCode(): string
    {
        return $this->originCodeName->getCode();
    }

    public function getOriginName(): string
    {
        return $this->originCodeName->getName();
    }

    public function getDestinationCode(): string
    {
        return $this->destinationCodeName->getCode();
    }

    public function getDestinationName(): string
    {
        return $this->destinationCodeName->getName();
    }

    public function getStart(): \DateTimeImmutable
    {
        return $this->dateRange->getStart();
    }

    public function getEnd(): \DateTimeImmutable
    {
        return $this->dateRange->getEnd();
    }

    public function getTransportNumber(): string
    {
        return $this->transportNumber->value();
    }

    public function getCompanyCode(): string
    {
        return $this->companyCodeName->getCode();
    }

    public function getCompanyName(): string
    {
        return $this->companyCodeName->getName();
    }

    public static function create(
        CodeName $originCodeName,
        CodeName $destinationCodeName,
        DateRange $dateRange,
        TransportNumber $transportNumber,
        CodeName $companyCodeName,
    ): self {
        return new self(
            $originCodeName,
            $destinationCodeName,
            $dateRange,
            $transportNumber,
            $companyCodeName
        );
    }
}
