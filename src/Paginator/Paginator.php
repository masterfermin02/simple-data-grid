<?php

namespace Masterfermin02\SimpleDataGrid\Paginator;

interface Paginator
{
    public function getItemsForCurrentPage(): array;

    public function getTotalPages(): int;

    public function getCurrentPage(): int;

    public function getNextPage(): int;

    public function getPreviousPage(): int;

    public function addItemPerPage(int $itemPerPage): self;

    public function addCurrentPage(int $currentPage): self;
}
