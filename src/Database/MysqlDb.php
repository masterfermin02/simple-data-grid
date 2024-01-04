<?php

namespace Masterfermin02\SimpleDataGrid\Database;

use Masterfermin02\SimpleDataGrid\Exceptions\MysqliConnectException;
use mysqli;

class MysqlDb implements DbConnection
{
    private mysqli $link;

    /**
     * @throws MysqliConnectException
     */
    public function __construct(
        public readonly string $server,
        public readonly string $username,
        public readonly string $password,
        public readonly string $databaseName,
        public readonly int $port = 3306,
        public readonly string $sqlDataCoding = "",
    ) {
        $this->link = new mysqli($this->server, $this->username, $this->password, $this->databaseName, $this->port);

        if (mysqli_connect_errno()) {
            throw new MysqliConnectException(
                $this->server,
                $this->username,
                $this->password,
                $this->databaseName,
                mysqli_connect_error()
            );
        }

        if ($this->sqlDataCoding) {
            $this->link->set_charset($this->sqlDataCoding);
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @throws \Exception
     */
    public function query(Query $sql): QueryResult
    {
        if ($result = $this->link->query($sql->toString())) {
            if ($sql->isSelect()) {
                return MysqlQueryResult::create(
                    $result->getIterator(),
                    $result->num_rows
                );
            }
        }

        throw new \Exception($this->link->error);
    }

    public function execute(string $sql): void
    {
        $this->link->query($sql);
    }

    public function getInsertId(): int
    {
        return $this->link->insert_id;
    }

    public function getAffectedRows(): int
    {
        return $this->link->affected_rows;
    }

    public function getError(): string
    {
        return $this->link->error;
    }

    public function getErrorNo(): int
    {
        return $this->link->errno;
    }

    public function getDebugLog(): array
    {
        return [$this->link->info];
    }

    public function close(): void
    {
        $this->link->close();
    }
}
