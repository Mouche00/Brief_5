<?php

    require_once ("../config/config.php");

    Class Compte extends Database{
        private $id;
        private $balance;
        private $devise;
        private $rib;
        private $client_id;

        function __construct($balance, $devise, $rib, $client_id) {
            $this->balance = $balance;
            $this->devise = $devise;
            $this->rib = $rib;
            $this->client_id = $client_id;
        }

        function get_id() {
            return $this->id;
        }

        function set_id($id) {
            $this->id = $id;
        }

        function set_balance($balance) {
            $this->balance = $balance;
        }

        function set_devise($devise) {
            $this->devise = $devise;
        }

        function set_rib($rib) {
            $this->rib = $rib;
        }

        function set_client($client_id) {
            $this->client_id = $client_id;
        }

        function insert() {
            try {
                $stmt = $this->conn()->prepare("INSERT INTO Compte (balance, devise, rib, client_id) 
                VALUES (:balance, :devise, :rib, :client_id)");

                $stmt->bindParam(':balance', $this->balance);
                $stmt->bindParam(':devise', $this->devise);
                $stmt->bindParam(':rib', $this->rib);
                $stmt->bindParam(':client_id', $this->client_id);

                $stmt->execute();
                $stmt->closeCursor();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }


        
        function update() {
            try {
                $stmt = $this->conn()->prepare("UPDATE Compte SET balance=:balance, devise=:devise, rib=:rib, client_id=:client_id WHERE id=:id");

                $stmt->bindParam(':balance', $this->balance);
                $stmt->bindParam(':devise', $this->devise);
                $stmt->bindParam(':rib', $this->rib);
                $stmt->bindParam(':client_id', $this->client_id);
                $stmt->bindParam(':id', $this->id);

                $stmt->execute();
                $stmt->closeCursor();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function delete() {
            try {
                $sql = "DELETE FROM Compte WHERE id = :id";
                $stmt = $this->conn()->prepare($sql);
                $stmt->bindParam(":id", $this->id);
        
                $stmt->execute();
            }  catch(PDOException $e) {
                die("ERROR: Could not connect. " . $e->getMessage());
            }
        }

        // function __construct() {
        // }

        // function create() {
        //     return new self();
        // }

        // function set_nom($nom) {
        //     $this->nom = $nom;
        // }
        
        // function set_prenom($prenom) {
        //     $this->prenom = $prenom;
        // }
        
        // function set_date($dateNais) {
        //     $this->dateNais = $dateNais;
        // }
        
        // function set_nationalite($nationalite) {
        //     $this->nationalite = $nationalite;
        // }
        
        // function set_genre($genre) {
        //     $this->genre = $genre;
        // }

        // function set_id($id) {
        //     $this->id = $id;
        // }

    }

?>