<?php

namespace Masterfermin02\SimpleDataGrid\Component;

use Masterfermin02\SimpleDataGrid\Paginator\Paginator;

class Table implements Component
{
    public function __construct(
        public readonly array $headers,
        public readonly Paginator $paginator,
        public readonly string $class = '',
        public readonly array $props = [],
    ) {}
    public function render(): string
    {
        $rows = $this->paginator->getItemsForCurrentPage();
        $props = implode(' ', array_map(fn($key, $value) => "$key=\"$value\"", array_keys($this->props), $this->props));
        return "<table class=\"min-w-full divide-y divide-gray-200 {$this->class}\" $props>
            <thead class='bg-gray-10'>
                <tr>
                    ". implode("", array_map(fn($header) => "<th class='px-6 py-5 text-left text-20 font-medium text-gray-400 uppercase rounded-sm tracking-wider'>$header</th>", $this->headers)) . "
                </tr>
            </thead>
            <tbody class='bg-white divide-y divide-gray-200'>
                " . implode("", array_map(fn($row) => "<tr>" . implode("", array_map(fn($cell) => "<td class='px-6 py-10 whitespace-nowrap'>$cell</td>", $row)) . "</tr>", $rows)) . "
            </tbody>
</table>
";
    }
}
