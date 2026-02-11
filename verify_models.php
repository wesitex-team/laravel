<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Department;
use App\Models\EmploymentDetail;
use App\Models\Leave;

$models = [
    'User' => User::class,
    'Department' => Department::class,
    'EmploymentDetail' => EmploymentDetail::class,
    'Leave' => Leave::class,
];

foreach ($models as $name => $class) {
    if (class_exists($class)) {
        echo "$name: Found\n";
    } else {
        echo "$name: Missing\n";
    }
}

echo "\nTesting instantiation:\n";
try {
    $u = new User();
    echo "User instantiated\n";
    $d = new Department();
    echo "Department instantiated\n";
    $e = new EmploymentDetail();
    echo "EmploymentDetail instantiated\n";
    $l = new Leave();
    echo "Leave instantiated\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
