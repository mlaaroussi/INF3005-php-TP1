<?php

//Vérification de session
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.html");
}
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
            if (file_exists("upload/" . $_FILES["fichierImg"]["name"])) {
                $destination = "upload/" . $nomSansExtension . "-1." . $extension;
                //echo "upload/" . $nomSansExtension . "-1." . $extension . "<br>";
            } else {
                $destination = "upload/" . $_FILES['fichierImg']['name'];
            }
            move_uploaded_file($source, $destination); //déplacer le fichier vers $destination
            // echo "<span id='success'>Image téléchargée avec succès, (Nom du fichier : " . $_FILES["fichierImg"]["name"] . ")</span>";
        }
    } else {
        echo "<span id='erreur'> Taille ou type de fichier non valide, seulement les images de taille inférieur à 10Mo sont acceptées <span>";
    }
}
//Produire la facture  
//date de livraison = date d'aujourd'hui plus 3 jours
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
$dateLivraison= ucwords((strftime("%A %e %B à %H h %M", mktime(10, 0, 0, date("m"), date("d") + 3, date("Y")))));
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
        <section>
            <h2> Facture </h2>
            <h3>Date de livraison: <span style="color: #464646;">'.$dateLivraison.' </span> </h3>
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
                        <img src= "' . $_POST["imgData"] . '" >    
                    </div>
                </div>                
            </div> 
            
        </section>
    </body>
</html>';

//$headers = "From: $from_email";
$headers = "Content-type: text/html";
if (mail('molaaroussi@gmail.com', 'Facture', $message, $headers)) {
//if (mail($_SESSION['email'], 'Facture', $message, $headers)) {
    echo str_replace("<h2> Facture </h2>", "<h2> Facture <span id='#success'> (Envoyée avec succès par email)</span> </h2>", $message);
} else {
    echo str_replace("<h2> Facture </h2>", "<h2> Facture <span id='#erreur'>  (Problème d'envoi par email) </span>  </h2>", $message);
}


