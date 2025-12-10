<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

echo "=== Laravel Manual Bootstrap Test ===\n\n";

try {
    echo "1. Loading autoloader...\n";
    require __DIR__.'/vendor/autoload.php';
    echo "   ✓ Autoloader loaded\n\n";

    echo "2. Loading Laravel application...\n";
    $app = require_once __DIR__.'/bootstrap/app.php';
    echo "   ✓ App instance created (" . get_class($app) . ")\n\n";

    echo "3. Creating console kernel...\n";
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    echo "   ✓ Console kernel created (" . get_class($kernel) . ")\n\n";

    echo "4. Manually running bootstrap steps...\n";
    
    // Get the bootstrappers
    $reflection = new ReflectionClass($kernel);
    $bootstrappersMethod = $reflection->getMethod('bootstrappers');
    $bootstrappersMethod->setAccessible(true);
    $bootstrappers = $bootstrappersMethod->invoke($kernel);
    
    echo "   Bootstrappers: " . count($bootstrappers) . "\n";
    foreach ($bootstrappers as $i => $bootstrapper) {
        echo "   " . ($i + 1) . ". " . $bootstrapper . "...";
        flush();
        try {
            $app->make($bootstrapper)->bootstrap($app);
            echo " ✓\n";
        } catch (\Throwable $e) {
            echo " ✗\n";
            echo "      ERROR: " . $e->getMessage() . "\n";
            echo "      File: " . $e->getFile() . ":" . $e->getLine() . "\n";
            throw $e;
        }
    }
    
    echo "\n   ✓ Bootstrap complete\n";

} catch (\Throwable $e) {
    echo "\n\n✗ FATAL ERROR:\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";

    if ($e->getPrevious()) {
        echo "\n\nPrevious exception:\n";
        echo "Message: " . $e->getPrevious()->getMessage() . "\n";
        echo "File: " . $e->getPrevious()->getFile() . ":" . $e->getPrevious()->getLine() . "\n";
    }
}
