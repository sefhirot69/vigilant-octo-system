<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api;

use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Command\CommandBusInterface;
use App\Shared\Domain\Bus\Command\CommandResponse;
use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\QueryResponse;
use App\Shared\Infrastructure\Exceptions\SymfonyExceptionsHttpStatusCodeMapping;

use function Lambdish\Phunctional\each;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

abstract class BaseController extends AbstractController
{
    public function __construct(
        SymfonyExceptionsHttpStatusCodeMapping $exceptionMapping,
        protected readonly CommandBusInterface $commandBus,
        protected readonly QueryBusInterface $queryBus,
        protected readonly SerializerInterface $serializer,
    ) {
        each(
            fn (int $httpCode, string $exceptionClass) => $exceptionMapping->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    public function ask(Query $query): ?QueryResponse
    {
        return $this->queryBus->ask($query);
    }

    public function dispatch(Command $command): ?CommandResponse
    {
        return $this->commandBus->dispatch($command);
    }

    protected function deserialize(Request $request, string $class): mixed
    {
        $content = null;

        if ('json' === $request->getContentTypeFormat() || !empty($request->getContent())) {
            $content = $request->getContent();
        } elseif (!empty($request->request->all())) {
            $content = json_encode($request->request->all(), JSON_THROW_ON_ERROR);
        } elseif (!empty($request->query->all())) {
            $content = json_encode($request->query->all(), JSON_THROW_ON_ERROR);
        }

        return $this->serializer->deserialize(
            $content,
            $class,
            'json'
        );
    }

    abstract protected function exceptions(): array;
}
