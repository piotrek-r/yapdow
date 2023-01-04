<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

use Stringable;

interface Statement extends Stringable
{
    public function createParameter(mixed $value): string;

    public function getParameters(): array;
}
