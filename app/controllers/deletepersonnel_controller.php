<?php
    require_once "../core/Application.php"; //Connect to wrs_db

    $userID = $_POST['userID'] ?? null;
    if (!$userID) {
        header ('Location: ../public/user/index.php');
        exit;
    }

    $statement = $DB_con->prepare('DELETE FROM personnel WHERE userID = :userID');
    $statement->bindValue(':userID', $userID);
    $statement->execute();
    header("Location: ../public/user/index.php");
?>
