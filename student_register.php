<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$success = $error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = sanitize($_POST['full_name']);
    $email = sanitize($_POST['email']);
    $pass  = sanitize($_POST['password']); // Note: For demo only; use hashing in production.

    $stmt = mysqli_prepare($conn, "SELECT id FROM students WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $error = "⚠️ This email is already registered. Please log in instead.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO students (full_name, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $pass);

        if (mysqli_stmt_execute($stmt)) {
            $success = "🎉 Registration successful! You can now <a href='student_login.php'><strong>Login</strong></a>.";
        } else {
            $error = "❌ Something went wrong. Please try again.";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<style>
.register-container {
  max-width: 500px;
  margin: 60px auto;
  background: #ffffff;
  padding: 30px 40px;
  border-radius: 10px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.1);
  animation: fadeIn 0.7s ease-in;
}
.register-container h2 {
  text-align: center;
  font-size: 2rem;
  margin-bottom: 20px;
  color: #003366;
}
form input {
  width: 100%;
  margin-bottom: 18px;
  padding: 12px;
  font-size: 15px;
  border: 1px solid #ccc;
  border-radius: 6px;
}
form button {
  width: 100%;
  background: #003366;
  color: white;
  padding: 12px;
  font-weight: bold;
  border: none;
  border-radius: 6px;
  transition: background 0.3s;
}
form button:hover {
  background: #002244;
}
.success-message, .error-message {
  padding: 12px;
  border-radius: 6px;
  font-weight: bold;
  margin-bottom: 20px;
}
.success-message {
  background: #e0ffe4;
  color: #116611;
}
.error-message {
  background: #ffe0e0;
  color: #990000;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(15px); }
  to   { opacity: 1; transform: translateY(0); }
}
</style>

<div class="register-container">
  <h2>📝 Student Registration</h2>

  <?php if (!empty($success)): ?>
    <div class="success-message"><?= $success ?></div>
  <?php elseif (!empty($error)): ?>
    <div class="error-message"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <input type="text" name="full_name" placeholder="Full Name" value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>" required>
    <input type="email" name="email" placeholder="Email Address" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
    <input type="password" name="password" placeholder="Create Password" required>
    <button type="submit">✅ Register</button>
  </form>

  <p style="text-align: center; margin-top: 15px;">
    Already registered? <a href="student_login.php"><strong>Login here</strong></a>.
  </p>
</div>

<?php include 'includes/footer.php'; ?>
