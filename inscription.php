<?php
// Démarage de la session
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("config.php");

if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['motdepasse']) && isset($_POST['confirmationMotdepasse'])) 
{
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $motdepasse = htmlspecialchars($_POST['motdepasse']);
    $confirmationmdp = htmlspecialchars($_POST['confirmationMotdepasse']);

    $check =  $conn->prepare("SELECT nom, email_address, PASSWORD FROM Employes WHERE email_address = ?");
    $check->execute(array($email));
    $data = $check -> fetch();
    $row = $check -> rowCount();

    if ($row == 0) 
    {
        if (strlen($nom) <= 50) 
        {
        
            if (strlen($email) <= 100) 
            {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    if ($motdepasse === $confirmationmdp) 
                    {
                    $motdepasse = md5($motdepasse);
                    $insertion = $conn->prepare("INSERT INTO Employes (nom, email_address, PASSWORD) VALUES (:nom, :email_address, :PASSWORD)");
                    // Insertion des données dans la BDD
                    $insertion->execute(array(
                        ':nom' => $nom,
                        ':email_address' => $email,
                        ':PASSWORD' => $motdepasse
                    ));
                    // Après avoir inséré un nouvel utilisateur dans la base de données
                    $lastInsertedUserId = $conn->lastInsertId();
                    $_SESSION["id_Employe"] = $lastInsertedUserId; // Stockez l'ID de l'utilisateur dans la session
                    header("location: index.php?reg_err=success");
                    //var_dump($lastInsertedUserId);
                    
                } else header("location: index.php?reg_err=password");
            } else header("location:index.php?reg_err=email");
        }else header("location: index.php?reg_err=email_length");
        }else header("location:index.php?reg_err=nom_length");
    } else header("location: index.php?reg_err=already");
} 
?>
