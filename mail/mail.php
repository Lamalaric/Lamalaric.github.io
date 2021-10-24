<?php 

$envoi = mail('alf2002@hotmail.fr', "Portfolio: ".$_POST['sujet'], $_POST['message'], $_POST['mail']);
header('Location: http://perso-etudiant.u-pem.fr/~alefor03/index.html');

?>