<?php

declare(strict_types=1);

use App\FlightManagement\Domain\Segment;
use App\FlightManagement\Domain\ValueObject\CodeName;
use App\FlightManagement\Domain\ValueObject\DateRange;
use App\FlightManagement\Domain\ValueObject\TransportNumber;
use App\Tests\Unit\FlightManagement\Domain\ValueObject\CodeNameMother;
use App\Tests\Unit\FlightManagement\Domain\ValueObject\DateRangeMother;
use App\Tests\Unit\FlightManagement\Domain\ValueObject\TransportNumberMother;

final class SegmentMother
{
    public static function create(
         CodeName        $originCodeName,
         CodeName        $destinationCodeName,
         DateRange       $dateRange,
         TransportNumber $transportNumber,
         CodeName        $companyCodeName,
    ): Segment
    {
        return Segment::create(
            $originCodeName,
            $destinationCodeName,
            $dateRange,
            $transportNumber,
            $companyCodeName
        );
    }

    public static function random(): Segment
    {
        return self::create(
            CodeNameMother::random(),
            CodeNameMother::random(),
            DateRangeMother::random(),
            TransportNumberMother::random(),
            CodeNameMother::random(),
        );
    }
}
