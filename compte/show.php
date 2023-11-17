<?php
    require_once ("../config/db.php");
    require_once ("../config/compte.php");
    require_once ("./model.php");
    session_start();

    if(!empty($_GET["id"])){
        try {
            $stmt = $conn->prepare("SELECT * FROM Compte WHERE id = :id");
            $stmt->bindParam(':id', $_GET["id"]);
            $stmt->execute();
            $comptes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $conn->prepare("SELECT * FROM Transaction WHERE compte_id = :id");
            $stmt->bindParam(':id', $_GET["id"]);
            $stmt->execute();
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    } else {
        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Comptes</title>
</head>
<body class="bg-gray-400 flex relative">
    
<header class="h-[100vh] bg-black">
        <nav class="h-full flex flex-col justify-around items-center">
            <ul class="w-[100%] h-full flex flex-col justify-evenly items-center text-white">
                <li class="h-[33.3%] w-full flex justify-center items-center">
                    <a class="rotate-[-90deg]" href="./index.php">CLIENTS</a>
                </li>
                <li class="h-[33.3%] w-full flex justify-center items-center">
                    <a class="rotate-[-90deg]" href="../compte/index.php" class="">COMPTES</a>
                </li>
                <li class="h-[33.3%] w-full flex justify-center items-center">
                    <a class="rotate-[-90deg]" href="../compte/index.php" class="">TRANSACTIONS</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class="min-h-[20vh] w-[80%] m-auto bg-white rounded">
        <h1 class="text-4xl ml-8 mt-8">CLIENT:</h1>
        <?php foreach ($clients as $client): ?>
            <div class="m-8 ml-14 mt-2">
                <p>ID: <?=$client['id']?></p>
                <p>Nom: <?=$client['nom']?></p>
                <p>Prenom: <?=$client['prenom']?></p>
                <p>Date de naissance: <?=$client['dateNais']?></p>
                <p>Nationalite: <?=$client['nationalite']?></p>
                <p>Genre: <?=$client['genre']?></p>
            </div>
        <?php endforeach; ?>
        <h1 class="text-4xl ml-8">COMPTE(S):</h1>
        <table class="w-[95%] m-auto mb-4 text-center mt-2">
            <thead>
                <tr class="bg-black text-white">
                    <th>ID</th>
                    <th>Balance</th>
                    <th>Devise</th>
                    <th>RIB</th>
                    <th>Client</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comptes as $compte): ?>
                    <tr>
                        <td><?=$compte['id']?></td>
                        <td><?=$compte['balance']?></td>
                        <td><?=$compte['devise']?></td>
                        <td><?=$compte['rib']?></td>
                        <td><?=$compte['client_id']?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>



    
<script type="text/javascript" src="./main.js"></script>
</body>
</html>