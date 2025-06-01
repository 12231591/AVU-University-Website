<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// 🔒 Allow only logged-in admins
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fn    = sanitize($_POST['first_name']);
    $ln    = sanitize($_POST['last_name']);
    $pos   = sanitize($_POST['position']);
    $dept  = sanitize($_POST['department']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);

    // ✅ Email format validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<div class='error-message'>❌ Invalid email format.</div>");
    }

    // ✅ Prepared statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO staff (first_name, last_name, position, department, email, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fn, $ln, $pos, $dept, $email, $phone);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php#staff");
        exit;
    } else {
        echo "<div class='error-message'>❌ DB Error: " . $stmt->error . "</div>";
    }
} else {
    header("Location: admin_dashboard.php");
    exit;
}
?>
