<?php

    require_once ("../config/db.php");
    require_once ("../config/compte.php");
    require_once ("../config/client.php");
    require_once ("../client/model.php");
    require_once ("../compte/model.php");
    session_start();


        $stmt = $conn->prepare("SELECT * FROM Client");
        $stmt->execute();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare("SELECT * FROM Compte");
        $stmt->execute();
        $comptes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($clients as $client):
            $clientObj = new Client($client['nom'], $client['prenom'], $client['dateNais'], $client['nationalite'], $client['genre']);
            $clientObj->set_id($client['id']);
            $_SESSION["clients"][$clientObj->get_id()] = $clientObj;
        endforeach;

        foreach ($comptes as $compte):
            $compteObj = new Compte($compte['balance'], $compte['devise'], $compte['rib'], $compte['client_id']);
            $compteObj->set_id($compte['id']);
            $_SESSION["comptes"][$compteObj->get_id()] = $compteObj;
        endforeach;




?>