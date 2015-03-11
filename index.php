
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
                <a href=""> <img id="cadre1" src="img/cadre1.jpg" alt="cadre 1" width="115" height="115" > </a> 
                <a href=""> <img id="cadre2" src="img/cadre2.jpg"alt="cadre 2" width="115" height="115"> </a>
                <a href=""> <img id="cadre3" src="img/cadre3.jpg"alt="cadre 3" width="115" height="115"> </a>  
                <a href=""> <img id="cadre4" src="img/cadre4.jpg" alt="cadre 4" width="115" height="115" > </a> 
                <a href=""> <img id="cadre5" src="img/cadre5.jpg"alt="cadre 5" width="115" height="115"> </a> 
                <a href=""> <img id="cadre6" src="img/cadre6.jpg"alt="cadre 6" width="115" height="115"> </a>
                <a href=""> <img id="cadre7" src="img/cadre7.jpg" alt="cadre 7" width="115" height="115" > </a> 
                <a href=""> <img id="cadre8" src="img/cadre8.jpg"alt="cadre 8" width="115" height="115" > </a>   
                <a href=""> <img id="cadre9" src="img/cadre9.jpg"alt="cadre 9" width="115" height="115" > </a>   
                <figcaption> Veuillez choisir un modèle de cadre.</figcaption>
            </figure>

            <form id="formPrincipal" enctype="multipart/form-data" oninput="ht.value=rangeH.value; lr.value=rangeL.value; pf.value=parseInt(rangeP.value)/20;">
                <article id="choix">
                    <h2>2.Adapter votre choix :</h2>
                    <label for="cadre-choisi" >Cadre choisi:</label>  <img id="img-choisi" src="" width="32" height="32" >
                    <input type="hidden" id="cadre-choisi" name="cadre-choisi" >
                    <br/>
                    <h3>Dimensions :</h3>
                    <label for="rangeH" >Hauteur: <span class="normal">(max. 100cm)</span> </label> 
                    <input type="range" id="rangeH" value="20">
                    <input type="text" name="hauteur" id="ht" value="20">
                    <br/>
                    <label for="rangeL" >Largeur: <span class="normal">(max. 100cm)</span> </label> 
                    <input type="range" id="rangeL" value="20">
                    <input type="text" name="largeur" id="lr" value="20">
                    <br/>
                    <label for="rangeP" >Profondeur: <span class="normal">(max. 5cm)</span> </label>
                    <input type="range" id="rangeP" value="40">
                    <input type="text" name="profondeur" id="pf" value="2">
                    <br/>
                    <label for="couleur" >Couleur: </label>
                    <input type="color" name="couleur"/>
                </article>
                
                <aside id="upload">
                     <h2> Résultat de l'ecadrement ...</h2>                                    
                    <img id="rslt-photo" src="" width="200" height="100" >                                    
                </aside>

                <aside id="choix-fichier">
                    <h2>3.Fournir un fichier contenant votre photo</h2>
                    <input type="file" name="file" id="file" accept="image/*" required />              
                    <br/>
                    <input type="submit" value="Produire facture"/>
                    <h4 id="chargement" >Chargement..</h4>
                    <div id="message"></div>
                </aside>                               
            </form>           
        </section>

        <footer>
            <p> TP1 INF3005 </p>
        </footer>

    </body>
</html>
