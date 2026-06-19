<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function require_login($roles = []) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit();
    }
    if (!empty($roles) && !in_array($_SESSION['role'], $roles, true)) {
        header('Location: ' . $_SESSION['role'] . '.php');
        exit();
    }
}

function redirect_by_role($role) {
    if ($role === 'admin') return 'admin.php';
    if ($role === 'teacher') return 'teacher.php';
    return 'student.php';
}

function page_header($title) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $role = $_SESSION['role'] ?? '';
    $username = $_SESSION['username'] ?? '';
    $links = [];
    if ($role === 'admin') {
        $links = [
            'admin.php' => 'Dashboard',
            'students.php' => 'Students',
            'teachers.php' => 'Teachers',
            'grades.php' => 'Grades',
            'attendance.php' => 'Attendance'
        ];
    } elseif ($role === 'teacher') {
        $links = [
            'teacher.php' => 'Dashboard',
            'grades.php' => 'Enter Grades',
            'attendance.php' => 'Attendance'
        ];
    } elseif ($role === 'student') {
        $links = [
            'student.php' => 'My Report'
        ];
    }
    echo "<!doctype html><html lang='en'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>" . e($title) . "</title><link rel='stylesheet' href='style.css'></head><body>";
    echo "<aside class='sidebar'><div class='brand'>Student System</div><div class='user-box'>" . e(ucfirst($role)) . "<br><small>" . e($username) . "</small></div><nav>";
    foreach ($links as $href => $label) {
        $active = basename($_SERVER['PHP_SELF']) === $href ? ' class="active"' : '';
        echo "<a href='" . e($href) . "'" . $active . ">" . e($label) . "</a>";
    }
    echo "<a class='logout' href='logout.php'>Logout</a></nav></aside><main class='main'><div class='topbar'><h1>" . e($title) . "</h1></div>";
}

function page_footer() {
    echo "</main></body></html>";
}
?>
