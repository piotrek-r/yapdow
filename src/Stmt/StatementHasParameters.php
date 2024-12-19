<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

trait StatementHasParameters
{
    private const PARAMETER_NAME_PREFIX = ':yap';

    private int $parameterIndex = 0;

    /**
     * @var list<Parameter>
     */
    private array $parameters = [];

    public function createParameter(mixed $value, int $type = null): string
    {
        $parameterName = sprintf('%s%d', self::PARAMETER_NAME_PREFIX, ++$this->parameterIndex);
        if ($type === null) {
            $type = $this->detectType($value);
        }
        $parameter = new Parameter($parameterName, $value, $type);
        $this->parameters[] = $parameter;
        return $parameterName;
    }

    /**
     * @return list<Parameter>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    private function detectType(mixed $value): int
    {
        return match (true) {
            is_null($value) => Parameter::PARAM_NULL,
            is_int($value) => Parameter::PARAM_INT,
            is_bool($value) => Parameter::PARAM_BOOL,
            default => Parameter::PARAM_STR,
        };
    }
}
