<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

$error = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = sanitize($_POST['email']    ?? '');
    $password = sanitize($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $error = "⚠️ Please fill in both email and password.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, full_name, password FROM students WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if ($password === $user['password']) {
                $_SESSION['student_id'] = $user['id'];
                $_SESSION['student_name'] = $user['full_name'];
                $_SESSION['student_loggedin'] = true;
                header("Location: student_dashboard.php");
                exit;
            } else {
                $error = "❌ Incorrect password.";
            }
        } else {
            $error = "❌ No student found with that email.";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<style>
.login-container {
  max-width: 480px;
  margin: 60px auto;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  padding: 30px 40px;
  animation: fadeIn 0.8s ease;
}
.login-container h2 {
  margin-bottom: 20px;
  font-size: 2rem;
  text-align: center;
  color: #003366;
}
.form-group {
  margin-bottom: 20px;
}
label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
}
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 1rem;
}
.btn {
  background-color: #003366;
  color: #fff;
  border: none;
  padding: 12px 20px;
  width: 100%;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s;
}
.btn:hover {
  background-color: #002244;
}
.error-message {
  background: #ffe0e0;
  color: #a10000;
  padding: 10px 15px;
  border-radius: 5px;
  margin-bottom: 15px;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.register-link {
  margin-top: 15px;
  text-align: center;
}
.register-link a {
  color: #0055a5;
  font-weight: 600;
  text-decoration: none;
}
.register-link a:hover {
  text-decoration: underline;
}
</style>

<div class="login-container">
    <h2>🎓 Student Login</h2>

    <?php if ($error !== ''): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input id="email" type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input id="password" type="password" name="password" required>
        </div>
        <button type="submit" class="btn">🔐 Login</button>
    </form>

    <div class="register-link">
        New student? <a href="student_register.php">Register here</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
