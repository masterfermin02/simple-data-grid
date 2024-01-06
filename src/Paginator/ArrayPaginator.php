<?php

namespace Masterfermin02\SimpleDataGrid\Paginator;

class ArrayPaginator implements Paginator
{
    public function __construct(
        public readonly array $items,
        public readonly int $itemsPerPage,
        public readonly int $currentPage = 1,
    ) {}

    public function getItemsForCurrentPage(): array
    {
        $offset = ($this->currentPage - 1) * $this->itemsPerPage;
        return array_slice($this->items, $offset, $this->itemsPerPage);
    }

    public function getTotalPages(): int
    {
        return ceil(count($this->items) / $this->itemsPerPage);
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getNextPage(): int
    {
        return $this->currentPage + 1;
    }

    public function getPreviousPage(): int
    {
        return $this->currentPage - 1;
    }

    public function addItemPerPage(int $itemPerPage): Paginator
    {
        return new static(
            items: $this->items,
            itemsPerPage: $itemPerPage,
            currentPage: $this->currentPage,
        );
    }

    public function addCurrentPage(int $currentPage): Paginator
    {
        return new static(
            items: $this->items,
            itemsPerPage: $this->itemsPerPage,
            currentPage: $currentPage,
        );
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }
}
