<?php
    require_once "Application.php"; //Connect to wrs_db

    //Create Personnel Table if not exist in wrs_db
    try{
        $SQL = "CREATE TABLE IF NOT EXISTS personnel(
            userID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            roleID VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            email VARCHAR(70) NOT NULL UNIQUE,
            contact_number INT(11) NOT NULL,
            age VARCHAR(255) NULL,
            birthday DATE NOT NULL,
            validID VARCHAR(255) NOT NULL,
            profpic VARCHAR(255) NULL,
            user_status VARCHAR(255) NULL,
            created_at timestamp DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp DEFAULT CURRENT_TIMESTAMP
            )";
        $DB_con->exec($SQL);
        echo "Table created successfully" . '<br>';
    } catch (PDOException $error){
        die("Error creating table $SQL." . $error->getMessage());
    }

    //Create Customer Table if not exist in wrs_db
    try {
        $SQL = "CREATE TABLE IF NOT EXISTS customer( 
            cstmr_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            cstmr_address VARCHAR(255) NOT NULL,
            contact_number INT(11) NOT NULL,
            birthday DATE NOT NULL,
            created_at timestamp DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp DEFAULT CURRENT_TIMESTAMP
            )";
        $DB_con->exec($SQL);
        echo "Table created successfully" . '<br>';
    } catch (PDOException $error){
        die("Error creating table $SQL." . $error->getMessage());
    }

    //Create Supply Table if not exist in wrs_db
    //Create Expense Table if not exist in wrs_db
    //Create Sales Report Table if not exist in wrs_db
?>
