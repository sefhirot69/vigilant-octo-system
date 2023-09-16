<?php

namespace App\FlightManagement\Domain;

use App\FlightManagement\Domain\ValueObject\Code;

interface SegmentFindRepository
{
    /**
     * @return array<int, Segment>
     *                             TODO esto deberia de ser un Criteria Pattern
     */
    public function findBy(
        Code $originCode,
        Code $destinationCode,
        \DateTimeImmutable $start,
    ): array;
}
