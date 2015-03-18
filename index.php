<?php

if(isset($_GET['msg'])){
    $msg =$_GET['msg'];
    if($msg=="ajoutok"){
        $affichage="<span id='success'> Compte ajouté avec succès ! Veuillez vous identifier pour continuer </span>";
    }     
} else {
    $affichage="Authentification";
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
              <?php echo  $affichage ?>
            </div>
            
            <form id="loginForm" method="post" action="script_login.php">
                <label class="normal" for="login">Login:</label>
                <input type="text" name="login" required placeholder = "Login">

                <label class="normal" for="pass">Mot de passe: </label>
                <input type="password" name="pass" required placeholder = "Mot de passe">

                <span id="connexion_msg"> </span>
                <br>
                <a href="nouveau.php"> Créer nouveau compte</a>

                <input type="submit" value="Se connecter">                                
                
            </form>
        </div>

    </body>
</html>

