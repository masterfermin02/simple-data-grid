<?php

namespace Masterfermin02\SimpleDataGrid;

use Masterfermin02\SimpleDataGrid\Component\Table;
use Masterfermin02\SimpleDataGrid\Database\DbConnection;
use Masterfermin02\SimpleDataGrid\Database\MysqlQuery;
use Masterfermin02\SimpleDataGrid\Database\Query;
use Masterfermin02\SimpleDataGrid\Enums\DbTypes;
use Masterfermin02\SimpleDataGrid\Exceptions\MysqliConnectException;
use Masterfermin02\SimpleDataGrid\Factories\DbConnectionFactory;

class SimpleGrid
{
    public function __construct(
        public readonly Table $table,
        public readonly ?DbConnection $dbConnection = null,
    )
    {

    }

    public static function create(
        array $header,
        array $rows,
    ): self
    {
        return new self(
            new Table(
                headers: $header,
                rows: $rows,
            )
        );
    }

    public static function fromArray(
        array $header,
        array $rows,
    ): self
    {
        return new self(
            new Table(
                headers: $header,
                rows: $rows,
            )
        );
    }

    /**
     * @throws MysqliConnectException
     */
    public static function fromDatabase(
        string $server,
        string $username,
        string $password,
        string $databaseName,
        DbTypes $dbType = DbTypes::MYSQL,
        int $port = 3306,
    ): self
    {
        return new static(
            new Table(
                headers: [],
                rows: [],
            ),
            (new DbConnectionFactory(
                server: $server,
                username: $username,
                password: $password,
                databaseName: $databaseName,
                dbType: $dbType,
                port: $port,
            ))->create()
        );
    }

    public function mysqlQuery(MysqlQuery $query): self
    {
        $queryResult = $this->dbConnection->query($query);

        return new self(
            new Table(
                headers: $query->columns,
                rows: $queryResult->getData(),
            ),
            $this->dbConnection
        );
    }

    public function render(): string
    {
        return $this->table->render();
    }
}
