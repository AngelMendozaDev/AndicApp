let cont = 0;

function getColonia(code) {
    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { tipo: 'getCols', code },
        success: function (response) {
            console.log(response);
            if (response != "Nan") {
                data = JSON.parse(response);
                $('#colonia').empty();
                $('#colonia').append("<option value='0' selected='true' disabled>--Selecciona una opcion</option>")
                $.each(data, function (key, item) {
                    $('#colonia').append("<option value='" + item[0] + "'>" + item[1] + "</option>")
                    alc = item[2];
                    edo = item[3]
                });
                $('#alc').val(alc);
                $('#edo').val(edo);
            }
        }
    });
}

function setPerson() {
    if ($('#colonia').val() != null) {
        $('#colonia').css('border','1px solid rgba(0,0,0,0.5)')
        $.ajax({
            url: "controllers/setInfoU.php",
            type: "POST",
            data: $('#form-person').serialize(),
            success: function (response) {
                console.log(response);
            }
        });
    }
    else{
        $('#colonia').css('border','2px solid red')
    }

    return false;
}

$(function () {
    $('#cp').keyup(function () {
        code = $('#cp').val();
        if (code != null || code != "") {
            getColonia(code)
        }
    });

});