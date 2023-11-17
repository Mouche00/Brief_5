<?php

    require_once ("../config/db.php");
    require_once ("../config/client.php");
    require_once ("../config/all.php");
    var_dump($_GET["id"]);
    try {
        $sql = "DELETE FROM Client WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $_GET["id"]);

        if($stmt->execute()){
            header("location: index.php");
            exit();
        } else{
            echo "Error";
        }
    }  catch(PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }

?>