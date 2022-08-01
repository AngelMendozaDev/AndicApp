function prepareForm() {
    $('#form-res')[0].reset();
}

function getColonia(code) {
    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { tipo: 'getCols', code },
        success: function (response) {
            //console.log(response);
            if (response != '-1') {
                data = JSON.parse(response);
                $('#colonia').empty();
                $('#colonia').append("<option value='0' selected='true' disabled>--Selecciona una opcion</option>")
                if (data.length > 0) {
                    $.each(data, function (key, item) {
                        $('#colonia').append("<option value='" + item[0] + "'>" + item[1] + "</option>")
                        alc = item[2];
                        edo = item[3]
                    });
                    $('#alc').val(alc);
                    $('#edo').val(edo);
                }
            }
            else {
                $('#alc').val("");
                $('#edo').val("");
                $('#colonia').empty();
                $('#colonia').append("<option value='0' selected='true' disabled>--Selecciona una opcion</option>")
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

function getEscuela(text) {
    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { tipo: 'getSchool', text },
        success: function (response) {
            //console.log(response);
            $('#datalistOptions').empty();
            dat = JSON.parse(response);
            //console.log(dat);
            if (dat.lengt > 0) {
                $.each(dat, function (key, item) {
                    $('#datalistOptions').append("<option value='" + item + "'>")
                });
            }
        }
    });
}

function getCarrera(text) {
    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { tipo: 'getCarrera', text },
        success: function (response) {
            //console.log(response);
            $('#carrera-options').empty();
            dat = JSON.parse(response);
            //console.log(dat);
            if (dat.lengt > 0) {
                $.each(dat, function (key, item) {
                    $('#carrera-options').append("<option value='" + item + "'>")
                });
            }
        }
    });
}

