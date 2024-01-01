<?php

namespace Masterfermin02\SimpleDataGrid\Factories;

use Masterfermin02\SimpleDataGrid\Database\DbConnection;
use Masterfermin02\SimpleDataGrid\Database\MysqlDb;
use Masterfermin02\SimpleDataGrid\Enums\DbTypes;
use Masterfermin02\SimpleDataGrid\Exceptions\MysqliConnectException;

class DbConnectionFactory
{
    public function __construct(
        public readonly string $server,
        public readonly string $username,
        public readonly string $password,
        public readonly string $databaseName,
        public readonly bool $useADOdb = false,
        public readonly DbTypes $dbType = DbTypes::MYSQL,
        public readonly int $port =3306,
        public readonly string $sqlDataCoding = "",
    ) {}

    /**
     * @throws MysqliConnectException
     */
    public function create(): DbConnection
    {
        return new MysqlDb(
            $this->server,
            $this->username,
            $this->password,
            $this->databaseName,
            $this->port,
            $this->sqlDataCoding
        );
    }
}
