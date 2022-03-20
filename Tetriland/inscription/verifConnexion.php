<?php
	session_start();

	$fonction = $_POST["function"];

	$pseudo = $_POST["pseudo"];
	$mdp = $_POST["mdp"];

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
			case 'verifConnexion':
				if((isset($pseudo) && !empty($pseudo)) && (isset($mdp) && !empty($mdp)))
					verifConnexion($pseudo, $mdp);
				else
					echo json_encode("Erreur, veuillez entrer un pseudo et un mot de passe.");

				break;

			default:
				break;
		}
	}

	function verifConnexion($pseudo, $mdp) {
		$bdd = connexionBDD();

		// On maîtrise les balises html
		$pseudo = htmlspecialchars($pseudo);
		$mdp = htmlspecialchars($mdp);

		// On maîtrise les accents
		$pseudo = enleverAccents($pseudo);

		$req = $bdd->query('SELECT pseudo, mdp FROM utilisateur WHERE pseudo =\'' . $pseudo . '\'');
		while($donnees = $req->fetch()) {
			if(password_verify($mdp, $donnees['mdp'])) 
			{
				$_SESSION['isLoggedIn'] = true;
				$_SESSION['username'] = $pseudo;
				echo json_encode('Connexion autorisee');
			} else {
				echo json_encode('Mot de passe incorrect');
			}
		}

		if($reqCount = $req -> rowCount() == 0) {
			echo json_encode('Pseudo incorrect');
		}

		$req -> closeCursor();
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