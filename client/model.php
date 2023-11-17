<?php

    require_once ("../config/config.php");

    Class Client extends Database{
        private $id;
        private $nom;
        private $prenom;
        private $dateNais;
        private $nationalite;
        private $genre;

        function __construct($nom, $prenom, $dateNais, $nationalite, $genre) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->dateNais = $dateNais;
            $this->nationalite = $nationalite;
            $this->genre = $genre;
        }

        function get_id() {
            return $this->id;
        }

        function set_id($id) {
            $this->id = $id;
        }

        function set_nom($nom) {
            $this->nom = $nom;
        }

        function set_prenom($prenom) {
            $this->prenom = $prenom;
        }

        function set_date($dateNais) {
            $this->dateNais = $dateNais;
        }

        function set_nationalite($nationalite) {
            $this->nationalite = $nationalite;
        }

        function set_genre($genre) {
            $this->genre = $genre;
        }

        function insert() {
            try {
                $stmt = $this->conn()->prepare("INSERT INTO Client (nom, prenom, dateNais, nationalite, genre) 
                VALUES (:nom, :prenom, :dateNais, :nationalite, :genre)");

                $stmt->bindParam(':nom', $this->nom);
                $stmt->bindParam(':prenom', $this->prenom);
                $stmt->bindParam(':dateNais', $this->dateNais);
                $stmt->bindParam(':nationalite', $this->nationalite);
                $stmt->bindParam(':genre', $this->genre);

                $stmt->execute();
                $stmt->closeCursor();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }


        
        function update() {
            try {
                $stmt = $this->conn()->prepare("UPDATE Client SET nom=:nom, prenom=:prenom, dateNais=:dateNais, nationalite=:nationalite, genre=:genre WHERE id=:id");

                $stmt->bindParam(':nom', $this->nom);
                $stmt->bindParam(':prenom', $this->prenom);
                $stmt->bindParam(':dateNais', $this->dateNais);
                $stmt->bindParam(':nationalite', $this->nationalite);
                $stmt->bindParam(':genre', $this->genre);
                $stmt->bindParam(':id', $this->id);

                $stmt->execute();
                $stmt->closeCursor();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function test() {
            $sql = "SELECT * FROM Client";
            $this->conn->exec($sql);
            $this->conn->closeCursor();
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