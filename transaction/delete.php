<?php

    require_once ("../config/db.php");
    require_once ("../config/transaction.php");
    require_once ("./model.php");
    require_once ("../config/all.php");
    session_start();

    $transactionArray = $_SESSION["transactions"];
    $transaction = $transactionArray[$_GET["id"]];

    var_dump($compteArray);

    $transaction->delete();

    header("location: index.php");

?>