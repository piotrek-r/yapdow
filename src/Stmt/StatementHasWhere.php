<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

use Yapdow\Expr\AndGroup;
use Yapdow\Expr\Expression;

trait StatementHasWhere
{
    private Expression|string|null $where = null;

    public function where(Expression|string ...$where): static
    {
        $this->where = new AndGroup(...$where);
        return $this;
    }

    protected function stringifyWhere(): string
    {
        if ($this->where === null) {
            return '';
        }

        return 'WHERE ' . $this->where;
    }
}
