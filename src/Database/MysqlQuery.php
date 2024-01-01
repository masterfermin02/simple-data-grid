<?php

namespace Masterfermin02\SimpleDataGrid\Database;

class MysqlQuery implements Query
{
    private array $where = [];

    public function __construct(
        public readonly string $table,
        public readonly array $columns = [],
    ) {}

    public function where(string $column, string $operator, string $value): self
    {
        if (empty($this->where)) {
            $this->where[] = "WHERE $column $operator '$value'";
            return $this;
        }

        $this->where[] = "AND $column $operator '$value'";
        return $this;
    }
    public function toString(): string
    {
        return "SELECT " . implode(",", $this->columns) . "
        FROM {$this->table}
        " . implode(" ", $this->where);
    }

    public function isSelect(): bool
    {
        return true;
    }
}
