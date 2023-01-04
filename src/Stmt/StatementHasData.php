<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

use Yapdow\Expr\Expression;

trait StatementHasData
{
    private array $setData = [];

    public function set(string $columnName, Expression|string|int|float $value): static
    {
        $this->setData[$columnName] = $value;
        return $this;
    }

    protected function stringifySet(): string
    {
        if (count($this->setData) === 0) {
            return '';
        }

        $set = [];
        foreach ($this->setData as $key => $value) {
            $set[] = sprintf('%s = %s', $key, $value);
        }

        return 'SET ' . implode(', ', $set);
    }
}
