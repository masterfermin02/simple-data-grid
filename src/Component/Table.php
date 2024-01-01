<?php

namespace Masterfermin02\SimpleDataGrid\Component;

class Table implements Component
{
    public function __construct(
        public readonly array $headers,
        public readonly array $rows,
        public readonly string $class = '',
        public readonly array $props = [],
    ) {}
    public function render(): string
    {
        $props = implode(' ', array_map(fn($key, $value) => "$key=\"$value\"", array_keys($this->props), $this->props));
        return "<table class=\"min-w-full divide-y divide-gray-200 {$this->class}\" $props>
            <thead>
                <tr>
                    ". implode("", array_map(fn($header) => "<th>$header</th>", $this->headers)) . "
                </tr>
            </thead>
            <tbody>
                " . implode("", array_map(fn($row) => "<tr>" . implode("", array_map(fn($cell) => "<td>$cell</td>", $row)) . "</tr>", $this->rows)) . "
            </tbody>
</table>
";
    }
}
