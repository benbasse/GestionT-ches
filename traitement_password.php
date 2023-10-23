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

        // Rediriger vers une page de confirmation de réinitialisation du mot de passe
        header("Location: reset_password_confirmation.php");
        exit();
    } else {
        // En cas d'erreurs, afficher un message d'erreur à l'utilisateur
        $error_message = "Veuillez vérifier vos informations.";
    }
}
?>
