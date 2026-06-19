<?php
include 'config.php';
include 'includes/functions.php';
require_login(['student']);
$user_id=(int)$_SESSION['user_id'];
$stmt=$conn->prepare('SELECT id,name,email FROM students WHERE user_id=? LIMIT 1'); $stmt->bind_param('i',$user_id); $stmt->execute(); $student=$stmt->get_result()->fetch_assoc();
page_header('My Academic Report');
if(!$student){ echo '<div class="alert danger">No student profile linked to this account.</div>'; page_footer(); exit(); }
$sid=(int)$student['id'];
$stmt=$conn->prepare('SELECT g.*, sub.name subject_name FROM grades g JOIN subjects sub ON g.subject_id=sub.id WHERE g.student_id=? ORDER BY sub.name'); $stmt->bind_param('i',$sid); $stmt->execute(); $grades=$stmt->get_result();
$stmt=$conn->prepare('SELECT a.*, sub.name subject_name FROM attendance a JOIN subjects sub ON a.subject_id=sub.id WHERE a.student_id=? ORDER BY a.attendance_date DESC'); $stmt->bind_param('i',$sid); $stmt->execute(); $attendance=$stmt->get_result();
$stmt=$conn->prepare('SELECT AVG(total) avg_total FROM grades WHERE student_id=?'); $stmt->bind_param('i',$sid); $stmt->execute(); $avg=$stmt->get_result()->fetch_assoc()['avg_total'];
?>
<div class="grid cards"><div class="card"><span>Name</span><strong><?= e($student['name']) ?></strong></div><div class="card"><span>Average</span><strong><?= $avg===null ? 'N/A' : e(number_format($avg,2)) ?></strong></div><div class="card"><span>Status</span><strong><?= $avg===null ? 'No grades' : ($avg>=50 ? 'Pass' : 'At Risk') ?></strong></div></div>
<div class="card"><h2>My Grades</h2><table><tr><th>Subject</th><th>Assignment</th><th>Midterm</th><th>Final</th><th>Total</th></tr><?php while($r=$grades->fetch_assoc()): ?><tr><td><?= e($r['subject_name']) ?></td><td><?= e($r['assignment']) ?></td><td><?= e($r['midterm']) ?></td><td><?= e($r['final_exam']) ?></td><td><?= e($r['total']) ?></td></tr><?php endwhile; ?></table></div>
<div class="card"><h2>My Attendance</h2><table><tr><th>Date</th><th>Subject</th><th>Status</th></tr><?php while($r=$attendance->fetch_assoc()): ?><tr><td><?= e($r['attendance_date']) ?></td><td><?= e($r['subject_name']) ?></td><td><span class="badge <?= strtolower(e($r['status'])) ?>"><?= e($r['status']) ?></span></td></tr><?php endwhile; ?></table></div>
<?php page_footer(); ?>
