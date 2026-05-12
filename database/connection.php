<?php
// Database connection - Supabase PostgreSQL
define('DB_HOST', getenv('DB_HOST') ?: 'aws-1-us-west-2.pooler.supabase.com');
define('DB_USER', getenv('DB_USER') ?: 'postgres.vffcogryczymyudiavyt');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'postgres');
define('DB_PORT', getenv('DB_PORT') ?: 5432);

// Create PostgreSQL connection using PDO
try {
  $dsn = 'pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
  $conn = new PDO($dsn, DB_USER, DB_PASSWORD, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (PDOException $e) {
  die(json_encode(['error' => 'Error conectando a la base de datos: ' . $e->getMessage()]));
}

// Connection established
// echo "Conectado a la base de datos\n";

/*$conn = null;*/
?>
