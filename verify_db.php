<?php

use Illuminate\Support\Facades\Schema;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$tables = ['users', 'departments', 'employment_details', 'leaves'];

foreach ($tables as $table) {
    echo "\nTable: $table\n";
    print_r(Schema::getColumnListing($table));
}
