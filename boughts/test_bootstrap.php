<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== Laravel Bootstrap Test ===\n\n";

try {
    echo "1. Loading autoloader...\n";
    require __DIR__.'/vendor/autoload.php';
    echo "   ✓ Autoloader loaded\n\n";

    echo "2. Loading Laravel application...\n";
    $app = require_once __DIR__.'/bootstrap/app.php';
    echo "   ✓ App instance created\n\n";

    echo "3. Creating console kernel...\n";
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    echo "   ✓ Console kernel created\n\n";

    echo "4. Bootstrapping Laravel...\n";
    $kernel->bootstrap();
    echo "   ✓ Bootstrap complete\n\n";

    echo "5. Testing basic artisan command...\n";
    $status = $kernel->handle(
        $input = new Symfony\Component\Console\Input\ArrayInput(['command' => '--version']),
        $output = new Symfony\Component\Console\Output\BufferedOutput()
    );
    echo "   Exit code: " . $status . "\n";
    echo "   Output: " . $output->fetch() . "\n";

} catch (\Throwable $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";

    if ($e->getPrevious()) {
        echo "\nPrevious exception:\n";
        echo $e->getPrevious()->getMessage() . "\n";
        echo $e->getPrevious()->getTraceAsString() . "\n";
    }
}
