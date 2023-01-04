<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

class DeleteStmt implements ChangeStatement
{
    use StatementHasLimit;
    use StatementHasOrder;
    use StatementHasParameters;
    use StatementHasWhere;

    public function __construct(private readonly string $tableName)
    {
    }

    public function __toString(): string
    {
        return implode(
            ' ',
            array_filter([
                'DELETE FROM',
                $this->tableName,
                $this->stringifyWhere(),
                $this->stringifyOrder(),
                $this->stringifyLimit(),
            ]),
        );
    }
}
