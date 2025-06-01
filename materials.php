<?php include 'includes/header.php'; ?>

<h2>📚 Course Materials</h2>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Subject</th>
                <th>Type</th>
                <th>Description</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $materials = getAllMaterials();
            while ($m = mysqli_fetch_assoc($materials)) {
                $title       = htmlspecialchars($m['title']);
                $subject     = htmlspecialchars($m['subject_name']);
                $type        = htmlspecialchars($m['type']);
                $description = htmlspecialchars($m['description']);
                $file        = htmlspecialchars($m['file_name']);

                echo "<tr>";
                echo "<td>{$title}</td>";
                echo "<td>{$subject}</td>";
                echo "<td>{$type}</td>";
                echo "<td>{$description}</td>";
                echo "<td><a class='btn' href='downloads/{$file}' download>📥 Download</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
