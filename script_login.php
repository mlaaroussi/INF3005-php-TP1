<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=CADRES', 'root', 'root');
	$bdd->exec("SET CHARACTER SET utf8");

}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}



if(isset($_POST['login']) && isset($_POST['pass'])){

		$reponse = $bdd->query('SELECT * FROM User');

		if($donnes = $reponse->fetch()){
			

			if($donnes['usager'] == $_POST['login'] && $donnes['pass']==$_POST['pass']){
				/*session_start();
				$_SESSION['login']= $_POST['login'];*/
				header('location:index.php');
			} else {
				header('location:login.html');

			}
		}


}

?>