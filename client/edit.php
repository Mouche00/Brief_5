<?php


    require_once ("../config/db.php");
    require_once ("../config/client.php");
    require_once ("../config/all.php");
    require_once ("./model.php");
    session_start();

    try {
    
            $nom = $prenom = $dateNais = $nationalite = $genre = '';

            $nom = trim($_POST["nom"]);
            $prenom = trim($_POST["prenom"]);
            $dateNais = trim($_POST["dateNais"]);
            $nationalite = trim($_POST["nationalite"]);
            $genre = trim($_POST["genre"]);

            // $stmt = $conn->prepare("SELECT * FROM Client");
            // $stmt->execute();

            // $client = new Client($nom, $prenom, $dateNais, $nationalite, $genre);

            // $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // $client->set_id((int)$_POST["id"]);
            // $client->set_id((int)$_POST["id"]);
            $clientArray = $_SESSION["clients"];
            $client = $clientArray[$_POST["id"]];



            $client->set_nom($nom);
            $client->set_prenom($prenom);
            $client->set_date($dateNais);
            $client->set_nationalite($nationalite);
            $client->set_genre($genre);

            // var_dump($clients[$_POST["id"]]);
            // echo "<br>";

            // $client = Client::create()->set_nom($nom)->set_prenom($prenom)->set_date($dateNais)->set_nationalite($nationalite)->set_genre($genre);
            
            $client->update();

            // $test["client1"] = $client;
            // $test["client2"] = $client2;

            // echo "<br>";



            header("Location: index.php");
    }  catch(PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }

?>