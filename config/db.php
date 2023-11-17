<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');

    try {
        $conn = new PDO("mysql:host=" . DB_SERVER, DB_USERNAME, DB_PASSWORD);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute (PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);


        $sql = "CREATE DATABASE IF NOT EXISTS DB_Test";
        $conn->exec($sql);

    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;

?>