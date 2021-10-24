<?php
	// Initialisation de la variable langue qui va indiquer à la page si le contenu doit
	// être affiché en anglais ou en français.
	// 0 : français
	// 1 : anglais
	$langue = 0;
	if (isset($_GET["lang"])) {
		switch ($_GET["lang"]) {
			case 0:
				$langue = 0; break;
			case 1:
				$langue = 1; break;
		}
	}

	// Traductions
	// Si on est en français on prend le texte à l'index 0 de la liste.
	// Si on est en anglais on prend le texte à l'index 1 de la liste.
	/* NAV */
	$nav_home = array("Accueil", "Home");
	$nav_history = array("Histoire", "History");
	$nav_galery = array("Galerie d'image", "Image gallery");
	$nav_visit = array("À visiter", "To visit");
	$nav_infos = array("Infos pratiques", "Practical informations");
	$nav_contact = array("À propos", "About us");

	/* INDEX */
	$a1_h1 = array("Petra, une cité nabatéenne", "Petra, a Nabatean city");
	$introduction = array("Petra est une cité antique du sud de l’actuelle Jordanie.<br>Son attraction mondiale en a fait l’un des principaux pôle touristique de Jordanie. Fondée en -1200 par les Édomites, elle fut par la suite occupée par les Nabatéens à partir du VIe siècle avant JC, qui la firent prospérer grâce à sa position stratégique sur la route des caravanes en provenance de l’Orient. Aujourd’hui classée au patrimoine mondial de l’UNESCO, elle est considérée comme l’un des plus beaux sites troglodytiques du monde.",
	    "Petra is an ancient city in the south of present-day Jordan.<br>Its worldwide attraction has made it one of Jordan's main tourist poles. Founded in 1200 BC by the Edomites, it was later occupied by the Nabataeans from the 6th century BC who made it prosper thanks to its strategic position on the route of caravans from the East. Today, classified as a UNESCO World Heritage Site, it is considered one of the most beautiful troglodytic sites in the world.");
	$a3_h2 = array("PARCOURS", "COURSES");
	$a3_p = array("Nous avons sélectionné pour vous les meilleurs parcours à effectuer, tout en nous assurant que vous ne raterez aucun des monuments phare de cette magnifique citée nabatéenne.", "We have selected for you the best routes to take, ensuring that you will not miss any of the highlights of this magnificent Nabatean city.");
	$a3_label = array("Durée du parcours : ", "Duration of the course : ");
	$a3_option0 = array("Aucun ", "None ");
	$a3_option1 = array("Tout afficher ", "Display all ");
	$a3_input_value = array("Rechercher", "Search");
	$a4_h2 = array("IMAGES À LA UNE", "FEATURED IMAGES");
	$a4_a = array("Voir plus", "See more");

	/* HISTOIRE */
	$h1_h1 = array("La grande histoire de Petra", "The great history of Petra");
	$sommaire = array("Sommaire", "Summary");
	$sommaire_1 = array("Histoire", "History");
	$sommaire_1_1 = array("Antiquité", "Antiquity");
	$sommaire_1_2 = array("Moyen-Âge", "Middle Ages");
	$sommaire_2 = array("Recherches archéologiques", "Archaeological researches");
	$sommaire_3 = array("Architecture", "Architecture");
	$sommaire_4 = array("Petra dans l'art et la culture", "Petra in art and culture");
	$h2_h2 = $sommaire_1;
	$h2_h3 = $sommaire_1_1;
	$h2_p = array("Aux alentours de 1200 avant  JC les Édomites furent les premiers à occuper l’emplacement actuel de la cité de Pétra. Originaire du royaume d’Édom (sud de l’actuelle Jordanie) ces tribus nomades étaient réputés pour leurs textiles, leurs céramiques et leur travail des métaux. Parmi leur héritage sur place, on retrouve les traces d’une série de fortins au dessus de promontoires visant à les protéger d’éventuelles attaques.", "Around 1200 B.C. the Edomites were the first to occupy the present site of the city of Petra. Originally from the Kingdom of Edom (southern Jordan), these nomadic tribes were famous for their textiles, ceramics, and metalwork. Nowaday, their legacies on the site are traces of a series of forts above promontories to protect them from possible attack.");
	$h3_p = array("La fin de l’occupation Édomite vers le VIe siècle avant JC se mêle avec le début de l’occupation nabatéenne qui fit prospérer la cité en en faisant un carrefour du commerce oriental notamment grâce aux caravanes de chameaux. Les Nabatéens étaient à l’origine un peuple de nomades connus pour leur commerce des aromates.", "The end of the Edomite occupation around the 6th century BC is mixed with the beginning of the Nabataean occupation which made the city prosper by making it a crossroads of oriental trade, notably thanks to camel caravans. The Nabataeans were originally a nomadic people known for their trade in herbs.");
	$h4_p = array("C’est durant l’occupation nabatéenne (VIe avant J.-C. jusqu’au Ie siècle après J.-C.) qu’apparaissent les principaux monuments comme Al Kazneh. Il s’agit principalement de tombeaux royaux.<br>
		La cité attire alors l’attention de nombreux rois locaux et les nabatéens devrons repousser des nombreuses incursions ennemies. C’est à ce moment qu’est construit le Temple de Deir, en l’honneur du roi Obodas 1er après de nombreuses victoires militaires. Après à la mort du dernier roi Nabatéen Rabbel II, la cité tombe aux mains des romains. <br>
		En 363 lors de sa période byzantine, la cité est frappée d’un violent séisme détruisant de nombreux bâtiments comme les aqueducs et le théâtre. La ville affaiblie depuis l’occupation romaine ne fut pas reconstruite et perdra petit à petit ses habitants.", "It was during the Nabataean occupation (6th B.C. to 1st century A.D.) that the main monuments such as Al Kazneh appeared. They are mainly royal tombs.<br>
		The city then attracted the attention of many local kings and the Nabataeans had to repel numerous enemy incursions. It is at this time that the Temple of Deir was built in honor of King Obodas I after many military victories. After the death of the last Nabataean king, Rabbel II, the city fell to the Romans.<br>
		In 363 during its Byzantine period, the city was struck by a violent earthquake destroying many buildings like the aqueducts and the theater. The city weakened since the Roman occupation was not rebuilt and will lose little by little its inhabitants.");
	$h5_h3 = $sommaire_1_2;
	$h5_p_1 = array("Au Moyen Age, la cité se dépeuple et en l'an 700 il ne s’agit plus que d’un petit village, ignoré, même par l’expansion de l’Islam.", "In the Middle Ages, the city was depopulated and in 700 it was only a small village, ignored even by the expansion of Islam.");
	$h5_p_2 = array("La cité tombe peu à peu dans l’oubli.", "The city falls step by step into oblivion.");
	$h6_h2 = $sommaire_2;
	$h6_p = array("La cité nabatéenne fut redécouverte par le monde occidental en 1812 grâce à l’explorateur suisse Jean-Louis Burckhardt. Malheureusement la situation géopolitique d’alors ne lui permit pas d’étudier les vestiges de la cité oubliée en détail et dû se contenter de la traverser sans même pouvoir prendre de notes. Cependant il fit part de sa découverte aux occidentaux installés en Syrie et en Égypte. Il fallut attendre 6 ans pour qu’une véritable expédition ait lieu, menée par William John Bankes, un égyptologue anglais. Avec son équipe pue rester quelques jours et faire des croquis des lieux. Par la suite Pétra fit l’objet de nombreuses expéditions et recherches archéologiques.", "The Nabatean city was rediscovered by the Western world in 1812 thanks to the Swiss explorer Jean-Louis Burckhardt. Unfortunately, the geopolitical situation at the time did not allow him to study the remains of the forgotten city in detail and he had to be satisfied with crossing it without even being able to take notes. However, he shared his discovery with the Westerners settled in Syria and Egypt. It was necessary to wait 6 years for a true expedition to take place, led by William John Bankes, an English Egyptologist. He and his team stayed a few days and made sketches of the place. Thereafter, Petra was the subject of many expeditions and archaeological research.");
	$h7_h2 = $sommaire_3;
	$h7_p = array("Les premières constructions des Nabatéens étaient simplement creusées dans la roche de manière assez rustique. Progressivement, les habitants s’inspirèrent des styles architecturaux des civilisations voisines afin de créer des façades plus complexe. On peut aussi retrouver des traces de l’architecture hellénistiques dans l’aspect des bâtiments public que ce soit les colonnes ou encore le péristyle. Les lieux de vie et de travail des habitants sont quand à eux d’avantage d’inspiration arabe.", "The first constructions of the Nabateans were simply dug into the rock in a rather rustic way. Gradually, the inhabitants were inspired by the architectural styles of neighboring civilizations to create more complex facades. Traces of Hellenistic architecture can also be found in the appearance of the public buildings, be it the columns or the peristyle. The living and working places of the inhabitants are more of Arab inspiration.");
	$h8_h2 = $sommaire_4;
	$h8_p = array("Depuis sa redécouverte, Petra subjugue et inspire. C’est ainsi que virent le jours de nombres œuvres . Plusieurs peintre en firent des représentations.<br><br>
		La cité nabatéenne fit aussi quelques apparitions sur grand écran que ce soit dans Indiana Jones et la dernière croisade, Transformers 2, Le Retour de la Momie ou encore Mortal Kombat : Destruction Finale. Le jeu vidéo Overwatch lui fit aussi hommage en recréant la cité dans un monde futuriste.", "Since his rediscovery Petra subjugates and inspires, that's how many works saw the light of day. Several painters made representations of it.<br><br>
		The Nabataean city also made some appearances on large screen that it is in Indiana Jones and the last crusade, Transformers 2, The Return of the Mummy or Mortal Kombat: Final Destruction. The video game Overwatch also paid homage to him by recreating the city in a futuristic world.");

	/* GALERIE */
	$galerie_h1 = array("Galerie d'image", "Image gallery");
	$galerie_img1 = array("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel egestas ex. Morbi placerat risus in ante pretium, eu dapibus ante suscipit. Phasellus tempor ex augue, ac iaculis tortor sollicitudin eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel egestas ex. Morbi placerat risus in ante pretium, eu dapibus ante suscipit. Phasellus tempor ex augue, ac iaculis tortor sollicitudin eu.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel egestas ex. Morbi placerat risus in ante pretium, eu dapibus ante suscipit. Phasellus tempor ex augue, ac iaculis tortor sollicitudin eu.");
	$galerie_img2 = array("Description", "Description");
	$galerie_img3 = array("Description", "Description");
	$galerie_img4 = array("Description", "Description");
	$galerie_img5 = array("Description", "Description");
	$galerie_img6 = array("Description", "Description");
	$galerie_img7 = array("Description", "Description");
	$galerie_img8 = array("Description", "Description");
	$galerie_img9 = array("Description", "Description");
	$galerie_img10 = array("Description", "Description");
	$galerie_img11 = array("Description", "Description");
	$galerie_img12 = array("Description", "Description");
	$galerie_img13 = array("Description", "Description");
	$galerie_img14 = array("Description", "Description");
	$galerie_img15 = array("Description", "Description");
	$galerie_img16 = array("Description", "Description");
	$galerie_img17 = array("Description", "Description");
	$galerie_img18 = array("Description", "Description");
	$galerie_img19 = array("Description", "Description");
	$galerie_img20 = array("Description", "Description");

	/* A VISITER */
	$visiter_h1 = array("Principaux monuments", "Main monuments");
	$visiter_1_titre = array("Le Kazneh", "El Kazneh");
	$visiter_1_texte = array("Cette édifice troglodyte, sans doute le plus impressionnant, serait le tombeau d’un roi nabatéen mort autour de l’an 40 de notre ère. Le style architectural de la façade est inspiré de celui d’Alexandrie que l’on peut également retrouver dans les décors de certaines villas de Pompéi. À l’intérieur du monuments se trouve un vestibules débouchant sur 3 salles complètement souterraine dont les dimensions vont jusqu’à 11*28 m pour la plus grande.", "Perhaps the most impressive of the troglodytic buildings is the tomb of a Nabataean king who died around 40. The architectural style of the facade is inspired by that of Alexandria, which can also be found in the decoration of some of the villas in Pompeii. Inside the monument is a vestibule leading to 3 completely underground rooms, the largest of which is 11*28 m in size.");
	$visiter_2_titre = array("Al Deir", "Al Deir");
	$visiter_2_texte = array("Ce monument aux envergures impressionnantes (45 m de large et 42 m de haut) est lui aussi un tombeau d’un roi nabatéen, sans doute Obodas 1er qui accéda au trône en -96. Une urne funéraire de 9 mètres de haut est présente à son sommet. Il fut par la suite utilisé comme monastère par des Chrétiens qui lui donnèrent son nom actuel.", "This monument of impressive proportions (45 meters wide and 42 meters high) is also the tomb of a Nabataean king, probably Obodas I, who acceded to the throne in 96 BC. A 9-meter (30-foot) tall funerary urn stands at the top of the tomb. It was later used as a monastery by Christians who gave it its present name.");
	$visiter_3_titre = array("Théâtre romain", "Roman theater");
	$visiter_3_texte = array("L’occupation romaine a elle aussi marqué la cité de Pétra. Un théâtre pouvant accueillir plusieurs milliers de spectateur a été creusé dans le grès.", "The Roman occupation also marked the city of Petra. A theater that could accommodate several thousand spectators was dug in the sandstone.");
	$visiter_4_titre = array("Les aqueducs", "The aqueducts");
	$visiter_4_texte = array("La cité se situe dans une zone très aride. Ainsi plusieurs systèmes de gestion de l’eau furent mis en place. L’eau de la cité provenait essentiellement de la pluie, le sol étant peu perméable, les habitants pouvaient la récupérer aux alentours. Pour l’acheminer, deux aqueducs furent creusé dans la parois le long du Sîq (défilé rocheux menant devant Al Kazneh, l’un alimenté par l’Aïn Moussa (cours d’eau passant non loin), l’autre par les eaux de pluies. Enfin environs 200 citernes permettaient de stocker l’eau à proximiter de la citer.", "The city is located in a very arid area. Thus several systems of water management were set up. The water of the city came essentially from the rain, the ground being not very permeable, the inhabitants could recover it in the surroundings. To convey it, two aqueducts were dug in the wall along the Sîq (rocky gorge leading in front of Al Kazneh), one fed by the Aïn Moussa (a stream passing nearby), the other by rainwater. Finally, about 200 cisterns were used to store water near the cistern.");

	/* INFOS PRATIQUE */
	$infos_h1 = array("Informations pratiques", "Practicals informations");
	$infos_title1 = array("Plan du site", "Site map");
	$infos_title2 = array("Divers", "Other");
	$infos_text1 = array("Le site de Petra et son office de tourisme est ouverte de 6h00 à 18h00 en été, et de 6h00 à 16h00 en hiver.<br>Nous vous recommandons de réserver une chambre d'hôtel avant de débuter votre voyage.", "The Petra site and its tourist office is open from 6:00 am to 6:00 pm in summer, and from 6:00 am to 4:00 pm in winter.<br>We recommend that you book an hotel room before starting your trip.");
	$infos_subtitle1 = array("Recommandations diplomatiques", "Diplomatic advices");
	$infos_text2 = array("Le Royaume hachémite de Jordanie, pôle de stabilité dans une région traversée par les crises, n’est cependant pas à l’abri de troubles, en particulier du risque terroriste. La Jordanie connaît une menace permanente d’attentats. Cette menace est prise en compte par les autorités jordaniennes qui continuent de se mobiliser pour prévenir le risque terroriste ou infiltrations aux frontières.", "The Hashemite Kingdom of Jordan, a pole of stability in a region plagued by crises, is not, however, immune to unrest, particularly the risk of terrorism. Jordan is under constant threat of terrorist attacks. This threat is taken into account by the Jordanian authorities who continue to mobilize to prevent the risk of terrorism or infiltration at the borders.");
	$infos_subsubtitle1 = array("Recommandations", "Advices");
	$infos_subsubtitle1_text1 = array("La discrétion, y compris vestimentaire, doit être de mise aux abords des mosquées, notamment lors des rassemblements pour la prière du vendredi.", "Discretion, including clothing, must be exercised in the vicinity of mosques, especially during gatherings for Friday prayers.");
	$infos_subsubtitle1_text2 = array("Il est préférable d’éviter tout signe distinctif permettant d’être identifié comme français (drapeaux, logos français sur véhicules, vêtements, etc.).", "It is preferable to avoid any distinctive sign allowing to be identified as French (flags, French logos on vehicles, clothing, etc.). ");
	$infos_subsubtitle1_text3 = array("Il est recommandé aux femmes de ne pas voyager seules et de préférence de jour, et d’adopter une tenue sobre en public. De manière générale, les épaules dénudées, les shorts et les jupes sont à éviter.", "It is recommended that women do not travel alone and preferably during the day, and that they dress conservatively in public. In general, bare shoulders, shorts and skirts should be avoided.");
	$infos_subsubtitle2 = array("Zone de vigilance", "Vigilance area");
	$infos_subsubtitle2_text1 = array("Frontière entre la Jordanie et la Syrie.", "Border between Jordan and Syria.");
	$infos_subsubtitle2_text2 = array("Frontière entre la Jordanie et l’Irak.", "Border between Jordan and Iraq.");
	$infos_subsubtitle2_text3 = array("Péninsule du Sinaï (Égypte) depuis la Jordanie.", "Sinai Peninsula (Egypt) from Jordan.");
	$infos_subtitle2 = array("Quelques traductions utiles", "Some helpful translations");
	$infos_subtitle3 = array("Convertisseur de monnaie", "Currency converter");
	$infos_title3 = array("Aux alentours", "near by");
	$infos_subtitle4 = array("Hôtels", "Hotels");
	$infos_subtitle3_text1 = array("Besoin de vous loger ? Ne vous en faites pas ! Nous avons séléctionné pour vous les hôtels à proximité, classé par étoiles.", "Need a place to stay? Don't worry about it! We have selected for you the hotels in the area, classified by stars.");
	$infos_hotel_plus = array("Les + :", "Advantages :");
	$infos_hotel_tarif = array("Tarifs : ", "Prices :");
	$infos_hotel_non_renseigne = array("Non renseignés.", "Unknown.");
	$infos_hotel_address = array("Adresse", "Address");
	$infos_hotel_website = array("Site web", "Website");
	$infos_hotel_telephone = array("Téléphone", "Phone");

	$infos_hotel1_1 = array("L'hotel le plus proche de Petra", "The nearest hotel to Petra");
	$infos_hotel1_2 = array("Vue sur la vallée du grand rift", "View of the Great Rift Valley");
	$infos_hotel1_5 = array("Piscine", "Pool");
	$infos_hotel2_1 = array("Internet haut débit gratuit", "Free high speed internet");
	$infos_hotel2_tarif = array(
							"1 lit : 62 à 88 JOD (72 à 102€)<br>
							2 lits : 75 à 88 JOD (87 à 102€)<br>
							3 lits : 110 à 141 JOD (128 à 164€)<br><br>
							Les prix varient selon la taille des lits. (Single ou Kings)<br>
							Prix indiqués pour une nuit.", 
							"1 bed : 62 to 88 JOD (88 to 124\$ / 62 to 88£)<br>
							2 beds : 75 to 88 JOD (106 to 124\$ / 75 to 88£)<br>
							3 beds : 110 to 141 JOD (155 to 175\$ / 110 to 141£)<br><br>
							Prices vary depending on the size of the beds. (Single or Kings)<br>
							Prices are for one night.");
	$infos_hotel3_2 = array("Situé à 150m de Petra", "Located at 150m from Petra");
	$infos_hotel3_3 = array("Piscine", "Pool");
	$infos_hotel3_4 = array("Déjeuner gratuit", "Free lunch");
	$infos_hotel3_5 = array("Parking gratuit", "Free parking");
	$infos_hotel3_tarif = array(
							"2 personne : 165€ / nuit<br>
							3 personnes : 195€ / nuit<br>
							5 personnes : 250€ / nuit<br>", 
							"2 persons : 165€ / night<br>
							3 persons : 195€ / night<br>
							5 persons : 250€ / night<br>");
	$infos_hotel4_1 = array("Internet gratuit", "Free internet");
	$infos_hotel4_tarif = array(
							"Suite Deluxe : 41€+ / nuit<br>
							King suite : 123€+ / nuit<br>
							Suite avec vue sur océan : 165€+ / nuit", 
							"Suite Deluxe : 41€+ / night<br>
							King suite : 123€+ / night<br>
							Ocean view Suite : 165€+ / night");
	$infos_hotel5_1 = array("Situé à 10min de Petra", "Located at 10min from Petra");
	$infos_hotel5_4 = array("Petit-déjeuner gratuit", "Free breakfast");
	$infos_hotel5_5 = array("Wifi gratuit", "Free Internet");
	$infos_hotel5_6 = array("Parking gratuit", "Free parking");
	$infos_hotel5_tarif = array(
							"2 personnes : 95€ / nuit<br>
							3 personnes : 87 à 99€ / nuit", 
							"2 persons : 95€ / night<br>
							3 persons : 87 to 99€ / night");

	$infos_hotel6_1 = array("Proche de Petra", "Near to Petra");
	$infos_hotel6_3 = array("Piscine", "Pool");
	$infos_hotel6_5 = array("Wifi gratuit", "Free Internet");
	$infos_hotel6_tarif = array(
							"1 personne : 44 ou 68€<br>
							2 personnes : 62 ou 77€<br>
							3 personnes : 84 ou 104€<br>
							4 personnes : 108 ou 136€<br><br>
							Le premier prix indiqué fait référence aux saisons hautes, le second aux saisons basses.", 
							"1 person : 44 or 68€<br>
							2 persons : 62 or 77€<br>
							3 persons : 84 or 104€<br>
							4 persons : 108 or 136€<br><br>
							The first price indicated refers to high seasons, the second to low seasons.");

	// Header + nav
	if ($langue == 0) {
		$lang_header = "fr";
	} else {
		$lang_header = "en";
	}
	echo '
	<!DOCTYPE html> 
	<html lang="'.$lang_header.'">
	<head> 
		<title>Petra - Médiation Culturelle et Numérique</title>
		<meta name="author" content="Amalaric Le Forestier" />
		<link rel="icon" href="images/logo.ico" />
		<meta charset="utf-8" />
		<script src="https://kit.fontawesome.com/79f61c2135.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="styles/style.css" type="text/css" />
		<link rel="stylesheet" href="styles/mediaqueries.css" type="text/css" />
		<script type="text/javascript" src="scripts/script.js" ></script>
	</head>

	<header>
		<nav role="navigation">											<!-- Menu de navigation -->
			<i class="fas fa-bars"></i>
			<ul>';
				// Pour appliquer un style différent à la page où l'on se trouve
				if ($page == "index") {
					echo '<li><a href="index.php?lang='.$langue.'" class="page-actuelle">'.$nav_home[$langue].'</a></li>';
				} else {
					echo '<li><a href="index.php?lang='.$langue.'">'.$nav_home[$langue].'</a></li>';
				}
				if ($page == "histoire") {
					echo '<li class="histoire"><a href="histoire.php?lang='.$langue.'" class="page-actuelle">'.$nav_history[$langue].'</a>';
				} else {
					echo '<li class="histoire"><a href="histoire.php?lang='.$langue.'">'.$nav_history[$langue].'</a>';
				}
				echo "
				<ul class=\"deroulant deroulant-h\">
					<li><a href=\"histoire.php?lang=".$langue."#histoire\">".$sommaire_1[$langue]."</a></li>
					<ul>
						<li><a href=\"histoire.php?lang=".$langue."#antiquite\">".$sommaire_1_1[$langue]."</a></li>
						<li><a href=\"histoire.php?lang=".$langue."#moyen-age\">".$sommaire_1_2[$langue]."</a></li>
					</ul>
					<li><a href=\"histoire.php?lang=".$langue."#archeo\">".$sommaire_2[$langue]."</a></li>
					<li><a href=\"histoire.php?lang=".$langue."#archi\">".$sommaire_3[$langue]."</a></li>
					<li><a href=\"histoire.php?lang=".$langue."#culture\">".$sommaire_4[$langue]."</a></li>
				</ul></li>
				";
				if ($page == "galerie") {
					echo '<li><a href="galerie.php?lang='.$langue.'" class="page-actuelle">'.$nav_galery[$langue].'</a></li>';
				} else {
					echo '<li><a href="galerie.php?lang='.$langue.'">'.$nav_galery[$langue].'</a></li>';
				}
				echo '
				<li class="logo-langue">
					<div>';
					if ($langue == 0) {
						echo '<a href="'.$_SERVER["PHP_SELF"].'" target="_self"><img src="images/flag_fr.png" alt="Langue FR" id="flag" class="langue-actuelle"></a>';
					} else {
						echo '<a href="'.$_SERVER["PHP_SELF"].'" target="_self"><img src="images/flag_fr.png" alt="Langue FR" id="flag"></a>';
					}
					echo '<a href="index.php?lang='.$langue.'"><img src="images/logo.png" alt="Logo" id="logo"></img></a>';
					if ($langue == 1) {
						echo '<a href="'.$_SERVER["PHP_SELF"].'?lang=1" target="_self"><img src="images/flag_en.png" alt="Langue EN" id="flag" class="langue-actuelle"></a>';
					} else {
						echo '<a href="'.$_SERVER["PHP_SELF"].'?lang=1" target="_self"><img src="images/flag_en.png" alt="Langue EN" id="flag"></a>';
					}
				echo '
					</div>
				</li>
				';
				if ($page == "visiter") {
					echo '<li class="visiter"><a href="visiter.php?lang='.$langue.'" class="page-actuelle">'.$nav_visit[$langue].'</a>';
				} else {
					echo '<li class="visiter"><a href="visiter.php?lang='.$langue.'">'.$nav_visit[$langue].'</a>';
				}
				echo "
				<ul class=\"deroulant deroulant-v\">
					<li><a href=\"visiter.php?lang=".$langue."#kazneh\">".$visiter_1_titre[$langue]."</a></li>
					<li><a href=\"visiter.php?lang=".$langue."#ad-deir\">".$visiter_2_titre[$langue]."</a></li>
					<li><a href=\"visiter.php?lang=".$langue."#theatre\">".$visiter_3_titre[$langue]."</a></li>
					<li><a href=\"visiter.php?lang=".$langue."#aqueducs\">".$visiter_4_titre[$langue]."</a></li>
				</ul></li>
				";
				if ($page == "informations") {
					echo '<li class="informations"><a href="informations.php?lang='.$langue.'" class="page-actuelle">'.$nav_infos[$langue].'</a>';
				} else {
					echo '<li class="informations"><a href="informations.php?lang='.$langue.'">'.$nav_infos[$langue].'</a>';
				}
				echo "
				<ul class=\"deroulant deroulant-if\">
					<li><a href=\"informations.php?lang=".$langue."#plan\">Plan du site</a></li>
					<li><a href=\"informations.php?lang=".$langue."#divers\">Divers</a></li>
					<ul>
						<li><a href=\"informations.php?lang=".$langue."#reco-diplo\">Recommandations diplomatiques</a></li>
						<li><a href=\"informations.php?lang=".$langue."#trad\">Quelques traductions utiles</a></li>
						<li><a href=\"informations.php?lang=".$langue."#convertisseur\">Convertisseur de monnaie</a></li>
					</ul>
					<li><a href=\"informations.php?lang=".$langue."#alentours\">Aux alentours</a></li>
					<ul>
						<li><a href=\"informations.php?lang=".$langue."#hotels\">Hôtels</a></li>
						<li><a href=\"informations.php?lang=".$langue."#resto\">Restaurants</a></li>
					</ul>
				</ul></li>
				";
				if ($page == "contact") {
					echo '<li><a href="contact.php?lang='.$langue.'" class="page-actuelle">'.$nav_contact[$langue].'</a></li>';
				} else {
					echo '<li><a href="contact.php?lang='.$langue.'">'.$nav_contact[$langue].'</a></li>';
				}
	echo '
			</ul>
			<a href="index.php?lang='.$langue.'" class="logo2"><img src="images/logo.png" alt="Logo" id="logo"></img></a>
		</nav>
	</header>

	<div id="progress"></div> 							<!-- Barre de progression -->
	';
?>
