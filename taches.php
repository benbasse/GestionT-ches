<?php
session_start();
require_once("config.php");

// Récupérer les tâches depuis la base de données
$sql = "SELECT * FROM Taches";
$Taches = [];

try {
    $result = $conn->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $Taches[] = $row;
    }
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des tâches : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<link rel="stylesheet" href="taches.css">
<html>

<head>
    <title>Mes Tâches</title>
</head>

<body>
    <div class="navbar">
        <h1 class="leye">Gestion de Mes Tâches</h1>
    </div>

    <!-- Afficher les tâches ici -->
    <div class="task-container">
        <?php foreach ($Taches as $task) : ?>
            <h1 class="lp"><?= $task['NAME_TACHE']; ?></h1>
            <p><?= $task['DESCRIPTION']; ?></p>
            <div class="inline-elements">
                <p>Priorité: <?= $task['PRIORITY']; ?></p>
                <p class="paragraph">Statut: <?= $task['STATUS']; ?></p>
                <button><a href="details.php" style="color: #ffff; text-decoration: none">Voir les détails</a></button>
            </div>
            <!-- Stocker ID dans une session -->
        <?php endforeach; 
        $_SESSION["id"] = $task['ID_Tache']; ?>
    </div>

    <!-- Le formulaire d'ajout de tâche -->
    <div class="add-task">
        <h1>Ajouter une nouvelle tâche</h1>
        <form action="traitement_taches.php" method="POST">
            <label for="task-title">Titre:</label>
            <input type="text" id="task-title" name="task-title">

            <label for="task-priority">Priorité:</label>
            <select id="task-priority" name="task-priority">
                <option value="haute">Haute</option>
                <option value="moyenne">Moyenne</option>
                <option value="basse">Basse</option>
            </select>

            <label for="task-status">Statut:</label>
            <select id="task-status" name="task-status">
                <option value="encours">En cours</option>
                <option value="enattente">En attente</option>
                <option value="terminee">Terminée</option>
            </select>

            <label for="date_echeance">Date d'échéance:</label>
            <input type="date" id="date_echeance" name="date_echeance">

            <label for="task-description">Description:</label>
            <textarea id="task-description" name="task-description" rows="4"></textarea>

            <button type="submit" name="ajouter">Ajouter</button>
        </form>
    </div>
</body>
</html>
