<?php

declare(strict_types=1);

namespace Yapdow\Stmt;

use PDO;

readonly class Parameter
{
    public const PARAM_NULL = PDO::PARAM_NULL;
    public const PARAM_INT = PDO::PARAM_INT;
    public const PARAM_STR = PDO::PARAM_STR;
    public const PARAM_LOB = PDO::PARAM_LOB;
    public const PARAM_STMT = PDO::PARAM_STMT;
    public const PARAM_BOOL = PDO::PARAM_BOOL;
    public const PARAM_STR_NATL = PDO::PARAM_STR_NATL;
    public const PARAM_STR_CHAR = PDO::PARAM_STR_CHAR;

    public function __construct(
        private string $name,
        private mixed $value,
        private int $type,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getType(): int
    {
        return $this->type;
    }
}
