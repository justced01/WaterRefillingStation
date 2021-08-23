<?php
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASSWORD = 'admin';
    $DB_NAME = 'testdb';

    $PDO = new PDO("mysql:host=$DB_HOST", $DB_USER, $DB_PASSWORD);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

