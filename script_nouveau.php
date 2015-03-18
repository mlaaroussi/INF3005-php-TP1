<?php

include('connexion.php');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$usager = $_POST['usager'];
$pass = $_POST['pass'];
$tel = $_POST['tel'];
$courriel = $_POST['courriel'];
$adresse = $_POST['adresse'];

//pour protèger la reuquete SQL des caractères spéciaux
$nom = mysql_real_escape_string($nom);
$prenom = mysql_real_escape_string($prenom);
$usager = mysql_real_escape_string($usager);
$pass = mysql_real_escape_string($pass);
$tel = mysql_real_escape_string($tel);
$courriel = mysql_real_escape_string($courriel);
$adresse = mysql_real_escape_string($adresse);

//on vérifie si un utilisateur existe avec le même nom d'usager
$selectSql = "SELECT * FROM $tbl_user WHERE usager='$usager'";
$rsltSelect = mysql_query($selectSql);
$count = mysql_num_rows($rsltSelect);

if ($count == 0) {
// On met à jour les modifications
    $sql = "INSERT INTO $tbl_user(nom,prenom,usager,pass,tel,courriel,adresse) VALUES ('$nom', '$prenom','$usager' ,'$pass' , '$tel', '$courriel', '$adresse')";
    $result = mysql_query($sql);

    if ($result) {
        header('location:index.php?msg=ajoutok');
    } else {
        header('location:erreur_tech.html');
    }
} else {
    header('location:nouveau.php?msg=existedeja');
}

mysql_close();
