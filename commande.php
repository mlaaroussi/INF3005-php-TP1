<?php
session_start();
if (!isset($_SESSION['user'])) {
     header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>INF3005-TP1</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>       
        <script type="text/javascript" src="js/script.js"></script>
    </head>

    <body>

        <header>
            <h1>Composition et achat de cadres pour les photos en ligne</h1>
            <ul>
                <li><a href="accueil.php">Menu principal</a></li>
                <li><a href="modifierCmpt.php">Modifier compte</a></li>
                <li><a href="modifierCmd.php">Modifier commande</a></li>
                <li><a href="quitter.php">Quitter</a></li>
            </ul>
        </header>

        <section>            
            <form id="formPrincipal" action="produire_facture.php" method="post" enctype="multipart/form-data" >               
                <div id="corps">                   
                    <div id="choixCriteres">
                        <h2>1.Choisissez un fichier contenant votre photo:</h2>

                        <input type="file" name="fichierImg" id="fichierImg" accept="image/*" required />                                 
                        <h2>2.Adapter votre choix :</h2>                                           
                        <h3>Dimensions :</h3>
                        <label class="normal" for="rangeH" >Hauteur: <span class="normal">(max. 100cm)</span> </label> 
                        <input type="range" id="rangeH" value="50">
                        <input type="text" name="hauteur" id="ht" value="50" readonly>
                        <br/>
                        <label class="normal" for="rangeL" >Largeur: <span class="normal">(max. 100cm)</span> </label> 
                        <input type="range" id="rangeL" value="50">
                        <input type="text" name="largeur" id="lr" value="50" readonly>
                        <br/>
                        <label class="normal" for="rangeP" >Profondeur: <span class="normal">(max. 5cm)</span> </label>
                        <input type="range" id="rangeP" value="40">
                        <input type="text" name="profondeur" id="pf" value="2" readonly> 
                        <br/>
                        <label class="normal" for="rangeLc" >Largeur cadre: <span class="normal">(max. 10cm)</span> </label>
                        <input type="range" id="rangeLc" value="40">
                        <input type="text" name="lCadre" id="lCadre" value="5" readonly>
                        <br/>
                        <label class="normal" for="rangeMr" >Marge: <span class="normal">(max. 10cm)</span> </label>
                        <input type="range" id="rangeMr" value="40">
                        <input type="text" name="marge" id="marge" value="5" readonly>                       

                        <h3>Couleurs des cotés du cadre:</h3>
                        <label class="couleurs" for="coulHaut" >Haut: </label>
                        <input type="color" name="coulHaut" id="coulHaut" value="#ED1A59"/>
                        <label class="couleurs" for="coulBas" >Bas: </label>
                        <input type="color" name="coulBas" id="coulBas" value="#ED1A59"/>
                        <label class="couleurs" for="coulGauche" >Gauche: </label>
                        <input type="color" name="coulGauche" id="coulGauche" value="#ED1A59"/>
                        <label class="couleurs" for="coulDroite" >Droit: </label>
                        <input type="color" name="coulDroite" id="coulDroite" value="#ED1A59"/>
                        <h3>Matériel du cadre:</h3>

                        <input type="radio" name="type" value="Bois" checked/>Bois <img src="img/bois.jpg" width="48" height="48">
                        <input type="radio" name="type" value="Acier"/>Acier <img src="img/acier.jpg" width="48" height="48">                    
                        <input type="radio" name="type" value="Plastique"/>Plastique <img src="img/plastique.jpg" width="48" height="48">                    
                        <input type="hidden" name="imgData" id="imgData"/>
                        <input type="hidden" name="lschema" id="lschema"/>
                        <br/>
                        <input type="submit" value="Produire facture"/>
                        <div id="message"></div>
                    </div>

                    <div id="affichageRslt">
                        <h2> Résultat de l'ecadrement <img id="chargement" src="img/chargement.gif" width="22" height="22" ></h2>                                    

                        <canvas id="canvasRslt"  >
                            Votre navigateur ne supporte pas Canvas 
                        </canvas>
                    </div>
                </div>
            </form>           
        </section>

        <footer>
            <p> TP1 INF3005 </p>
        </footer>

    </body>
</html>