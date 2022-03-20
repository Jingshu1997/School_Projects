<?php
	// On démarre la session
	session_start ();

	// On détruit les variables de session
	unset($_SESSION['isLoggedIn']);
	unset($_SESSION['username']);

	// On redirige vers la page d'accueil
	header ('Location: ../index.php');
?>