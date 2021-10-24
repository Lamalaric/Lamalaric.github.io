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
        if (isset($_SESSION['codeprofil'])){
            //je sais pas trop sois ça te renvoi direct vers l'index sois on affiche se déconnecter et dans ce cas faut juste mettre session_destroy();
        }

        include("connexion.inc.php");
        $cnx->exec("SET SEARCH_PATH TO punk");

        //si on as remplis le formulaire:
        if (isset($_POST['pseudo']) && isset($_POST['password'])){
            $pseudo = $_POST['pseudo'];
            $mdp = $_POST['password'];
            $money = $cnx->query("SELECT soldep FROM profils WHERE profils.nomutilisateur = '".$pseudo."';")->fetch()[0];
            //test de si ces pseudo/mdp existe et corresponde
            $requete = "SELECT nomutilisateur,motdepasse FROM profils WHERE nomutilisateur = '".$pseudo."';";
            $result = $cnx->query($requete);
            while($ligne = $result->fetch()){
                if ($ligne[0] == $pseudo){
                    if ($ligne[1] == md5($mdp)){
                        //connexion (session) + renvoi vers index
                        session_start(); 
                        $_SESSION['codeprofil'] = $cnx->query("SELECT codeprofil FROM profils WHERE nomutilisateur = '".$_POST['pseudo']."';")->fetch()[0];;
                        $_SESSION['mdp'] = $_POST['password'];
                        header('location:index.php');
                    }
                    else {
                        $situation = 'Mot de passe incorrect';
                    }
                }
                else {
                    $situation = 'Pseudo incorrect';
                }
            }
        } else {
            $situation = '';
        }

        //affichage du header
        include("header.inc.php");
    ?>
    <main>
        <div class="container-cnx">
            <!-- questionnaire pour se connecter -->
            <form action="" method="post">
                <h1>Connexion</h1>
                <input type="text" name="pseudo" placeholder="pseudo" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <?php
                    echo $situation;
                ?>
                <input type="submit" name="submit" value="Valider">
                <p>Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
            </form>
        </div>
    </main>

</body>
</html>