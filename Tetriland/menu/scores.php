<?php
    session_start();

    try 
    {
        $bdd = new PDO('mysql:host=localhost;dbname=tetris;charset=utf8', 'root', 'root');
    }
    catch(Exception $e) 
    {
        die('Erreur : '.$e->getMessage());
    }

    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true)
    {
        $getOwnPb = $bdd -> query('SELECT score, difficulte FROM score WHERE joueur_id IN (SELECT joueur_id FROM utilisateur WHERE pseudo = \'' . $_SESSION["username"] . '\') ORDER BY score DESC LIMIT 10');
        $ownPb = $getOwnPb -> fetchAll();
        $getOwnPb -> closeCursor();
    }

    $getAllPB = $bdd -> query('SELECT pseudo, score, difficulte FROM utilisateur LEFT JOIN score ON score.id = best_score_id WHERE score IS NOT NULL ORDER BY score DESC LIMIT 5');
    $allPb = $getAllPB -> fetchAll();
    $getAllPB -> closeCursor();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/scores.css" />
        <title>TETRILAND BY FC CHOMAGE</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
    </head>
    <body>
        <?php include("../include/header.php"); ?>
        <div id="misc_div">
            <button id="accueil">Retour à l'accueil</button>
        </div>

        <!-- 
            Div gère la partie inscription/connexion
            Boutons à faire apparaitre/disparaitre en fonction de si l'user est connecté
            Affichage en haut à droite
        -->
        <div id="login_div">
            <?php
                if(!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false)
                {
                    echo '<button id="sign_up">Inscription</button><br/><button id="login">Connexion</button><br/>';
                }
                else if($_SESSION['isLoggedIn'] == true)
                {
                    echo '<span id="un">' . $_SESSION['username']  . '</span><br/>';
                    echo '<button id="logout">Déconnexion</button>';
                }
            ?>            
        </div>

        <br/><br/><br/><br/>

        <div id="subtitle">
            <h3>Menu des scores</h3>
            <span class="caption">Meilleurs scores personels :</span>

            <?php 
                if (isset($ownPb) && sizeof($ownPb) > 0)
                {
            ?>
            <table id="ownPb">
                <!-- Titre des colonnes du tableaux -->
                <div>
                    <thead>
                        <tr>
                            <th>Score</th>
                            <th>Difficulté</th>
                        </tr>
                    </thead>

                    <!-- Contenu du tableau -->
                    <tbody>
                        <?php 
                            for ($i = 0; $i < sizeof($ownPb); $i++)
                            {
                                echo '<tr><td>' . $ownPb[$i]["score"] . '</td><td>' . $ownPb[$i]["difficulte"] . '</td></tr>';
                            }
                        ?>
                    </tbody>
                </div>
            </table>
                    
            <?php
                }
                else if (isset($ownPb))
                {
                    echo "<span class='error'>Vous n'avez aucun score enregistré !</span>";
                }
                else
                {
                    echo "<span class='error'>Veuillez vous connecter pour voir votre tableau des scores !</span>";
                }
            ?>
            <br/>
            <span class="caption">Meilleurs scores de tous les joueurs :</span>
            <table id="allPb">
                <!-- Titre des colonnes du tableaux -->
                <div>
                    <thead>
                        <tr>
                            <th>Pseudo</th>
                            <th>Meilleur score</th>
                            <th>Difficulté</th>
                        </tr>
                    </thead>

                    <!-- Contenu du tableau -->
                    <tbody>
                        <?php 
                            for ($i = 0; $i < sizeof($allPb); $i++)
                            {
                                // print_r($allPb[$i]["BEST_SCORE"]);
                                // echo "<br/>";

                                echo '<tr><td>' . $allPb[$i]["pseudo"] . '</td><td>' . $allPb[$i]["score"] . '</td><td>' . $allPb[$i]["difficulte"] . '</td></tr>';
                            }
                        ?>
                    </tbody>
                </div>
            </table>
        </div>
    </body>
    <footer>
        <script type="text/javascript">
            // Redirige vers la page d'accueil au click du bouton "Retour"
            $("#accueil").click(function()
            {
                document.location.href="accueil.php"; 
            });

            // Redirige vers la page d'inscription au click du bouton "Inscription"
            $("#sign_up").click(function()
            {
                document.location.href="../inscription/Inscription.php"; 
            });

            // Redirige vers la page de connexion au click du bouton "Connexion"
            $("#login").click(function()
            {
                document.location.href="../inscription/Login.php"; 
            });

            // Redirige vers la page de deconnexion au click du bouton "Deconnexion"
            $("#logout").click(function()
            {
                document.location.href="../inscription/Logout.php"; 
            });
        </script>
    </footer>
</html>