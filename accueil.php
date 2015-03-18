<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.html");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">					
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Connexion</title>
    </head>

    <body>

        <div class="auth">
   
            <div id="legend">
                Menu principal
            </div>
            <ul>
                <li id="nvCmd"><a href="commande.php">Nouvelle commande</a></li>                
                <li id="mdfCmd"><a href="">Modifier commande</a></li>
                <li id="mdfCmpt"><a href="modifierCmpt.php">Modifier compte</a></li>
                <li id="quitter"><a href="quitter.php">Quitter</a></li>
            </ul>
        </div>

    </body>
</html>


