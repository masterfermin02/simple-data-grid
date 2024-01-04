<?php

namespace Masterfermin02\SimpleDataGrid\Factories;

use Masterfermin02\SimpleDataGrid\Paginator\ArrayPaginator;
use Masterfermin02\SimpleDataGrid\Paginator\IteratorPaginator;

class PaginatorFactory
{
    public static function createFromArray(array $items, int $itemsPerPage = 10, int $currentPage = 1): ArrayPaginator
    {
        return new ArrayPaginator($items, $itemsPerPage, $currentPage);
    }

    public static function createFromIterator(\Iterator $items, int $itemsPerPage = 10, int $currentPage = 1): IteratorPaginator
    {
        return new IteratorPaginator($items, $itemsPerPage, $currentPage);
    }
}
