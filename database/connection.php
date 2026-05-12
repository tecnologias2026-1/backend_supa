<?php
// Database connection - Supabase PostgreSQL
$databaseUrl = getenv('DATABASE_URL') ?: '';

$host = getenv('DB_HOST') ?: 'aws-1-us-west-2.pooler.supabase.com';
$user = getenv('DB_USER') ?: 'postgres.vffcogryczymyudiavyt';
$password = getenv('DB_PASSWORD') ?: 'baSfaFH3tSVfFkKw';
$name = getenv('DB_NAME') ?: 'postgres';
$port = getenv('DB_PORT') ?: '5432';

// Render commonly exposes PostgreSQL credentials via DATABASE_URL.
if ($databaseUrl !== '') {
  $parts = parse_url($databaseUrl);
  if ($parts !== false) {
    $host = $parts['host'] ?? $host;
    $user = $parts['user'] ?? $user;
    $password = isset($parts['pass']) ? rawurldecode($parts['pass']) : $password;
    $name = isset($parts['path']) ? ltrim($parts['path'], '/') : $name;
    $port = isset($parts['port']) ? (string)$parts['port'] : $port;
  }
}

if ($password === '') {
  die(json_encode([
    'error' => 'Error de configuracion: falta DB_PASSWORD o DATABASE_URL en variables de entorno.'
  ]));
}

// Create PostgreSQL connection using PDO
try {
  $dsn = 'pgsql:host=' . $host . ';port=' . $port . ';dbname=' . $name . ';sslmode=require';
  $conn = new PDO($dsn, $user, $password, [
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
