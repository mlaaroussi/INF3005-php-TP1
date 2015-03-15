/**
 * @author Mohamed LAAROUSSI, LAAM03038304
 */
var long = 320;
 var haut = 250;
 var lcadre = 20;
 var marge = 30;
 var couleurHaut = "red";
 var couleurBas = "blue";
 var couleurGauche = "gray";
 var couleurDroit = "green";
var imgSrc = "img/no-image.jpg"; 

$(document).ready(function (e) {


    dessinerCadre();

    $("#formPrincipal").submit(function (e) {
        e.preventDefault();
        $("#message").empty();
        $("#chargement").show();
        $.ajax({
            url: "upload.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                $("#chargement").hide();
                $("#message").html(data);
            }
        });
    });

    $("figure a").each(function () {

        $(this).click(function () {
            $('figure img').css('background', '#e3e7e3');
            $(this).children('img').css('background', '#333333');
            $('#cadre-choisi').val($(this).children('img').attr('id'));
            modifierDimensionCadre(170, $(this).children('img').attr('src').replace("cadre", "ccadre"));
            return (false);
        });

    });

    $("#rangeH").on("input", function () {
        //changer hauteur
        $("#ht").val($("#rangeH").val());
       // $("#imgRslt").attr("height", $("#rangeH").val() * 4);
         haut = $("#rangeH").val() * 4;         
         dessinerCadre();

    });

    $("#rangeL").on("input", function () {
        //changer laegeur
        $("#lr").val($("#rangeL").val());
        //$("#imgRslt").attr("width", $("#rangeL").val() * 4);
         long = $("#rangeL").val() * 4;         
         dessinerCadre();
    });

    $("#rangeP").on("input", function () {
        $("#pf").val($("#rangeP").val() / 20);
    });

    $("#rangeP").on("input", function () {
        var profondeur = $("#rangeP").val() / 20;
        $("#pf").val(profondeur);
        $("#imgRslt").css("box-shadow", profondeur * 3 + "px " + profondeur * 3 + "px 5px #888888");

    });
        
     $("#coulHaut").on("input", function () {
         couleurHaut = $(this).val();         
         dessinerCadre();
    });
     $("#coulBas").on("input", function () {
         couleurBas = $(this).val();         
         dessinerCadre();
    });
     $("#coulDroit").on("input", function () {
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
            var typesAcceptes = ["image/jpeg", "image/png", "image/jpg"];
            if (type !== typesAcceptes[0] && type !== typesAcceptes[1] && type !== typesAcceptes[2]) {
                imgSrc = "img/no-image.jpg"; 
                //$('#imgRslt1').attr('src', 'img/no-image.jpg');
                $("#message").html("<span id='erreur'> Veuillez choisir une image valide, Seulement les types JPEG,JPG et PNG sont permis</span>");
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
    //$('#imgRslt').attr('src', e.target.result);
    imgSrc = e.target.result;
    dessinerCadre();
}

function modifierDimensionCadre(dim, img) {

    $('#imgRslt').css("border-image", "url(" + img + ") " + dim + " " + dim + " round");
}

function dessinerCadre() {

 var canvas = $("#canvasRslt")[0];
    var ctx = canvas.getContext("2d");
    
    //pour initialiser le canvas precedent
     ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    var img = new Image();
    img.src = imgSrc;
    img.onload = function () {
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
    ctx.moveTo(long, 1);
    ctx.stroke();
    ctx.fillStyle = couleurDroit  ;
    ctx.fill();
    ctx.closePath();

    // bas du cadre
    ctx.beginPath();
    ctx.moveTo(1, haut);
    ctx.lineTo(lcadre, haut - lcadre);
    ctx.lineTo(long - lcadre, haut - lcadre);
    ctx.lineTo(long, haut);
    ctx.moveTo(1, haut);
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
