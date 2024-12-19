<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

use Stringable;

interface Statement extends Stringable
{
    public function createParameter(mixed $value, int $type = null): string;

    public function getParameters(): array;
}
