<?php

namespace Masterfermin02\SimpleDataGrid\Paginator;

class IteratorPaginator implements Paginator
{
    public function __construct(
        public readonly \Iterator $items,
        public readonly int $itemsPerPage,
        public readonly int $currentPage = 1,
    ) {}

    public function getItemsForCurrentPage(): array
    {
        $offset = ($this->currentPage - 1) * $this->itemsPerPage;
        $items = new \LimitIterator($this->items, $offset, $this->itemsPerPage);
        return iterator_to_array($items);
    }

    public function getTotalPages(): int
    {
        $this->items->rewind();
        $totalItems = iterator_count($this->items);
        return ceil($totalItems / $this->itemsPerPage);
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
}
