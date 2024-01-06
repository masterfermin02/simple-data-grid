# Simple Data Grid

[![Latest Version on Packagist](https://img.shields.io/packagist/v/masterfermin02/simple-data-grid.svg?style=flat-square)](https://packagist.org/packages/masterfermin02/simple-data-grid)
[![Tests](https://github.com/masterfermin02/simple-data-grid/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/masterfermin02/simple-data-grid/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/masterfermin02/simple-data-grid.svg?style=flat-square)](https://packagist.org/packages/masterfermin02/simple-data-grid)

Simple Data Grid is a PHP package that provides an easy way to generate HTML tables from arrays of data. It supports custom headers, rows, CSS classes, and table properties.

## Installation

You can install the package via composer:

```bash
composer require masterfermin02/simple-data-grid
```

## Usage

Here's a basic example of how to use the Simple Data Grid:

```php
use Masterfermin02\SimpleDataGrid\SimpleGrid;

$headers = ['Name', 'Email', 'Phone'];
$rows = [
    ['John Doe', 'john@example.com', '123-456-7890'],
    ['Jane Doe', 'jane@example.com', '098-765-4321'],
];

echo SimpleGrid::fromArray($headers, $rows)->render();
```

This will generate an HTML table with the specified headers, rows, CSS class, and table properties.

## Mysql Database Support

This example assumes that you have a MySQL database running on localhost with a database named `mydatabase`, a table named `users`, and columns `id`, `name`, and `email`.

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Masterfermin02\SimpleDataGrid\SimpleGrid;
use Masterfermin02\SimpleDataGrid\Database\MysqlQuery;
use Masterfermin02\SimpleDataGrid\Enums\DbTypes;

$grid = SimpleGrid::fromDatabase(
    server: 'localhost',
    username: 'myuser',
    password: 'mypassword',
    databaseName: 'mydatabase',
    dbType: DbTypes::MYSQL,
    port: 3306,
)
    ->mysqlQuery(
        new MysqlQuery(
            table: 'users',
            columns: ['id', 'name', 'email'],
        )
    );

echo $grid->render();
```

## Add pagination

```php
<?php
        $grid = SimpleGrid::fromArray(
            header: ['id', 'name', 'email'],
            rows: [
                [1, 'John Doe', 'josh@estemail.com'],
                [2, 'John Doe2', 'josh2@estemail.com'],
                [3, 'John Doe3', 'josh3@estemail.com'],
                [4, 'John Doe4', 'josh4@estemail.com'],
                [1, 'John Doe', 'josh@estemail.com'],
                [2, 'John Doe2', 'josh2@estemail.com'],
                [3, 'John Doe3', 'josh3@estemail.com'],
                [4, 'John Doe4', 'josh4@estemail.com'],
            ],
        )
            ->itemPerPage(3)
            ->currentPage(
                    $_GET['page'] ?? 1
            );

    echo $grid->render();
    echo (new PaginatorNav(
        $grid
    ))->render();
```

In this example, `SimpleGrid::fromDatabase` is used to create a new `SimpleGrid` instance connected to a MySQL database. The `mysqlQuery` method is then used to execute a SELECT query on the `users` table, selecting the `id`, `name`, and `email` columns. The `render` method is finally called to generate the HTML for the data grid.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Fermin](https://github.com/masterfermin02)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
```

This `README.md` provides a brief description of the package, installation instructions, a usage example, and links to other important documents like the changelog, contributing guidelines, and license.
