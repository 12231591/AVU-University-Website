<?php include 'includes/header.php'; ?>

<div class="card">
    <h2 style="text-align: center; margin-bottom: 20px;">👩‍🏫 Meet Our Staff</h2>

    <table>
        <thead>
            <tr>
                <th>👤 Name</th>
                <th>🏷️ Position</th>
                <th>🏢 Department</th>
                <th>📧 Email</th>
                <th>📞 Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $staff = getAllStaff();
            while ($s = mysqli_fetch_assoc($staff)) {
                echo "<tr>";
                echo "<td>{$s['first_name']} {$s['last_name']}</td>";
                echo "<td>{$s['position']}</td>";
                echo "<td>{$s['department']}</td>";
                echo "<td><a href='mailto:{$s['email']}'>{$s['email']}</a></td>";
                echo "<td><a href='tel:{$s['phone']}'>{$s['phone']}</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
