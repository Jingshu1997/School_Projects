<?php
	session_start();

	if(isset($_SESSION['username']))
	{
		$userName = $_SESSION['username'];
	}
	else
	{
		$userName = null;
	}

	if(isset($_SESSION['diff']))
	{
		$difficulty = $_SESSION['diff'];
	}
	else
	{
		$difficulty = null;
	}

	if(isset($_POST['score']))
	{
		$score = $_POST['score'];
	}
	else
	{
		$score = null;
	}

	switch ($_POST['function'])
	{
		case 'saveScore':
			saveScore($userName, $difficulty, $score);
			break;

		default:
			echo "Call to undefined function.";
			break;
	}

	function connectBdd()
	{
		try 
		{
			$bdd = new PDO('mysql:host=localhost;dbname=tetris;charset=utf8', 'root', 'root');
		}
		catch(Exception $e)
		{
			echo json_encode('ALED');
			die('Erreur : '.$e->getMessage());
		}
		return $bdd;
	}

	function saveScore($userName, $difficulty, $score)
	{
		$bdd = connectBdd();

		$getScore = $bdd -> prepare('SELECT score FROM score WHERE id = (SELECT best_score_id FROM utilisateur where pseudo = :name)');
		$getScore -> execute(array('name' => $userName));
		$best = $getScore -> fetch();
		$getScore -> closeCursor();

		$update = $bdd -> prepare('INSERT INTO score(joueur_id, difficulte, score) VALUES((SELECT joueur_id FROM utilisateur WHERE pseudo = :username), :diff, :score)');
		$update -> execute(array('username' => $userName, 'diff' => $difficulty, 'score' => $score));
		$update -> closeCursor();

		$getLastId = $bdd -> prepare('SELECT id FROM score WHERE difficulte = :diff AND joueur_id = (SELECT joueur_id FROM utilisateur WHERE pseudo = :username) AND score = :score');
		$getLastId -> execute(array('diff' => $difficulty, 'username' => $userName, 'score' => $score));
		$lastId = $getLastId -> fetch();
		$getLastId -> closeCursor();

		if ($best[0] < $score)
		{
			$newscore = $bdd -> prepare('UPDATE utilisateur SET best_score_id = :scoreid WHERE pseudo = :name');
			$newscore -> execute(array('scoreid' => $lastId[0], 'name' => $userName));
			$newscore -> closeCursor();
		}

		$_SESSION['score'] = $score;

		echo json_encode("score updated");
	}
?>