<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/Database.php';

/**
 * Reusable PDO CRUD operations.
 *
 * Table and column names are defined only in trusted DAO subclasses.
 * Values are always passed as prepared-statement parameters.
 */
abstract class BaseDao
{
    protected PDO $connection;
    protected string $table;
    protected string $primaryKey;
    /** @var list<string> */
    protected array $allowedColumns;

    public function __construct(?PDO $connection = null)
    {
        $this->connection = $connection ?? Database::getConnection();
    }

    /** @return list<array<string, mixed>> */
    public function findAll(): array
    {
        $sql = sprintf(
            'SELECT * FROM `%s` ORDER BY `%s` DESC',
            $this->identifier($this->table),
            $this->identifier($this->primaryKey)
        );

        return $this->connection->query($sql)->fetchAll();
    }

    /** @return array<string, mixed>|null */
    public function findById(int $id): ?array
    {
        $sql = sprintf(
            'SELECT * FROM `%s` WHERE `%s` = :id LIMIT 1',
            $this->identifier($this->table),
            $this->identifier($this->primaryKey)
        );
        $statement = $this->connection->prepare($sql);
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        return $row === false ? null : $row;
    }

    /**
     * Insert a row and return its generated primary key.
     * @param array<string, mixed> $data
     */
    public function create(array $data): int
    {
        $data = $this->filterData($data);
        if ($data === []) {
            throw new InvalidArgumentException('At least one valid field is required.');
        }

        $columns = array_keys($data);
        $quotedColumns = array_map(fn(string $column): string => '`' . $this->identifier($column) . '`', $columns);
        $placeholders = array_map(fn(string $column): string => ':' . $column, $columns);

        $sql = sprintf(
            'INSERT INTO `%s` (%s) VALUES (%s)',
            $this->identifier($this->table),
            implode(', ', $quotedColumns),
            implode(', ', $placeholders)
        );

        $statement = $this->connection->prepare($sql);
        $statement->execute($data);

        return (int)$this->connection->lastInsertId();
    }

    /**
     * Update a row. Returns true when at least one row was changed.
     * @param array<string, mixed> $data
     */
    public function update(int $id, array $data): bool
    {
        $data = $this->filterData($data);
        if ($data === []) {
            throw new InvalidArgumentException('At least one valid field is required.');
        }

        $assignments = [];
        $parameters = ['__id' => $id];
        foreach ($data as $column => $value) {
            $assignments[] = '`' . $this->identifier($column) . '` = :' . $column;
            $parameters[$column] = $value;
        }

        $sql = sprintf(
            'UPDATE `%s` SET %s WHERE `%s` = :__id',
            $this->identifier($this->table),
            implode(', ', $assignments),
            $this->identifier($this->primaryKey)
        );

        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);

        return $statement->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        $sql = sprintf(
            'DELETE FROM `%s` WHERE `%s` = :id',
            $this->identifier($this->table),
            $this->identifier($this->primaryKey)
        );
        $statement = $this->connection->prepare($sql);
        $statement->execute(['id' => $id]);

        return $statement->rowCount() > 0;
    }

    /** @param array<string, mixed> $data
     *  @return array<string, mixed>
     */
    protected function filterData(array $data): array
    {
        $filtered = [];
        foreach ($data as $column => $value) {
            if (in_array($column, $this->allowedColumns, true)) {
                $filtered[$column] = $value;
            }
        }

        return $filtered;
    }

    private function identifier(string $identifier): string
    {
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $identifier)) {
            throw new InvalidArgumentException('Invalid SQL identifier.');
        }

        return $identifier;
    }
}
