<?php

    require_once ("../config/db.php");
    require_once ("../config/compte.php");
    require_once ("./model.php");
    require_once ("../config/all.php");
    session_start();

    $compteArray = $_SESSION["comptes"];
    $compte = $compteArray[$_GET["id"]];

    var_dump($compteArray);

    $compte->delete();

    header("location: index.php");

?>