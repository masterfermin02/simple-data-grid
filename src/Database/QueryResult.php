<?php

namespace Masterfermin02\SimpleDataGrid\Database;

interface QueryResult
{
    public function addRow(array $row): self;

    public function addNumRows(int $numRows): self;

    public function getData(): array;

    public function getAffectedRows(): int;
}
