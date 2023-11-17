<?php
    require_once ("../config/db.php");
    require_once ("../config/transaction.php");
    require_once ("./model.php");
    session_start();

    $stmt = $conn->prepare("SELECT * FROM Compte");
    $stmt->execute();
    $comptes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM Transaction");
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($_GET["id"])){
        try {
            $sql = "SELECT * FROM Transaction WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $_GET["id"]);
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
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
    <title>Transactions</title>
</head>
<body class="bg-gray-400 flex relative">
    
    <header class="h-[100vh] bg-black text-white">
        <nav class="h-full flex flex-col justify-around items-center">
            <ul class="w-[100%] h-full flex flex-col justify-evenly items-center">
                <li class="h-[33.3%] w-full flex justify-center items-center">
                    <a class="rotate-[-90deg]" href="../client/index.php">CLIENTS</a>
                </li>
                <li class="h-[33.3%] w-full flex justify-center items-center">
                    <a class="rotate-[-90deg]" href="../compte/index.php" class="">COMPTES</a>
                </li>
                <li class="h-[33.3%] w-full flex justify-center items-center bg-white">
                    <a class="rotate-[-90deg] text-black" href="#" class="">TRANSACTIONS</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="add-overlay" class="bg-black w-full h-[100vh] opacity-0 z-[-1] absolute transition ease-in-out delay-15"></div>


    <section id="add-form" class="h-[60vh] w-[40%] m-auto bg-white rounded flex justify-center items-center absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] z-20 scale-0 transition ease-in-out delay-15">
        <form class="w-[80%] h-[90%] flex flex-col justify-evenly" action="add.php" enctype="multipart/form-data" autocomplete="off" method="post">
            <div class="flex justify-between">
                <div class="w-[60%] flex flex-col justify-evenly">
                    <label>Montant:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="montant">
                </div>
                <div class="w-[25%] flex flex-col">
                    <label>Type:</label>
                    <select class="bg-gray-300 rounded p-1" name="type">
                        <option value="credit">Credit</option>
                        <option value="debit">Debit</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-col">
                <label>Compte:</label>
                <select class="bg-gray-300 rounded p-1" name="compte_id">
                    <?php foreach ($comptes as $compte): ?>
                        <option value=<?=$compte['id']?>><?=$compte['id']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex flex-col">
                <input class="w-[30%] rounded m-auto bg-green-500 text-white p-1" type="submit" value="Submit">
            </div>
        </form>
    </section>

    <?php if(!empty($_GET["id"])){ ?>
        <div id="edit-overlay" class="bg-black w-full h-[100vh] opacity-50 z-10 absolute transition ease-in-out delay-15"></div>
        <section id="edit-form" class="h-[60vh] w-[40%] m-auto bg-white rounded flex justify-center items-center absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] z-20 scale-100 transition ease-in-out delay-15">
            <form class="w-[80%] h-[90%] flex flex-col justify-evenly" action="edit.php" enctype="multipart/form-data" autocomplete="off" method="post">
                <div class="flex flex-col justify-evenly hidden">
                    <label>ID:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="id" value=<?=$row['id']?> readonly>
                </div>
                <div class="flex justify-between">
                    <div class="w-[60%] flex flex-col justify-evenly">
                        <label>Montant:</label>
                        <input class="bg-gray-300 rounded p-1" type="text" name="montant" value=<?=$row['montant']?>>
                    </div>
                    <div class="w-[25%] flex flex-col">
                        <label>Type:</label>
                        <select class="bg-gray-300 rounded p-1" name="type">
                            <?php if($row['type'] == 'credit'){ ?>
                                <option value="credit" selected>Credit</option>
                                <option value="debit">Debit</option>
                            <?php } else {  ?>
                                <option value="credit">Credit</option>
                                <option value="debit" selected>Debit</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label>Client:</label>
                    <select class="bg-gray-300 rounded p-1" name="compte_id">
                    <?php foreach ($comptes as $compte): ?>
                        <?php if($compte['id'] == $row['compte_id']){ ?>
                            <option value=<?=$compte['id']?> selected><?=$compte['id']?></option>
                        <?php } else {  ?>
                            <option value=<?=$compte['id']?>><?=$compte['id']?></option>
                        <?php } ?>
                    <?php endforeach; ?>
                </select>
                </div>
                <div class="flex flex-col">
                    <input class="w-[30%] rounded m-auto bg-green-500 text-white p-1" type="submit" value="Submit">
                </div>
            </form>
        </section>
    <?php } ?>


    <section class="m-auto flex w-[80%] min-h-[20vh]">
        <section class="flex w-[90%] justify-center bg-white rounded">
            <table class="w-[95%] m-auto text-center">
                <thead>
                    <tr class="bg-black text-white">
                        <th>ID</th>
                        <th>Montant</th>
                        <th>Type</th>
                        <th>Compte</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?=$transaction['id']?></td>
                            <td><?=$transaction['montant']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['compte_id']?></td>
                            <td class="no-border flex justify-evenly">
                                <?php
                                    echo '<a class="w-[45%] bg-red-500 p-1 m-1 text-center text-white rounded" href="delete.php?id='. $transaction['id'] .'" title="Del">Delete</a>';
                                    echo '<a class="w-[45%] bg-orange-400 p-1 m-1 text-center text-white rounded" href="index.php?id='. $transaction['id'] .'" title="Update">Edit</a>';
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <button class="h-[20vh] w-[20vh] bg-black text-white text-9xl" type="button" onclick=showForm()>+</button>
    </section>



    
<script type="text/javascript" src="./main.js"></script>
</body>
</html>