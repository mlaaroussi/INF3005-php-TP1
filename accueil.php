<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
if(isset($_GET['msg'])){
    $msg =$_GET['msg'];
    if($msg=="cmptok"){
        $affichage="Compte modifié avec succès";
    }
    if($msg=="cmptnok"){
        $affichage="Porbleme de modification Compte!";
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

        <div class="auth">
   
            <div id="legend">
                Menu principal 
                <br/>
                <span id="success"><?php echo $affichage ?></span>
            </div>
            <ul>
                <li id="nvCmd"><a href="commande.php">Nouvelle commande</a></li>                
                <li id="mdfCmd"><a href="modifierCmd.php">Modifier commande</a></li>
                <li id="mdfCmpt"><a href="modifierCmpt.php">Modifier compte</a></li> 
                <li id="quitter"><a href="quitter.php">Quitter</a></li>
            </ul>
        </div>

    </body>
</html>

