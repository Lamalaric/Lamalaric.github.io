<?php
	if (isset($_POST["accepter"])){
		setcookie('cookie', $_POST["accepter"], time()+3600*24*365);
	}
	if (isset($_POST["refuser"])){
		session_start(); 
		$_SESSION['cookie'] = $_POST["refuser"];
	}
?>

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

<body class="index">
	<?php
		$page = "";
		include("connexion.inc.php");
        $cnx->exec("SET SEARCH_PATH TO punk");

		
		session_start(); 
		if (isset($_SESSION['codeprofil'])){
			//pour afficher le pseudo
			$codeprofil = $_SESSION['codeprofil'];
			$pseudo = $cnx->query("SELECT nomutilisateur FROM profils WHERE codeprofil = ".$codeprofil.";")->fetch()[0];
			$money = $cnx->query("SELECT soldep FROM profils WHERE profils.codeprofil = ".$codeprofil.";")->fetch()[0];
			// Nom
			$requete = "SELECT UPPER(nomp) FROM profils WHERE profils.codeprofil = ".$codeprofil.";";
			$nom = $cnx->query($requete)->fetch()[0];
			// Prénom
			$requete = "SELECT prenomp FROM profils WHERE profils.codeprofil = ".$codeprofil.";";
			$prenom = $cnx->query($requete)->fetch()[0];
			// Age
			$requete = "SELECT (date_part('year', CURRENT_DATE) - date_part('year',datenaissancep)) FROM profils WHERE profils.codeprofil = ".$codeprofil.";";
			$age = $cnx->query($requete)->fetch()[0];
			// Adresse mail
			$requete = "SELECT adressemailp FROM profils WHERE profils.codeprofil = ".$codeprofil.";";
			$mail = $cnx->query($requete)->fetch()[0];
			// Téléphone
			$requete = "SELECT telephonep FROM profils WHERE profils.codeprofil = ".$codeprofil.";";
			$telephone = $cnx->query($requete)->fetch()[0];
			// Tag préféré
			$requete = "SELECT tagprefere FROM profils WHERE profils.codeprofil = ".$codeprofil.";";
			$tag = $cnx->query($requete)->fetch()[0];
		}

		//jeux le plus téléchargé
		$plusdow = $cnx->query("SELECT * FROM (SELECT jeux.codej FROM jeux order by nombredetéléchargementj desc) as test limit 1;")->fetch()[0];
		// image du jeu
		$cheminImagePlus = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$plusdow.";")->fetch()[0];
		//les deux jeux les moins téléchargés
		$result = $cnx->query("SELECT * FROM (SELECT jeux.codej FROM jeux order by nombredetéléchargementj) as test limit 2;");
		$lessdow = array();
		while($ligne = $result->fetch()){
			$lessdow[] = $ligne[0];
			$cheminImageMoins[] = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
		}

		//heures jouées
		$heuresPlay = $cnx->query("SELECT SUM(sauvegarde.heuresjoué) FROM sauvegarde;")->fetch()[0];
		//nombre de jeux
		$nmbGame = $cnx->query("SELECT Count(*) FROM jeux;")->fetch()[0];
		//nombres de comptes
		$nmbProfil = $cnx->query("SELECT Count(*) FROM profils;")->fetch()[0];
		//nombres de succès
		$nmbrSucces = $cnx->query("SELECT Count(*) FROM achievements;")->fetch()[0];

		//affichage du header
		include("header.inc.php");
	?>
	<main>
		<section>
			<article class="p1">
				<div class="preview-profile">
					<h3>Résumé</h3>
					<div>
						<?php
							//si connecté résumé du profil
							if (isset($_SESSION['codeprofil'])){
								echo "
									<p class=\"name\">$nom $prenom<p>
									<p> ans</p>
									<p> $mail </p>
									<p> $telephone </p>
									<p>Tag préféré : $tag </p>
									<p>Solde : $money €</p>
								";
							//sinon bouton se connecter
							} else {
								echo '<a href="connexion.php">Se connecter</a>';
							}
						?>
					</div>
					<a href="profil.php" class="button-see-more"><span>Voir plus</span></a>
				</div>
				<div class="preview-shop">
					<?php
						//affichage des trois jeu mis en avant
						echo "
						<a href=\"jeu.php?codej= $plusdow \" style=\"background-image: url('$cheminImagePlus')\" class=\"first-in-view\"></a>
						<a href=\"jeu.php?codej= $lessdow[0] \" style=\"background-image: url('$cheminImageMoins[0]')\" class=\"second-in-view\"></a>
						<a href=\"jeu.php?codej= $lessdow[1] \" style=\"background-image: url('$cheminImageMoins[1]')\" class=\"third-in-view\"></a>";
					?>
				</div>
				<div class="preview-social">
					<h3>Social</h3>
					<div>
						<?php
							// si on est connecté on affiche les amis
							if (isset($_SESSION['codeprofil'])){
								$result = $cnx ->query("SELECT amis.CodeProfil From Profils as amis, Ajouter Where Ajouter.CodeProfil = '".$codeprofil."' And Ajouter.CodeProfil_Amis = amis.CodeProfil;");
								$amis = array();
								while($ligne = $result->fetch()){
									$amis[] = $ligne[0];
									$cheminImage = $cnx->query("SELECT cheminimagep FROM profils WHERE codeprofil =".$ligne[0].";")->fetch()[0];
									echo '<a href="profil.php?codeprofilami='.$ligne[0].'"><span style=\'background-image: url("'.$cheminImage.'");\'></span></a>';
								}
							// sinon on affiche un bouton pour se connecter
							} else {
								echo '<a href="connexion.php">Se connecter</a>';
							}
	                	?>
					</div>
						
					<a href="social.php" class="button-see-more"><span>Voir plus</span></a>
				</div>
			</article>
			<a href="magasin.php" class="button-see-more"><span>Voir plus</span></a>

			<article class="p2">
				<div class="preview-biblio">
					<h2>Les jeux les plus joués</h2>
					<div class="containeur-games">
						<?php
							if (isset($_SESSION['codeprofil'])){
								//jeux les plus joué (4)
								$requete = "SELECT * FROM (SELECT jeux.codej,jeux.nomj FROM jeux,sauvegarde WHERE sauvegarde.codeprofil = '".$codeprofil."' AND sauvegarde.codej = jeux.codej order by heuresjoué desc) as test limit 4;";
								$result = $cnx->query($requete);
								while($ligne = $result->fetch()){
									$cheminImage = $cnx->query("SELECT cheminimage FROM jeux WHERE codej =".$ligne[0].";")->fetch()[0];
									echo'<a href="jeu.php?codej='.$ligne[0].'" style="background-image: url(\''.$cheminImage.'\')" class="item-game"></a>';
								}
							} else {
								echo '<a href="connexion.php">Se connecter</a>';
							}
							
						?>
					</div>
				</div>		
			</article>

			<article class="p3">
				<!-- On affiche des informations générale sur le site -->
				<h2>Punk, c'est :</h2>
				<div class="container-stats">
					<span class="stat-visitor">
						<?php echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> $heuresPlay </b><br>heures jouées</p>" ?>
					</span>
					<span class="stat-game">
						<?php echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> $nmbGame </b><br>jeux référencés</p>" ?>
					</span>
					<span class="stat-account">
						<?php echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> $nmbProfil </b><br>comptes crées</p>" ?>
					</span>
					<span class="stat-success">
						<?php echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> $nmbrSucces </b><br>succès réalisés</p>" ?>
					</span>
				</div>
			</article>
		</section>
	</main>

	<?php 
		//affichage du footer
		include("footer.inc.php");
	?>

</body>
</html>