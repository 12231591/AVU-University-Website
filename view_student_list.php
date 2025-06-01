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
?>

<div class="card" style="max-width: 1000px; margin: 40px auto; padding: 30px;">
    <h2>👥 Registered Students</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM students");
            while ($student = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$student['id']}</td>
                        <td>{$student['full_name']}</td>
                        <td>{$student['email']}</td>
                        <td>
                            <a href='delete_student.php?id={$student['id']}' 
                               onclick=\"return confirm('Are you sure you want to delete this student?');\" 
                               style='color: red;'>🗑 Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
