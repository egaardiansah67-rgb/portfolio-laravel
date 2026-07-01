<?php

return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeders',
    ],

    'repositories' => [
        'migration' => \Illuminate\Database\Migrations\DatabaseMigrationRepository::class,
    ],

    'migrations' => 'migrations',

    'create_migration_table' => true,
];
