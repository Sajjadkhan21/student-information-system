<?php
require 'config.php';
$stmt = $pdo->prepare("DELETE FROM students WHERE id=?");
$stmt->execute([(int)($_GET['id'] ?? 0)]);
header('Location: index.php');
