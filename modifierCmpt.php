<?php
session_start();
if (!isset($_SESSION['user'])) {
     header("location:index.php");
}

include('connexion.php');
// username and password sent from form 
$idUser = $_SESSION['user'];

$sql = "SELECT * FROM $tbl_user WHERE id = $idUser";
$rslt = mysql_query($sql);

$data = mysql_fetch_assoc($rslt);

$nom = $data['nom'];
$prenom = $data['prenom'];
$usager = $data['usager'];
$pass = $data['pass'];
$tel = $data['tel'];
$courriel = $data['courriel'];
$adresse = $data['adresse'];

mysql_close();

$affichage='';
if(isset($_GET['msg'])){
    $msg =$_GET['msg'];
    if($msg=="existedeja"){
        $affichage="Le nom d'usager est deja choisi, Veuillez choisir un autre.";
    }     
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">					
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Modifier compte</title>
         <script language="JavaScript">
            function validation(f) {
                if (f.pass.value != f.confirmPass.value) {
                    alert('Les mots de passe ne sont pas identiques !');
                    f.pass.focus();
                    return false;
                }
                else if (f.pass.value == f.confirmPass.value) {
                    return true;
                }
                else {
                    f.pass.focus();
                    return false;
                }
            }
        </script>
    </head>

    <body>
        <div id="nvCompte">
            <form id="creerForm" action="script_modifierCmpt.php" method="post" onSubmit="return validation(this)">
                <h2> Modifier les informations personnelles </h2>
                <span id="erreur"><?php echo $affichage ?></span>
                <br/>
                <label class="normal" for="nom">Nom:</label><br />
                <input name="nom" type="text" required value="<?php echo $nom ?>" /><br />

                <label class="normal" for="prenom">Prénom :</label><br />
                <input name="prenom" type="text" required value="<?php echo $prenom ?>"/><br />

                <label class="normal" for="usager">Choisissez votre nom d'usager:</label><br />
                <input name="usager" type="text" required value="<?php echo $usager ?>"/><br />

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
                <span id="erreur"></span><br />
                <input type="submit" value="Modifier"/>               
            </form>
        </div>		
    </body>

</body>
</html>