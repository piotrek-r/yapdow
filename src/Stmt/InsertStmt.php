<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

class InsertStmt implements ChangeStatement
{
    use StatementHasData;
    use StatementHasParameters;

    public function __construct(private readonly string $tableName)
    {
    }

    public function __toString(): string
    {
        return implode(
            ' ',
            array_filter([
                'INSERT INTO',
                $this->tableName,
                $this->stringifySet(),
            ]),
        );
    }
}
