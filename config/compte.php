<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'DB_Test');

    try {
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute (PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

    $sql = "CREATE TABLE IF NOT EXISTS Compte (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        balance FLOAT(30) NOT NULL,
        devise VARCHAR(10) NOT NULL,
        rib DOUBLE NOT NULL,
        client_id INT(6) UNSIGNED,
        FOREIGN KEY (client_id) REFERENCES Client(id) 
            ON DELETE CASCADE
            ON UPDATE CASCADE
        )";

        $conn->exec($sql);

    } catch(PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }

?>