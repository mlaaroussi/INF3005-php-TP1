/**
 * @author Mohamed LAAROUSSI, LAAM03038304
 */
$(document).ready(function () {

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
        $("#imgRslt").attr("height", $("#rangeH").val() * 4);

    });
    
    $("#rangeL").on("input", function () {
        //changer laegeur
        $("#lr").val($("#rangeL").val());
        $("#imgRslt").attr("width", $("#rangeL").val() * 4);
    });
    
    $("#rangeP").on("input", function () {
        $("#pf").val($("#rangeP").val() / 20);
    });
   
     $("#rangeP").on("input", function () {
        var profondeur = $("#rangeP").val() / 20;
        $("#pf").val(profondeur);
        $("#imgRslt").css("box-shadow",profondeur*3+"px "+profondeur*3+"px 5px #888888");
        
    });
     
});

//Fonction qui permet de visualiser l'image après validation
$(function () {
    $("#fichierImg").change(function () {
        $("#message").empty(); // Pour supprimer le message d'erreur précédent
        var fichier = this.files[0];
        var type = fichier.type;
        var typesAcceptes = ["image/jpeg", "image/png", "image/jpg"];
        if (type !== typesAcceptes[0] && type !== typesAcceptes[1] && type !== typesAcceptes[2]) {
            $('#imgRslt').attr('src', 'img/no-image.jpg');
            $("#message").html("<span id='erreur'> Veuillez choisir une image valide, Seulement les types JPEG,JPG et PNG sont permis</span>");
            return false;
        } else {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $("#fichierImg").css("color", "green");
    $('#imgRslt').attr('src', e.target.result);
}

function modifierDimensionCadre(dim, img) {

    $('#imgRslt').css("border-image", "url(" + img + ") " + dim + " " + dim + " round");
}