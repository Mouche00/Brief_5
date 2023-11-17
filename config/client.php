<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'DB_Test');

    try {
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute (PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

    $sql = "CREATE TABLE IF NOT EXISTS Client (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL,
        prenom VARCHAR(30) NOT NULL,
        dateNais DATE NOT NULL,
        nationalite VARCHAR(30) NOT NULL,
        genre VARCHAR(30) NOT NULL
        )";

        $conn->exec($sql);

    } catch(PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }

?>