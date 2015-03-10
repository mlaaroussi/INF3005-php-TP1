/**
 * @author Mohamed LAAROUSSI, LAAM03038304
 */
$(document).ready(function () {
    $("figure a").each(function () {

        $(this).click(function () {
            $('figure img').css('background', '#e3e7e3');
            $(this).children('img').css('background', '#333333');
            $('#img-choisi').attr('src', $(this).children('img').attr('src'));
            $('#cadre-choisi').val($(this).children('img').attr('id'));
            return (false);
        });

    });
});