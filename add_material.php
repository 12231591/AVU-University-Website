<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// 🔒 Only admin can add materials
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title']);
    $subject_id = intval($_POST['subject_id']);
    $type = sanitize($_POST['type']);
    $description = sanitize($_POST['description']);

    // 📦 Upload handling
    $target_dir = "downloads/";
    $original_file = basename($_FILES["file"]["name"]);
    $safe_file = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $original_file);
    $target_file = $target_dir . $safe_file;

    // ✅ Create folder if not exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // 🔒 Validate MIME type (optional)
    $allowed_types = ['application/pdf', 'application/zip', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $mime_type = mime_content_type($_FILES['file']['tmp_name']);

    if (!in_array($mime_type, $allowed_types)) {
        die("<div class='error-message'>❌ Invalid file type. Only PDF, Word, or ZIP files allowed.</div>");
    }

    // 📤 Upload file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // ✅ Insert securely
        $stmt = $conn->prepare("INSERT INTO materials (title, subject_id, type, description, file_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $title, $subject_id, $type, $description, $safe_file);

        if ($stmt->execute()) {
            header("Location: admin_dashboard.php#materials");
            exit;
        } else {
            die("<div class='error-message'>❌ DB Error: " . $stmt->error . "</div>");
        }
    } else {
        die("<div class='error-message'>❌ File upload failed. Check permissions.</div>");
    }
} else {
    header("Location: admin_dashboard.php");
    exit;
}
?>
