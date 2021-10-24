<?php
    echo'
    <header>
        <nav>';
            //on test sur qu'elle page on est pour appliquer une class css différente
            if ($page == "boutique"){
                echo '<a href="boutique.php" class="current-page"><span>Magasin</span></a>';
            }else {
                echo '<a href="boutique.php"><span>Magasin</span></a>';
            }
            if ($page == "bibliotheque"){
                echo '<a href="bibliotheque.php" class="current-page"><span>Bibliotheque</span></a>';
            } else {
                echo '<a href="bibliotheque.php"><span>Bibliothèque</span></a>';
            }
            echo '<a href="index.php" class="nav-logo" ><span></span></a>';
            if ($page == "social"){
                echo '<a href="social.php" class="current-page"><span>Social</span></a>';
            } else {
                echo '<a href="social.php"><span>Social</span></a>';
            }
            if ($page == "profil"){
                echo '<a href="profil.php" class="current-page"><span>';
            } else {
                echo '<a href="profil.php"><span>';
            }
            if (isset($_SESSION['codeprofil'])){
                echo "$pseudo | $money € ";
            } else {
                echo'Profil';
            }
            echo '</span></a>
        </nav>
    </header>';
?>