<?php
/*
Name: Patrick Sullivan
Date: April 2, 2026
Description: Admin page that retrieves and displays all contact form submissions from the database in a tabular format.
*/

// Connect to the db brige 
include "includes/db_connect.php";

// Fetch all submissions joined with visitor info, newest coming first
$stmt = $pdo->query("
    SELECT cs.submission_id, v.name, v.email, cs.reason, cs.message, cs.submitted_at
    FROM contact_submissions cs
    JOIN visitors v ON cs.visitor_id = v.visitor_id
    ORDER BY cs.submitted_at DESC
");

$submissions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submissions</title>
</head>
<body>

<h1>Contact Submissions</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Reason</th>
        <th>Message</th>
        <th>Time</th>
        <th>Action</th>
    </tr>

    <?php foreach ($submissions as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row["name"]) ?></td>
            <td><?= htmlspecialchars($row["email"]) ?></td>
            <td><?= htmlspecialchars($row["reason"]) ?></td>
            <td><?= htmlspecialchars($row["message"]) ?></td>
            <td><?= htmlspecialchars($row["submitted_at"]) ?></td>
            <td>
                <!-- Delete links with confirmation prompt -->
                <a href="delete_submissions.php?id=<?= $row["submission_id"] ?>" 
                   onclick="return confirm('Delete this submission?');">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>
</body>
</html>