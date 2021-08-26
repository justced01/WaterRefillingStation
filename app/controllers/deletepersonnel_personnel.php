<?php
    require_once "../../core/Application.php"; //Connect to wrs_db

    $id = $_POST['id'] ?? null;
    if (!$id) {
        header ('Location: index.php');
        exit;
    }

    $statement = $DB_con->prepare('DELETE FROM personnel WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    header("Location: index.php");
?>
