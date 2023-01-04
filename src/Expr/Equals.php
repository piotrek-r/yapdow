<?php

declare(strict_types=1);

namespace Yapdow\Expr;

readonly class Equals extends Comparator
{
    public function __construct(
        Expression|string|int|float|bool|null $side1,
        Expression|string|int|float|bool|null $side2,
    ) {
        parent::__construct($side1, $side2, '=');
    }
}
