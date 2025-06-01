<?php
session_start();
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';
?>

<!-- 🔥 Dashboard Header -->
<div class="card" style="text-align: center;">
    <h2 style="margin-bottom: 10px;">🎛️ Admin Dashboard</h2>
    <p>Welcome back, <strong><?php echo $_SESSION['admin_username']; ?></strong> 👋</p>
</div>

<!-- 🚀 Quick Links -->
<div class="card admin-nav" style="text-align: center;">
    <h3>Quick Access</h3>
    <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 15px; margin-top: 15px;">
        <a href="#staff" class="btn">👨‍🏫 Manage Staff</a>
        <a href="#subjects" class="btn">📚 Manage Subjects</a>
        <a href="#materials" class="btn">📂 Manage Materials</a>
        <a href="#forms" class="btn">📝 Manage Forms</a>
        <a href="logout.php" class="btn" style="background-color: #c0392b;">🚪 Logout</a>
    </div>
</div>

<!-- 👥 Staff Section -->
<section id="staff" class="card">
    <h3>👥 Manage Staff</h3>
    <form action="add_staff.php" method="POST">
        <input name="first_name" placeholder="First Name" required>
        <input name="last_name" placeholder="Last Name" required>
        <input name="position" placeholder="Position" required>
        <input name="department" placeholder="Department" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="phone" placeholder="Phone" required>
        <button type="submit">➕ Add Staff</button>
    </form>

    <table>
        <thead><tr><th>Name</th><th>Email</th><th>Actions</th></tr></thead>
        <tbody>
        <?php
        $staff = getAllStaff();
        while ($s = mysqli_fetch_assoc($staff)) {
            echo "<tr>";
            echo "<td>{$s['first_name']} {$s['last_name']}</td>";
            echo "<td>{$s['email']}</td>";
            echo "<td>
                    <a href='edit_staff.php?id={$s['id']}' class='btn btn-edit'>Edit</a>
                    <a href='delete_staff.php?id={$s['id']}' onclick=\"return confirm('Delete this staff?')\" class='btn btn-delete'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</section>

<!-- 📚 Subjects Section -->
<section id="subjects" class="card">
    <h3>📚 Manage Subjects</h3>
    <form action="add_subject.php" method="POST">
        <input name="name" placeholder="Subject Name" required>
        <input name="code" placeholder="Code" required>
        <input name="credits" type="number" placeholder="Credits" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <select name="staff_id" required>
            <option value="">Select Instructor</option>
            <?php
            $staff = getAllStaff();
            while ($s = mysqli_fetch_assoc($staff)) {
                echo "<option value='{$s['id']}'>{$s['first_name']} {$s['last_name']}</option>";
            }
            ?>
        </select>
        <button type="submit">➕ Add Subject</button>
    </form>

    <table>
        <thead><tr><th>Code</th><th>Name</th><th>Instructor</th></tr></thead>
        <tbody>
        <?php
        $subjects = getAllSubjects();
        while ($sub = mysqli_fetch_assoc($subjects)) {
            echo "<tr>";
            echo "<td>{$sub['code']}</td>";
            echo "<td>{$sub['name']}</td>";
            echo "<td>{$sub['first_name']} {$sub['last_name']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</section>

<!-- 📂 Materials Section -->
<section id="materials" class="card">
    <h3>📂 Manage Materials</h3>
    <form action="add_material.php" method="POST" enctype="multipart/form-data">
        <input name="title" placeholder="Title" required>
        <select name="subject_id" required>
            <option value="">Select Subject</option>
            <?php
            $subs = getAllSubjects();
            while ($s = mysqli_fetch_assoc($subs)) {
                echo "<option value='{$s['id']}'>{$s['name']}</option>";
            }
            ?>
        </select>
        <input name="type" placeholder="Type" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="file" name="file" required>
        <button type="submit">➕ Add Material</button>
    </form>

    <table>
        <thead><tr><th>Title</th><th>Subject</th><th>Type</th></tr></thead>
        <tbody>
        <?php
        $materials = getAllMaterials();
        while ($m = mysqli_fetch_assoc($materials)) {
            echo "<tr>";
            echo "<td>{$m['title']}</td>";
            echo "<td>{$m['subject_name']}</td>";
            echo "<td>{$m['type']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</section>

<!-- 📝 Forms Section -->
<section id="forms" class="card">
    <h3>📝 Manage Forms</h3>
    <form action="add_form.php" method="POST" enctype="multipart/form-data">
        <input name="title" placeholder="Form Title" required>
        <select name="type" required>
            <option value="">Select Type</option>
            <option value="Student">Student</option>
            <option value="Staff">Staff</option>
            <option value="Admin">Admin</option>
        </select>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="file" name="file" required>
        <button type="submit">➕ Add Form</button>
    </form>

    <table>
        <thead><tr><th>Title</th><th>Type</th><th>Description</th></tr></thead>
        <tbody>
        <?php
        $forms = getAllForms();
        while ($f = mysqli_fetch_assoc($forms)) {
            echo "<tr>";
            echo "<td>{$f['title']}</td>";
            echo "<td>{$f['type']}</td>";
            echo "<td>{$f['description']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</section>

<?php include 'includes/footer.php'; ?>
