<?php
    require_once "Application.php"; //Connect to wrs_db

    //Create Personnel Table if not exist in wrs_db
    try{
        $SQL = "CREATE TABLE IF NOT EXISTS personnel(
            prsnnl_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            email VARCHAR(70) NOT NULL UNIQUE,
            contactno INT(11) NOT NULL,
            prsnnl_img VARCHAR(255) NOT NULL,
            birthday DATE NOT NULL,
            validID VARCHAR(255) NOT NULL,
            
            created_at timestamp DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp DEFAULT CURRENT_TIMESTAMP,
            -- personnel_status for deleting
            )";
        // $SQL = "ALTER TABLE personnel
        //     ADD IF NOT EXISTS profilepic VARCHAR(2048) NOT NULL,
        //     -- ADD IF NOT EXISTS 'status' BOOLEAN for deleting status
        //     ADD IF NOT EXISTS created_at timestamp DEFAULT CURRENT_TIMESTAMP";
        $DB_con->exec($SQL);
        //echo "Table created successfully" . '<br>';
    } catch (PDOException $error){
        die("Error creating table $SQL." . $error->getMessage());
    }

    //Create Customer Table if not exist in wrs_db
    try {
        $SQL = "CREATE TABLE IF NOT EXISTS customer( 
            cstmr_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            'address' VARCHAR(255) NOT NULL,
            contactno INT(11) NOT NULL,
            birthday DATE NOT NULL,
            created_at timestamp DEFAULT CURRENT_TIMESTAMP
            )";
        $DB_con->exec($SQL);
        //echo "Table created successfully" . '<br>';
    } catch (PDOException $error){
        die("Error creating table $SQL." . $error->getMessage());
    }
?>
