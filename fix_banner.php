<?php

// Load Laravel environment
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Add the banner column if it doesn't exist
try {
    if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'banner')) {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users ADD COLUMN banner VARCHAR(255) NULL AFTER photo");
        echo "Banner column added successfully!\n";
    } else {
        echo "Banner column already exists.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 