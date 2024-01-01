<?php

namespace Masterfermin02\SimpleDataGrid\Exceptions;

use Exception;

class MysqliConnectException extends Exception
{
    public function __construct(
        public readonly string $server,
        public readonly string $username,
        public readonly string $password,
        public readonly string $databaseName,
        public readonly string $error,
    ) {
        parent::__construct("Error connecting to database: {$this->error}");
    }
}
