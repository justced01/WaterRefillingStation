<?php
    $DB_HOST = 'localhost';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = '';
    $DB_NAME = 'wrs_db';
    //$DB_con = null;

    $DB_con = new PDO("mysql:host=$DB_HOST", $DB_USERNAME, $DB_PASSWORD);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USERNAME,$DB_PASSWORD);
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $error){
        echo $error->getMessage();
    }

    $DB_con->exec("CREATE DATABASE IF NOT EXISTS $DB_NAME;");

    $DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USERNAME,$DB_PASSWORD);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
