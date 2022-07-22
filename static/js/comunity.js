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

function setColonia(code, valor) {
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
                $('#colonia').val(valor);
            }
        }
    });
}

function setPerson() {
    if ($('#colonia').val() != null) {
        $('#colonia').css('border', '1px solid rgba(0,0,0,0.5)')
        $.ajax({
            url: "controllers/setInfoU.php",
            type: "POST",
            data: $('#form-person').serialize(),
            success: function (response) {
                console.log(response);
                if (response.trim() == 1) {
                    $('#form-person')[0].reset();
                    $('#closeModal').click();
                    swal("Información Guardada con exito!", "ANDIC [2022]", "success")
                        .then((value) => {
                            location.reload();
                        });
                }
                else if (response.trim() == -1) {
                    swal("Oops!", "Correo  o telefono ya se encuentra registrado", "info");
                }
                else {
                    swal("Ocurrio un error intenta mas tarde", "ANDIC [2022]", "error");
                }
            }
        });
    }
    else {
        $('#colonia').css('border', '2px solid red')
    }

    return false;
}

function getInfo(type, persona) {
    prepareForm();
    bandera = type == 'v' ? true : false;

    $('#person').val(type + "-" + persona);

    if (bandera == true)
        $('#btn-send').hide();
    else
        $('#btn-send').show();

    $('.form-control').attr('disabled', bandera)
    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { tipo: "getPerson", persona },
        success: function (response) {
            dato = JSON.parse(response.trim());
            setColonia(dato.cp, dato.col);
            $('#nombre').val(dato.nombre);
            $('#app').val(dato.app);
            $('#apm').val(dato.apm);
            $('#mail').val(dato.correo);
            if (dato.sexo == "H")
                $('#sex-m').prop('checked', true);
            else
                $('#sex-f').prop('checked', true);
            $('#nacimiento').val(dato.fecha_nac);
            $('#phone').val(dato.tel);
            $('#calle').val(dato.calle);
            $('#cp').val(dato.cp);
        }
    });
}

function prepareForm() {
    $('.form-control').attr('disabled', false);
    $('#form-person')[0].reset();
    $('#btn-send').show()
}

function setImage() {
    var form = $('#changeImageForm');
    var datos = form.serialize();
    var archivos = new FormData();
    for (var i = 0; i < (form.find('input[type=file]').length); i++) {
        archivos.append((form.find('input[type="file"]:eq(' + i + ')').attr('name')), ((form.find('input[type="file"]:eq(' + i + ')')[0]).files[0]));
    }
    $.ajax({
        url: 'controllers/changeImage.php?' + datos,
        type: 'POST',
        contentType: false,
        data: archivos,
        processData: false,
        beforeSend: function () {
            console.log("cargando...");
        },
        success: function (response) {
            console.log(response);
            if (response.trim() == '1') {
                swal("Foto actualizada!", "ANDIC A.C. [2022]", "success")
                    .then((value) => {
                        location.reload();
                    });
            }
        }
    });
    return false;
}

function getImage(person) {
    $('#folP').val(person)
    $('#btn-foto').hide();
    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { tipo: 'getImage', person },
        success: function (response) {
            console.log(response);
            data = JSON.parse(response);
            $('#imagePerson').attr('src', "static/media/pictures/" + data.picture);
        }
    });
}

function deletePerson(person) {
    swal({
        title: "Estas segur@?",
        text: "Una vez eliminado el registro no se podra recuperar!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url:"controllers/deleteInfo.php",
                type:"POST",
                data:{tbl:"",}
              });
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

    $('#foto').change(function () {
        if ($('#foto').val() != "") {
            $('#btn-foto').show();
        }
        else
            $('#btn-foto').hide();
    })

});