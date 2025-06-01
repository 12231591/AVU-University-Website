<?php include 'includes/header.php'; ?>

<div class="card">
    <h2 style="text-align:center; margin-bottom: 20px;">📘 Subjects Offered</h2>

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Credits</th>
                <th>Instructor</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $subjects = getAllSubjects();
            while ($s = mysqli_fetch_assoc($subjects)) {
                $desc = strlen($s['description']) > 100 
                    ? substr($s['description'], 0, 100) . '...'
                    : $s['description'];
                echo "<tr>";
                echo "<td>{$s['code']}</td>";
                echo "<td>{$s['name']}</td>";
                echo "<td>{$s['credits']}</td>";
                echo "<td>{$s['first_name']} {$s['last_name']}</td>";
                echo "<td>{$desc}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
