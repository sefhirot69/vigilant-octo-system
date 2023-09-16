<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Command;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\QueryResponse;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseCommand extends Command
{
    protected static $defaultName = 'command:default';

    public function __construct(
        protected readonly QueryBusInterface $queryBus,
        protected readonly SerializerInterface $serializer,
        protected readonly ValidatorInterface $validator,
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

    protected function validationData(array $data, string $class): mixed
    {
        $objectDto = $this->deserialize($data, $class);

        $validationErrors = $this->validator->validate($objectDto);

        if ($validationErrors->count() > 0) {
            throw new ValidationFailedException($objectDto::class, $validationErrors);
        }

        return $objectDto;
    }
}
