<?php

require_once __DIR__ . '/vendor/autoload.php';

// Load Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "Testing MongoDB Atlas connection...\n";
    
    $connection = \Illuminate\Support\Facades\DB::connection('mongodb');
    $collections = $connection->getMongoDB()->listCollections();
    
    echo "✅ MongoDB Atlas connection successful!\n";
    echo "Database: " . config('database.connections.mongodb.database') . "\n";
    
    // Test creating a simple document
    $testCollection = $connection->getCollection('connection_test');
    $result = $testCollection->insertOne([
        'test' => true,
        'timestamp' => new \MongoDB\BSON\UTCDateTime(),
        'message' => 'Atlas connection working!'
    ]);
    
    echo "✅ Test document created with ID: " . $result->getInsertedId() . "\n";
    
    // Clean up test document
    $testCollection->deleteOne(['_id' => $result->getInsertedId()]);
    echo "✅ Test document cleaned up\n";
    
} catch (Exception $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    echo "Please check your MongoDB Atlas configuration in .env file\n";
}
