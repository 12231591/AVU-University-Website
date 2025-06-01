<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Check if student is logged in
if (!isset($_SESSION['student_loggedin'])) {
    header("Location: student_login.php");
    exit;
}

include 'includes/header.php';
?>

<!-- 🎓 Student Dashboard -->
<div class="card">
    <h2>Welcome, <?= isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Student'; ?> 👋</h2>
    <p>Explore all the key areas of your academic profile right here.</p>
    <a href="#subjects" class="btn">View Subjects</a>
    <a href="#materials" class="btn">Study Materials</a>
    <a href="#forms" class="btn">Useful Forms</a>
</div>

<!-- ✨ Quick Overview -->
<div class="card">
    <h3>🏢 AVU at a Glance</h3>
    <ul>
        <li><strong>Courses:</strong> Access a wide range of industry-aligned subjects.</li>
        <li><strong>Faculty:</strong> Learn from world-class instructors and mentors.</li>
        <li><strong>Resources:</strong> Download materials, forms, and use the AI assistant.</li>
        <li><strong>Support:</strong> 24/7 access to academic help and resources.</li>
    </ul>
</div>

<!-- 📘 Subjects Section -->
<div class="card" id="subjects">
    <h3>📘 Your Subjects</h3>
    <table>
        <thead><tr><th>Code</th><th>Name</th><th>Instructor</th></tr></thead>
        <tbody>
        <?php
        $subjects = getAllSubjects();
        while ($sub = mysqli_fetch_assoc($subjects)) {
            echo "<tr><td>{$sub['code']}</td><td>{$sub['name']}</td><td>{$sub['first_name']} {$sub['last_name']}</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- 📂 Materials Section -->
<div class="card" id="materials">
    <h3>📂 Downloadable Materials</h3>
    <table>
        <thead><tr><th>Title</th><th>Subject</th><th>Type</th><th>Download</th></tr></thead>
        <tbody>
        <?php
        $materials = getAllMaterials();
        while ($m = mysqli_fetch_assoc($materials)) {
            echo "<tr>
                    <td>{$m['title']}</td>
                    <td>{$m['subject_name']}</td>
                    <td>{$m['type']}</td>
                    <td><a href='downloads/{$m['file_name']}' download>👅 Download</a></td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- 🗒 Forms Section -->
<div class="card" id="forms">
    <h3>🗒 Useful Forms</h3>
    <table>
        <thead><tr><th>Title</th><th>Type</th><th>Description</th><th>Download</th></tr></thead>
        <tbody>
        <?php
        $forms = getAllForms();
        while ($f = mysqli_fetch_assoc($forms)) {
            echo "<tr>
                    <td>{$f['title']}</td>
                    <td>{$f['type']}</td>
                    <td>{$f['description']}</td>
                    <td><a href='downloads/{$f['file_name']}' download>👅 Download</a></td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- 🧠 Chatbot Panel -->
<div class="card">
    <h3>🧠 Ask AVU AI Assistant</h3>
    <textarea id="question" placeholder="Ask about your schedule, materials, etc..." rows="3" style="width:100%; padding:10px;"></textarea>
    <br><br>
    <button onclick="askAI()" class="btn">Ask</button>
    <div id="ai-response" style="margin-top:15px; font-weight: bold;"></div>
</div>

<script>
function askAI() {
    const question = document.getElementById("question").value;
    const responseBox = document.getElementById("ai-response");
    responseBox.innerHTML = "⏳ Thinking...";

    fetch("ai_chat.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ question: question })
    })
    .then(response => response.json())
    .then(data => {
        responseBox.innerHTML = data.answer;
    })
    .catch(error => {
        responseBox.innerHTML = "⚠️ Something went wrong.";
    });
}
</script>

<?php include 'includes/footer.php'; ?>
