<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// 🔐 Check login
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

// 🔍 Get staff data
$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM staff WHERE id = $id LIMIT 1");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("❌ Staff not found.");
}

// 📝 Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fn    = sanitize($_POST['first_name']);
    $ln    = sanitize($_POST['last_name']);
    $pos   = sanitize($_POST['position']);
    $dept  = sanitize($_POST['department']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Invalid email address.");
    }

    $update = "UPDATE staff SET 
        first_name='$fn',
        last_name='$ln',
        position='$pos',
        department='$dept',
        email='$email',
        phone='$phone'
        WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        header("Location: admin_dashboard.php#staff");
        exit;
    } else {
        echo "❌ Update failed: " . mysqli_error($conn);
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="card">
    <h2>✏️ Edit Staff Member</h2>

    <form method="POST">
        <div class="form-group">
            <label>First Name</label>
            <input name="first_name" value="<?= htmlspecialchars($data['first_name']) ?>" required>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input name="last_name" value="<?= htmlspecialchars($data['last_name']) ?>" required>
        </div>
        <div class="form-group">
            <label>Position</label>
            <input name="position" value="<?= htmlspecialchars($data['position']) ?>" required>
        </div>
        <div class="form-group">
            <label>Department</label>
            <input name="department" value="<?= htmlspecialchars($data['department']) ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input name="phone" value="<?= htmlspecialchars($data['phone']) ?>" required>
        </div>
        <button type="submit">✅ Update Staff</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
