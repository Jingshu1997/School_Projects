<?php 
	session_start();
?>

 <!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../css/login.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</head>

	<body>
		<?php include("../include/header.php"); ?>
		<div id="misc_div">
            <button id="accueil">Retour à l'accueil</button>
        </div>
        <div id="form">
        	<nav class="label">
				<label for="pseudo"> Pseudo : </label>
				<input type="text" name="pseudo" id="pseudo" placeholder="Ex : Charlus" maxlength="255" required="required"> </br></br>
			</nav>

			<nav class="label">
				<label for="mdp"> Mot de passe : </label>
				<input type="password" name="mdp" id="mdp" maxlength="255" required="required"> </br></br>
			</nav>

			<div id=resultatConnexion></div>

			<input id="buttonConnexion" type="submit" value="Valider" title="Connexion">

			<div id='resultat'></div>
        </div>
	</body>

	<footer>
		<script type="text/javascript" src="JS/Connexion.js"></script>
	</footer>
</html>