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

<body class="shop">

    <?php
            $page = "boutique";
            include("connexion.inc.php");
            $cnx->exec("SET SEARCH_PATH TO punk");
            //test si y'as une session
            session_start(); 
            if (!isset($_SESSION['codeprofil'])){
                //envoie vers la page de connexion
                header('location:connexion.php');
            }

            //les fonctions
            function gameInCategory($category){
                include("connexion.inc.php");
                $cnx->exec("SET SEARCH_PATH TO punk");
                echo '<h3>'.$category.'</h3>
                <div class="container-fps">';
                $result = $cnx->query("SELECT jeux.codej From jeux WHERE jeux.tagj ='".$category."' ;");
                while($ligne = $result->fetch()){
                    $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                    echo'<a href="jeu.php?codej='.$ligne[0].'"><div style="background-image: url(\''.$cheminImage.'\')"></div></a>';
                }
                echo '</div>';
            }

            //pour afficher le pseudo
            $codeprofil = $_SESSION['codeprofil'];
            $pseudo = $cnx->query("SELECT nomutilisateur FROM profils WHERE codeprofil = ".$codeprofil.";")->fetch()[0];
            $money = $cnx->query("SELECT soldep FROM profils WHERE profils.codeprofil = ".$codeprofil.";")->fetch()[0];

            //jeux le plus téléchargé
            $plusdow = $cnx->query("SELECT * FROM (SELECT jeux.codej FROM jeux order by nombredetéléchargementj desc) as test limit 1;")->fetch()[0];
            // image du jeu
            $cheminImagePlus = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$plusdow.";")->fetch()[0];
            //les deux jeux les moins téléchargé
            $result = $cnx->query("SELECT * FROM (SELECT jeux.codej FROM jeux order by nombredetéléchargementj) as test limit 2;");
            $lessdow = array();
            while($ligne = $result->fetch()){
                $lessdow[] = $ligne[0];
                $cheminImageMoins[] = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
            }

            //affichage du header
            include("header.inc.php");
    ?>

    <main>
        <!-- Barre de recherche pour trouver un jeu -->
        <form action="" method="post" class="searchbar">
            <input type="text" name="searchbar" placeholder="Rechercher un jeu..">
            <input type="submit" name="submit-search" value="Rechercher">
        </form>
        
        <div class="p1">
            <form method="post" class="filters">
                <!-- affichage des différent filtre pour la recherche -->
                <h3>Filtres</h3>
                <div>
                    <input type="text" name="prixmin" placeholder="Prix minimum">
                    <input type="text" name="prixmax" placeholder="Prix maximum">
                    <div>
                        <input type="radio" name="choix" value= "miniToMax">
                        <label for="">Du - au + cher</label>
                    </div>
                    <div>
                        <input type="radio" name="choix" value="prixSuffi">
                        <label for="">Solde suffisant</label>
                    </div> 
                    <div>
                        <input type="radio" name="choix" value="tagPref">
                        <label for="">
                            <?php
                                $tagP = $cnx->query("SELECT tagprefere FROM profils WHERE codeprofil = ".$codeprofil.";")->fetch()[0];
                                echo 'Mon tag préféré ('.$tagP.')';
                            ?>
                        </label>
                    </div>
                </div>
                
                <input type="submit" class="button-see-more" value="Rechercher">
            </form>

            <div class="a-la-une">
                <?php
                    //affichage des jeux à la une
                    echo '
                        <a href="jeu.php?codej='.$plusdow.'" style="background-image: url(\''.$cheminImagePlus.'\')" class="first-in-view"></a>
                        <a href="jeu.php?codej='.$lessdow[0].'" style="background-image: url(\''.$cheminImageMoins[0].'\')" class="second-in-view"></a>
                        <a href="jeu.php?codej='.$lessdow[1].'" style="background-image: url(\''.$cheminImageMoins[1].'\')" class="third-in-view"></a>';
                ?>
            </div>

        </div>


        <div class="p2">
            <div class="container-games">
                <?php
                if (isset($_POST['searchbar'])){
                // Barre de recherche
                    echo'<h3>Recherche</h3>
                        <div class="container-rpg">';
                    $result = $cnx->query("SELECT jeux.codej From jeux WHERE LOWER(jeux.nomj) LIKE LOWER('%".$_POST['searchbar']."%') ;");
                    while($ligne = $result->fetch()){
                        $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                        echo'<a href="jeu.php?codej='.$ligne[0].'"><div style="background-image: url(\''.$cheminImage.'\')"></div></a>';
                    }
                    echo '</div>';

                // Prix maximum
                } else if (isset($_POST['prixmax']) && $_POST['prixmax'] != '') {
                    echo'<h3>recherche</h3>
                        <div class="container-rpg">';
                    $result = $cnx->query("SELECT jeux.codej From jeux WHERE jeux.prix <= ".$_POST['prixmax']." ;");
                    while($ligne = $result->fetch()){
                        $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                        echo'<a href="jeu.php?codej='.$ligne[0].'"><div style="background-image: url(\''.$cheminImage.'\')"></div></a>';
                    }
                    echo '</div>';

                // Prix minimum
                } else if (isset($_POST['prixmin'])  && $_POST['prixmin'] != '' ) {
                    echo'<h3>recherche</h3>
                        <div class="container-rpg">';
                    $result = $cnx->query("SELECT jeux.codej From jeux WHERE jeux.prix >= ".$_POST['prixmin']." ;");
                    while($ligne = $result->fetch()){
                        $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                        echo'<a href="jeu.php?codej='.$ligne[0].'"><div style="background-image: url(\''.$cheminImage.'\')"></div></a>';
                    }
                    echo '</div>';

                } else if (isset($_POST['choix'])){
                    echo'<h3>Recherche</h3>
                        <div class="container-rpg">';

                    // Du - cher au + cher
                    if ($_POST['choix'] == "miniToMax"){
                        $result = $cnx->query("SELECT jeux.codej From jeux ORDER BY jeux.prix;");
                        while($ligne = $result->fetch()){
                            $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                            echo'<a href="jeu.php?codej='.$ligne[0].'"><div>'.$ligne[0].'</div></a>';echo'<a href="jeu.php?codej='.$ligne[0].'"><div style="background-image: url(\''.$cheminImage.'\')"></div></a>';
                        }
                    // Solde disponnible
                    } else if ($_POST['choix'] == "prixSuffi"){
                        $result = $cnx->query("SELECT Jeux.codej From Jeux,profils WHERE profils.codeprofil = ".$codeprofil." AND profils.soldep >= jeux.prix ;");
                        while($ligne = $result->fetch()){
                            $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                            echo'<a href="jeu.php?codej='.$ligne[0].'"><div style="background-image: url(\''.$cheminImage.'\')"></div></a>';
                        }
                    } else if ($_POST['choix'] == "tagPref") {
                        $result = $cnx->query("SELECT codej FROM jeux WHERE tagj ='".$tagP."';");
                        while($ligne = $result->fetch()) {
                            $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                            echo'<a href="jeu.php?codej='.$ligne[0].'"><div style="background-image: url(\''.$cheminImage.'\')"></div></a>';
                        }
                    }
                    echo '</div>';
                }
                ?>
                
                <h3>Populaire</h3>
                <!-- affichage des jeux les plus populaires (ceux avec le plus de téléchargement)-->
                <div class="container-rpg">
                    <?php
                        $result = $cnx->query("SELECT Jeux.codej From Jeux Order BY Jeux.NombreDeTéléchargementJ Desc LIMIT 10;");
                        while($ligne = $result->fetch()){
                            $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
                            echo'<a href="jeu.php?codej='.$ligne[0].'"><div style="background-image: url(\''.$cheminImage.'\')"></div></a>';
                        }
                    ?>
                </div>

                <?php
                    //on utilise la fonction gameInCategory pour afficher tout les jeux dans une certaine catégorie
                    gameInCategory("MMORPG");
                    gameInCategory("SURVIVAL");
                    gameInCategory("FPS");
                ?>
            </div> 
        </div>
       
        
    </main>    

</body>
</html>