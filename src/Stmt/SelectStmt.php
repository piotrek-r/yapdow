<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

use Yapdow\Expr\Expression;

class SelectStmt implements Statement
{
    use StatementHasLimit;
    use StatementHasOffset;
    use StatementHasOrder;
    use StatementHasParameters;
    use StatementHasWhere;

    private array $columns = [];

    public function __construct(private readonly ?string $tableName = null)
    {
    }

    public function field(Expression|string $field, string $alias = null): static
    {
        $fieldValue = (string)$field;

        if ($alias !== null) {
            $fieldValue .= ' AS ' . $alias;
        }

        $this->columns[] = $fieldValue;

        return $this;
    }

    public function __toString(): string
    {
        // todo joins

        return implode(
            ' ',
            array_filter([
                'SELECT',
                $this->stringifyColumns(),
                $this->tableName ? 'FROM ' . $this->tableName : '',
                $this->stringifyWhere(),
                // todo group by
                $this->stringifyOrder(),
                $this->stringifyLimit(),
                $this->stringifyOffset(),
            ]),
        );
    }

    protected function stringifyColumns(): string
    {
        if (count($this->columns) === 0) {
            return '';
        }

        return implode(', ', $this->columns);
    }
}
