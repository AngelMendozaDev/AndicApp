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
                if(response.trim() == 1){
                    swal("Persona registrada con exito!","ANDIC [2022]","success");
                    $('#form-person')[0].reset();
                }
                else if(response.trim() == -1){
                    swal("Oops!", "Correo  o telefono ya se encuentra registrado", "info");
                }
                else{
                    swal("Ocurrio un error intenta mas tarde","ANDIC [2022]","error");
                }
            }
        });
    }
    else{
        $('#colonia').css('border','2px solid red')
    }

    return false;
}

function getInfo(type,persona){
    bandera = type =='v'?true: false;
    $('.form-control').attr('disabled',bandera)
    $.ajax({
        url:'controllers/getInfo.php',
        type:'POST',
        data:{tipo:"getPerson", persona},
        success:function(response){
            dato = JSON.parse(response.trim());
            getColonia(dato.cp);
            $('#nombre').val(dato.nombre);
            $('#app').val(dato.app);
            $('#apm').val(dato.apm);
            $('#mail').val(dato.correo);
            if(dato.sexo == "H")
                $('#sex-m').prop('checked',true);
            else
                $('#sex-f').prop('checked',true);
            $('#nacimiento').val(dato.fecha_nac);
            $('#phone').val(dato.tel);
            $('#calle').val(dato.calle);
            $('#cp').val(dato.cp);
            $('#colonia').val(dato.col);            
        }
    });
}

$(function () {
    $('#cp').keyup(function () {
        code = $('#cp').val();
        if (code != null || code != "") {
            getColonia(code)
        }
    });

});