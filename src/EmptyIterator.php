<?php

namespace Masterfermin02\SimpleDataGrid;

class EmptyIterator implements \Iterator
{

    public function current(): mixed
    {
        return 0;
    }

    public function next(): void
    {

    }

    public function key(): mixed
    {
        return 0;
    }

    public function valid(): bool
    {
        return false;
    }

    public function rewind(): void
    {

    }
}
