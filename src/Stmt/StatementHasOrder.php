<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

use Yapdow\Expr\Expression;

trait StatementHasOrder
{
    private array $orders = [];

    public function orderBy(Expression|string $expression, OrderDirection $direction): static
    {
        $this->orders[] = [$expression, $direction];
        return $this;
    }

    protected function stringifyOrder(): string
    {
        if (count($this->orders) === 0) {
            return '';
        }

        $orders = [];
        foreach ($this->orders as $order) {
            $orderValue = (string)$order[0];
            if ($order[1] === OrderDirection::Descending) {
                $orderValue .= ' DESC';
            }
            $orders[] = $orderValue;
        }

        return 'ORDER BY ' . implode(', ', $orders);
    }
}