function setPractica() {
    $.ajax({
        url: 'controllers/setPractica.php',
        type: 'POST',
        data: $('#form-res').serialize(),
        success: function (response) {
            //console.log(response);
            if (response.trim() == 1) {
                $('#form-res')[0].reset();
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
    return false;
}

$(function () {
    $('#school-text').keyup(function () {
        text = $('#school-text').val();
        if (text != "")
            getEscuela(text);
    });

    $('#carrera-text').keyup(function () {
        text = $('#carrera-text').val();
        if (text != "")
            getCarrera(text);
    });

    $('#cp').keyup(function () {
        text = $('#cp').val();
        if (text != "")
            getColonia(text);
    });

    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { tipo: 'getPracticas' },
        success: function (response) {
            console.log(response)
            data = JSON.parse(response);
            console.log(data);
            $.each(data, function (key, item) {
                console.log(item[8])
                tipo = item[7] == 'S' ? 'SERVICIO SOCIAL' : 'RESIDENCIAS PROFESIONALES';
                switch (item[8]) {
                    case 1:
                        $('#sol').append("<div class='tarjeta-alumno'>" +
                            "<span class='name-al'>" + item[0] + " " + item[1] + " " + item[2] + "</span>" +
                            "<p>" +
                            "<i class='fa fa-graduation-cap' aria-hidden='true'></i>" +
                            "<span class='escuela'>" + item[4] + "</span>" +
                            "</p>" +
                            "<p>" +
                            "<span class='carrera'>" + item[5] + " [" + item[6] + "°]</span>" +
                            "</p>" +
                            "<p class='proyect'>" + tipo + "</p>" +
                            "<p class='proyect'></p>" +
                            "<div class='controls'>" +
                            "<button class='btn btn-outline-success btn-small' onclick='nextStep(`" + item[3] + "`)'>" +
                            "<i class='fa fa-check-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "<button class='btn btn-outline-danger btn-small' onclick='rechazar(`" + item[3] + "`)'>" +
                            "<i class='fa fa-times-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "</div>" +
                            "</div>");
                        break;
                    case 2:
                        $('#acept').append("<div class='tarjeta-alumno'>" +
                            "<span class='name-al'>" + item[0] + " " + item[1] + " " + item[2] + "</span>" +
                            "<p>" +
                            "<i class='fa fa-graduation-cap' aria-hidden='true'></i>" +
                            "<span class='escuela'>" + item[4] + "</span>" +
                            "</p>" +
                            "<p>" +
                            "<span class='carrera'>" + item[5] + " [" + item[6] + "°]</span>" +
                            "</p>" +
                            "<p class='proyect'>" + tipo + "</p>" +
                            "<p class='proyect'></p>" +
                            "<div class='controls'>" +
                            "<button class='btn btn-outline-success btn-small' onclick='nextStep(`" + item[3] + "`)'>" +
                            "<i class='fa fa-check-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "<button class='btn btn-outline-danger btn-small' onclick='rechazar(`" + item[3] + "`)'>" +
                            "<i class='fa fa-times-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "</div>" +
                            "</div>");
                        break;
                    case 3:
                        $('#working').append("<div class='tarjeta-alumno'>" +
                            "<span class='name-al'>" + item[0] + " " + item[1] + " " + item[2] + "</span>" +
                            "<p>" +
                            "<i class='fa fa-graduation-cap' aria-hidden='true'></i>" +
                            "<span class='escuela'>" + item[4] + "</span>" +
                            "</p>" +
                            "<p>" +
                            "<span class='carrera'>" + item[5] + " [" + item[6] + "°]</span>" +
                            "</p>" +
                            "<p class='proyect'>" + tipo + "</p>" +
                            "<p class='proyect'></p>" +
                            "<div class='controls'>" +
                            "<button class='btn btn-outline-success btn-small' onclick='nextStep(`" + item[3] + "`)'>" +
                            "<i class='fa fa-check-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "<button class='btn btn-outline-danger btn-small' onclick='rechazar(`" + item[3] + "`)'>" +
                            "<i class='fa fa-times-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "</div>" +
                            "</div>");
                        break;
                    case 4:
                        $('#lib').append("<div class='tarjeta-alumno'>" +
                            "<span class='name-al'>" + item[0] + " " + item[1] + " " + item[2] + "</span>" +
                            "<p>" +
                            "<i class='fa fa-graduation-cap' aria-hidden='true'></i>" +
                            "<span class='escuela'>" + item[4] + "</span>" +
                            "</p>" +
                            "<p>" +
                            "<span class='carrera'>" + item[5] + " [" + item[6] + "°]</span>" +
                            "</p>" +
                            "<p class='proyect'>" + tipo + "</p>" +
                            "<p class='proyect'></p>" +
                            "<div class='controls'>" +
                            "<button class='btn btn-outline-success btn-small' onclick='nextStep(`" + item[3] + "`)'>" +
                            "<i class='fa fa-check-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "<button class='btn btn-outline-danger btn-small' onclick='rechazar(`" + item[3] + "`)'>" +
                            "<i class='fa fa-times-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "</div>" +
                            "</div>");
                        break;
                    case 5:
                        $('#rech').append("<div class='tarjeta-alumno'>" +
                            "<span class='name-al'>" + item[0] + " " + item[1] + " " + item[2] + "</span>" +
                            "<p>" +
                            "<i class='fa fa-graduation-cap' aria-hidden='true'></i>" +
                            "<span class='escuela'>" + item[4] + "</span>" +
                            "</p>" +
                            "<p>" +
                            "<span class='carrera'>" + item[5] + " [" + item[6] + "°]</span>" +
                            "</p>" +
                            "<p class='proyect'>" + tipo + "</p>" +
                            "<p class='proyect'></p>" +
                            "<div class='controls'>" +
                            "<button class='btn btn-outline-success btn-small' onclick='nextStep(`" + item[3] + "`)'>" +
                            "<i class='fa fa-check-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "<button class='btn btn-outline-danger btn-small' onclick='rechazar(`" + item[3] + "`)'>" +
                            "<i class='fa fa-times-circle' aria-hidden='true'></i>" +
                            "</button>" +
                            "</div>" +
                            "</div>");
                        break;
                }
            });
        }
    });
});