<?php
session_start();
require_once('config.php');

// Vérification de la soumission du formulaire
if (isset($_POST["connecter"])) {
    // Vérification que les champs email et mot de passe ne sont pas vides
    if (!empty($_POST["login-nom"]) && !empty($_POST["login-motdepasse"])) {
        $email = htmlspecialchars($_POST["login-nom"]); // Récupération de l'email
        $motdepasse = md5($_POST["login-motdepasse"]); // Hachage du mot de passe avec MD5 

        // Validation des données
        $regex_nom = "/^[a-zA-Z]{2,}$/";
        if (strlen($nom) > 50 && preg_match($regex_nom, $nom)) {
            echo "Votre nom est incorrect";
        }
        if (strlen($motdepasse) < 7) {
            echo "Mot de passe incorrect";
        } else {
            // Préparation et exécution de la requête SQL pour vérifier l'authentification
            $select = "SELECT * FROM Employes WHERE email_address = ?";
            $selectUser = $conn->prepare($select);
            $selectUser->execute(
                array(
                    "email_address" => $email,
                    "PASSWORD" => $motdepasse
                )
            );
            $row = $selectUser->rowCount();
            if ($row == 1) {
                // Authentification réussie, création de la session et redirection
                $user = $selectUser->fetch(PDO::FETCH_ASSOC);
                $_SESSION["id"] = $user["id_Employe"];
                $_SESSION["nom"] = $user["nom"];
                
                header("location: taches.php");
                exit();
            } else {
                echo "Votre email ou mot de passe est incorrect";
            }
        }
    } else {
        echo "Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="connexion.css">
        <title>Connexion</title>
    </head>
    <body>
        <div class="navbar">
            <h1>Se connecter à mon compte</h1>
        </div>
        <div class="container">
            <div class="form-container">
                <h2>Connexion</h2>
                <form action="" method="post">
                    <div>
                        <label for="login-nom">Nom :</label><br>
                        <input type="text" id="login-nom" name="login-nom">
                    </div>
                    <div>
                        <label for="login-motdepasse">Mot de passe :</label><br>
                        <input type="password" id="login-motdepasse" name="login-motdepasse">
                    </div>
                    <button type="submit" name="connecter">Se Connecter</button>
                    <a href="password.php">Mot de passe Oublier</a>
                </form>
            </div>
    </body>
</html>