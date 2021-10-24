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

<body class="profile">
        <?php
            //nom de la page pour le header
            $page = "profil";
            //démarrage de la session
            session_start(); 
        
            //test de si l'utilisateur veut se connecter
            if (isset($_POST['disconnect'])){
                session_destroy();
            }

            //test si y'as une session
            if (!isset($_SESSION['codeprofil'])){
                //envoie vers la page de connexion
                header('location:connexion.php');
            }
            //test

            //connexion à la bdd
            include("connexion.inc.php");
            $cnx->exec("SET SEARCH_PATH TO punk");

            //pour afficher le pseudo (on test si on essaie d'acceder à sa page où à celle d'un ami)
            $codeprofil = (isset($_GET['codeprofilami'])) ?  $_GET['codeprofilami'] : $_SESSION['codeprofil'];

            $pseudo = $cnx->query("SELECT nomutilisateur FROM profils WHERE codeprofil = ".$codeprofil.";")->fetch()[0];
            
            //si on essai de changer de pseudo
            if (isset($_POST['changePseudo']) && $_POST['changePseudo'] != ''){
                $requete = "UPDATE profils SET nomutilisateur = '".$_POST['changePseudo']."' WHERE profils.codeprofil = ".$codeprofil.";";
                $cnx->exec($requete);
                $pseudo = $_POST['changePseudo'];
            }
            // si on essai changer nom
            if (isset($_POST['changeNom']) && $_POST['changeNom'] != ''){
                $requete = "UPDATE profils SET nomp = '".$_POST['changeNom']."' WHERE profils.codeprofil = ".$codeprofil.";";
                $cnx->exec($requete);
            }
            //si on essai changer prénom
            if (isset($_POST['changePrenom']) && $_POST['changePrenom'] != ''){
                $requete = "UPDATE profils SET prenomp = '".$_POST['changePrenom']."' WHERE profils.codeprofil = ".$codeprofil.";";
                $cnx->exec($requete);
            }
            //si on essai changer mail
            if (isset($_POST['changeMail']) && $_POST['changeMail'] != ''){
                $requete = "UPDATE profils SET adressemailp = '".$_POST['changeMail']."' WHERE profils.codeprofil = ".$codeprofil.";";
                $cnx->exec($requete);
            }
            //si on essai de changer mdp
            if (isset($_POST['changeMdp']) && $_POST['changeMdp'] != ''){
                $requete = "UPDATE profils SET motdepasse = md5('".$_POST['changeMdp']."') WHERE profils.codeprofil = ".$codeprofil.";";
                $cnx->exec($requete);
            }
            //si on essai d'ajouter de la thune
            if (isset($_POST['increaseMoney'])){
                $requete = "UPDATE profils SET soldep = soldep + ".$_POST['increaseMoney']." WHERE profils.codeprofil = ".$codeprofil.";";
                $cnx->exec($requete);
            }
            //si on essai d'envoyé un message 
            if (isset($_POST['message']) && $_POST['message'] != ''){
                $requete = "INSERT INTO discuter (codeprofil, codeprofil_1, message) VALUES (".$_SESSION['codeprofil'].",".$codeprofil.",'".$_POST['message']."');";
                $cnx->exec($requete);
            }
            //heures joué en tout
            $requete = "SELECT SUM(sauvegarde.heuresjoué) FROM sauvegarde WHERE sauvegarde.codeprofil = ".$codeprofil.";";
            $timeplay = $cnx->query($requete)->fetch()[0];
            //jeu ? c'est vraiment utile ici alors qu'il y'as la bibliothéques ?
            $requete = "SELECT Jeux.NomJ FROM Jeux, Acheter WHERE Jeux.CodeJ = Acheter.CodeJ and Acheter.CodeProfil = '".$pseudo."';";
            //Succès dévérouiller ? pareil ducoup j'ai fais le nombre de succés déverrouillé
            $requete = "SELECT achievements.numachievement FROM achievements, profils, avoir, jeux WHERE profils.codeprofil = '".$pseudo."' AND profils.codeprofil = avoir.codeprofil AND avoir.numachievement = achievements.numachievement AND Jeux.codej = avoir.codej;";
            //liste des amis
            $requete = "SELECT amis.CodeProfil From Profils as amis, Ajouter Where Ajouter.CodeProfil = '".$pseudo."' And Ajouter.CodeProfil_Amis = amis.CodeProfil;";
            //thune dispo
            $money = $cnx->query("SELECT soldep FROM profils WHERE profils.codeprofil = ".$codeprofil.";")->fetch()[0];
            //nom prenom
            $requete = "SELECT prenomp FROM profils WHERE profils.codeprofil = ".$codeprofil.";";
            $prenom = $cnx->query($requete)->fetch()[0];
            $requete = "SELECT nomp FROM profils WHERE profils.codeprofil = ".$codeprofil.";";
            $nom = $cnx->query($requete)->fetch()[0];
        ?>

        <?php
            //affichage du header
            include("header.inc.php");
        ?>

    <main>
        <div class="container-primary-infos">
            
            
                <?php
                    // avoir la photo de profil
                    $cheminImage = $cnx->query("SELECT cheminimagep FROM profils WHERE codeprofil =".$codeprofil.";")->fetch()[0];
                    echo "<span class=\"profile-picture\" style=\"background-image: url($cheminImage)\"></span>";
                    echo "<div class=\"user-info\"><h1>$pseudo($prenom $nom)</h1>";
                    //pour afficher la description
                    $description =  $cnx->query("SELECT profils.description FROM profils WHERE profils.nomutilisateur = '".$pseudo."';")->fetch()[0];
                    echo "<p>$description</p>";
                ?>
            </div>
            <hr>
            <div class="most-played-games">
                <h1>Jeux les plus joués</h1>
                <div>
                    <?php
                        //jeux les plus joué (4)
                        $requete = "SELECT * FROM (SELECT jeux.codej,jeux.nomj FROM jeux,sauvegarde WHERE sauvegarde.codeprofil = '".$codeprofil."' AND sauvegarde.codej = jeux.codej order by heuresjoué desc) as test limit 4;";
                        $result = $cnx->query($requete);
                        while($ligne = $result->fetch()){
                            $timeplaygame = $cnx->query("SELECT SUM(sauvegarde.heuresjoué) FROM sauvegarde WHERE sauvegarde.codeprofil = ".$codeprofil." AND sauvegarde.codej = ".$ligne[0].";")->fetch()[0];
                            $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                            echo "
                            <div>
                                <p>$timeplaygame h&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                <p><b> $ligne[1] </b></p>
                                <span style=\"background-image: url('$cheminImage')\"></span>
                            </div>";
                        } 
                    ?>
                </div>
            </div>
        </div>
        <div class="other-infos">
            <?php
                echo "<p>Temps de jeu total : $timeplay h</p>
                    <p>Solde du compte : $money €</p> ";
            ?>
        
        </div>
        <?php
            //si c'est notre page profil on affiche un formulaire pour changer nos informations
            if ($codeprofil == $_SESSION['codeprofil']){
                echo '<div class="info-perso">
                <h1>Informations personelles</h1>
                <form action="" method="post">
                    <input type="text" name="changePseudo" placeholder="Modifier le pseudo">
                    <input type="text" name="changeNom" placeholder="Modifier le nom">
                    <input type="text" name="changePrenom" placeholder="Modifier le prénom">
                    <input type="text" name="changeMail" placeholder="Modifier l\'adresse mail">
                    <input type="text" name="changeMdp" placeholder="Modifier le mot de passe">
                    <input type="submit" name="modifier" value="Modifier">
                </form>
                <h1>Remplir mon portefeuille</h1>
                <form class="form2" action="" method="post">
                    <input type="text" name="increaseMoney" placeholder="Montant (€)">
                    <input type="submit" name="valider" value="Ajouter">
                </form>
            </div>';
            //sinon on affiche un chat avec notre amis
            } else {
                echo '<div class="discussion">
                <h1>Discussion</h1>
                <div class="container-discu">';
                //affichage conversation entre deux personnes
                $requete = "SELECT Discuter.Message, Discuter.CodeProfil FROM Discuter WHERE Discuter.CodeProfil = ".$_SESSION['codeprofil']." AND Discuter.CodeProfil_1 = ".$codeprofil." or Discuter.CodeProfil_1 = ".$_SESSION['codeprofil']." AND Discuter.CodeProfil = ".$codeprofil."";
                $result = $cnx->query($requete);
                    while($ligne = $result->fetch()){
                        //avoir le pseudo de la personne qui envoie le message;
                        $pseudo = $cnx->query("SELECT nomutilisateur FROM profils WHERE codeprofil = ".$ligne[1].";")->fetch()[0];
                        echo "<span>
                        <p class=\"auteur\">$pseudo</p>
                        <p class=\"message\">$ligne[0]</p>
                        </span>";
                    }
                //formulaire pour envoyer un message
                echo '</div>
                <form action="" method="post">
                    <input type="text" name="message" placeholder="Message">
                    <input type="submit" name="envoyer-message" value="Envoyer">
                </form>
                </div>';
            }
            //bouton pour se déconnecter
            ?> 
            <form action="" method="post">
                <input type="submit" name="disconnect" value="Déconnexion" class="disconnect">
            </form>
    </main>
</body>
</html>