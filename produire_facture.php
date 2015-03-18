<?php

//Vérification de session
session_start();
if (!isset($_SESSION['user'])) {
     header("location:index.php");
}
//telechargement de l'image.
$nomUnique = uniqid(); //génerer unidentifiant unique
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
            $destination = "upload/" . $imgNom;

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
$fp = fopen("upload/" . $canvasNom, 'wb');
fwrite($fp, $decodedData);
fclose($fp);
//$cheminCanv="http://moka.labunix.uqam.ca/~ch791163/PHP/Tp1_php/upload/".$canvasNom;
$cheminCanv = "upload/" . $canvasNom;

//Produire le message de la facture et envoi d'email  
//date de livraison = date d'aujourd'hui plus 3 jours
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
$dateLivraison = mktime(10, 0, 0, date("m"), date("d") + 3, date("Y"));
$strDateLivraison = ucwords((strftime("%A %e %B à %H h %M", $dateLivraison)));
//message de l'email
$message = '
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>INF3005-TP1</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>       
    </head>
    <body>
    <header>
            <h1>Composition et achat de cadres pour les photos en ligne</h1>
            <ul>
                <li><a href="accueil.php">Menu principal</a></li>
                <li><a href="">Modifier compte</a></li>
                <li><a href="modifierCmd.php">Modifier commande</a></li>
                <li><a href="quitter.php">Quitter</a></li>
            </ul>
        </header>
        <section>
            <h2> Facture </h2>
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
                    <div id="schema" style=\'width:' . $_POST["lschema"] . 'px;\'>                    
                        <img src= "' . $cheminCanv . '" >    
                    </div>
                </div>                
            </div>             
        </section>
    </body>
</html>';
//Les entetes du courriel
$headers = "From: TP1-INF3005\r\n";
$headers .= "Content-type: text/html";
//envoi du courriel en format html
if (mail('molaaroussi@gmail.com', 'Facture', $message, $headers)) {
//if (mail($_SESSION['email'], 'Facture', $message, $headers)) {
    echo str_replace("<h2> Facture </h2>", "<h2> Facture <span id='#success'> (Envoyée avec succès par email)</span> </h2>", $message);
} else {
    echo str_replace("<h2> Facture </h2>", "<h2> Facture <span id='#erreur'>  (Problème d'envoi par email) </span>  </h2>", $message);
}
//enregistrer la commade dans la base
include('connexion.php');
$sql = "insert into $tbl_commande (id_user,hauteur,profondeur,largeur,lrg_cadre,lrg_marge,couleur_haut,couleur_bas,couleur_gauche,couleur_droite,materiel,img_fichier,date_commande,date_livraison)";
$sql.=" values (" . $_SESSION['user'] . "," . $_POST["hauteur"] . "," . $_POST["largeur"] . "," . $_POST["profondeur"] . "," . $_POST["lCadre"] . "," . $_POST["marge"] . ",'" . $_POST["coulHaut"] . "','" . $_POST["coulBas"] . "','" . $_POST["coulGauche"] . "','" . $_POST["coulDroite"] . "','" . $_POST["type"] . "','" . $imgNom . "',now(),'" . date("Y-m-d H:i:s", $dateLivraison) . "')";

mysql_query($sql);
mysql_close();


