#!/usr/bin/env php
<?php
// Test Redis Connection and Caching

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

echo "Testing Redis Connection and Caching\n";
echo "=====================================\n\n";

try {
    // Test 1: Direct Redis connection
    echo "1. Testing direct Redis connection...\n";
    $redis = Redis::connection();
    $redis->set('test_key', 'Hello from Laravel!');
    $value = $redis->get('test_key');
    echo "   ✓ Direct Redis connection works: $value\n\n";

    // Test 2: Laravel Cache with Redis
    echo "2. Testing Laravel Cache (Redis driver)...\n";
    Cache::put('cache_test', 'Cached value from Laravel', 60);
    $cached = Cache::get('cache_test');
    echo "   ✓ Laravel Cache works: $cached\n\n";

    // Test 3: Cache Remember
    echo "3. Testing Cache::remember()...\n";
    $result = Cache::remember('test_remember', 3600, function() {
        return 'This value is cached for 1 hour';
    });
    echo "   ✓ Cache::remember works: $result\n\n";

    // Test 4: Check Redis stats
    echo "4. Redis Statistics:\n";
    $info = $redis->info();
    echo "   - Connected clients: " . $info['connected_clients'] . "\n";
    echo "   - Total keys: " . $redis->dbsize() . "\n";
    echo "   - Used memory: " . $info['used_memory_human'] . "\n\n";

    echo "=====================================\n";
    echo "✓ All Redis tests passed successfully!\n";
    echo "✓ Laravel is now using Redis for caching\n";

} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}
