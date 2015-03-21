<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
$affichage='';
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if ($msg == "cmptok") {
        $affichage = "Compte modifié avec succès";
    }
    if ($msg == "cmptnok") {
        $affichage = "Porbleme de modification Compte!";
    }
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
        <div class="menupr">
            <div id="legend">
                <h2>Menu principal</h2> 
                Bienvenu, Vous ête connecté en tant que: <span id="success"><?php echo $_SESSION['login'] ?></span>
                <br/>
                <span id="success"><?php echo $affichage ?></span>
            </div>
            <ul>
                <li id="nvCmd"><a href="commande.php"> Nouvelle commande</a></li>                
                <li id="mdfCmd"><a href="afficherCmd.php"> Afficher la liste des commandes</a></li>
                <li id="mdfCmpt"><a href="modifierCmpt.php"> Modifier les informations personnelles</a></li> 
                <li id="quitter"><a href="quitter.php"> Quitter </a></li>
            </ul>
        </div>
    </body>
</html>


