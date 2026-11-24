<?php
$host = getenv('DB_HOST') ?: '127.0.0.1';
$name = getenv('DB_NAME') ?: 'sis';
$user = getenv('DB_USER') ?: 'sis_user';
$pass = getenv('DB_PASS') ?: 'ChangeMe123!';

$pdo = new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
