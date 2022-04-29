$(function () {
    $('#status').change(function () {
        if ($('#status').is(':checked')) {
            $('#slide-menu').addClass('muestra');
        } else {
            $('#slide-menu').removeClass('muestra');
        }
    });

    $('#more-opt').hover(function () {
        $('#lienzo-opt').append("<div class='cont-downbtn'>" +
            "<ul class='sub-options'>" +
            "<li><a href=''>Change Pasword</a></li>" +
            "<hr style='margin: 0px; margin-top: 8px; margin-bottom: 8px; padding: 0px; display: flex;'>" +
            "<li><a href=''>Close Sessión <i class='fa fa-sign-out' aria-hidden='true'></i></a></li>" +
            "</ul>" +
            "</div>");
            $('.cont-downbtn').addClass('dow-muestra');
    }, function () {
        $('.cont-downbtn').removeClass('dow-muestra');
        $('#lienzo-opt').empty();
    });

});