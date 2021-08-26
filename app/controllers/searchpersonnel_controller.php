<?php   
    require_once "../../core/Application.php"; //Connect to wrs_db

    //search
    $search = $_GET['search'] ?? '';
    if ($search) {
        $statement = $DB_con->prepare('SELECT * FROM personnel WHERE lname LIKE :lname ORDER BY created_at DESC');
        $statement->bindValue(':lname',"%$search%");
    } else {
        $statement = $DB_con->prepare('SELECT * FROM personnel ORDER BY created_at DESC');
    }
    $statement->execute();
    $personnel = $statement->fetchall(PDO::FETCH_ASSOC);
?>