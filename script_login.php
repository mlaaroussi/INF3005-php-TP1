<?php

$host = "localhost";
$username = "root";
$password = "mohamed";
$db_name = "CADRES";
$tbl_name = "User";

// Connection au serveur Mysql et choix de la base.
mysql_connect("$host", "$username", "$password")or die("Porblème de connexion");
mysql_select_db("$db_name") or die("Porblème de choix de la base");

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
    header('location:index.php');
} else {
    header('location:erreur_login.html');
}