<?php

declare(strict_types=1);

namespace Yapdow\Expr;

readonly class Funct implements Expression
{
    private array $values;

    public function __construct(private string $name, Expression|string|int|float|bool|null ...$values)
    {
        $this->values = $values;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s(%s)',
            strtoupper($this->name),
            implode(
                ', ',
                array_map(
                    fn($value) => (string)$value,// todo bool? null?
                    $this->values,
                ),
            ),
        );
    }
}