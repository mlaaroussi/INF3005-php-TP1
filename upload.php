<?php

if (isset($_FILES["file"]["type"])) {
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
            ) && ($_FILES["file"]["size"] < 10000000)// fichiers inférieurs a 10Mo peuvent être téléchargés.
            && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Code d'erreur: " . $_FILES["file"]["error"] . "<br/><br/>";
        } else {
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " <span id='erreur'><b>Fichier existe déjà.</b></span> ";
            } else {
                $sourcePath = $_FILES['file']['tmp_name']; // variable pour stocker le chemin du fichier source
                $targetPath = "upload/" . $_FILES['file']['name']; // variable pour stocker le chemin ou le fichier est stocké
                move_uploaded_file($sourcePath, $targetPath); //déplacer le fichier vers $targetPath
                echo "<span id='success'>Image téléchargée avec succès, (Nom du fichier : " . $_FILES["file"]["name"] . ")</span>";
              
            }
        }
    } else {
        echo "<span id='erreur'> Taille ou type de fichier non valide, seulement les images de taille inférieur à 10Mo sont acceptées <span>";
    }
}