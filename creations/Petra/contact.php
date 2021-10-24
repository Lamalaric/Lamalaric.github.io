<?php
	$page = "contact";
	include("header.inc.php");
?>


<body class="container-c">
	<main>
		<div class="container-staff">
			<h2>À propos de nous</h2>
			<h3>Notre groupe</h3>
			<p>Ce site web a été créé dans le cadre de notre projet tutoré de notre première année de DUT informatique. Il vise avant tout la création d’une médiation culturelle et numérique, et a été réalisé en collaboration avec l’UNESCO.</p>
			<div class="auteurs">
				<div>
					<div class="img-ama"></div>
					<p>Amalaric Le Forestier</p>
					<span class="reseaux">
						<a href="https://www.linkedin.com/in/amalaric-le-forestier-61a513202/" class="linkedin"><span></span></a>
						<a href="https://github.com/Lamalaric" class="github"><span></span></a>
						<a href="https://www.instagram.com/lamalaric/" class="instagram"><span></span></a>
					</span>
					<p class="role">Chef de projet<br>Lead developpeur<br>Designer</p>
				</div>
				<div>
					<div class="img-bastou"></div>
					<p>Bastien Corgnac</p>
					<span class="reseaux">
						<a href="https://www.linkedin.com/in/bastien-corgnac/" class="linkedin"><span></span></a>
						<a href="https://github.com/Bastien-crg" class="github"><span></span></a>
					</span>
					<p class="role">Lead recherches<br>Développeur<br>Designer</p>
				</div>
				<div>
					<div class="img-dydy"></div>
					<p>Dylan Chalier</p>
					<span class="reseaux">
						<a href="https://www.linkedin.com/in/dylan-chalier-435080206/" class="linkedin"><span></span></a>
						<a href="https://github.com/DylanChalier" class="github"><span></span></a>
					</span>
					<p class="role">Recherches<br>Concepteur</p>
				</div>
			</div>

			<div class="snap_credit">
				<div class="snap">
					<h3>Nos contenus</h3>
					<p>Vous avez aimé votre voyage à Petra et vous souhaitez le montrer au monde entier ? Empressez-vous d'essayer notre filtre snapchat et de l'envoyer à tous vos proches !</p>
					<img src="images/snapcode.png" alt="Snapcode">
				</div>

				<div class="credits">
					<h3>Crédits</h3>
					<h4>Projet</h4>
					<ul>
						<li>ETTAYEB Tewfik : Responsable du Forum UNESCO - UGE</li>
						<li>CESSY David</li>
						<li>REBY Yann</li>
					</ul>
					<h4>Traductions</h4>
					<ul>
						<li>Prof d'arabe ?</li>
					</ul>
					<h4>Illustrations</h4>
					<ul>
						<li>PERNICINI Tia : Logo</li>
						<li>Le monsieur ? : Photographies</li>
					</ul>
				</div>
				</div>			
		</div>

		<div class="container-partenaires">
			<h2>Partenaires</h2>
			<div class="partenaires">
				<a href=""><span class="f-logoMCN"></span></a>
	            <a href="http://www.u-pem.fr" target="_blank"><span class="f-logoUPEM"></span></a>
	            <a href="https://fr.unesco.org" target="_blank"><span class="f-logoUNESCO"></span></a>
	            <a href="https://anr.fr" target="_blank"><span class="f-logoANR"></span></a>
	            <a href="http://idea.univ-paris-est.fr/fr" target="_blank"><span class="f-logoIDEA"></span></a>
			</div>
            
		</div>

		<div class="container-form">
			<h2>Nous contacter</h2>
			<div class="formulaire">
				<form>
					<p>Une question ? Besoin d'aide ? N'hésitez pas à nous écrire, nous serons ravis de vous répondre.</p>
					<input type="text" name="prenom" id="prenom" placeholder="Prénom">
					<input type="text" name="nom" id="nom" placeholder="Nom">
					<input type="text" name="mail" id="mail" placeholder="Adresse mail">
					<input type="text" name="titre" id="titre" placeholder="Sujet de votre message" required>
					<textarea rows="10" cols="100" placeholder="Écrivez votre message ici" required></textarea>
					<input type="submit" name="Submit">
				</form>
			</div>
		</div>
	</main>

	<?php
		include("footer.inc.php");
	?>
</body>
</html>