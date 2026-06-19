<?php
include 'config.php';
include 'includes/functions.php';
require_login(['admin']);
$students = $conn->query('SELECT COUNT(*) c FROM students')->fetch_assoc()['c'] ?? 0;
$teachers = $conn->query('SELECT COUNT(*) c FROM teachers')->fetch_assoc()['c'] ?? 0;
$subjects = $conn->query('SELECT COUNT(*) c FROM subjects')->fetch_assoc()['c'] ?? 0;
$fail = $conn->query('SELECT COUNT(*) c FROM grades WHERE total < 50')->fetch_assoc()['c'] ?? 0;
page_header('Admin Dashboard');
?>
<div class="grid cards">
 <div class="card"><span>Students</span><strong><?= e($students) ?></strong></div>
 <div class="card"><span>Teachers</span><strong><?= e($teachers) ?></strong></div>
 <div class="card"><span>Subjects</span><strong><?= e($subjects) ?></strong></div>
 <div class="card"><span>Failing Grades</span><strong><?= e($fail) ?></strong></div>
</div>
<div class="card"><h2>Admin Tools</h2><p>Use the navigation tabs to manage students, teachers, grades, and attendance.</p></div>
<?php page_footer(); ?>
