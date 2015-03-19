<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}
include('connexion.php');

$idUser = $_SESSION['user'];
//
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
$selectSql = "SELECT * FROM $tbl_user WHERE usager ='$usager' and id != $idUser";
$rsltSelect = mysql_query($selectSql);
$count = mysql_num_rows($rsltSelect);

if ($count == 0) {
// On met à jour les modifications
    $sql = "update $tbl_user set nom = '$nom', prenom ='$prenom',usager ='$usager' ,pass ='$pass' ,tel ='$tel',courriel='$courriel',adresse='$adresse' WHERE id='$idUser'";
    $result = mysql_query($sql);

    if ($result) {
        header('location:accueil.php?msg=cmptok');
    } else {
        header('location:erreur_tech.html');
    }
} else {
    header('location:modifierCmpt.php?msg=existedeja');
}

mysql_close();