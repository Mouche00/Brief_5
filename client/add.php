<?php
    require_once ("../config/db.php");
    require_once ("../config/client.php");
    require_once ("./model.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $nom = $prenom = $dateNais = $nationalite = $genre = '';

        $nom = trim($_POST["nom"]);
        $prenom = trim($_POST["prenom"]);
        $dateNais = trim($_POST["dateNais"]);
        $nationalite = trim($_POST["nationalite"]);
        $genre = trim($_POST["genre"]);

        $client = new Client($nom, $prenom, $dateNais, $nationalite, $genre);

        // $client = Client::create()->set_nom($nom)->set_prenom($prenom)->set_date($dateNais)->set_nationalite($nationalite)->set_genre($genre);
        
        $client->insert();

        $sql = "SELECT id FROM Client ORDER BY id DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();

        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        $client->set_id($id["id"]);

        $_SESSION["clients"][$client->get_id()] = $client;

        // $_SESSION["clients"] = $clientsArray;

        header("Location: index.php");

    }


?>