<?php

    require_once ("../config/config.php");

    Class Transaction extends Database{
        private $id;
        private $montant;
        private $type;
        private $compte_id;

        function __construct($montant, $type, $compte_id) {
            $this->montant = $montant;
            $this->type = $type;
            $this->compte_id = $compte_id;
        }

        function get_id() {
            return $this->id;
        }

        function set_id($id) {
            $this->id = $id;
        }

        function set_montant($montant) {
            $this->montant = $montant;
        }

        function set_type($type) {
            $this->type = $type;
        }

        function set_compte($compte_id) {
            $this->compte_id = $compte_id;
        }

        function insert() {
            try {
                $stmt = $this->conn()->prepare("INSERT INTO Transaction (montant, type, compte_id) 
                VALUES (:montant, :type, :compte_id)");

                $stmt->bindParam(':montant', $this->montant);
                $stmt->bindParam(':type', $this->type);
                $stmt->bindParam(':compte_id', $this->compte_id);

                $stmt->execute();
                $stmt->closeCursor();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }


        
        function update() {
            try {
                $stmt = $this->conn()->prepare("UPDATE Transaction SET montant=:montant, type=:type, compte_id=:compte_id WHERE id=:id");

                $stmt->bindParam(':montant', $this->montant);
                $stmt->bindParam(':type', $this->type);
                $stmt->bindParam(':compte_id', $this->compte_id);
                $stmt->bindParam(':id', $this->id);

                $stmt->execute();
                $stmt->closeCursor();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function delete() {
            try {
                $sql = "DELETE FROM Transaction WHERE id = :id";
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