<?php

//Connexion avec la base de donnée
$servername = "localhost";  //Nom du serveur
$username = "ben221";       //Utilisateur
$password = "B@sse@bdou221";
$dbname = "gestionataches";
try {
    $conn = new PDO("mysql:host=$servername;dbname=gestionataches", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?> 