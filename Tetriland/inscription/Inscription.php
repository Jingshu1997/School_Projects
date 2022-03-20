<?php 
	session_start();
?>

 <!DOCTYPE html>
<html>
	<head>
		<title>Inscription</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../css/inscription.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</head>

	<body>
		<?php include("../include/header.php"); ?>
		<div id="misc_div">
            <button id="accueil">Retour à l'accueil</button>
        </div>
		<div id="form">
			<!-- Renseignement nom et prénom avec option de retour à la page d'accueil -->
			
					<p>Veuillez renseigner les informations suivantes : </p>
					<nav class="label">
						<label for="nom"> Nom de famille : </label>
						<input type="text" name="nom" id="nom" placeholder="Ex : Boulanger" maxlength="255" required="required"> </br></br>
					</nav>
					<div id='resultatNomPrenomPseudo'></div>

					<nav class="label">
						<label for="prenom"> Prenom : </label>
						<input type="text" name="prenom" id="prenom" placeholder="Ex : Charles Antoine" maxlength="255" required="required"> </br></br>
					</nav>

					<nav class="label">
						<label for="pseudo"> Pseudo : </label>
						<input type="text" name="pseudo" id="pseudo" placeholder="Ex : Charlus" maxlength="255" required="required"> </br></br>
					</nav>

					<nav class="label">
						<label for="mdp"> Mot de passe : </label>
						<input type="password" name="mdp" id="mdp" maxlength="255" required="required"> </br></br>
					</nav>

					<nav class="label">
						<label for="mdp2"> Confirmer mot de passe : </label>
						<input type="password" name="mdp2" id="mdp2" maxlength="255" required="required"> </br></br>
					</nav>

					<div id='resultatMdp'></div>

					<nav class="label">
						<label for="email"> Adresse mail : </label>
						<input type="email" name="email" id="email" placeholder="Ex : charlieboulanger2000@gmail.com" maxlength="255" required="required" size=30> </br></br>
					</nav>

					<nav class="label">
						<label for="age"> Âge : </label>
						<input type="number" name="age" id="age" placeholder="Ex : 21" min="0" max="99" required="required"> </br></br>
					</nav>

					<input id="buttonInscription" type="submit" value="Valider" title="Cliquez ici pour valider vos informations">

			<div id='resultat'></div>
		</div>
	</body>

	<footer>
			<script type="text/javascript" src="JS/Inscription.js"></script>
	</footer>
</html>