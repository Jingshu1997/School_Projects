<?php
    session_start();

    if (!isset($_SESSION["diff"]))
    {
        $_SESSION["diff"] = "easy";
    }
    
    if (!isset($_SESSION["events"]))
    {
        $_SESSION["events"] = "on";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/accueil.css" />
        <title>TETRILAND BY FC CHOMAGE</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
    </head>
    <body>
        <?php include("../include/header.php"); ?>

        <!--
            Div gerant les boutons randoms, qui redirigent sur d'autres pages sans vérification supplémentaire
            Affichage en haut à gauche
        -->
        <div id="misc_div">
            <button id="scores">Scores</button>
            <button id="settings">Options   </button>
            <button id="rules">Règles</button>
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

        <!-- 
            Div gère le lancement du jeu
            Affichage au milieu
        -->
        <?php
            if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true)
            {

                echo "<div id='diff_div'><button id='play'>Jouer</button></div>";
            }
            else
            {
                echo "<div id='diff_div' style='width: 350px'><span class='error'>Veuillez vous connecter pour jouer à TetriLand !</span></div>";
            }
        ?>
    </body>
    <footer>
    	<script type="text/javascript">

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

            // Redirige vers la page des scores au click du bouton "Scores"
            $("#scores").click(function()
            {
                document.location.href="scores.php"; 
            });

            // Redirige vers la page des options au click du bouton "Options"
            $("#settings").click(function()
            {
                document.location.href="settings.php"; 
            });

            // Redirige vers la page des règles au click du bouton "Règles"
            $("#rules").click(function()
            {
                document.location.href="rules.php"; 
            });

            // Redirige vers la page du jeu au click du bouton "Jouer"
            $("#play").click(function()
            {
                document.location.href="../jeu/Jeu.php"; 
            });

        </script>
    </footer>
</html>