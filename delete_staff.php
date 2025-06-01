<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// 🔐 Ensure admin is logged in
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

// 🧪 Check if ID is passed
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // 🧹 Set related subjects' staff_id to NULL
    $unlink = "UPDATE subjects SET staff_id = NULL WHERE staff_id = $id";
    mysqli_query($conn, $unlink);

    // ✅ Then delete staff
    $query = "DELETE FROM staff WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: admin_dashboard.php#staff");
        exit;
    } else {
        echo "❌ Error deleting staff: " . mysqli_error($conn);
    }
} else {
    echo "❌ Invalid staff ID";
}
?>
