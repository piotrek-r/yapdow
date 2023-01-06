<?php

declare(strict_types=1);

namespace Yapdow;

use Yapdow\Stmt\ChangeStatement;
use Yapdow\Stmt\SelectStmt;
use PDO;
use PDOException;
use PDOStatement;

final readonly class Database
{
    public static function fromPDODetails(
        string $dsn,
        string $username = null,
        string $password = null,
        array  $pdoOptions = null,
    ): Database
    {
        $pdo = new PDO($dsn, $username, $password, $pdoOptions);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return new Database($pdo);
    }

    public function __construct(private PDO $pdo)
    {
    }

    public function execute(ChangeStatement $statement): ChangeResult
    {
        $stmt = $this->prepare($statement->__toString(), $statement->getParameters());

        try {
            $stmt->execute();
            $lastInsertId = $this->pdo->lastInsertId() ?: null;
        } catch (PDOException $e) {
            throw new Exception\DatabaseExecuteException($e->getMessage(), 0, $e);
        }

        $statementType = get_debug_type($statement);
        return match ($statementType) {
            Stmt\InsertStmt::class => new ChangeResult(1, $lastInsertId),
            Stmt\UpdateStmt::class,
            Stmt\DeleteStmt::class => new ChangeResult($stmt->rowCount(), null),
            default => throw new Exception\DatabaseExecuteException('Unknown statement type: ' . $statementType),
        };
    }

    public function fetchAll(SelectStmt $statement): array
    {
        try {
            $stmt = $this->prepare($statement->__toString(), $statement->getParameters());
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception\DatabaseFetchException($e->getMessage(), 0, $e);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function map(SelectStmt $statement, callable $fn): array
    {
        return array_map($fn, $this->fetchAll($statement));
    }

    public function executeRawSQL(string $sql, array $parameters = []): PDOStatement
    {
        try {
            $stmt = $this->prepare($sql, $parameters);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception\DatabaseExecuteException($e->getMessage(), 0, $e);
        }

        return $stmt;
    }

    private function prepare(string $sql, array $parameters): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);

        foreach ($parameters as $paramName => &$paramValue) {
            $stmt->bindParam($paramName, $paramValue);
        }

        return $stmt;
    }
}
