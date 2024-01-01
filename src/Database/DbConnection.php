<?php

namespace Masterfermin02\SimpleDataGrid\Database;

interface DbConnection
{
    public function query(Query $sql): QueryResult;

    public function execute(string $sql): void;

    public function getInsertId(): int;

    public function getAffectedRows(): int;

    public function getError(): string;

    public function getErrorNo(): int;

    public function getDebugLog(): array;

    public function close(): void;
}
