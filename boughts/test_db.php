<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $pdo = DB::connection()->getPdo();
    echo "✓ Database connection successful\n";
    echo "  Driver: " . DB::connection()->getDriverName() . "\n";
    echo "  Database: " . DB::connection()->getDatabaseName() . "\n";
    
    // Test a simple query
    $result = DB::select('SELECT TOP 5 SKU FROM SKUData ORDER BY SKU');
    echo "✓ Query test successful - Found " . count($result) . " SKUs\n";
    foreach ($result as $row) {
        echo "  - " . $row->SKU . "\n";
    }
} catch (\Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n";
}
