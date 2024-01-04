<?php

namespace Masterfermin02\SimpleDataGrid;

use Masterfermin02\SimpleDataGrid\Component\Table;
use Masterfermin02\SimpleDataGrid\Database\DbConnection;
use Masterfermin02\SimpleDataGrid\Database\MysqlQuery;
use Masterfermin02\SimpleDataGrid\Database\Query;
use Masterfermin02\SimpleDataGrid\Enums\DbTypes;
use Masterfermin02\SimpleDataGrid\Exceptions\MysqliConnectException;
use Masterfermin02\SimpleDataGrid\Factories\DbConnectionFactory;
use Masterfermin02\SimpleDataGrid\Factories\PaginatorFactory;

class SimpleGrid
{
    public const DEFAULT_PAGE = 1;

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
        return new static(
            new Table(
                headers: $header,
                paginator: PaginatorFactory::createFromArray($rows),
            )
        );
    }

    public static function fromArray(
        array $header,
        array $rows,
    ): self
    {
        return new static(
            new Table(
                headers: $header,
                paginator: PaginatorFactory::createFromArray(
                   items: $rows,
                ),
            ),
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
            table: new Table(
                headers: [],
                paginator:  PaginatorFactory::createFromIterator(
                    items: new EmptyIterator(),
                ),
            ),
            dbConnection: (new DbConnectionFactory(
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

        return new static(
            table: new Table(
                headers: $query->columns,
                paginator: PaginatorFactory::createFromIterator(
                    items: $queryResult->getIterator(),
                ),
            ),
            dbConnection: $this->dbConnection,
        );
    }

    public function itemPerPage(
        int $itemPerPage
    ): self {
        return new static(
            new Table(
                headers: $this->table->headers,
                paginator: $this->table->paginator->addItemPerPage($itemPerPage)
            ),
            dbConnection: $this->dbConnection,
        );
    }

    public function currentPage(int $currentPage): self
    {
        return new static(
            new Table(
                headers: $this->table->headers,
                paginator: $this->table->paginator->addCurrentPage($currentPage)
            ),
            dbConnection: $this->dbConnection,
        );
    }

    public function render(): string
    {
        return $this->table->render();
    }
}
