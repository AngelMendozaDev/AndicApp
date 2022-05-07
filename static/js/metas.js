function viewAction(action) {
    $.ajax({
        url: "controllers/getInfo.php",
        type: 'POST',
        data: { tipo: "getAction", action },
        success: function(response) {
            console.log(response);
        }
    });
}

function setAction() {
    var my;
    var myFile;
    let foto;

    if ($('#mult').val() != 'N' && $('#mult').val() != '') {
        my = document.getElementById('media');
        myFile = my.files[0];
        foto = myFile.toDataURL(); //Esta es la foto, en base 64
    }

    console.log(foto)

    $.ajax({
        url: "controllers/setInfo.php",
        type: 'POST',
        headers: {
            "Content-type": "application/x-www-form-urlencoded",
        },
        data: { data: $('#form-action').serialize(), foto: encodeURIComponent(foto) },
        success: function(response) {
            console.log(response);
        }
    });

    return false;
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
        } else if (dato == 'V') {
            $('#lienzo').append("<div class='input-group'>" +
                "<span class='input-group-text'>" +
                "<i class='fa fa-video-camera' aria-hidden='true'></i>" +
                "</span>" +
                "<input type='file' accept='.avi, .mp4' class='form-control' name='media' id='media' required>" +
                "</div>");
        }
    });
})