<?php

declare(strict_types=1);

namespace App\FlightManagement\Infrastructure\Repository;

use App\FlightManagement\Domain\SegmentFindRepository;
use App\FlightManagement\Domain\ValueObject\Code;

final class InMemorySegmentFindRepository implements SegmentFindRepository
{
    private string $content;

    public function __construct()
    {
        $this->content = file_get_contents('/var/www/html/src/FlightManagement/Infrastructure/Stub/data.xml');
    }

    public function findBy(
        Code $originCode,
        Code $destinationCode,
        \DateTimeImmutable $start,
    ): array
    {
        return [];
    }
}