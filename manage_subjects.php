<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Check Admin Access
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'includes/header.php';

// Handle Add Subject Form Submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code = sanitize($_POST['code'] ?? '');
    $name = sanitize($_POST['name'] ?? '');
    $instructor = sanitize($_POST['instructor'] ?? '');

    if ($code && $name && $instructor) {
        $stmt = mysqli_prepare($conn, "INSERT INTO subjects (code, name, instructor) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $code, $name, $instructor);
        mysqli_stmt_execute($stmt);
        $success = "✅ Subject added successfully.";
    } else {
        $error = "⚠️ Please fill in all fields.";
    }
}
?>

<div class="card" style="max-width: 800px; margin: 40px auto; padding: 30px;">
    <h2>📚 Manage Subjects</h2>

    <?php if (!empty($success)): ?>
        <div class="success-message"><?= $success ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" style="margin-bottom: 30px;">
        <input type="text" name="code" placeholder="Subject Code" required>
        <input type="text" name="name" placeholder="Subject Name" required>
        <input type="text" name="instructor" placeholder="Instructor Name" required>
        <button type="submit" class="btn">➕ Add Subject</button>
    </form>

    <h3>📋 Current Subjects</h3>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Instructor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM subjects");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['code']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['instructor']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
