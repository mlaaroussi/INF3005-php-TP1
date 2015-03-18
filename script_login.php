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
$sql = "SELECT * FROM $tbl_name WHERE usager='$login' and pass='$pass'";
$result = mysql_query($sql);

// Compter les lignes de la table
$count = mysql_num_rows($result);

if ($count == 1) {
// Register $login, $pass and redirect to file "login_success.php"
    session_start();
    $_SESSION['user'] = $login;
    header('location:accueil.php');
} else {
    header('location:erreur_login.html');
}
mysql_close();
