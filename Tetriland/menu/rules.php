<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/rules.css" />
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
            <h3>Règles du jeu</h3>    
        </div>
        <div id="pavecesar">
            Le but de TetriLand est d'obtenir le maximum de score possible.<br/><br/>

            Pour se faire, il faut utiliser les différentes touches pour déplacer les pièces qui sont : <br/>
            &emsp;&emsp;- La touche <span style="text-decoration: underline;">Flèche Numérique Droite</span> (<span style="color: red;">→</span>) pour déplacer la pièce a droite.<br/>
            &emsp;&emsp;- La touche <span style="text-decoration: underline;">Flèche Numérique Gauche</span> (<span style="color: red;">←</span>) pour déplacer la pièce a gauche.<br/>
            &emsp;&emsp;- La touche <span style="text-decoration: underline">Flèche Numérique Haut</span> (<span style="color: red;">↑</span>) faire une rotation de la pièce.<br/>
            &emsp;&emsp;- La touche <span style="text-decoration: underline">Flèche Numérique Bas</span> (<span style="color: red;">↓</span>) pour déplacer rapidement vers le bas.<br/>
            &emsp;&emsp;- La <span style="text-decoration: underline">Barre d'Espace</span> pour instantanément descendre la pièce.<br/>
            &emsp;&emsp;- La touche <span style="text-decoration: underline">Shift Gauche</span> pour enregistrer la pièce pour l'utiliser plus tard et de récuper la pièce enregistrer pour la jouer.<br/><br/>

            Le score est calculé de la façon suivante : <br/>
            &emsp;&emsp;- 1 ligne complétée vaut <span style="color: red;">10 points</span><br/>
            &emsp;&emsp;- 2 ligne complétée vaut <span style="color: orange;">20 points</span><br/>
            &emsp;&emsp;- 3 ligne complétée vaut <span style="color: yellow;">60 points</span><br/>
            &emsp;&emsp;- 4 ligne complétée vaut <span style="color: green;">240 points</span><br/>
            &emsp;&emsp;- Le tableau remis à vide vaut <span style="color: blue;">1200 points</span><br/>
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