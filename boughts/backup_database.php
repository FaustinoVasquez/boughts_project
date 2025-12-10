#!/usr/bin/env php
<?php
// SQL Server Database Backup Script

$serverName = "192.168.0.236";
$database = "Remotes";
$username = "tempuser";
$password = "pLa13t1B";

try {
    // ODBC 18 requires TrustServerCertificate for self-signed certificates
    $conn = new PDO(
        "sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=yes;Encrypt=yes",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database successfully\n";

    // Get backup path from SQL Server
    $backupDate = date('Ymd_His');
    $backupName = "Remotes_Backup_$backupDate.bak";

    // Execute backup command - use default SQL Server backup location
    $sql = "BACKUP DATABASE [Remotes] TO DISK = N'$backupName' WITH NOFORMAT, NOINIT, NAME = N'Remotes-Full Database Backup', SKIP, NOREWIND, NOUNLOAD, STATS = 10";

    echo "Starting database backup...\n";
    echo "Backup file: $backupName\n";

    $stmt = $conn->query($sql);

    echo "Database backup completed successfully!\n";
    echo "Backup location: /var/opt/mssql/data/$backupName on SQL Server\n";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
