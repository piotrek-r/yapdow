<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

trait StatementHasLimit
{
    private ?int $limit = null;

    public function limit(?int $limit): static
    {
        $this->limit = $limit;
        return $this;
    }

    protected function stringifyLimit(): string
    {
        if ($this->limit === null) {
            return '';
        }

        return 'LIMIT ' . $this->limit;
    }
}
