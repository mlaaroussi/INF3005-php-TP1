<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=CADRES', 'root', 'root');
	$bdd->exec("SET CHARACTER SET utf8");
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$stmt = $bdd->prepare("INSERT INTO User (nom,prenom,usager,pass,tel,courriel,adresse) VALUES (:nom,:prenom,:usager,:pass,:tel,:courriel,:adresse)");
$stmt->bindParam(':nom', $_POST['nom']);
$stmt->bindParam(':prenom', $_POST['prenom']);
$stmt->bindParam(':usager', $_POST['usager']);
$stmt->bindParam(':pass', $_POST['pass']);
$stmt->bindParam(':tel', $_POST['tel']);
$stmt->bindParam(':courriel', $_POST['courriel']);
$stmt->bindParam(':adresse', $_POST['adresse']);
$stmt->execute();

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
                <?php echo($_POST['prenom']." ".$_POST['nom']); ?> à été ajouté(e) avec succès ! Veuillez vous identifier pour continuer : 
            </div>

            <form id="loginForm" method="post" action="script_login.php">
                <label class="normal" for="login">Login:</label>
                <input type="text" name="login">

                <label class="normal" for="pass">Mot de passe: </label>
                <input type="password" name="pass">

                <span id="connexion_msg"> </span>
                <br>
                <a href="nouveau.html"> Créer nouveau compte</a>

                <input type="submit" value="Se connecter">                                
                <?php ?>
            </form>
        </div>

    </body>
</html>

