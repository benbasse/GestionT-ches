<?php
session_start();
require_once("config.php");

// RÉCUPERER LES TÂCHES DEPUIS LE FORMULAIRE
$select = "SELECT * FROM Taches";
$Taches = [];

try {
    $result = $conn->query($select);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $Taches[] = $row;
    }
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des tâches : " . $e->getMessage();
}

?>


<!DOCTYPE html>
<link rel="stylesheet" href="details.css">
<html>
<head>
    <title>Details de la Tâche</title>
</head>
<body>
    <form action="traitement_taches.php" method="POST">
    <div class="navbar">
        <h1>Details Tâche</h1>
    </div>

    <!-- Appliquons le traitement_taches dans la page -->
    <div class="task-details">
        <?php foreach($Taches as $task) : ?>
            <h1 class="lp"><?= $task['NAME_TACHE']; ?></h1>
            <div class="inline-elements">
                <p class="priority">Priorité: <?= $task['PRIORITY']; ?></p>
                <p class="status">Statut: <?= $task['STATUS']; ?></p>
            </div>
            <p>Description: <?= $task['DESCRIPTION']; ?></p>
        <?php endforeach; ?>
    </div>

    <!-- <div class="task-details">
        <h1 class="lp">Nom de la Tâche</h1>
        <div class="inline-elements">
            <p class="priority">Priorité: Haute</p>
            <p class="status">Statut: En cours</p>
        </div>
        <p>Description de la tâche.</p> -->

        <div class="button-container">
            <button id="markCompleted" style="background-color:green" name="markCompleted">Marquer comme terminé</button>
            <button id="deleteTask" style="background-color:red" name="deleteTask">Supprimer la tâche</button>
        </div>
    </div>

    <div class="button-container">
        <a href="taches.php">Retour à la liste des tâches</a>
    </div>
    </form>
</body>

</html>
