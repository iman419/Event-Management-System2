<?php

declare(strict_types=1);

final class Database
{
    private static ?PDO $connection = null;

    private function __construct()
    {
    }

    public static function getConnection(): PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        $configPath = __DIR__ . '/config.php';
        if (!is_file($configPath)) {
            throw new RuntimeException(
                'Database configuration is missing. Copy config.example.php to config.php and set local credentials.'
            );
        }

        $config = require $configPath;
        $db = $config['database'] ?? null;

        if (!is_array($db)) {
            throw new RuntimeException('The database configuration is invalid.');
        }

        foreach (['host', 'database', 'username', 'password'] as $key) {
            if (!array_key_exists($key, $db)) {
                throw new RuntimeException("Missing database configuration key: {$key}");
            }
        }

        $port = (int)($db['port'] ?? 3306);
        $charset = (string)($db['charset'] ?? 'utf8mb4');
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $db['host'],
            $port,
            $db['database'],
            $charset
        );

        self::$connection = new PDO($dsn, (string)$db['username'], (string)$db['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        return self::$connection;
    }
}
