<?php


    require_once ("../config/db.php");
    require_once ("../config/transaction.php");
    require_once ("../config/all.php");
    require_once ("./model.php");
    session_start();

    try {
    
            $montant = $type = $compte_id = '';

            $montant = trim($_POST["montant"]);
            $type = trim($_POST["type"]);
            $compte_id = trim($_POST["compte_id"]);

            // $stmt = $conn->prepare("SELECT * FROM Client");
            // $stmt->execute();

            // $client = new Client($nom, $prenom, $dateNais, $nationalite, $genre);

            // $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // $client->set_id((int)$_POST["id"]);
            // $client->set_id((int)$_POST["id"]);
            $transactionArray = $_SESSION["transactions"];
            $transaction = $transactionArray[$_POST["id"]];

            var_dump($transaction);


            $transaction->set_montant($montant);
            $transaction->set_type($type);
            $transaction->set_compte($compte_id);

            // var_dump($clients[$_POST["id"]]);
            // echo "<br>";

            // $client = Client::create()->set_nom($nom)->set_prenom($prenom)->set_date($dateNais)->set_nationalite($nationalite)->set_genre($genre);
            
            $transaction->update();

            // var_dump($compte);

            // $test["client1"] = $client;
            // $test["client2"] = $client2;

            // echo "<br>";



            header("Location: index.php");
    }  catch(PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }

?>