function viewAction(action, letter) {
    console.log(letter)
    $('#btn-send').hide();
    $.ajax({
        url: "controllers/getInfo.php",
        type: 'POST',
        data: { tipo: "getAction", action },
        success: function(response) {
            data = JSON.parse(response);
            //console.log(data)
            $('#lienzo').empty();
            $('#title').val(data.titulo);
            $('#year').val(data.ano);
            $('#mult').val(data.multimedia);
            $('#textoArea').val(data.texto);
            $('#folioAction').val(data.id_accion)
            if (data.multimedia == 'I')
                $('#lienzo').append("<img src='static/media/pictures/" + data.media + "' width='100%'>");
        }
    });
    $('#typeAction').val(letter);
    if (letter == 'U') {
        $('#btn-send').show();
        $('#btn-send').html('Actualizar <i class="fas fa-sync"></i>');
    } else
        $('#btn-send').hide();
}

function startForm() {
    $('#form-action')[0].reset();
    $('#typeAction').val('C');
    $('#btn-send').html('Guardar <i class="fas fa-save"></i>');
    $('#lienzo').empty();
    $('#btn-send').show();
}

function setAction() {
    var my = 0;
    if ($('#mult').val() != 'N') {
        my = $('#media').val().length
        if (my > 0) {
            var formulario = $('#form-action');
            var datos = formulario.serialize();
            var archivos = new FormData();
            for (var i = 0; i < (formulario.find('input[type=file]').length); i++) {
                archivos.append((formulario.find('input[type="file"]:eq(' + i + ')').attr('name')), ((formulario.find('input[type="file"]:eq(' + i + ')')[0]).files[0]));
            }
            $.ajax({
                url: 'controllers/setInfoI.php?' + datos,
                type: 'POST',
                contentType: false,
                data: archivos,
                processData: false,
                beforeSend: function() {
                    console.log("cargando...");
                },
                success: function(response) {
                    console.log(response);
                    if (response.trim() == '1') {
                        swal("Acontecimiento creado!", "ANDIC A.C. [2022]", "success")
                            .then((value) => {
                                location.reload();
                            });
                    }
                }
            });
        } else
            swal('Selecciona un archivo para enviar', '', 'error');
    } else {
        $.ajax({
            url: 'controllers/setInfo.php',
            type: 'POST',
            data: $('#form-action').serialize(),
            success: function(response) {
                console.log(response);
                swal("Acontecimiento creado!", "ANDIC A.C. [2022]", "success")
                    .then((value) => {
                        location.reload();
                    });
            }
        });
    }
    return false;
}

function deleteAction(tbl, id) {
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
                    data: { tbl, campo: "id_accion", id },
                    success: function(response) {
                        console.log(response);
                        if (response.trim() == '1') {
                            swal("Acontecimiento eliminado!", "ANDIC A.C. [2022]", "success")
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

$(function() {
    $("#tabla").dataTable();

    $("#mult").change(function() {
        dato = $('#mult').val();
        $('#lienzo').empty();
        if (dato == 'I') {
            $('#lienzo').append("<div class='input-group'>" +
                "<span class='input-group-text'>" +
                "<i class='fas fa-image'></i>" +
                "</span>" +
                "<input type='file' accept='.jpeg, .jpg, .png, .gif' class='form-control' name='media' id='media' required>" +
                "</div>");
        }
    });
})