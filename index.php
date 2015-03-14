
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
        </header>

        <section>
            <h2>1.Modèles de cadres: </h2>
            <figure>
                <a href=""> <img id="cadre1" src="img/cadre1.jpg" alt="cadre 1" width="80" height="80" > </a> 
                <a href=""> <img id="cadre2" src="img/cadre2.jpg"alt="cadre 2" width="80" height="80"> </a>
                <a href=""> <img id="cadre3" src="img/cadre3.jpg"alt="cadre 3" width="80" height="80"> </a>  
                <a href=""> <img id="cadre4" src="img/cadre4.jpg" alt="cadre 4" width="80" height="80" > </a> 
                <a href=""> <img id="cadre5" src="img/cadre5.jpg"alt="cadre 5" width="80" height="80"> </a> 
                <a href=""> <img id="cadre6" src="img/cadre6.jpg"alt="cadre 6" width="80" height="80"> </a>
                <a href=""> <img id="cadre7" src="img/cadre7.jpg" alt="cadre 7" width="80" height="80" > </a> 
                <a href=""> <img id="cadre8" src="img/cadre8.jpg"alt="cadre 8" width="80" height="80" > </a>   
                <a href=""> <img id="cadre9" src="img/cadre9.jpg"alt="cadre 9" width="80" height="80" > </a>   
                <figcaption> Veuillez choisir un modèle de cadre.</figcaption>
            </figure>

            <form id="formPrincipal">
                <div id="corps">
                    <div id="choixCriteres">
                        <h2>2.Adapter votre choix :</h2>                    
                        <input type="hidden" id="cadreChoisi" name="cadre-choisi" >
                        <h3>Dimensions :</h3>
                        <label for="rangeH" >Hauteur: <span class="normal">(max. 100cm)</span> </label> 
                        <input type="range" id="rangeH" value="50">
                        <input type="text" name="hauteur" id="ht" value="50">
                        <br/>
                        <label for="rangeL" >Largeur: <span class="normal">(max. 100cm)</span> </label> 
                        <input type="range" id="rangeL" value="50">
                        <input type="text" name="largeur" id="lr" value="50">
                        <br/>
                        <label for="rangeP" >Profondeur: <span class="normal">(max. 5cm)</span> </label>
                        <input type="range" id="rangeP" value="40">
                        <input type="text" name="profondeur" id="pf" value="2">
                        <br/>
                        <label for="couleur" >Couleur: </label>
                        <input type="color" name="couleur"/>


                        <h2>3.Fournir un fichier contenant votre photo</h2>
                        <input type="file" name="file" id="fichierImg" accept="image/*" required />              
                        <br/>
                        <input type="submit" value="Produire facture"/>

                        <div id="message"></div>

                    </div>

                    <div id="affichageRslt">
                        <h2> Résultat de l'ecadrement <img id="chargement" src="img/chargement.gif" width="22" height="22" ></h2>                                    
                        <img id="imgRslt" src="img/no-image.jpg" width="150" height="150" >                      
                    </div>
                </div>

            </form>           
        </section>

        <footer>
            <p> TP1 INF3005 </p>
        </footer>

    </body>
</html>
