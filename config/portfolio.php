return [
    'admin' => [
        'name' => env('APP_ADMIN_NAME', 'Admin'),
        'email' => env('APP_ADMIN_EMAIL', 'admin@example.com'),
        'logo_path' => 'storage/uploads/logo.png',
    ],
    'frontend' => [
        'items_per_page' => 12,
        'blog_items_per_page' => 10,
    ],
    'cache' => [
        'enabled' => env('CACHE_ENABLED', true),
        'ttl' => 3600,
    ],
];
