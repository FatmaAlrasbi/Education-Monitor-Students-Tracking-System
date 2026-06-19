<?php
include 'config.php';
include 'includes/functions.php';
require_login(['admin','teacher']);
$message='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $student_id=(int)$_POST['student_id']; $subject_id=(int)$_POST['subject_id']; $date=$_POST['date']; $status=$_POST['status'];
    $stmt=$conn->prepare('INSERT INTO attendance(student_id,subject_id,attendance_date,status) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE status=VALUES(status)');
    $stmt->bind_param('iiss',$student_id,$subject_id,$date,$status); $stmt->execute(); $message='Attendance saved successfully.';
}
$students=$conn->query('SELECT id,name FROM students ORDER BY name');
$subjects=$conn->query('SELECT id,name FROM subjects ORDER BY name');
$rows=$conn->query('SELECT a.*, st.name student_name, sub.name subject_name FROM attendance a JOIN students st ON a.student_id=st.id JOIN subjects sub ON a.subject_id=sub.id ORDER BY a.attendance_date DESC, a.id DESC');
page_header('Attendance');
?>
<?php if($message): ?><div class="alert"><?= e($message) ?></div><?php endif; ?>
<div class="card"><h2>Record Attendance</h2><form method="POST" class="form-grid"><select name="student_id" required><option value="">Select student</option><?php while($s=$students->fetch_assoc()): ?><option value="<?= (int)$s['id'] ?>"><?= e($s['name']) ?></option><?php endwhile; ?></select><select name="subject_id" required><option value="">Select subject</option><?php while($sub=$subjects->fetch_assoc()): ?><option value="<?= (int)$sub['id'] ?>"><?= e($sub['name']) ?></option><?php endwhile; ?></select><input type="date" name="date" value="<?= date('Y-m-d') ?>" required><select name="status"><option>Present</option><option>Absent</option><option>Late</option></select><button>Save Attendance</button></form></div>
<div class="card"><h2>Attendance List</h2><table><tr><th>Date</th><th>Student</th><th>Subject</th><th>Status</th></tr><?php while($r=$rows->fetch_assoc()): ?><tr><td><?= e($r['attendance_date']) ?></td><td><?= e($r['student_name']) ?></td><td><?= e($r['subject_name']) ?></td><td><span class="badge <?= strtolower(e($r['status'])) ?>"><?= e($r['status']) ?></span></td></tr><?php endwhile; ?></table></div>
<?php page_footer(); ?>
