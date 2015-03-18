<?php

// Fichier qui permet la connexion à mysql
//parametres en local
$host = "localhost";
$username = "root";
$password = "mohamed";
$db_name = "CADRES";
$tbl_name = "User";

// Connection au serveur Mysql et choix de la base.
mysql_connect("$host", "$username", "$password")or die("Porblème de connexion");
mysql_select_db("$db_name") or die("Porblème base de données");

