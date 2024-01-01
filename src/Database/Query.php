<?php

namespace Masterfermin02\SimpleDataGrid\Database;

interface Query
{
    public function toString(): string;

    public function isSelect(): bool;
}
