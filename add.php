<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO students (roll_no, full_name, email, course) VALUES (?,?,?,?)");
    $stmt->execute([$_POST['roll_no'], $_POST['full_name'], $_POST['email'], $_POST['course']]);
    header('Location: index.php'); exit;
}
?>
<!DOCTYPE html><html><body style="font-family:sans-serif;max-width:500px;margin:30px auto">
<h2>Add Student</h2>
<form method="post">
  Roll No<br><input name="roll_no" required><br><br>
  Full Name<br><input name="full_name" required><br><br>
  Email<br><input name="email" type="email"><br><br>
  Course<br><input name="course"><br><br>
  <button>Save</button> <a href="index.php">Cancel</a>
</form></body></html>
