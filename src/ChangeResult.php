<?php

declare(strict_types=1);

namespace Yapdow;

readonly class ChangeResult
{
    public function __construct(private int|null $rowCount, private string|null $insertedId)
    {
    }

    public function getRowCount(): ?int
    {
        return $this->rowCount;
    }

    public function getInsertedId(): string|null
    {
        return $this->insertedId;
    }
}
