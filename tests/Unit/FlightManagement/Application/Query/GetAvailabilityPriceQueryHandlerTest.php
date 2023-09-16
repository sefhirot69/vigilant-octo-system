<?php

declare(strict_types=1);

namespace App\Tests\Unit\FlightManagement\Application\Query;

use App\FlightManagement\Application\Query\GetAvailabilityPriceQuery;
use App\FlightManagement\Application\Query\GetAvailabilityPriceQueryHandler;
use App\FlightManagement\Application\Query\Response\GetAvailabilityPriceCollectionResponse;
use App\FlightManagement\Domain\SegmentFindRepository;
use App\Shared\Domain\Exceptions\NotFoundException;
use App\Tests\Unit\FlightManagement\Domain\SegmentMother;
use App\Tests\Unit\FlightManagement\Domain\ValueObject\CodeMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GetAvailabilityPriceQueryHandlerTest extends TestCase
{
    private MockObject|SegmentFindRepository $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(SegmentFindRepository::class);
    }

    /** @test */
    public function itShouldFindSegments(): void
    {
        // GIVEN

        $originCodeExpected      = CodeMother::random();
        $destinationCodeExpected = CodeMother::random();
        $dateExpected            = new \DateTimeImmutable();
        $queryExpected           = GetAvailabilityPriceQuery::create(
            $originCodeExpected->value(),
            $destinationCodeExpected->value(),
            $dateExpected,
        );

        $segmentsExpected = [
            SegmentMother::random(),
            SegmentMother::random(),
        ];

        // WHEN

        $this->repository
            ->expects(self::once())
            ->method('findBy')
            ->with($originCodeExpected, $destinationCodeExpected, $dateExpected)
            ->willReturn($segmentsExpected);

        $queryHandler = new GetAvailabilityPriceQueryHandler($this->repository);
        $response     = ($queryHandler)($queryExpected);

        // THEN

        self::assertInstanceOf(GetAvailabilityPriceCollectionResponse::class, $response);
    }

    /** @test */
    public function itShouldThrownAnExceptionWhenNotFoundSegments(): void
    {
        // THEN

        $this->expectException(NotFoundException::class);

        // GIVEN

        $originCodeExpected      = CodeMother::random();
        $destinationCodeExpected = CodeMother::random();
        $dateExpected            = new \DateTimeImmutable();
        $queryExpected           = GetAvailabilityPriceQuery::create(
            $originCodeExpected->value(),
            $destinationCodeExpected->value(),
            $dateExpected,
        );

        $segmentsExpected = [];

        // WHEN

        $this->repository
            ->expects(self::once())
            ->method('findBy')
            ->with($originCodeExpected, $destinationCodeExpected, $dateExpected)
            ->willReturn($segmentsExpected);

        $queryHandler = new GetAvailabilityPriceQueryHandler($this->repository);
        ($queryHandler)($queryExpected);
    }
}
