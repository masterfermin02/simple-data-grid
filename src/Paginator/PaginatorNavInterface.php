<?php

namespace Masterfermin02\SimpleDataGrid\Paginator;

interface PaginatorNavInterface
{
    public function getTotalPages(): int;

    public function getCurrentPage(): int;

    public function getNextPage(): int;

    public function getPreviousPage(): int;

    public function getItemsPerPage(): int;
}
