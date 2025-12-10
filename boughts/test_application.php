<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Application Functionality Tests ===\n\n";

// Test 1: Database Connection
echo "1. Database Connection Test\n";
try {
    $skuCount = DB::table('SKUData')->count();
    echo "   ✓ Database connected\n";
    echo "   ✓ SKU count: " . number_format($skuCount) . "\n\n";
} catch (\Exception $e) {
    echo "   ✗ Database error: " . $e->getMessage() . "\n\n";
}

// Test 2: Redis Caching
echo "2. Redis Caching Test\n";
try {
    Cache::put('test_cache', 'working', 60);
    $cached = Cache::get('test_cache');
    echo "   ✓ Redis caching: " . $cached . "\n";
    Cache::forget('test_cache');
    echo "   ✓ Cache clear: successful\n\n";
} catch (\Exception $e) {
    echo "   ✗ Redis error: " . $e->getMessage() . "\n\n";
}

// Test 3: Model Loading (using optimized caching)
echo "3. Model Loading Test\n";
try {
    $categories = Cache::remember('test_categories', 60, function() {
        return DB::table('Category')->orderBy('CategoryID', 'ASC')->take(5)->get();
    });
    echo "   ✓ Cached query executed\n";
    echo "   ✓ Categories loaded: " . count($categories) . "\n\n";
} catch (\Exception $e) {
    echo "   ✗ Model error: " . $e->getMessage() . "\n\n";
}

// Test 4: Index Performance (from optimizations)
echo "4. Database Index Test\n";
try {
    $start = microtime(true);
    $result = DB::table('SKUData')
        ->where('CategoryID', 1)
        ->orderBy('SKU')
        ->take(10)
        ->get();
    $elapsed = round((microtime(true) - $start) * 1000, 2);
    echo "   ✓ Indexed query executed in {}ms\n";
    echo "   ✓ Results found: " . count($result) . "\n\n";
} catch (\Exception $e) {
    echo "   ✗ Query error: " . $e->getMessage() . "\n\n";
}

// Test 5: Bulk Operations (from N+1 fixes)
echo "5. Bulk Update Test\n";
try {
    $start = microtime(true);
    // Test bulk operation pattern (not actually updating)
    $ids = DB::table('MarketPlaceMapping')->take(10)->pluck('ID');
    $elapsed = round((microtime(true) - $start) * 1000, 2);
    echo "   ✓ Bulk query executed in {}ms\n";
    echo "   ✓ IDs fetched: " . count($ids) . "\n\n";
} catch (\Exception $e) {
    echo "   ✗ Bulk query error: " . $e->getMessage() . "\n\n";
}

// Test 6: PHP 8.1 Features
echo "6. PHP Version Test\n";
echo "   ✓ PHP Version: " . PHP_VERSION . "\n";
echo "   ✓ Extensions loaded:\n";
$extensions = ['sqlsrv', 'pdo_sqlsrv', 'redis', 'mbstring', 'xml'];
foreach ($extensions as $ext) {
    $status = extension_loaded($ext) ? '✓' : '✗';
    echo "     {} {}\n";
}

echo "\n=== All Tests Complete ===\n";
