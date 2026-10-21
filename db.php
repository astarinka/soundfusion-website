<?php

$configFile = __DIR__ . '/config.local.php';

if (!is_file($configFile)) {
    http_response_code(500);
    exit('Database configuration is missing. Copy config.example.php to config.local.php and fill in your local MySQL settings.');
}

$config = require $configFile;

if (!is_array($config)) {
    http_response_code(500);
    exit('Database configuration is invalid.');
}

$host = $config['host'] ?? '127.0.0.1';
$port = (int)($config['port'] ?? 3306);
$dbname = $config['database'] ?? 'soundfusion';
$username = $config['username'] ?? '';
$password = $config['password'] ?? '';

try {
    $pdo = new PDO(
        "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    error_log('SoundFusion database connection failed: ' . $e->getMessage());
    http_response_code(500);
    exit('Could not connect to the database. Check config.local.php and make sure MySQL is running.');
}
