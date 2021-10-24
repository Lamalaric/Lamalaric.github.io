<!DOCTYPE html>
<html lang="FR">
<head>
    <title>Punk</title>
    <meta name="author" content="Amalaric Le Forestier - Idriss Bachi" />
    <!-- <link rel="icon" href="images/alf.ico" /> -->
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <!-- <script type="text/javascript" src="script.js" ></script> -->
</head>

<body class="cnx">
    <?php
        $page = "";
        //test si on as déjà une session
        session_start(); 
        if (isset($_SESSION['codeprofil'])){
            //je sais pas trop sois ça te renvoi direct vers l'index sois on affiche se déconnecter et dans ce cas faut juste mettre session_destroy();
            header('location:index.php');
        }

        include("connexion.inc.php");
        $cnx->exec("SET SEARCH_PATH TO punk");

        //si on as remplis le formulaire:
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password-repeat']) && isset($_POST['mail'])){
            if ($_POST['password'] == $_POST['password-repeat']){
                $requete = "INSERT INTO profils (nomutilisateur, nomp, prenomp, telephonep, datenaissancep, adressemailp, cartebleup, soldep, tagprefere, motdepasse, description) VALUES('".$_POST['username']."', null, null, null, null, '".$_POST['mail']."', null, 0, 'Action',md5('".$_POST['password']."'), null);";
                $cnx->exec($requete);
                header('location:connexion.php');
            }
            else {
                echo "Erreur lors de la création du compte";
            }
        } 

        //affichage du header
        include("header.inc.php");
    ?>
    <main>
        <div class="container-cnx">
            <form action="" method="post">
                <!-- questionnaire pour s'inscrire -->
                <h1>Inscription</h1>
                <input type="text" name="mail" placeholder="Adresse mail" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="password" name="password-repeat" placeholder="Répétez le mot de passe" required>
                <input type="text" name="username" placeholder="Pseudo" class="input-pseudo" required><br>

                <input type="submit" name="submit" value="Valider">
                <p>Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous</a></p>
            </form>
        </div>
    </main>
</body>
</html>