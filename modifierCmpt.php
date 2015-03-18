<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.html");
}

include('connexion.php');
// username and password sent from form 
$login = $_SESSION['user'];

//Pour eviter les injections sql
$login = stripslashes($login);
$pass = stripslashes($pass);
$login = mysql_real_escape_string($login);
$pass = mysql_real_escape_string($pass);
$sql = "SELECT * FROM $tbl_name WHERE usager='$login'";
$rslt = mysql_query($sql);

while($data = mysql_fetch_assoc($rslt)) { 
    $nom=$data['nom'];
    $prenom=$data['prenom'];
    $pass=$data['pass'];
    $tel=$data['tel'];
    $courriel=$data['courriel'];
    $adresse=$data['adresse'];                          
} 

mysql_close(); 


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">					
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Connexion</title>
    </head>

    <body>
<div id="nvCompte">
            <form id="creerForm" action="script_nouveau.php" method="post" onSubmit="return validation(this)">
                <h2> Modifier compte </h2>
                <label class="normal" for="nom">Nom:</label><br />
                <input name="nom" type="text" required value="<?php echo $nom ?>" /><br />

                <label class="normal" for="prenom">Prénom :</label><br />
                <input name="prenom" type="text" required value="<?php echo $prenom ?>"/><br />

                <label class="normal" for="usager">Choisissez votre nom d'usager:</label><br />
                <input name="usager" type="text" required value="<?php echo $login ?>"/><br />

                <label class="normal" for="pass">Créez un mot de passe:</label><br />
                <input name="pass" type="password" required  value="<?php echo $password ?>"/><br />

                <label class="normal" for="confirmPass">Confirmez votre mot de passe:</label><br />
                <input name="confirmPass" type="password" required  value="<?php echo $password ?>"/><br />

                <label class="normal" for="tel">Téléphone:</label><br />
                <input name="tel" type="tel" required  value="<?php echo $tel ?>" /><br />

                <label class="normal" for="courriel">Courriel:</label><br />
                <input name="courriel" type="email" required  value="<?php echo $courriel ?>" /><br />  

                <label class="normal" for="adresse">Adresse:</label><br />
                <textarea name="adresse" required ><?php echo $adresse ?></textarea><br />                                    

                <input type="submit" value="Modifier"/>               
            </form>
        </div>		
    </body>

    </body>
</html>