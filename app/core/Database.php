<?php
    require_once "Application.php"; //Connect to wrs_db

    //Create Personnel Table if not exist in wrs_db
    try{
        $SQL = "CREATE TABLE IF NOT EXISTS personnel(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            fname VARCHAR(255) NOT NULL,
            lname VARCHAR(255) NOT NULL,
            email Varchar(70) NOT NULL UNIQUE
            /*uname VARCHAR(25) NOT NULL
            pword VARCHAR(16)*/
            )";
        $SQL = "ALTER TABLE personnel
            ADD IF NOT EXISTS profilepic VARCHAR(2048) NOT NULL,
            ADD IF NOT EXISTS created_at timestamp DEFAULT CURRENT_TIMESTAMP";
        $PDO->exec($SQL);
        //echo "Table created successfully" . '<br>';
    } catch (PDOException $error){
        die("Error creating table $SQL." . $error->getMessage());
    }

    //Create Customer Table if not exist in wrs_db
    try {
        $SQL = "CREATE TABLE IF NOT EXISTS customer( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            fname VARCHAR(255) NOT NULL,
            lname VARCHAR(255) NOT NULL,
            address_ VARCHAR(255) NOT NULL,
            contactno INT(11) NOT NULL,
            birthday DATE NOT NULL,
            created_at timestamp DEFAULT CURRENT_TIMESTAMP
            )";
        $PDO->exec($SQL);
        //echo "Table created successfully" . '<br>';
    } catch (PDOException $error){
        die("Error creating table $SQL." . $error->getMessage());
    }
?>
