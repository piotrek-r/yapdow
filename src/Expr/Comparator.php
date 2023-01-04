<?php

declare(strict_types=1);

namespace Yapdow\Expr;

readonly class Comparator implements Expression
{
    public function __construct(
        private Expression|string|int|float|bool|null $side1,
        private Expression|string|int|float|bool|null $side2,
        private string $operator,
    ) {
    }

    public function __toString(): string
    {
        return sprintf('%s %s %s', $this->side1, $this->operator, $this->side2);
    }
}
