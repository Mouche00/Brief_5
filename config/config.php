<?php

    Class Database {
        public $conn;

        function conn() {
            define('DB_SERVER', 'localhost');
            define('DB_USERNAME', 'root');
            define('DB_PASSWORD', 'root');
            define('DB_NAME', 'DB_Test');

            try {
                $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute (PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                return $conn;

            } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }

?>