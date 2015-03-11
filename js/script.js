/**
 * @author Mohamed LAAROUSSI, LAAM03038304
 */
$(document).ready(function () {
    
      $("#formPrincipal").on('submit', (function (e) {
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
    }));
    
    //Fonction qui permet de visualiser l'image après validation
    $(function () {
        $("#file").change(function () {
            $("#message").empty(); // Pour supprimer le message d'erreur précédent
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (imagefile !== match[0] && imagefile !== match[1] && imagefile !== match[2] ) {
                $('#rslt-photo').attr('src', 'img/no-image.jpg');
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
      $("#file").css("color", "green");
        $('#rslt-photo').attr('src', e.target.result);

    }
    

    function modifierDimensionCadre(largeur,img) {
                
        $('#rslt-photo').css("border-image",  "url("+img+") "+largeur+" "+largeur+" round");
    }
    
    $("figure a").each(function () {

        $(this).click(function () {
            $('figure img').css('background', '#e3e7e3');
            $(this).children('img').css('background', '#333333');
            //$('#img-choisi').attr('src', $(this).children('img').attr('src'));
            $('#cadre-choisi').val($(this).children('img').attr('id'));
            // largeur = parseInt();
            //largeur = parseInt($('#rangeL'));
            modifierDimensionCadre(170,$(this).children('img').attr('src').replace("cadre","ccadre"));
          // $('#rslt-photo').css("border-image",  "url("+$(this).children('img').attr('src').replace("cadre","ccadre")+") 140 140 round");
            
           // $('#rslt-photo').css("border-image", $('#rslt-photo').css("border-image").replace("\(*\)","("+$(this).children('img').attr('src').replace("cadre","ccadre")+")") );
          
            return (false);
        });

    });
});