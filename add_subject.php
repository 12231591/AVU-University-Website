<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// 🔒 Restrict access
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

// 🚀 Only run on POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name        = sanitize($_POST['name']);
    $code        = sanitize($_POST['code']);
    $credits     = (int) $_POST['credits'];
    $description = sanitize($_POST['description']);
    $staff_id    = (int) $_POST['staff_id'];

    // ❗ Validate all required fields
    if (empty($name) || empty($code) || empty($credits) || empty($description) || empty($staff_id)) {
        die("❌ All fields are required.");
    }

    // ✅ Use prepared statement for better security
    $stmt = $conn->prepare("INSERT INTO subjects (name, code, credits, description, staff_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisi", $name, $code, $credits, $description, $staff_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: admin_dashboard.php#subjects");
        exit;
    } else {
        echo "❌ Database Error: " . $stmt->error;
        $stmt->close();
    }
} else {
    // Redirect if script accessed directly
    header("Location: admin_dashboard.php");
    exit;
}
?>
