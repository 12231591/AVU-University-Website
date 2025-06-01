<?php include 'includes/header.php'; ?>

<div class="card">
    <h2>📝 Downloadable Forms</h2>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Description</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $forms = getAllForms();
            while ($f = mysqli_fetch_assoc($forms)) {
                $filePath = 'downloads/' . $f['file_name'];
                $fileExists = file_exists($filePath);

                echo "<tr>";
                echo "<td>" . htmlspecialchars($f['title']) . "</td>";
                echo "<td>" . htmlspecialchars($f['type']) . "</td>";
                echo "<td>" . htmlspecialchars($f['description']) . "</td>";
                echo "<td>";
                if ($fileExists) {
                    echo "<a class='btn' href='$filePath' download>📥 Download</a>";
                } else {
                    echo "<span style='color: red;'>❌ Missing</span>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
