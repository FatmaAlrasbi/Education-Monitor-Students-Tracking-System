<?php
include 'config.php';
include 'includes/functions.php';
require_login(['admin','teacher']);
$message='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $student_id=(int)$_POST['student_id']; $subject_id=(int)$_POST['subject_id'];
    $assignment=(float)$_POST['assignment']; $midterm=(float)$_POST['midterm']; $final=(float)$_POST['final_exam']; $total=$assignment+$midterm+$final;
    $stmt=$conn->prepare('INSERT INTO grades(student_id,subject_id,assignment,midterm,final_exam,total) VALUES(?,?,?,?,?,?) ON DUPLICATE KEY UPDATE assignment=VALUES(assignment), midterm=VALUES(midterm), final_exam=VALUES(final_exam), total=VALUES(total)');
    $stmt->bind_param('iidddd',$student_id,$subject_id,$assignment,$midterm,$final,$total);
    $stmt->execute(); $message='Grade saved successfully. Total = '.$total;
}
$students=$conn->query('SELECT id,name FROM students ORDER BY name');
$subjects=$conn->query('SELECT id,name FROM subjects ORDER BY name');
$rows=$conn->query('SELECT g.*, st.name student_name, sub.name subject_name FROM grades g JOIN students st ON g.student_id=st.id JOIN subjects sub ON g.subject_id=sub.id ORDER BY g.id DESC');
page_header('Grades');
?>
<?php if($message): ?><div class="alert"><?= e($message) ?></div><?php endif; ?>
<div class="card"><h2>Enter Grades</h2><form method="POST" class="form-grid"><select name="student_id" required><option value="">Select student</option><?php while($s=$students->fetch_assoc()): ?><option value="<?= (int)$s['id'] ?>"><?= e($s['name']) ?></option><?php endwhile; ?></select><select name="subject_id" required><option value="">Select subject</option><?php while($sub=$subjects->fetch_assoc()): ?><option value="<?= (int)$sub['id'] ?>"><?= e($sub['name']) ?></option><?php endwhile; ?></select><input type="number" step="0.01" name="assignment" placeholder="Assignment" required><input type="number" step="0.01" name="midterm" placeholder="Midterm" required><input type="number" step="0.01" name="final_exam" placeholder="Final" required><button>Save Grade</button></form></div>
<div class="card"><h2>Grades List</h2><table><tr><th>Student</th><th>Subject</th><th>Assignment</th><th>Midterm</th><th>Final</th><th>Total</th><th>Status</th></tr><?php while($r=$rows->fetch_assoc()): ?><tr><td><?= e($r['student_name']) ?></td><td><?= e($r['subject_name']) ?></td><td><?= e($r['assignment']) ?></td><td><?= e($r['midterm']) ?></td><td><?= e($r['final_exam']) ?></td><td><?= e($r['total']) ?></td><td><span class="badge <?= $r['total'] < 50 ? 'bad' : 'good' ?>"><?= $r['total'] < 50 ? 'Fail' : 'Pass' ?></span></td></tr><?php endwhile; ?></table></div>
<?php page_footer(); ?>
