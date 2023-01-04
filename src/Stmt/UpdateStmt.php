<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

class UpdateStmt implements ChangeStatement
{
    use StatementHasData;
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
                'UPDATE',
                $this->tableName,
                $this->stringifySet(),
                $this->stringifyWhere(),
                $this->stringifyOrder(),
                $this->stringifyLimit(),
            ]),
        );
    }
}
