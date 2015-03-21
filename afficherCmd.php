<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}

include('connexion.php');
$idUser = $_SESSION['user'];

$sql = "SELECT * FROM $tbl_commande WHERE id_user = $idUser";
$rslt = mysql_query($sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">					
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Modifier commande</title>         
    </head>

    <body>
        <div>
            <div id="header">
                <div id="titre"> Composition et achat de cadres pour les photos en ligne</div>
                <ul>
                    <li><a href="accueil.php">Menu principal</a></li>
                    <li ><a href="quitter.php">Quitter </a> [ <?php echo $_SESSION['login'] ?> ]</li>
                </ul> 
            </div>          
            <table>
                <caption> <h2>Liste des commades effectuées:</h2></caption> 
                <tr>                        
                    <th colspan="5">Dimensions du cadre (en cm)</th>
                    <th colspan="4">Couleurs des côtés du cadre</th>
                    <th rowspan="2">Matériel du cadre</th>  
                    <th rowspan="2">Image Fournie</th>
                    <th colspan="2">Dates</th>                     
                </tr>
                <tr>
                    <th>Largeur</th>
                    <th>Hauteur</th>
                    <th>Profondeur</th> 
                    <th>Largeur du cadre</th>
                    <th>Largeur du marge</th>
                    <th>Couleur du haut</th>
                    <th>Couleur du bas</th>
                    <th>Couleur du gauche</th>
                    <th>Couleur du droite</th>                                              
                    <th>Date de la commande</th>
                    <th>Date de livraison</th>
                </tr>
                <?php
                while ($data = mysql_fetch_assoc($rslt)) {
                    echo "<tr>";
                    echo "<td>" . $data['hauteur'] . "</td>";
                    echo "<td>" . $data['largeur'] . "</td>";
                    echo "<td>" . $data['profondeur'] . "</td>";
                    echo "<td>" . $data['lrg_cadre'] . "</td>";
                    echo "<td>" . $data['lrg_marge'] . "</td>";
                    echo "<td> <span style = 'color:" . $data['couleur_haut'] . "'> " . $data['couleur_haut'] . "</span></td>";
                    echo "<td> <span style = 'color:" . $data['couleur_bas'] . "'> " . $data['couleur_bas'] . "</span></td>";
                    echo "<td> <span style = 'color:" . $data['couleur_gauche'] . "'> " . $data['couleur_gauche'] . "</span></td>";
                    echo "<td> <span style = 'color:" . $data['couleur_droite'] . "'> " . $data['couleur_droite'] . "</span></td>";
                    echo "<td>" . $data['materiel'] . "</td>";
                    echo "<td> <img src='upload/" . $data['img_fichier'] . "' width='64' height='64'/> </td>";
                    echo "<td width='15%'>" . date('d/m/Y à H\hi', strtotime($data['date_commande'])) . " </td>";
                    echo "<td width='15%'>" . date('d/m/Y à H\hi', strtotime($data['date_livraison'])) . " </td>";
                    echo "</tr>";
                }
                mysql_close();
                ?>                      
            </table>
        </div>		
    </body>
</body>
</html>