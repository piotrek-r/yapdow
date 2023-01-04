<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

trait StatementHasOffset
{
    private ?int $offset = null;

    public function offset(?int $offset): static
    {
        $this->offset = $offset;
        return $this;
    }

    protected function stringifyOffset(): string
    {
        if ($this->offset === null) {
            return '';
        }

        return 'OFFSET ' . $this->offset;
    }
}
