<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

trait StatementHasParameters
{
    private const PARAMETER_NAME_PREFIX = ':yap';

    private int $parameterIndex = 0;

    private array $parameters = [];

    public function createParameter(mixed $value): string
    {
        $parameterName = sprintf('%s%d', self::PARAMETER_NAME_PREFIX, ++$this->parameterIndex);
        $this->parameters[$parameterName] = $value;
        return $parameterName;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
