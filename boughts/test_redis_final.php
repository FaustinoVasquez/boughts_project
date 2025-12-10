<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Test Redis connection using Predis
    $redis = new Predis\Client([
        'scheme' => 'tcp',
        'host'   => 'redis',
        'port'   => 6379,
    ]);
    $redis->set('test_key', 'Laravel 8 + Redis working!');
    $value = $redis->get('test_key');
    echo "✓ Predis connection successful\n";
    echo "  Test value: " . $value . "\n";
    
    // Test Laravel Cache facade with Redis
    Cache::put('laravel_test', 'Cache facade working', 60);
    echo "✓ Laravel Cache::put() successful\n";
    
    $cached = Cache::get('laravel_test');
    echo "✓ Laravel Cache::get() successful: " . $cached . "\n";
    
    echo "\n✓ Redis is fully functional with Laravel 8!\n";
    
} catch (\Exception $e) {
    echo "✗ Redis error: " . $e->getMessage() . "\n";
}
