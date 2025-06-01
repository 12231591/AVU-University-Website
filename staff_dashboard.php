<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// For demo: Only allow admins to access staff dashboard
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'includes/header.php';
?>

<div class="card" style="max-width: 800px; margin: 40px auto; padding: 30px;">
    <h2>👨‍🏫 Staff Dashboard</h2>
    <p>Welcome to the staff management section. Here you can manage courses, view reports, and assist students.</p>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-top: 30px;">
        <a href="manage_subjects.php" class="btn" style="background: #003366; color: white;">📚 Manage Subjects</a>
        <a href="manage_materials.php" class="btn" style="background: #0055a5; color: white;">📂 Manage Materials</a>
        <a href="view_student_list.php" class="btn" style="background: #004080; color: white;">👩‍🎓 View Students</a>
        <a href="reports.php" class="btn" style="background: #336699; color: white;">📊 View Reports</a>
        <a href="logout.php" class="btn" style="background: #a80000; color: white;">🚪 Logout</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
