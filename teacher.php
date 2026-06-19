<?php
include 'config.php';
include 'includes/functions.php';
require_login(['teacher']);
$failures=$conn->query('SELECT st.name student_name, sub.name subject_name, g.total FROM grades g JOIN students st ON g.student_id=st.id JOIN subjects sub ON g.subject_id=sub.id WHERE g.total < 50 ORDER BY g.total ASC');
page_header('Teacher Dashboard');
?>
<div class="grid cards"><a class="card link-card" href="grades.php"><span>Enter Grades</span><strong>Open</strong></a><a class="card link-card" href="attendance.php"><span>Record Attendance</span><strong>Open</strong></a></div>
<div class="card"><h2>Failing Students Alert</h2><?php if($failures->num_rows===0): ?><p>No failing students currently.</p><?php else: ?><table><tr><th>Student</th><th>Subject</th><th>Total</th></tr><?php while($r=$failures->fetch_assoc()): ?><tr><td><?= e($r['student_name']) ?></td><td><?= e($r['subject_name']) ?></td><td><span class="badge bad"><?= e($r['total']) ?></span></td></tr><?php endwhile; ?></table><?php endif; ?></div>
<?php page_footer(); ?>
