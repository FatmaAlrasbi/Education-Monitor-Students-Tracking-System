<?php
include 'config.php';
include 'includes/functions.php';
require_login(['admin']);
$message = '';
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare('SELECT user_id FROM students WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt = $conn->prepare('DELETE FROM students WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    if ($user && $user['user_id']) {
        $uid = (int)$user['user_id'];
        $stmt = $conn->prepare('DELETE FROM users WHERE id=?');
        $stmt->bind_param('i', $uid);
        $stmt->execute();
    }
    $message = 'Student deleted successfully.';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->begin_transaction();
    try {
        $role = 'student';
        $stmt = $conn->prepare('INSERT INTO users(username,password,role) VALUES(?,?,?)');
        $stmt->bind_param('sss', $username, $password, $role);
        $stmt->execute();
        $user_id = $conn->insert_id;
        $stmt = $conn->prepare('INSERT INTO students(user_id,name,email) VALUES(?,?,?)');
        $stmt->bind_param('iss', $user_id, $name, $email);
        $stmt->execute();
        $conn->commit();
        $message = 'Student and login account added successfully.';
    } catch (Throwable $e) {
        $conn->rollback();
        $message = 'Error: username may already exist.';
    }
}
$rows = $conn->query('SELECT s.id, s.name, s.email, u.username FROM students s LEFT JOIN users u ON s.user_id=u.id ORDER BY s.id DESC');
page_header('Students');
?>
<?php if ($message): ?><div class="alert"><?= e($message) ?></div><?php endif; ?>
<div class="card"><h2>Add Student</h2><form method="POST" class="form-grid"><input name="name" placeholder="Student name" required><input name="email" placeholder="Email"><input name="username" placeholder="Username" required><input type="password" name="password" placeholder="Password" required><button>Add Student</button></form></div>
<div class="card"><h2>Students List</h2><table><tr><th>Name</th><th>Email</th><th>Username</th><th>Action</th></tr><?php while($r=$rows->fetch_assoc()): ?><tr><td><?= e($r['name']) ?></td><td><?= e($r['email']) ?></td><td><?= e($r['username']) ?></td><td><a class="btn danger" href="students.php?delete=<?= (int)$r['id'] ?>" onclick="return confirm('Delete this student?')">Delete</a></td></tr><?php endwhile; ?></table></div>
<?php page_footer(); ?>
