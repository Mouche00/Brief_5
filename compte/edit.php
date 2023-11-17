<?php


    require_once ("../config/db.php");
    require_once ("../config/compte.php");
    require_once ("../config/all.php");
    require_once ("./model.php");
    session_start();

    try {
    
            $balance = $devise = $rib = $client_id = '';

            $balance = trim($_POST["balance"]);
            $devise = trim($_POST["devise"]);
            $rib = trim($_POST["rib"]);
            $client_id = trim($_POST["client_id"]);

            // $stmt = $conn->prepare("SELECT * FROM Client");
            // $stmt->execute();

            // $client = new Client($nom, $prenom, $dateNais, $nationalite, $genre);

            // $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // $client->set_id((int)$_POST["id"]);
            // $client->set_id((int)$_POST["id"]);
            $compteArray = $_SESSION["comptes"];
            $compte = $compteArray[$_POST["id"]];



            $compte->set_balance($balance);
            $compte->set_devise($devise);
            $compte->set_rib($rib);
            $compte->set_client($client_id);

            // var_dump($clients[$_POST["id"]]);
            // echo "<br>";

            // $client = Client::create()->set_nom($nom)->set_prenom($prenom)->set_date($dateNais)->set_nationalite($nationalite)->set_genre($genre);
            
            $compte->update();

            var_dump($compte);

            // $test["client1"] = $client;
            // $test["client2"] = $client2;

            // echo "<br>";



            header("Location: index.php");
    }  catch(PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }

?>