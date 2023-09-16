<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Command;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\QueryResponse;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Serializer\SerializerInterface;

class BaseCommand extends Command
{
    protected static $defaultName = 'command:default';

    public function __construct(
        protected readonly QueryBusInterface $queryBus,
        protected readonly SerializerInterface $serializer,
    ) {
        parent::__construct();
    }

    public function ask(Query $query): ?QueryResponse
    {
        return $this->queryBus->ask($query);
    }

    protected function deserialize(array $data, string $class): mixed
    {
        $content = json_encode($data, JSON_THROW_ON_ERROR);

        return $this->serializer->deserialize(
            $content,
            $class,
            'json'
        );
    }
}
