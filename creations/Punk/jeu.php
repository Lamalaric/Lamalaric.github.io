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

<body class="game">
    <?php  
        $page = ""; 
        //test si y'as une session
        session_start(); 
        if (!isset($_SESSION['codeprofil'])){
            //envoie vers la page de connexion
            header('location:connexion.php');
        }
        //test si on as bien un jeu en paramètre
        if (!isset($_GET['codej'])){
            //envoie vers l'index
            header('location:index.php');
        }
        //connexion à la bdd
        include("connexion.inc.php");
        $cnx->exec("SET SEARCH_PATH TO punk");
        //codeprofil
        $codeprofil = $_SESSION['codeprofil'];
        $pseudo = $cnx->query("SELECT nomutilisateur FROM profils WHERE codeprofil = ".$codeprofil.";")->fetch()[0];
        $money = $cnx->query("SELECT soldep FROM profils WHERE profils.codeprofil = ".$codeprofil.";")->fetch()[0];
        //codej & nomj
        $codej = $_GET['codej'];
        $nomj = $cnx->query("SELECT nomj FROM jeux WHERE jeux.codej = ".$codej.";")->fetch()[0];
        //tag
        $tag = $cnx->query("SELECT tagj FROM jeux WHERE jeux.codej = ".$codej.";")->fetch()[0];
        //prix
        $gameprice = $cnx->query("SELECT jeux.prix FROM jeux WHERE jeux.codej = ".$codej.";")->fetch()[0];

        //méthode pour acheter un jeu
        if (isset($_GET['acheter'])){
            //test si on as assez d'argent
            if ($money > $gameprice){
                $cnx->exec("INSERT INTO acheter (codeprofil, codej, prixachat) VALUES (".$codeprofil.",".$codej.",".$gameprice.");");
                $acheter = true;
                //on retire l'argent
                $requete = "UPDATE profils SET soldep = soldep - ".$gameprice." WHERE profils.codeprofil = ".$codeprofil.";";
                $cnx->exec($requete);
                $money = $money-$gameprice;
            } else {
                $acheter = false;
            }
        } else {
            //on test si le jeu à déjà été acheté
            $result = $cnx->query("SELECT jeux.codej FROM jeux, acheter WHERE jeux.codej = acheter.codej and acheter.codeprofil = ".$codeprofil.";");
            $acheter = false;
            while($ligne = $result->fetch()){
                if ($ligne[0] == $codej){
                    $acheter = true;
                    break;
                }
            }
        }

        //affichage du header
        include("header.inc.php");
    ?>

    <main>
        <div class="header-game">
            <?php
                //affichage de l'image du jeu
               $cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$codej.";")->fetch()[0];
               echo '<span class="game-picture" style="background-image: url(\''.$cheminImage.'\')"></span>';
            ?>
            
            <div class="game-info">
                <span class="titre-tag">
                    <?php
                        echo '<h1>'.$nomj.'</h1>
                        <p>'.$tag.'</p>'
                    ?>       
                </span>
                <?php
                    $timeplaygame = $cnx->query("SELECT SUM(sauvegarde.heuresjoué) FROM sauvegarde WHERE sauvegarde.codeprofil = ".$codeprofil." AND sauvegarde.codej = ".$codej.";")->fetch()[0];
                    if ($acheter){
                        echo '<p>Temps de jeu : '.$timeplaygame.'h</p>';
                    }
                ?>
                <span> 
                    <?php
                        //<p class="ancien-prix">19,99€</p>
                        //<p class="nouveau-prix">14,99€</p>
                        echo '<p>'.$gameprice.'€</p>';
                    ?>
                </span>
            </div>
            <!-- Je sais pas si on doit rediriger vers un lien ou quoi que ce soit ducoup je met juste un p pour le acheter ou jouer -->
            <!-- <p>Acheter</p> -->
            <?php
                echo $acheter ? '<p>Jouer</p>' : '<a href="jeu.php?codej='.$codej.'&acheter=true"><p>Acheter</p></a>';
            ?>
        </div>

        <div class="container-game">
            <h1>Description</h1>
            <p>
                <?php
                    $description = $cnx->query("SELECT jeux.description FROM jeux WHERE jeux.codej = ".$codej.";")->fetch()[0];
                    echo $description;
                ?>
            </p><br>
            <?php
                //affiche editeur/date de sortie/nombre de download
                $editeur = $cnx->query("SELECT jeux.editeurs FROM jeux WHERE jeux.codej = ".$codej.";")->fetch()[0];
                $date = $cnx->query("SELECT jeux.datedesortie FROM jeux WHERE jeux.codej = ".$codej.";")->fetch()[0];
                $nmbrdow = $cnx->query("SELECT jeux.nombredetéléchargementj FROM jeux WHERE jeux.codej = ".$codej.";")->fetch()[0];
                echo "
                    <p><u>Éditeur</u> : $editeur</p>
                    <p><u>Date de sortie</u> : $date </p>
                    <p><u>Nombre de téléchargements</u> : $nmbrdow </p>
                ";
            ?>

            <h1>DLC</h1>
            <?php   
                    //affiche les différentes extension disponibles
                    $result = $cnx->query("SELECT nomex,descriptionex FROM extensions WHERE extensions.codej = ".$codej.";");
                    while($ligne = $result->fetch()){
                        echo "
                        <div>
                            <h2>$ligne[0]</h2>
                            <p>$ligne[1]</p>
                        </div>
                        ";
                    }
            ?> 

            <div class="config-mini">
                <h1>Configuration minimale</h1>
                <?php
                    //on récupère la config minimal qu'on sépare au niveau des ; avant de les afficher
                    $config = $cnx->query("SELECT jeux.configminimmum FROM jeux WHERE jeux.codej = ".$codej.";")->fetch()[0];
                    $config = explode(";", $config);
                    echo "<h4>Système d\'exploitation</h4>
                    <p>$config[0]</p>
                    <h4>Processeur</h4>
                    <p>$config[1]</p>
                    <h4>Mémoire vive</h4>
                    <p>$config[2]Go</p>
                    <h4>GPU</h4>
                    <p>$config[3]</p>
                    <h4>CPU</h4>
                    <p>$config[4]</p>
                    <h4>Esapce disque</h4>
                    <p>$config[5]Go</p>";
                ?>
                
            </div>

            <h1>Actualités</h1>
            <div class="actualites">
            <?php
                //Affiche les différentes actualité du jeu en question
                $result = $cnx->query("SELECT catégorieactu,informationsactu FROM actualités WHERE actualités.codej = ".$codej.";");
                while($ligne = $result->fetch()){
                    echo "
                    <div>
                        <h2>$ligne[0]</h2>
                        <p>$ligne[1]</p>
                    </div>
                    ";
                }
                ?> 
            </div>
            
        </div>
    </main>

</body>
</html>