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
<body class="biblio">
    <?php   
            //nom de la page
            $page = "bibliotheque";
            //connexion à la base de donnée
            include("connexion.inc.php");
            $cnx->exec("SET SEARCH_PATH TO punk");
            //test si y'as une session
            session_start(); 
            if (!isset($_SESSION['codeprofil'])){
                //envoie vers la page de connexion
                header('location:connexion.php');
            }
            //pour afficher le pseudo
            $codeprofil = $_SESSION['codeprofil'];
            $pseudo = $cnx->query("SELECT nomutilisateur FROM profils WHERE codeprofil = ".$codeprofil.";")->fetch()[0];
            $money = $cnx->query("SELECT soldep FROM profils WHERE profils.codeprofil = ".$codeprofil.";")->fetch()[0];
    ?>

    <?php
        //affichage du header
        include("header.inc.php");
    ?>

    <main>
       <h1>Jeux possédés</h1>

       <div class="container-games-owned">
           <?php
                //on affiche tout les jeux
                $requete = "SELECT jeux.codej, jeux.nomj FROM jeux, acheter WHERE jeux.codej = acheter.codej and acheter.codeprofil = ".$codeprofil.";";
                $result = $cnx->query($requete);
                while($ligne = $result->fetch()){
                    $heuresJoue = $cnx->query("SELECT SUM(sauvegarde.Heuresjoué) FROM sauvegarde WHERE sauvegarde.codeprofil = ".$codeprofil." AND sauvegarde.codej = ".$ligne[0].";")->fetch()[0];
                    $achivementGame = $cnx->query("SELECT COUNT(noma) FROM achievements WHERE achievements.codejeu = ".$ligne[0].";")->fetch()[0];
                    $achievementDebloc = $cnx->query("SELECT COUNT(achievements.numachievement) FROM achievements, profils, avoir, jeux WHERE profils.codeprofil = ".$codeprofil." AND profils.codeprofil = avoir.codeprofil AND avoir.numachievement = achievements.numachievement AND achievements.codejeu =".$ligne[0].";")->fetch()[0];
                    $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                    echo '
                    <div><span class="game-icone" style=\'background-image: url("'.$cheminImage.'");\'></span>
                    <div class="game-info"> 
                    <h3>'.$ligne[1].' </h3>
                    <p> Temps de jeu : '.$heuresJoue.'h</p>
                    <p>Succès dévérouillés : '.$achievementDebloc.'/'.$achivementGame.'</p></div>
                    <form action="jeu.php" method="get" >
                        <input type="hidden" name="codej" value="'.$ligne[0].'">
                        <input type="submit" name="modifier" value="Page du jeu" class="button-see-more" >
                    </form>
                    </div>';
                } 
           ?>
       </div>
    </main>
</body>
</html>