<?php

namespace Masterfermin02\SimpleDataGrid\Database;

class AdoDb
{
    private array $debugLog = [];

    public function __construct(
        public readonly string $server,
        public readonly string $username,
        public readonly string $password,
        public readonly string $databaseName,
        public readonly bool $debug = false,
    ) {
    }
}
