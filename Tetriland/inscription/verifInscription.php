<?php
	$fonction = $_POST["function"];

	if (isset($_POST["nom"]))
		$nom = $_POST["nom"];
	else
		$nom = null;

	if (isset($_POST["prenom"]))
		$prenom = $_POST["prenom"];
	else
		$prenom = null;

	if (isset($_POST["pseudo"]))
		$pseudo = $_POST["pseudo"];
	else
		$pseudo = null;

	if (isset($_POST["mdp"]))
		$mdp = $_POST["mdp"];
	else
		$mdp = null;

	if (isset($_POST["mdp2"]))
		$mdp2 = $_POST["mdp2"];
	else
		$mdp2 = null;

	if (isset($_POST["email"]))
		$email = $_POST["email"];
	else
		$email = null;

	if (isset($_POST["age"]))
		$age = $_POST["age"];
	else
		$age = null;

	function connexionBDD() {
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=tetris;charset=utf8', 'root', 'root');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}

		return $bdd;
	}

	if(isset($fonction)) {
		switch ($fonction) {
			case 'verifNomPrenomPseudo':
				if((isset($nom) && !empty($nom)) && (isset($prenom) && !empty($prenom)) && (isset($pseudo) && !empty($pseudo)))
					verifNomPrenomPseudo($nom, $prenom, $pseudo);
				else
					echo json_encode("Erreur, entree incorrecte");

				break;
			
			case 'verifMdp':
				$insertionBDD = $_POST["insertionBDD"];
				if((isset($mdp) && !empty($mdp)) && (isset($mdp2) && !empty($mdp2)))
					verifMdp($mdp, $mdp2, $insertionBDD);
				else
					echo json_encode("Erreur, mot de passe incorrecte");

				break;

			case 'verifEmail':
				$insertionBDD = $_POST["insertionBDD"];
				if(isset($email) && !empty($email))
					verifEmail($email, $insertionBDD);
				else
					echo json_encode("Erreur, adresse mail incorrecte");

				break;

			case 'verifAge':
				$insertionBDD = $_POST["insertionBDD"];
				if(isset($age) && is_numeric($age) && !empty($age))
					verifAge($age, $insertionBDD);
				else
					echo json_encode("Erreur, age incorrecte");

				break;

			case 'insertionNouvelUtilisateur':
				insertionNouvelUtilisateur($nom, $prenom, $pseudo, $mdp, $email, $age);

				break;

			default:
				break;
		}
	}

	function verifNomPrenomPseudo($nom, $prenom, $pseudo) {
		$bdd = connexionBDD();

		// On maîtrise les balises html
		$nom = htmlspecialchars($nom);
		$prenom = htmlspecialchars($prenom);
		$pseudo = htmlspecialchars($pseudo);

		// On maîtrise les accents
		$nom = enleverAccents($nom);
		$prenom = enleverAccents($prenom);
		$pseudo = enleverAccents($pseudo);

		$req = $bdd->query('SELECT pseudo FROM utilisateur WHERE pseudo =\'' . $pseudo . '\'');
		$reqCount = $req->rowCount();

		$req -> closeCursor();
		
		if($reqCount != 0)
			$informations = "Pseudo deja utilise, veuillez en choisir un autre.";
		else
			$informations = "";

		echo json_encode(array("informations" => $informations, "insertionBDD" => $reqCount == 0));
	}

	function verifMdp($mdp, $mdp2, $insertionBDD) {
		// On maîtrise les balises html
		$mdp = htmlspecialchars($mdp);
		$mdp2 = htmlspecialchars($mdp2);

		if($mdp == $mdp2) {
			$informations = "";
			$insertionBDD = $insertionBDD AND true;
		} else {
			$informations = "Mots de passe non identiques, veuillez reessayer.";
			$insertionBDD = false;
		}

		echo json_encode(array("informations" => $informations, "insertionBDD" => $insertionBDD));
	}

	function verifEmail($email, $insertionBDD) {
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=tetris;charset=utf8', 'root', 'root');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}

		// On maîtrise les balises html
		$email = htmlspecialchars($email);

		$req = $bdd -> query('SELECT email FROM utilisateur WHERE email =\'' . $email . '\'');
		$reqCount = $req -> rowCount();

		$req -> closeCursor();
		
		if($reqCount != 0) {
			$informations = "Adresse mail deja utilise, veuillez en choisir une autre.";
			$insertionBDD = false;
		} else {
			$informations = "";
			$insertionBDD = $insertionBDD AND true;
		}

		echo json_encode(array("informations" => $informations, "insertionBDD" => $insertionBDD));
	}

	function verifAge($age, $insertionBDD) {
		if($age <= 99 && $age >= 0) {
			$informations = "";
			$insertionBDD = $insertionBDD AND true;
		} else {
			$informations = "Erreur, veuillez entrez un age compris entre 0 et 99.";
			$insertionBDD = false;
		}

		echo json_encode(array("informations" => $informations, "insertionBDD" => $insertionBDD));
	}

	function insertionNouvelUtilisateur($nom, $prenom, $pseudo, $mdp, $email, $age) {
		$bdd = connexionBDD();

		$mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

		$creationUtilisateur = $bdd -> prepare("INSERT INTO utilisateur (nom, prenom, pseudo, mdp, email, best_score_id, age) VALUES(:nom, :prenom, :pseudo, :mdp, :email, :best_score, :age)");

		$creationUtilisateur -> execute(array('nom' => $nom, 
											  'prenom' => $prenom, 
											  'pseudo' => $pseudo, 
											  'mdp' => $mdpHash, 
											  'email' => $email, 
											  'best_score' => 0,
											  'age' => $age
		                                ));

	    $erreurRequete = $creationUtilisateur -> errorInfo();
		$creationUtilisateur -> closeCursor();

		echo json_encode($erreurRequete);
	}


	// Fonction retournant $string, passé en paramètre, en remplaçant les accents et autres
	function enleverAccents($string) { 
    	$string = preg_replace('#ç|Ç#', 'C', $string);
   	    $string = preg_replace('#è|é|ê|ë|È|É|Ê|Ë#', 'E', $string);
    	$string = preg_replace('#æ|à|á|â|ã|ä|å|@|Æ|À|Á|Â|Ã|Ä|Å#', 'A', $string);
    	$string = preg_replace('#ì|í|î|ï|Ì|Í|Î|Ï#', 'I', $string);
    	$string = preg_replace('#œ|ð|ò|ó|ô|õ|ö|Œ|Ò|Ó|Ô|Õ|Ö#', 'O', $string);
    	$string = preg_replace('#ù|ú|û|ü|Ù|Ú|Û|Ü#', 'U', $string);
    	$string = preg_replace('#ý|ÿ|Ý#', 'Y', $string);
     
    	return ($string);
	}
?>