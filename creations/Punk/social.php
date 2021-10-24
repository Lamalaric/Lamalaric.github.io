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

<body class="social">
    <?php   
        $page = "social";
        //test si y'as une session
        session_start(); 
        if (!isset($_SESSION['codeprofil'])){
            //envoie vers la page de connexion
            header('location:connexion.php');
        }
        
        //connexion à la bdd
        include("connexion.inc.php");
        $cnx->exec("SET SEARCH_PATH TO punk");

        //codeprofil
        $codeprofil = $_SESSION['codeprofil'];
        $pseudo = $cnx->query("SELECT nomutilisateur FROM profils WHERE codeprofil = ".$codeprofil.";")->fetch()[0];
        $money = $cnx->query("SELECT soldep FROM profils WHERE profils.codeprofil = ".$codeprofil.";")->fetch()[0];

        if (isset($_POST['friend'])){
            $codeAmi = $cnx->query("SELECT codeprofil FROM profils WHERE nomutilisateur = '".$_POST['friend']."';")->fetch()[0];
            $cnx->exec("INSERT INTO ajouter (codeprofil,codeprofil_amis) VALUES ('".$codeprofil."','".$codeAmi."');");
        }

        //affichage du header
        include("header.inc.php");
    ?>

    <main>
        <!-- Questionnaire pour Ajouter un ami -->
        <form action="" method="post">
            <input type="text" name="friend" placeholder="Ajouter un ami">
            <input type="submit" name="Ajouter">
        </form>
        
        <div class="container-friends">
            <!-- affichage de tout les amis avec possibilité de cliquer sur leurs images pour visiter leurs profils -->
            <h1>Amis</h1>
            <div class="friends-list">
                <?php
                    $result = $cnx ->query("SELECT amis.CodeProfil From Profils as amis, Ajouter Where Ajouter.CodeProfil = '".$codeprofil."' And Ajouter.CodeProfil_Amis = amis.CodeProfil;");
                    $amis = array();
                    while($ligne = $result->fetch()){
                        $cheminImage = $cnx->query("SELECT cheminimagep FROM profils WHERE codeprofil =".$ligne[0].";")->fetch()[0];
                        $amis[] = $ligne[0];
                        echo "<a href=\"profil.php?codeprofilami=$ligne[0]\" style='background-image: url(\"$cheminImage\");'></a>";
                    } 
                ?>
            </div>
        </div>

        <div class="container-friends-games">
            <!-- affichage du jeu le plus joué de tout nos amis -->
            <h1>Jeux auxquels jouent vos amis</h1>
            <div class="friends-game-list">
                <?php
                    foreach ($amis as $ami) {
                        $result = $cnx->query("SELECT * FROM (SELECT jeux.codej FROM jeux,sauvegarde WHERE sauvegarde.codeprofil = ".$ami." AND sauvegarde.codej = jeux.codej order by heuresjoué desc) as test limit 1;");
                        while($ligne = $result->fetch()){
                            $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                            echo "<a href=\"jeu.php?codej=$ligne[0]\" style=\"background-image: url('$cheminImage')\"></a>";
                        }
                    }
                ?>
            </div>
        </div>
        
        <div class="container-success-games">
            <!-- affichage des achievement déverouiller par ses amis -->
            <h1>Succès dévérouillés vos amis</h1>
            <div class="friends-success-list">
                <?php
                    foreach ($amis as $ami) {
                        $result = $cnx->query("SELECT achievements.noma FROM achievements, profils, avoir, jeux WHERE profils.codeprofil = ".$ami." AND profils.codeprofil = avoir.codeprofil AND avoir.numachievement = achievements.numachievement AND jeux.codej = achievements.codejeu;");
                        while($ligne = $result->fetch()){
                            $pseudoAmi = $cnx->query("SELECT profils.nomutilisateur FROM profils WHERE codeprofil = ".$ami.";")->fetch()[0];
                            echo "<div>
                                <a style=\"background-color: grey;\"></a>
                                <p>$pseudoAmi</p>
                                <p>$ligne[0]</p>
                            </div>";
                        }
                    }
                ?>
            </div>
        </div>
    </main>
</body>
</html>