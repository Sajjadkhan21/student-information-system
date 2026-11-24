<?php
require 'config.php';
$id = (int)($_GET['id'] ?? 0);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE students SET roll_no=?, full_name=?, email=?, course=? WHERE id=?");
    $stmt->execute([$_POST['roll_no'], $_POST['full_name'], $_POST['email'], $_POST['course'], $id]);
    header('Location: index.php'); exit;
}
$stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
$stmt->execute([$id]);
$s = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$s) { http_response_code(404); exit('Not found'); }
?>
<!DOCTYPE html><html><body style="font-family:sans-serif;max-width:500px;margin:30px auto">
<h2>Edit Student</h2>
<form method="post">
  Roll No<br><input name="roll_no" value="<?= h($s['roll_no']) ?>" required><br><br>
  Full Name<br><input name="full_name" value="<?= h($s['full_name']) ?>" required><br><br>
  Email<br><input name="email" type="email" value="<?= h($s['email']) ?>"><br><br>
  Course<br><input name="course" value="<?= h($s['course']) ?>"><br><br>
  <button>Update</button> <a href="index.php">Cancel</a>
</form></body></html>
