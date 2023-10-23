<?php
// Récuperer la tache entre et apporter les modification

session_start();
    require_once("config.php");
    $_SESSION["id"] = $task['ID_Tache'];


// Récupérer l'option choisi par le user
if (isset($_POST["deleteTask"])) {
    $updateTask = $conn->prepare("UPDATE Taches SET is_deleted = 1 WHERE ID_Tache = :ID_Tache");
    $updateTask->execute(["ID_Tache" => $_SESSION["id"]]);
    echo "Tache supprimer";
    header("location:taches.php");
}


    if(isset($_POST["markCompleted"]))
    {
        $markCompleted = $conn->prepare("UPDATE Taches SET STATUS = 'Terminée' WHERE ID_Tache = :ID_Tache");
        $markCompleted->execute(["ID_Tache" => $_SESSION["id"]]);
        header("location:taches.php");
        exit();
    }
?>