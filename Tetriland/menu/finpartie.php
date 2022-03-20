<?php
    session_start();

    if(isset($_SESSION['score']))
    {
        $score = $_SESSION['score'];
    }
    unset($_SESSION['score']);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/finpartie.css" />
        <title>TETRILAND BY FC CHOMAGE</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
    </head>
    <body>

        <?php include("../include/header.php"); ?>

        <div id="subtitle">
            <h3>VOUS AVEZ PERDU LA PARTIE !</h3>
            <h4>Votre score : <span class='score'><?php echo $score; ?></span></h4>
            <div id='boutondeco'>
                <button id="retour">Retour au menu</button>
            </div>
        </div>

    </body>
    <footer>
    	<script type="text/javascript">

            //Redirige vers le menu au click du bouton "Retour"
            $("#retour").click(function()
            {
                document.location.href="accueil.php"; 
            });

        </script>
    </footer>
</html>