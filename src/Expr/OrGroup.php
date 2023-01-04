<?php

declare(strict_types=1);

namespace Yapdow\Expr;

readonly class OrGroup extends Group
{
    protected function getSeparator(): string
    {
        return ' OR ';
    }
}
