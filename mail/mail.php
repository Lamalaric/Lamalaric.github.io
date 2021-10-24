<?php 

$envoi = mail('alf2002@hotmail.fr', "Portfolio: ".$_POST['sujet'], $_POST['message'], $_POST['mail']);
header('Location: https://amalaric.dev');

