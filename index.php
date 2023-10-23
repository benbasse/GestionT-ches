
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="index.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Page</title>
</head>
<body>
    <div class="navbar">
        <h1>Création de compte</h1>
    </div>
    <hr>
    <div>
        <?php
            if (isset($_GET['reg_err'])) 
            {
                $err = htmlspecialchars($_GET['reg_err']);
                switch ($err) 
                {
                    case 'success':
                        ?>
                        <div>
                            <strong>Succés </strong>Inscription réussi!
                        </div>
                        <p>
                            <a href="traitement_connect.php">Clicker ici pour se connecter</a>
                        </p>
                        <?php
                            break;
                            case 'password':
                                ?>
                                <div>
                                    <strong>Erreur: </strong>Mot de passe différent
                                </div>
                                <?php
                                    break;
                                    case 'email':
                                        ?>
                                        <div>
                                            <strong>Erreur: </strong>Email non valide
                                        </div>
                                        <?php
                                            break;
                                            case 'email_length':
                                                ?>
                                                <div>
                                                    <strong>Erreur: </strong>Email trop long!
                                                </div>
                                                <?php
                                                    break;
                                                    case 'name_length':
                                                        ?>
                                                        <div>
                                                            <strong>Erreur: </strong>Nom trop long!
                                                        </div>
                                                        <?php
                                                            break;
                                
                }
            }
        ?>
    </div>
    <div class="form-container">
        <h2>Inscription</h2>
        <form action="inscription.php" method="POST">
            <div>
                <label for="nom">Nom utilisateur:</label> <br>
                <input type="text" id="nom" name="nom">
            </div>
            <div>
                <label for="email">Email :</label> <br>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="motdepasse">Mot de passe :</label> <br>
                <input type="password" id="motdepasse" name="motdepasse">
            </div>
            <div>
                <label for="confirmationMotdepasse">Confirmation Mot de passe :</label> <br>
                <input type="password" id="confirmationMotdepasse" name="confirmationMotdepasse">
            </div>
            <button type="submit" name="inscrire"><a href="connexion.php"></a>S'Inscrire</button>
        </form>
    </div>
    </div>
</body>
</html>