<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = sanitize($_POST['username'] ?? '');
    $password = sanitize($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = "⚠️ Please enter both username and password.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM administrators WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($admin = mysqli_fetch_assoc($result)) {
            if ($password === $admin['password']) {
                $_SESSION['admin_id']       = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_loggedin'] = true;
                header("Location: admin_dashboard.php");
                exit;
            } else {
                $error = "❌ Incorrect password.";
            }
        } else {
            $error = "❌ Invalid username.";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<style>
.admin-login-container {
  max-width: 480px;
  margin: 60px auto;
  padding: 30px 40px;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
  animation: fadeIn 0.8s ease;
}
.admin-login-container h2 {
  text-align: center;
  color: #003366;
  font-size: 2rem;
  margin-bottom: 25px;
}
.form-group {
  margin-bottom: 20px;
}
label {
  display: block;
  font-weight: 600;
  margin-bottom: 8px;
}
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
}
.btn {
  background-color: #003366;
  color: white;
  padding: 12px;
  width: 100%;
  border: none;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
}
.btn:hover {
  background-color: #002244;
}
.error-message {
  background: #ffe0e0;
  color: #a10000;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 15px;
}
.demo-box {
  background-color: #f0f8ff;
  padding: 15px;
  border-radius: 6px;
  margin-top: 25px;
}
.demo-box h4 {
  margin-top: 0;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="admin-login-container">
  <h2>🔐 Staff Login</h2>

  <?php if ($error !== ''): ?>
    <div class="error-message"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="form-group">
      <label for="username">Username:</label>
      <input id="username" name="username" type="text" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required placeholder="Enter admin username">
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input id="password" name="password" type="password" required placeholder="Enter password">
    </div>

    <button type="submit" class="btn">🔐 Login</button>
  </form>

  <div class="demo-box">
    <h4>💡 Demo Credentials</h4>
    <ul>
      <li><strong>Username:</strong> superadmin</li>
      <li><strong>Password:</strong> supersecure</li>
    </ul>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Chatbot Script Integration -->
<div id="chat-widget" title="Chat with AVU AI Assistant">
  <div class="chat-toggle">💬</div>
  <div class="chat-window">
    <div class="chat-header">
      <span>AVU AI Assistant</span>
      <button class="chat-close">✖</button>
    </div>
    <div class="chat-body">
      <div id="chat-response">Ask me anything about AVU!</div>
      <input type="text" id="chat-input" placeholder="Type your question..." />
      <button id="chat-send">Send</button>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const widget = document.getElementById('chat-widget');
  const toggle = widget.querySelector('.chat-toggle');
  const windowEl = widget.querySelector('.chat-window');
  const closeBtn = widget.querySelector('.chat-close');
  const sendBtn = document.getElementById('chat-send');

  toggle.addEventListener('click', () => {
    toggle.style.display = 'none';
    windowEl.style.display = 'flex';
  });

  closeBtn.addEventListener('click', () => {
    windowEl.style.display = 'none';
    toggle.style.display = 'flex';
  });

  sendBtn.addEventListener('click', () => {
    const input = document.getElementById('chat-input').value.trim();
    const resp = document.getElementById('chat-response');
    if (!input) return;
    resp.textContent = '⏳ Thinking...';
    fetch('ai_chat.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ question: input })
    })
    .then(r => r.json())
    .then(d => resp.innerHTML = d.answer)
    .catch(() => resp.textContent = '⚠️ Connection error.');
  });
});
</script>
