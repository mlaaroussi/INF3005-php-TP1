<?php
session_start();
 if (!isset($_SESSION['user'])) {
 header("location:login.html");
 }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>INF3005-TP1</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>       
    </head>
    <body>       
        <?php
        if (isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
            $imageData = $GLOBALS['HTTP_RAW_POST_DATA'];
            echo "imagedata1: " . $imageData;
            $filteredData = substr($imageData, strpos($imageData, ",") + 1);
            $unencodedData = base64_decode($filteredData);
            $fp = fopen('upload/canvas.png', 'wb');
            fwrite($fp, $unencodedData);
            fclose($fp);
        }
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
        ?>
        <section>
            <h2> Facture </h2>

            <div id="facture">    
                <div id="choixCriteres">
                    <h3>Dimensions :</h3>
                    <ul>
                        <li>Hauteur:<?php echo $_POST["hauteur"] . "cm" ?> </li>
                        <li>Largeur: <?php echo $_POST["largeur"] . "cm" ?>  </li>
                        <li>Profondeur: <?php echo $_POST["profondeur"] . "cm" ?> </li>
                        <li>Largeur cadre: <?php echo $_POST["lCadre"] . "cm" ?> </li>
                        <li>Marge: <?php echo $_POST["marge"] . "cm" ?> </li>         
                    </ul>

                    <h3>Couleurs des cotés du cadre:</h3>
                    <ul>
                        <li>Haut:<?php echo $_POST["coulHaut"] ?> </li>
                        <li>Bas: <?php echo $_POST["coulBas"] ?></li>
                        <li>Gauche: <?php echo $_POST["coulGauche"] ?></li>
                        <li>Droite: <?php echo $_POST["coulDroite"] ?></li>         
                    </ul>

                    <h3>Matériel du cadre:</h3>
                    <ul>
                        <li><?php echo $_POST["type"] ?></li>
                    </ul>

                </div>  

                <div id="apercue">
                    <?php
                    $imageData = $_POST["imgData"];
                    ?>
                    <h3>Schéma en noir et blanc de l'encadrement</h3>

                    <img id="aperc" src= <?php echo $imageData ?> >                                           
                </div>                
                            
            </div> 
             <a href="mailto:votre_email?subject= sujet_du_message&body= corps_du_message">Envoyer par email</a> 
        </section>

    </body>
</html>
