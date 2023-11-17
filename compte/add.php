<?php
    require_once ("../config/db.php");
    require_once ("../config/compte.php");
    require_once ("./model.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $balance = $devise = $rib = $client_id = '';

        $balance = trim($_POST["balance"]);
        $devise = trim($_POST["devise"]);
        $rib = trim($_POST["rib"]);
        $client_id = trim($_POST["client_id"]);

        $compte = new Compte($balance, $devise, $rib, $client_id);

        // $client = Client::create()->set_nom($nom)->set_prenom($prenom)->set_date($dateNais)->set_nationalite($nationalite)->set_genre($genre);
        
        $compte->insert();

        $sql = "SELECT id FROM Compte ORDER BY id DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();

        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        $compte->set_id($id["id"]);

        $_SESSION["comptes"][$compte->get_id()] = $compte;

        // $_SESSION["clients"] = $clientsArray;

        header("Location: index.php");

    }


?>