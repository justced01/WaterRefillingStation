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
        $PDO->exec($SQL);
        //echo "Table created successfully" . '<br>';
    } catch (PDOException $error){
        die("Error creating table $SQL." . $error->getMessage());
    }

    /*try{
        $SQL = "INSERT INTO personnel (fname, lname, email) VALUES 
                ('James', 'Marañon', 'jamesmaranon@gmail.com')";
        $PDO->exec($SQL);
        echo "Record inserted successfully" . '<br>';
    } catch (PDOException $error){
        die("Error inserting record $SQL." . $error->getMessage());
    }*/
?>
