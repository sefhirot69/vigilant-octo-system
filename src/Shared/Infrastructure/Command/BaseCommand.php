<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Command;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\QueryResponse;
use Symfony\Component\Console\Command\Command;

class BaseCommand extends Command
{
    public function __construct(
        protected readonly QueryBusInterface $queryBus,
    ) {
        parent::__construct();
    }

    public function ask(Query $query): ?QueryResponse
    {
        return $this->queryBus->ask($query);
    }
}
