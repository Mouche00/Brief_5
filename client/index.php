<?php
    require_once ("../config/db.php");
    require_once ("../config/client.php");
    require_once ("./model.php");
    session_start();

    $stmt = $conn->prepare("SELECT * FROM Client");
    $stmt->execute();
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($_GET["id"])){
        try {
            $sql = "SELECT * FROM Client WHERE id = :id";
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
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Clients</title>
</head>
<body class="bg-gray-400 flex relative">
    
    <header class="h-[100vh] bg-black">
        <nav class="h-full flex flex-col justify-around items-center">
            <ul class="w-[100%] h-full flex flex-col justify-evenly items-center text-white">
                <li class="h-[33.3%] w-full flex justify-center items-center bg-white">
                    <a class="rotate-[-90deg] text-black" href="#">CLIENTS</a>
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

    <div id="add-overlay" class="bg-black w-full h-[100vh] opacity-0 z-[-1] absolute transition ease-in-out delay-15"></div>


    <section id="add-form" class="h-[50vh] w-[30%] m-auto bg-white rounded flex justify-center items-center absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] z-20 scale-0 transition ease-in-out delay-15">
        <form class="w-[80%] h-[90%] flex flex-col justify-evenly" action="add.php" enctype="multipart/form-data" autocomplete="off" method="post">
            <div class="flex justify-between">
                <div class="w-[45%] flex flex-col justify-evenly">
                    <label>Nom:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="nom">
                </div>
                <div class="w-[45%] flex flex-col">
                    <label>Prenom:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="prenom">
                </div>
            </div>

            <div class="w-[40%] flex flex-col">
                <label>Date de naissance:</label>
                <input class="bg-gray-300 rounded p-1" type="date" name="dateNais">
            </div>

            <div class="flex justify-between">
                <div class="w-[60%] flex flex-col">
                    <label>Nationalite:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="nationalite">
                </div>
                <div class="w-[30%] flex flex-col">
                    <label>Genre:</label>
                    <select class="bg-gray-300 rounded p-1" type="text" name="genre">
                        <option value="male">Male</option>
                        <option value="frmale">Female</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-col">
                <input class="w-[30%] rounded m-auto bg-green-500 text-white p-1" type="submit" value="Submit">
            </div>
        </form>
    </section>

    <?php if(!empty($_GET["id"])){ ?>
        <div id="edit-overlay" class="bg-black w-full h-[100vh] opacity-50 z-10 absolute transition ease-in-out delay-15"></div>
        <section id="edit-form" class="h-[60vh] w-[30%] m-auto bg-white rounded flex justify-center items-center absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] z-20 scale-100 transition ease-in-out delay-15">
            <form class="w-[80%] h-[90%] flex flex-col justify-evenly" action="edit.php" enctype="multipart/form-data" autocomplete="off" method="post">
                <div class="flex flex-col justify-evenly hidden">
                    <label>ID:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="id" value=<?=$row['id']?> readonly>
                </div>
                <div class="flex justify-between">
                    <div class="flex flex-col justify-evenly">
                        <label>Nom:</label>
                        <input class="bg-gray-300 rounded p-1" type="text" name="nom" value=<?=$row['nom']?>>
                    </div>
                    <div class="flex flex-col">
                        <label>Prenom:</label>
                        <input class="bg-gray-300 rounded p-1" type="text" name="prenom" value=<?=$row['prenom']?>>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label>Date de naissance:</label>
                    <input class="bg-gray-300 rounded p-1 w-[50%]" type="date" name="dateNais" value=<?=$row['dateNais']?>>
                </div>
                <div class="flex justify-between">
                    <div class="w-[60%] flex flex-col">
                        <label>Nationalite:</label>
                        <input class="bg-gray-300 rounded p-1" type="text" name="nationalite" value=<?=$row['nationalite']?>>
                    </div>
                    <div class="w-[30%] flex flex-col">
                        <label>Genre:</label>
                        <select class="bg-gray-300 rounded p-1" name="genre">
                            <?php if($row['genre'] == 'male'){ ?>
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                            <?php } else {  ?>
                                <option value="male">Male</option>
                                <option value="female" selected>Female</option>
                            <?php } ?>
                        </select>
                    </div>
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
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Date</th>
                        <th>Nationalite</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?=$client['id']?></td>
                            <td><?=$client['nom']?></td>
                            <td><?=$client['prenom']?></td>
                            <td><?=$client['dateNais']?></td>
                            <td><?=$client['nationalite']?></td>
                            <td><?=$client['genre']?></td>
                            <td class="no-border flex justify-evenly">
                                <?php
                                    echo '<a class="w-[45%] bg-blue-500 p-1 m-1 text-center text-white rounded" href="show.php?id='. $client['id'] .'" title="Show">Show</a>';
                                    echo '<a class="w-[45%] bg-red-500 p-1 m-1 text-center text-white rounded" href="delete.php?id='. $client['id'] .'" title="Del">Delete</a>';
                                    echo '<a class="w-[45%] bg-orange-400 p-1 m-1 text-center text-white rounded" href="index.php?id='. $client['id'] .'" title="Update">Edit</a>';
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