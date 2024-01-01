<?php

require __DIR__ . '/vendor/autoload.php';

use Masterfermin02\SimpleDataGrid\SimpleGrid;
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<h1 class="text-3xl font-bold underline">
    Hello world!
</h1>
<div>
    <?php
        echo SimpleGrid::fromArray(
            header: ['id', 'name', 'email'],
            rows: [
                [1, 'John Doe', 'josh@estemail.com'],
                [2, 'John Doe2', 'josh2@estemail.com'],
                [3, 'John Doe2', 'josh3@estemail.com'],
            ],
        )
            ->render();
    ?>
    <?php
    echo SimpleGrid::fromDatabase(
        server: '127.0.0.1',
        username: 'myuser',
        password: 'mypassword',
        databaseName: 'laravel',
        port: 13306,
    )
        ->mysqlQuery(
            new \Masterfermin02\SimpleDataGrid\Database\MysqlQuery(
                table: 'users',
                columns: ['id', 'name', 'email'],
            )
        )
        ->render();
    ?>
</div>
</body>
</html>
