<?php
//Vérification de session
session_start();
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
//génerer unidentifiant unique
$nomUnique = uniqid();
$dossierSauvegarde = "../../upload/";
//telechargement de l'image.
if (isset($_FILES["fichierImg"]["type"])) {
    $extensionsValides = array("jpeg", "jpg", "png", "gif");
    $temporary = explode(".", $_FILES["fichierImg"]["name"]);
    $extension = $temporary[1];
    $nomSansExtension = $temporary[0];
    if ((($_FILES["fichierImg"]["type"] == "image/png") || ($_FILES["fichierImg"]["type"] == "image/jpg") || ($_FILES["fichierImg"]["type"] == "image/jpeg") || ($_FILES["fichierImg"]["type"] == "image/gif") ) && ($_FILES["fichierImg"]["size"] < 10000000)// fichiers inférieurs a 10Mo peuvent être téléchargés.
            && in_array($extension, $extensionsValides)) {
        if ($_FILES["fichierImg"]["error"] > 0) {
            echo "Code d'erreur: " . $_FILES["fichierImg"]["error"] . "<br/><br/>";
        } else {
            $source = $_FILES['fichierImg']['tmp_name']; // variable pour stocker le chemin du fichier source
            $imgNom = "img_" . $nomUnique . "." . $extension;
            $destination = $dossierSauvegarde . $imgNom;

            move_uploaded_file($source, $destination); //déplacer le fichier vers $destination
            // echo "<span id='success'>Image téléchargée avec succès, (Nom du fichier : " . $_FILES["fichierImg"]["name"] . ")</span>";
        }
    } else {
        echo "<span id='erreur'> Taille ou type de fichier non valide, seulement les images de taille inférieur à 10Mo sont acceptées <span>";
    }
}
//convertir les donneés du canvas noir et blanc en png
$canvasData = $_POST['imgData'];
$canvasData = substr($canvasData, strpos($canvasData, ",") + 1);
$decodedData = base64_decode($canvasData);
$canvasNom = "cnv_" . $nomUnique . ".png";
$fp = fopen($dossierSauvegarde . $canvasNom, 'wb');
fwrite($fp, $decodedData);
fclose($fp);

//Produire le message de la facture et envoi d'email  
//date de livraison = date d'aujourd'hui plus 3 jours
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
$dateFacture = ucwords((strftime("%A %e %B à %H h %M")));
$dateLivraison = mktime(10, 0, 0, date("m"), date("d") + 3, date("Y"));
$strDateLivraison = ucwords((strftime("%A %e %B à %H h %M", $dateLivraison)));
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>INF3005-TP1</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>       
    </head>
    <body>
        <div id="header">
            <div id="titre"> Composition et achat de cadres pour les photos en ligne</div>
            <ul>
                <li><a href="accueil.php">Menu principal</a></li>
                <li ><a href="quitter.php">Quitter </a> [ <?php echo $_SESSION['login'] ?> ]</li>
            </ul> 
        </div> 
        <section>           
            <?php
            $msgEmailEnvoye = '';
            $cheminMoka = "http://moka.labunix.uqam.ca/~ch791163/upload/" . $canvasNom;

            //message de l'email
            $messageFacture = '        
            <h2> Facture %msgEmailEnvoye%</h2>
            <h3>Date de Facture: <span style="color: #464646;">' . $dateFacture . ' </span> </h3>
            <h3>Date de livraison: <span style="color: #464646;">' . $strDateLivraison . ' </span> </h3>
            <div id="facture">    
                <div id="criteres">                
                    <h3>Dimensions :</h3>
                    <ul>
                        <li>Hauteur:' . $_POST["hauteur"] . ' </li>
                        <li>Largeur: ' . $_POST["largeur"] . 'cm </li>
                        <li>Profondeur: ' . $_POST["profondeur"] . 'cm</li>
                        <li>Largeur cadre: ' . $_POST["lCadre"] . 'cm </li>
                        <li>Marge: ' . $_POST["marge"] . 'cm</li>         
                    </ul>
                    <h3>Couleurs des cotés du cadre:</h3>
                     <ul>
                        <li>Haut:<span style = "font-weight: bolder;color:' . $_POST["coulHaut"] . '">' . $_POST["coulHaut"] . '</span> </li>
                        <li>Bas:<span style = "font-weight: bolder;color:' . $_POST["coulBas"] . '"> ' . $_POST["coulBas"] . '</span></li>
                        <li>Gauche:<span style = "font-weight: bolder;color:' . $_POST["coulGauche"] . '">' . $_POST["coulGauche"] . '</span></li>
                        <li>Droite:<span style = "font-weight: bolder;color:' . $_POST["coulDroite"] . '">' . $_POST["coulDroite"] . '</span></li>         
                    </ul>                    
                    <h3>Matériel du cadre:</h3>
                    <ul>
                        <li>' . $_POST["type"] . '</li>
                    </ul>                    
                </div>  
                <div id="apercue">
                    <h3>Schéma en noir et blanc de l\'encadrement</h3>
                    <div id="schema" style=\'' . $_POST["lschema"] . '\'>                    
                        <img src= "%srcImg%" >    
                    </div>
                </div>                
            </div>';
            $message = str_replace('%msgEmailEnvoye%', '', $messageFacture);
            $message = str_replace('%srcImg%', $cheminMoka, $message);
            $msgFacure = "<html><body>" . $message . "</body></html>";
//Les entetes du courriel
            $headers = "From: TP1-INF3005\r\n";
            $headers .= "Content-type: text/html";

//On envoit la facture sous forme html
            if (mail($_SESSION['email'], 'Facture', $msgFacure, $headers)) {
                $messageFacture = str_replace('%msgEmailEnvoye%', "<span id='#success'> (Envoyée avec succès à votre courriel " . $_SESSION['email'] . ")</span>", $messageFacture);
                $messageFacture = str_replace('%srcImg%', $_POST['imgData'], $messageFacture);
            } else {
                $messageFacture = str_replace('%msgEmailEnvoye%', "<span id='#erreur'> (Problème d'envoi par email) </span>", $messageFacture);
                $messageFacture = str_replace('%srcImg%', $_POST['imgData'], $messageFacture);
            }
//On affiche la facture
            echo $messageFacture;
//enregistrer la commade dans la base
            include('connexion.php');
            $sql = "insert into $tbl_commande (id_user,hauteur,profondeur,largeur,lrg_cadre,lrg_marge,couleur_haut,couleur_bas,couleur_gauche,couleur_droite,materiel,img_fichier,date_commande,date_livraison)";
            $sql.=" values (" . $_SESSION['user'] . "," . $_POST["hauteur"] . "," . $_POST["largeur"] . "," . $_POST["profondeur"] . "," . $_POST["lCadre"] . "," . $_POST["marge"] . ",'" . $_POST["coulHaut"] . "','" . $_POST["coulBas"] . "','" . $_POST["coulGauche"] . "','" . $_POST["coulDroite"] . "','" . $_POST["type"] . "','" . $imgNom . "',now(),'" . date("Y-m-d H:i:s", $dateLivraison) . "')";

            mysql_query($sql);
            mysql_close();
            ?>
        </section>
    </body>
</html>



