var bandera;

function startForm(valor) {
    bandera = false;
    $('#form-event')[0].reset();
    $('#typeAction').val(valor);
    $('#lienzo').empty(); //imagen
    $('#lienzo').append("<input type='file' class='form-control' name='picture' id='picture' required>");
}

function setEvent() {
    var my = 0;
    my = $('#picture').val().length
    if (my > 0) {
        var formulario = $('#form-event');
        var datos = formulario.serialize();
        var archivos = new FormData();
        for (var i = 0; i < (formulario.find('input[type=file]').length); i++) {
            archivos.append((formulario.find('input[type="file"]:eq(' + i + ')').attr('name')), ((formulario.find('input[type="file"]:eq(' + i + ')')[0]).files[0]));
        }
        $.ajax({
            url: 'controllers/setEventI.php?' + datos,
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
                    swal("Evento creado!", "ANDIC A.C. [2022]", "success")
                        .then((value) => {
                            location.reload();
                        });
                }
            }
        });
    } else
        swal('Selecciona un archivo para enviar', '', 'error');
    return false;
}

function getEvent(evento, type) {
    bandera = false;
    $('#typeAction').val(type);
    if (type == 'V') {
        $('#btn-up').hide();
    }
    else{
        $('#btn-up').show();
    }

    $.ajax({
        url: "controllers/getInfo.php",
        type: 'POST',
        data: { tipo: "getEvent", evento },
        success: function (response) {
            console.log(response);
            data = JSON.parse(response);
            aux = data.fecha_inicio.split(" ");
            fecha = aux[0] + "T" + aux[1];
            aux = data.fecha_final.split(" ");
            fecha2 = aux[0] + "T" + aux[1];

            $('#idEvent').val(data.id_evento);
            $('#titleEvent').val(data.titulo);
            $('#dateStart').val(fecha);
            $('#dateEnd').val(fecha2);
            $('#horario').val(data.horario);
            $('#textEvent').val(data.descript);
            $('#registerControl').prop('checked', data.registro);
            if (type == 'V') {
                $('#lienzo').empty(); //imagen
                $('#lienzo').append("<img src='static/media/events/" + data.foto + "' width='100%'>");
            } else {
                $('#lienzo').empty(); //imagen
                $('#lienzo').append("<button class='btn btn-primary btn-small' type='button' onclick='changeF(`" + data.foto + "`)'><i class='fas fa-sync'></i></button>" +
                    "<img src='static/media/events/" + data.foto + "' width='100%'>");
            }
        }
    });
}

function changeF(dato) {
    if (bandera == false) {
        $('#lienzo').empty(); //imagen
        $('#lienzo').append("<input type='file' class='form-control' name='picture' id='picture' required>");
        bandera = true;
    } else {
        $('#lienzo').empty(); //imagen
        $('#lienzo').append("<button onclick='changeF()'><i class='fas fa-sync'></i></button>" +
            "<img src='static/media/events/" + dato + "' width='100%'>");
    }
}

function deleteEvent(tbl, id) {
    swal({
        title: "Esta seguro?",
        text: "Una vez eliminado, no se podra recuperar",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "controllers/deleteInfo.php",
                    type: 'POST',
                    data: { tbl, campo: "id_evento", id },
                    success: function (response) {
                        console.log(response);
                        if (response.trim() == '1') {
                            swal("Evento eliminado!", "ANDIC A.C. [2022]", "success")
                                .then((value) => {
                                    location.reload();
                                });
                        } else {
                            swal("Oops! Algo anda mal intentalo mas tarde", "ANDIC A.C. [2022]", "info");
                        }
                    }
                });
            }
        });
}

$(function () {

    $('#picture').change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#aux-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $("#tabla").dataTable();
});