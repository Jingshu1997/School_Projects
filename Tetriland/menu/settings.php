<?php
    session_start();

    if (isset($_POST["diff_ddl"]))
    {
        $diff = $_POST['diff_ddl'];
        if (isset($_POST['events']))
        {
            $events = "on";
        }
        else
        {
            $events = "off";
        }
        

        $_SESSION["diff"] = $diff;
        $_SESSION["events"] = $events;
        $varUpdated = true;
    }
    else
    {
        if (!isset($_SESSION["diff"]))
        {
            $_SESSION["diff"] = "easy";
        }
        
        if (!isset($_SESSION["events"]))
        {
            $_SESSION["events"] = "on";
        }
        $varUpdated = false;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/settings.css" />
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
                <h3>Menu des options</h3>
        </div>

        <div id="options">
            <form method="post" action="settings.php">
                <label for="diff_ddl">Difficulté : </label>
                <select id="diff_ddl" name="diff_ddl">
                    <option id="easy" value="easy" <?php
                            if (isset($_SESSION['diff']) && $_SESSION['diff'] == "easy")
                            {
                                echo "selected";
                            }
                        ?> >Facile</option>
                    <option id="medium" value="medium" <?php
                            if (isset($_SESSION['diff']) && $_SESSION['diff'] == "medium")
                            {
                                echo "selected";
                            }
                        ?> >Moyen</option>
                    <option id="hard" value="hard" <?php
                            if (isset($_SESSION['diff']) && $_SESSION['diff'] == "hard")  
                            {
                                echo "selected";
                            }
                        ?> >Difficile</option>
                </select>
                <label for="events">Présence d'évènements : </label>
                <input type="checkbox" id="events" name="events" <?php
                            if (isset($_SESSION['events']) && $_SESSION['events'] == "on")  
                            {
                                echo "checked";
                            }
                        ?> ><br/><br/>
                <input type="submit" id="update_settings" value="Mettre à jour les options">
            </form>
        </div>

        <?php if ($varUpdated == true)
        {
            echo "<h3 style='color: red'>Options mises à jour !</h3>";
        }
        ?>
        
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