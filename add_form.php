<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// 🔒 Allow only admin
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title']);
    $type = sanitize($_POST['type']);
    $description = sanitize($_POST['description']);

    // 📦 Upload config
    $target_dir = "downloads/";
    $original_file = basename($_FILES["file"]["name"]);
    $safe_file = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $original_file);
    $target_file = $target_dir . $safe_file;

    // ✅ Create directory if missing
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // 🔒 Check MIME type (optional)
    $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $mime_type = mime_content_type($_FILES['file']['tmp_name']);

    if (!in_array($mime_type, $allowed_types)) {
        die("<div class='error-message'>❌ Only PDF or Word files allowed.</div>");
    }

    // 📤 Move uploaded file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // ✅ Use prepared statement
        $stmt = $conn->prepare("INSERT INTO forms (title, type, description, file_name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $type, $description, $safe_file);
        
        if ($stmt->execute()) {
            header("Location: admin_dashboard.php#forms");
            exit;
        } else {
            die("<div class='error-message'>❌ DB Error: " . $stmt->error . "</div>");
        }
    } else {
        die("<div class='error-message'>❌ File upload failed. Check folder permissions.</div>");
    }
} else {
    header("Location: admin_dashboard.php");
    exit;
}
?>
