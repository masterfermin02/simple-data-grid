<?php

namespace Masterfermin02\SimpleDataGrid\Database;

class MysqlQueryResult implements QueryResult
{
    public function __construct(
        public readonly \Iterator $data,
        public readonly int $affectedRows,
        public readonly int $insertId,
        public readonly string $error,
        public readonly int $errorNo,
        public readonly array $debugLog,
    ) {
    }

    public static function create(
        \Iterator $data,
        int $affectedRows = 0,
        int $insertId = 0,
        string $error = "",
        int $errorNo = 0,
        array $debugLog = [],
    ): self
    {
        return new self($data, $affectedRows, $insertId, $error, $errorNo, $debugLog);
    }

    public function addNumRows(int $numRows): self
    {
        return new self(
            $this->data,
            $numRows,
            $this->insertId,
            $this->error,
            $this->errorNo,
            $this->debugLog,
        );
    }

    public function getAffectedRows(): int
    {
        return $this->affectedRows;
    }

    public function getIterator(): \Iterator
    {
        return $this->data;
    }

    public function getData(): array
    {
        return iterator_to_array($this->data);
    }
}
