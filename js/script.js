/**
 * @author Mohamed LAAROUSSI, LAAM03038304
 */
var long = 250;
var haut = 250;
var lcadre = 20;
var marge = 30;
var profond = 10;
var couleurHaut = "#ED1A59";
var couleurBas = "#ED1A59";
var couleurGauche = "#ED1A59";
var couleurDroit = "#ED1A59";
var imgSrc = "img/noimage.png";

$(document).ready(function (e) {
    dessinerCadre();

    $("#formPrincipal").submit(function () {
        canvasNoirEtBlanc();
    });

    $("#rangeH").on("input", function () {
        //changer hauteur
        $("#ht").val($("#rangeH").val());
        haut = $("#rangeH").val() * 3;
        dessinerCadre();

    });

    $("#rangeL").on("input", function () {
        //changer largeur
        $("#lr").val($("#rangeL").val());
        long = $("#rangeL").val() * 3;
        dessinerCadre();
    });

    $("#rangeP").on("input", function () {
        $("#pf").val($("#rangeP").val());
        profond = $("#rangeP").val() * 3;
        dessinerCadre();
    });


    $("#rangeLc").on("input", function () {
        $("#lCadre").val($("#rangeLc").val());
        lcadre = $("#rangeLc").val() * 3;
        dessinerCadre();
    });

    $("#rangeMr").on("input", function () {
        $("#marge").val($("#rangeMr").val());
        marge = $("#rangeMr").val() * 3;
        dessinerCadre();
    });

    $("#coulHaut").on("input", function () {
        couleurHaut = $(this).val();
        dessinerCadre();
    });
    $("#coulBas").on("input", function () {
        couleurBas = $(this).val();
        dessinerCadre();
    });
    $("#coulDroite").on("input", function () {
        couleurDroit = $(this).val();
        dessinerCadre();
    });

    $("#coulGauche").on("input", function () {
        couleurGauche = $(this).val();
        dessinerCadre();
    });

//Fonction qui permet de visualiser l'image après validation
    $(function () {
        $("#fichierImg").change(function () {
            $("#message").empty(); // Pour supprimer le message d'erreur précédent
            var fichier = this.files[0];
            var type = fichier.type;
            var typesAcceptes = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
            if (type !== typesAcceptes[0] && type !== typesAcceptes[1] && type !== typesAcceptes[2] && type !== typesAcceptes[3]) {
                imgSrc = "img/noimage.png";
                $("#message").html("<span id='erreur'> Veuillez choisir une image valide, Seulement les types JPEG,JPG,GIF et PNG sont permis</span>");
                return false;
            } else {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

});


function imageIsLoaded(e) {
    $("#fichierImg").css("color", "green");

    imgSrc = e.target.result;
    dessinerCadre();
}

//Fonction qui permet de dessiner le cadre avec le Canvas, utilise des variables globales
function dessinerCadre() {
    var canvas = $("#canvasRslt")[0];
    var ctx = canvas.getContext("2d");

    canvas.width = long + profond + 2;
    canvas.height = haut + profond + 2;

    //pour initialiser le canvas precedent
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    var img = new Image();
    img.src = imgSrc;
    img.onload = function () {
        //positionnement de l'image dans le cadre
        ctx.drawImage(img, lcadre + marge, lcadre + marge, long - 2 * (lcadre + marge), haut - 2 * (lcadre + marge));
    };
    // Haut du cadre
    ctx.beginPath();
    ctx.moveTo(1, 1);
    ctx.lineTo(long, 1);
    ctx.lineTo(long - lcadre, lcadre);
    ctx.lineTo(lcadre, lcadre);
    ctx.lineTo(1, 1);
    ctx.stroke();
    ctx.fillStyle = couleurHaut;
    ctx.fill();
    ctx.closePath();

    // gauche du cadre
    ctx.beginPath();
    ctx.moveTo(1, 1);
    ctx.lineTo(lcadre, lcadre);
    ctx.lineTo(lcadre, haut - lcadre);
    ctx.lineTo(1, haut);
    ctx.lineTo(1, 1);
    ctx.stroke();
    ctx.fillStyle = couleurGauche;
    ctx.fill();
    ctx.closePath();

    // droite du cadre
    ctx.beginPath();
    ctx.moveTo(long, 1);
    ctx.lineTo(long - lcadre, lcadre);
    ctx.lineTo(long - lcadre, haut - lcadre);
    ctx.lineTo(long, haut);
    ctx.lineTo(long, 1);
    ctx.stroke();
    ctx.fillStyle = couleurDroit;
    ctx.fill();
    ctx.closePath();

    // profondeur droite du cadre
    ctx.beginPath();
    ctx.moveTo(long, 1);
    ctx.lineTo(long + profond, profond);
    ctx.lineTo(long + profond, haut + profond);
    ctx.lineTo(long, haut);
    ctx.lineTo(long, 1);
    ctx.stroke();
    ctx.fillStyle = couleurDroit;
    ctx.fill();
    ctx.closePath();

    // bas du cadre
    ctx.beginPath();
    ctx.moveTo(1, haut);
    ctx.lineTo(lcadre, haut - lcadre);
    ctx.lineTo(long - lcadre, haut - lcadre);
    ctx.lineTo(long, haut);
    ctx.lineTo(1, haut);
    ctx.stroke();
    ctx.fillStyle = couleurBas;
    ctx.fill();
    ctx.closePath();

    // profondeur bas du cadre
    ctx.beginPath();
    ctx.moveTo(1, haut);
    ctx.lineTo(profond, haut + profond);
    ctx.lineTo(long + profond, haut + profond);
    ctx.lineTo(long, haut);
    ctx.lineTo(1, haut);
    ctx.stroke();
    ctx.fillStyle = couleurBas;

    ctx.fill();
    ctx.closePath();

    //marge
    ctx.beginPath();
    ctx.moveTo(lcadre + marge, lcadre + marge);
    ctx.lineTo(long - (lcadre + marge), lcadre + marge);
    ctx.lineTo(long - (lcadre + marge), haut - (lcadre + marge));
    ctx.lineTo(lcadre + marge, haut - (lcadre + marge));
    ctx.lineTo(lcadre + marge, lcadre + marge);
    //ctx.stroke();
    ctx.closePath();
}

//fonction qui permet de transformer le canvas en noir et blanc (grayScale),et de stocker les données 
//de l'image resultat dans un champ caché.
function canvasNoirEtBlanc() {
    var canvas = $("#canvasRslt")[0];
    var ctx = canvas.getContext("2d");

    var canvasNB = $("#canvasNoireBlanc")[0];
    var ctx2 = canvasNB.getContext("2d");
    
    var imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);

    //Transformation grayScale
    var pixels = imgData.data;
    for (var i = 0, n = pixels.length; i < n; i += 4) {
        var grayscale = pixels[i] * .3 + pixels[i + 1] * .59 + pixels[i + 2] * .11;
        pixels[i  ] = grayscale;        // red
        pixels[i + 1] = grayscale;        // green
        pixels[i + 2] = grayscale;        // blue       
    }
    canvasNB.width = canvas.width;
    canvasNB.height = canvas.height;
    //on remet l'image en noir et blanc
    ctx2.putImageData(imgData, 0, 0);

    var canvasData = canvasNB.toDataURL("image/png");
    //on remplit le champ caché par les données de l'image
    $("#imgData").val(canvasData);  
    $("#lschema").val("width:"+canvasNB.width+"px;");
}