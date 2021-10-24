<?php
	if (!(isset($_COOKIE['cookie']) || isset($_SESSION['cookie']))){
		echo "test";
	} else {
		echo "
		<div class=\"container-footer\">
			<p>Votre vie privée est notre priorité. Acceptez-vous d'utiliser nos cookies ?</p>
			<div>
				<form action=\"\" method=\"post\">
					<input type=\"submit\" name=\"accepter\" value=\"Accepter\">
					<input type=\"submit\" name=\"refuser\"  value=\"Refuser\">
				</form>
			</div>
		</div>
		";
	}
?>