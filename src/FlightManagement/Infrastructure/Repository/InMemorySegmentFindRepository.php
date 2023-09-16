<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Repository;

use App\FlightManagement\Domain\Segment;
use App\FlightManagement\Domain\SegmentFindRepository;
use App\FlightManagement\Domain\ValueObject\Code;
use App\FlightManagement\Domain\ValueObject\CodeName;
use App\FlightManagement\Domain\ValueObject\DateRange;
use App\FlightManagement\Domain\ValueObject\TransportNumber;

/**
 * TODO ¿todavía se siguen usando los servicios SOAP? Estamos en el 2023.
 */
final class InMemorySegmentFindRepository implements SegmentFindRepository
{
    private string $content;

    public function __construct()
    {
        $content = file_get_contents('/var/www/html/src/FlightManagement/Infrastructure/Stub/data.xml');

        if (false !== $content) {
            $this->content = $content;
        } else {
            throw new \RuntimeException('It was not possible to read the XML file');
        }
    }

    public function findBy(
        Code $originCode,
        Code $destinationCode,
        \DateTimeImmutable $start,
    ): array {
        try {
            $dataFromXml = new \SimpleXMLElement($this->content);

            $flightSegmentList = $dataFromXml->DataLists->FlightSegmentList;

            $result = [];

            foreach ($flightSegmentList->FlightSegment as $flightSegment) {
                $originAirportCode      = (string) $flightSegment->Departure->AirportCode;
                $destinationAirportCode = (string) $flightSegment->Arrival->AirportCode;
                $originStart            = (string) $flightSegment->Departure->Date;
                if (
                    $originAirportCode === $originCode->value() &&
                    $destinationAirportCode === $destinationCode->value() &&
                    $originStart === $start->format('Y-m-d')
                ) {
                    $originAirportName      = (string) $flightSegment->Departure->AirportName;
                    $destinationAirportName = (string) $flightSegment->Arrival->AirportName;
                    $originStartTime        = (string) $flightSegment->Departure->Time;
                    $destinationEnd         = (string) $flightSegment->Arrival->Date;
                    $destinationEndTime     = (string) $flightSegment->Arrival->Time;
                    $transportNumber        = (string) $flightSegment->Departure->Terminal->Name;
                    $companyCode            = (string) $flightSegment->OperatingCarrier->AirlineID;
                    $companyName            = (string) $flightSegment->OperatingCarrier->Name;

                    $result[] = Segment::create(
                        CodeName::create(
                            $originAirportCode,
                            $originAirportName
                        ),
                        CodeName::create(
                            $destinationAirportCode,
                            $destinationAirportName
                        ),
                        DateRange::create(
                            new \DateTimeImmutable(
                                $originStart.' '.$originStartTime,
                            ),
                            new \DateTimeImmutable(
                                $destinationEnd.' '.$destinationEndTime,
                            )
                        ),
                        TransportNumber::fromString(
                            $transportNumber
                        ),
                        CodeName::create(
                            $companyCode,
                            $companyName
                        )
                    );
                }
            }

            return $result;
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
