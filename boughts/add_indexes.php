#!/usr/bin/env php
<?php
// Database Index Creation Script

$serverName = "192.168.0.236";
$database = "Remotes";
$username = "tempuser";
$password = "pLa13t1B";

$indexes = [
    // SKUData table indexes
    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_SKUData_CategoryID' AND object_id = OBJECT_ID('SKUData'))
     CREATE INDEX IX_SKUData_CategoryID ON SKUData(CategoryID)",

    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_SKUData_Manufacturer' AND object_id = OBJECT_ID('SKUData'))
     CREATE INDEX IX_SKUData_Manufacturer ON SKUData(Manufacturer)",

    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_SKUData_ResearchComplete' AND object_id = OBJECT_ID('SKUData'))
     CREATE INDEX IX_SKUData_ResearchComplete ON SKUData(ResearchComplete)",

    // BinStock indexes
    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_BinStock_SKU' AND object_id = OBJECT_ID('BinStock'))
     CREATE INDEX IX_BinStock_SKU ON BinStock(SKU)",

    // BinHistory indexes
    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_BinHistory_SKU' AND object_id = OBJECT_ID('BinHistory'))
     CREATE INDEX IX_BinHistory_SKU ON BinHistory(SKU)",

    // MarketPlaceMapping indexes
    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_MarketPlaceMapping_SKU_ID' AND object_id = OBJECT_ID('MarketPlaceMapping'))
     CREATE INDEX IX_MarketPlaceMapping_SKU_ID ON MarketPlaceMapping(SKU, ID)",

    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_MarketPlaceMapping_Condition' AND object_id = OBJECT_ID('MarketPlaceMapping'))
     CREATE INDEX IX_MarketPlaceMapping_Condition ON MarketPlaceMapping(Condition)",

    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_MarketPlaceMapping_FulfillmentType' AND object_id = OBJECT_ID('MarketPlaceMapping'))
     CREATE INDEX IX_MarketPlaceMapping_FulfillmentType ON MarketPlaceMapping(FulfillmentType)",

    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_MarketPlaceMapping_IsCN' AND object_id = OBJECT_ID('MarketPlaceMapping'))
     CREATE INDEX IX_MarketPlaceMapping_IsCN ON MarketPlaceMapping(IsCN)",

    // Image table indexes
    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_Image_SKU' AND object_id = OBJECT_ID('Image'))
     CREATE INDEX IX_Image_SKU ON Image(SKU)",

    // CleanLaunch indexes
    "IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name='IX_CleanLaunch_PartNumber' AND object_id = OBJECT_ID('CleanLaunch'))
     CREATE INDEX IX_CleanLaunch_PartNumber ON CleanLaunch(PartNumber)",
];

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database successfully\n";
    echo "Adding performance indexes...\n\n";

    $successCount = 0;
    $skipCount = 0;

    foreach ($indexes as $index => $sql) {
        try {
            echo "Index " . ($index + 1) . "/" . count($indexes) . ": ";
            $conn->exec($sql);

            // Check if it was created or already existed
            if (stripos($sql, 'IX_SKUData_CategoryID') !== false) {
                echo "SKUData.CategoryID";
            } elseif (stripos($sql, 'IX_SKUData_Manufacturer') !== false) {
                echo "SKUData.Manufacturer";
            } elseif (stripos($sql, 'IX_SKUData_ResearchComplete') !== false) {
                echo "SKUData.ResearchComplete";
            } elseif (stripos($sql, 'IX_BinStock_SKU') !== false) {
                echo "BinStock.SKU";
            } elseif (stripos($sql, 'IX_BinHistory_SKU') !== false) {
                echo "BinHistory.SKU";
            } elseif (stripos($sql, 'IX_MarketPlaceMapping_SKU_ID') !== false) {
                echo "MarketPlaceMapping(SKU, ID)";
            } elseif (stripos($sql, 'IX_MarketPlaceMapping_Condition') !== false) {
                echo "MarketPlaceMapping.Condition";
            } elseif (stripos($sql, 'IX_MarketPlaceMapping_FulfillmentType') !== false) {
                echo "MarketPlaceMapping.FulfillmentType";
            } elseif (stripos($sql, 'IX_MarketPlaceMapping_IsCN') !== false) {
                echo "MarketPlaceMapping.IsCN";
            } elseif (stripos($sql, 'IX_Image_SKU') !== false) {
                echo "Image.SKU";
            } elseif (stripos($sql, 'IX_CleanLaunch_PartNumber') !== false) {
                echo "CleanLaunch.PartNumber";
            }

            echo " ✓\n";
            $successCount++;
        } catch (PDOException $e) {
            echo " (already exists or error)\n";
            $skipCount++;
        }
    }

    echo "\n================================\n";
    echo "Index Creation Summary:\n";
    echo "  Created/Verified: $successCount\n";
    echo "  Skipped: $skipCount\n";
    echo "================================\n";
    echo "\nDatabase indexes added successfully!\n";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
