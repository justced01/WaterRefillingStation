<?php
    try {
        $PDO = new PDO('mysql:host=localhost;port=3306;dbname=wrs_db','root','');
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $error){
        die("Error: Could not able to connect $SQL." . $error->getMessage());
    }

    try{
        $SQL = "CREATE DATABASE wrs_db";
        $PDO->exec($SQL);
        echo "Database created successfully.";
    } catch(PDOException $error){
        die("Error: Could not able to execute $SQL." . $error->getMessage());
    }

?>
