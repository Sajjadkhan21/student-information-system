<?php
require 'config.php';
$q = $_GET['q'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM students WHERE full_name LIKE ? OR roll_no LIKE ? ORDER BY id DESC");
$stmt->execute(["%$q%", "%$q%"]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Student Information System</title>
<style>
 body{font-family:sans-serif;max-width:900px;margin:30px auto}
 table{border-collapse:collapse;width:100%}
 td,th{border:1px solid #ccc;padding:8px;text-align:left}
 th{background:#f0f0f0}
</style></head>
<body>
<h1>Student Information System</h1>
<form method="get">
  <input name="q" placeholder="Search name or roll no" value="<?= h($q) ?>">
  <button>Search</button> <a href="add.php">+ Add student</a>
</form><br>
<table>
<tr><th>Roll No</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th></tr>
<?php foreach ($students as $s): ?>
<tr>
  <td><?= h($s['roll_no']) ?></td><td><?= h($s['full_name']) ?></td>
  <td><?= h($s['email']) ?></td><td><?= h($s['course']) ?></td>
  <td><a href="edit.php?id=<?= $s['id'] ?>">Edit</a> |
      <a href="delete.php?id=<?= $s['id'] ?>" onclick="return confirm('Delete?')">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</body></html>
