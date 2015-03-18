<?php

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
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        
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
            <form id="creerForm" action="script_nouveau.php" method="post" onSubmit="return validation(this)">
                <h2> Créer nouveau compte</h2>
                <span id="erreur"><?php echo $affichage ?></span>
                <br/>
                <label class="normal" for="nom">Nom:</label><br />
                <input name="nom" type="text" required placeholder = "Nom" /><br />

                <label class="normal" for="prenom">Prénom :</label><br />
                <input name="prenom" type="text" required placeholder = "Prénom"/><br />

                <label class="normal" for="usager">Choisissez votre nom d'usager:</label><br />
                <input name="usager" type="text" required placeholder = "Nom d'utilisateur"/><br />

                <label class="normal" for="pass">Créez un mot de passe:</label><br />
                <input name="pass" type="password" required placeholder = "Mot de passe"/><br />

                <label class="normal" for="confirmPass">Confirmez votre mot de passe:</label><br />
                <input name="confirmPass" type="password" required placeholder = "Confirmez votre Mot de Passe"/><br />

                <label class="normal" for="tel">Téléphone:</label><br />
                <input name="tel" type="tel" required placeholder = "Téléphone" /><br />

                <label class="normal" for="courriel">Courriel:</label><br />
                <input name="courriel" type="email" required placeholder = "Adresse Courriel" /><br />  

                <label class="normal" for="adresse">Adresse:</label><br />
                <textarea name="adresse" required placeholder = "Adresse"></textarea><br />                                    

                <input type="submit" value="Créer"/>
                <input type="reset" value="Vider"/>
            </form>
        </div>		
    </body>
</html>
