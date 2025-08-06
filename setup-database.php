<?php

/**
 * Database Setup Script
 * This script helps set up the database connection and run migrations
 */

echo "🔧 Database Setup Script\n";
echo "========================\n\n";

// Check if .env file exists
if (!file_exists('.env')) {
    echo "❌ .env file not found!\n";
    echo "Please copy .env.example to .env and configure your database settings.\n";
    exit(1);
}

// Read .env file
$envContent = file_get_contents('.env');
$envLines = explode("\n", $envContent);

echo "📋 Current database configuration:\n";
$dbConfig = [];

foreach ($envLines as $line) {
    if (strpos($line, 'DB_') === 0) {
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $value = trim($parts[1]);
            $dbConfig[$key] = $value;
            echo "  $key = $value\n";
        }
    }
}

echo "\n";

// Check if database credentials are set
if (empty($dbConfig['DB_USERNAME']) || $dbConfig['DB_USERNAME'] === 'root') {
    echo "⚠️  Warning: Database username is 'root' or empty\n";
    echo "   This might cause connection issues.\n\n";
}

if (empty($dbConfig['DB_PASSWORD'])) {
    echo "⚠️  Warning: Database password is empty\n";
    echo "   This might cause connection issues.\n\n";
}

if (empty($dbConfig['DB_DATABASE'])) {
    echo "⚠️  Warning: Database name is empty\n";
    echo "   This might cause connection issues.\n\n";
}

// Test database connection
echo "🔍 Testing database connection...\n";

try {
    $host = $dbConfig['DB_HOST'] ?? '127.0.0.1';
    $port = $dbConfig['DB_PORT'] ?? '3306';
    $database = $dbConfig['DB_DATABASE'] ?? 'laravel';
    $username = $dbConfig['DB_USERNAME'] ?? 'root';
    $password = $dbConfig['DB_PASSWORD'] ?? '';

    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "✅ Database connection successful!\n";

    // Check if migrations table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'migrations'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Migrations table exists\n";

        // Count existing migrations
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM migrations");
        $count = $stmt->fetch()['count'];
        echo "📊 Existing migrations: $count\n";
    } else {
        echo "ℹ️  Migrations table does not exist (will be created)\n";
    }
} catch (PDOException $e) {
    echo "❌ Database connection failed!\n";
    echo "   Error: " . $e->getMessage() . "\n\n";

    echo "🔧 Troubleshooting steps:\n";
    echo "1. Check your database credentials in .env file\n";
    echo "2. Make sure MySQL/MariaDB is running\n";
    echo "3. Verify the database exists\n";
    echo "4. Check if the user has proper permissions\n\n";

    echo "📝 Example .env database configuration:\n";
    echo "DB_CONNECTION=mysql\n";
    echo "DB_HOST=127.0.0.1\n";
    echo "DB_PORT=3306\n";
    echo "DB_DATABASE=your_database_name\n";
    echo "DB_USERNAME=your_username\n";
    echo "DB_PASSWORD=your_password\n\n";

    exit(1);
}

echo "\n🚀 Ready to run migrations!\n";
echo "Commands to run:\n";
echo "1. php artisan migrate:fresh --seed\n";
echo "2. php artisan storage:link\n";
echo "3. php artisan config:clear\n";
echo "4. php artisan cache:clear\n";

echo "\n💡 If you want to reorder migrations first, run:\n";
echo "   php reorder-migrations.php\n";
