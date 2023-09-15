<?php

declare(strict_types=1);

namespace App\FlightManagement\Domain\ValueObject;

final readonly class CodeName
{
    protected function __construct(
        private Code $code,
        private Name $name,
    )
    {
    }
    
    public static function create(
        Code $code,
        Name $name,
    ) : self {
        return new self(
            $code,
            $name
        );
    }

    public function getCode(): string
    {
        return $this->code->value();
    }

    public function getName(): string
    {
        return $this->name->value();
    }

}