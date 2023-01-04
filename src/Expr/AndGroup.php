<?php

declare(strict_types=1);

namespace Yapdow\Expr;

readonly class AndGroup extends Group
{
    protected function getSeparator(): string
    {
        return ' AND ';
    }
}
