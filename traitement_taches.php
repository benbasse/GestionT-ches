<?php
session_start();
require_once("config.php");



    if (isset($_POST["ajouter"])) {
        if (!empty($_POST["task-title"]) && !empty($_POST["task-priority"]) && !empty($_POST["date_echeance"]) && !empty($_POST["task-status"]) && !empty($_POST["task-description"])) {
            $title = htmlspecialchars($_POST["task-title"]);
            $priority = htmlspecialchars($_POST["task-priority"]);
            $status = htmlspecialchars($_POST["task-status"]);
            $description = htmlspecialchars($_POST["task-description"]);
            $date_echeance = htmlspecialchars($_POST["date_echeance"]);



            try {
                // Insertion d'une nouvelle tâche
                $insert = $conn->prepare('INSERT INTO Taches (NAME_TACHE, DESCRIPTION, DATE_ECHEANCE, STATUS, PRIORITY, is_deleted, CREATED_BY)
            VALUES (:NAME_TACHE, :DESCRIPTION, :DATE_ECHEANCE, :STATUS, :PRIORITY, :is_deleted, :CREATED_BY)');

                $insert->execute(array(
                    'NAME_TACHE' => $title,
                    'DESCRIPTION' => $description,
                    'DATE_ECHEANCE' => $date_echeance,
                    'STATUS' => $status,
                    'PRIORITY' => $priority,
                    'is_deleted' => 0,
                    'CREATED_BY' => $lastInsertedUserId
                ));
                header("location:taches.php");
                exit();
            } catch (PDOException $e) {
                echo "Erreur lors de l'insertion : " . $e->getMessage();
            }
        } else {
            echo "Veuillez saisir tous les champs";
        }
    }

