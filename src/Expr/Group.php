<?php

declare(strict_types=1);

namespace Yapdow\Expr;

readonly abstract class Group implements Expression
{
    protected array $values;

    public function __construct(Expression|string|int|float|bool|null ...$values)
    {
        $this->values = $values;
    }

    public function __toString(): string
    {
        if (count($this->values) === 0) {
            return '';
        }

        return sprintf(
            '(%s)',
            implode(
                $this->getSeparator(),
                array_map(
                    fn($value) => (string)$value,// todo bool? null?
                    $this->values,
                ),
            ),
        );
    }

    abstract protected function getSeparator(): string;
}
