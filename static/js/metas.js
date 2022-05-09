function viewAction(action, letter) {
    console.log(letter)
    $('#btn-send').hide();
    $.ajax({
        url: "controllers/getInfo.php",
        type: 'POST',
        data: { tipo: "getAction", action },
        success: function (response) {
            data = JSON.parse(response);
            //console.log(data)
            $('#lienzo').empty();
            $('#title').val(data.titulo);
            $('#year').val(data.ano);
            $('#mult').val(data.multimedia);
            $('#textoArea').val(data.texto);
            if (data.multimedia == 'I')
                $('#lienzo').append("<img src='static/media/pictures/" + data.media + "' width='100%'>");
        }
    });
    $('#typeAction').val(letter);
    if (letter == 'E') {
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
}

function setAction() {
    $('#btn-send').show();
    var my = 0;
    if ($('#mult').val() != 'N' && $('#mult').val() != '') {
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
                beforeSend: function () {
                    console.log("cargando...");
                },
                success: function (response) {
                    console.log(response);
                }
            });
        }
        else
            swal('Selecciona un archivo para enviar', '', 'error');
    }
    else {
        $.ajax({
            url: 'controllers/setInfo.php',
            type: 'POST',
            data: $('#form-action').serialize(),
            success: function (response) {
                console.log(response);
            }
        });
    }
    return false;
}

$(function () {
    $("#tabla").dataTable();

    $("#mult").change(function () {
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