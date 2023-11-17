<?php
    require_once ("../config/db.php");
    require_once ("../config/transaction.php");
    require_once ("./model.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $montant = $type = $compte_id = '';

        $montant = trim($_POST["montant"]);
        $type = trim($_POST["type"]);
        $compte_id = trim($_POST["compte_id"]);

        $transaction = new Transaction($montant, $type, $compte_id);

        // $client = Client::create()->set_nom($nom)->set_prenom($prenom)->set_date($dateNais)->set_nationalite($nationalite)->set_genre($genre);
        
        $transaction->insert();

        $sql = "SELECT id FROM Transaction ORDER BY id DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();

        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        $transaction->set_id($id["id"]);

        var_dump($transaction);

        $_SESSION["transactions"][$transaction->get_id()] = $transaction;

        // $_SESSION["clients"] = $clientsArray;

        header("Location: index.php");

    }


?>