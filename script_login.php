<?php

include('connexion.php');
// username and password sent from form 
$login = $_POST['login'];
$pass = $_POST['pass'];

//Pour eviter les injections sql
$login = stripslashes($login);
$pass = stripslashes($pass);
$login = mysql_real_escape_string($login);
$pass = mysql_real_escape_string($pass);
$sql = "SELECT * FROM $tbl_user WHERE usager='$login' and pass='$pass'";
$rslt = mysql_query($sql);
$data = mysql_fetch_assoc($rslt);
// Compter les lignes de la table
$count = mysql_num_rows($rslt);

if ($count == 1) {
    session_start();
    $_SESSION['user'] = $data['id'];
    header('location:accueil.php');
} else {
    header('location:erreur_login.html');
}
mysql_close();
