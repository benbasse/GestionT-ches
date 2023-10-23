<?php
// Inclure le fichier de configuration de la base de données
require_once("config.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST["email"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    // Valider les données (assurez-vous de mettre en place une validation plus robuste)
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && $newPassword === $confirmPassword) {
        // Générer un nouveau hash de mot de passe
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la base de données
        $updatePassword = $conn->prepare("UPDATE Employes SET PASSWORD = :password WHERE email_address = :email");
        $updatePassword->execute([
            "password" => $hashedPassword, 
            "email" => $email
        ]);
        
        echo "Réinitialisatiob réussi";
        // Rediriger vers une page de confirmation de réinitialisation du mot de passe
        header("Location: connexion.php");
        exit();
    } else {
        // En cas d'erreurs, afficher un message d'erreur à l'utilisateur
        $error_message = "Veuillez vérifier vos informations.";
    }
}
?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="password.css">
<head>
    <title>Réinitialisation de Mot de Passe</title>
</head>

<body>
    <form action="" method="post">
    <div class="container">
        <h1>Réinitialisation de Mot de Passe</h1>
        <p>Entrez votre adresse e-mail, nouveau mot de passe, et confirmez le nouveau mot de passe pour réinitialiser votre mot de passe.</p>

        <label for="email">Adresse E-mail:</label>
        <input type="text" id="email" name="email" placeholder="Entrez votre adresse e-mail">

        <label for="newPassword">Nouveau Mot de Passe:</label>
        <input type="password" id="newPassword" name="newPassword" placeholder="Entrez votre nouveau mot de passe">

        <label for="confirmPassword">Confirmez le Mot de Passe:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmez votre nouveau mot de passe"><br>

        <button type="submot" name="reinitialiser"><a href="">Réinitialiser le Mot de Passe</a></button>
    </div>
    </form>
    
    <?php if (isset($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
</body>

</html>
