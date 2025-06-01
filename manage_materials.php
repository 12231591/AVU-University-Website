<?php
session_start();
require_once 'includes/config.php';

if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['material'])) {
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $fileName = $_FILES['material']['name'];
    $fileTmp = $_FILES['material']['tmp_name'];
    $uploadPath = "uploads/" . basename($fileName);

    if (move_uploaded_file($fileTmp, $uploadPath)) {
        mysqli_query($conn, "INSERT INTO materials (title, subject_name, file_name) VALUES ('$title', '$subject', '$fileName')");
    }
}

include 'includes/header.php';
?>

<div class="card" style="max-width: 800px; margin: 40px auto; padding: 30px;">
    <h2>📂 Manage Study Materials</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Material Title" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <input type="file" name="material" required>
        <button type="submit">📥 Upload</button>
    </form>

    <h3 style="margin-top: 30px;">Uploaded Materials</h3>
    <table>
        <thead>
            <tr><th>Title</th><th>Subject</th><th>File</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM materials");
            while ($mat = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$mat['title']}</td>
                        <td>{$mat['subject_name']}</td>
                        <td><a href='uploads/{$mat['file_name']}' target='_blank'>View</a></td>
                        <td><a href='delete_material.php?id={$mat['id']}' style='color: red;'>🗑 Delete</a></td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
