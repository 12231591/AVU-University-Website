<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'includes/header.php';
?>

<div class="card" style="max-width: 800px; margin: 40px auto; padding: 30px;">
    <h2>📊 Reports</h2>
    <p>View reports on student performance, material downloads, and system activity.</p>

    <!-- Example Report Table -->
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th style="border: 1px solid #ccc; padding: 10px;">Report Name</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Date</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ccc; padding: 10px;">Student Performance Report</td>
                <td style="border: 1px solid #ccc; padding: 10px;">May 15, 2025</td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <a href="#" class="btn" style="padding: 8px 16px;">📄 View</a>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ccc; padding: 10px;">Material Downloads</td>
                <td style="border: 1px solid #ccc; padding: 10px;">May 10, 2025</td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <a href="#" class="btn" style="padding: 8px 16px;">📄 View</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
