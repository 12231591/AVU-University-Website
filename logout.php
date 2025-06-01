<?php
session_start();

$redirectTo = 'index.php';
if (isset($_SESSION['admin_loggedin'])) {
    $redirectTo = 'login.php'; // Admin login
} elseif (isset($_SESSION['student_loggedin'])) {
    $redirectTo = 'student_login.php'; // Student login
}

session_unset();
session_destroy();

header("Location: $redirectTo");
exit;
?>
