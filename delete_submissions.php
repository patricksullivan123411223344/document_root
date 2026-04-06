<?php
include "includes/db_connect.php";

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = (int)$_GET["id"];

    try {
        $stmt = $pdo->prepare("DELETE FROM contact_submissions WHERE submission_id = ?");
        $stmt->execute[$id];
    } catch (PDOException $e) {
        die("Delete failed: " . htmlspecialchars($e->getMessage()));
    }
}

header("Location: view_submissions.php")
exit;
