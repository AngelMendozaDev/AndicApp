let cont = 0;

function getColonia(code) {
    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { tipo: 'getCols', code },
        success: function(response) {
            console.log(response);
        }
    });
}

$(function() {
    $('.part').attr('hidden', true);
    $('#part-0').attr('hidden', false);

    $('#arrow-left').click(function() {
        if (cont > 0) {
            cont--;
            $('.part').attr('hidden', true);
            $('#part-' + cont).attr('hidden', false);
        } else {
            $('.part').attr('hidden', true);
            $('#part-0').attr('hidden', false);
        }
    });

    $('#arrow-right').click(function() {
        if (cont < 2) {
            cont++;
            $('.part').attr('hidden', true);
            $('#part-' + cont).attr('hidden', false);
        } else {
            $('.part').attr('hidden', true);
            $('#part-2').attr('hidden', false);
        }
    });

    $('#cp').keyup(function() {
        code = $('#cp').val();
        if (code != null || code != "") {
            getColonia(code)
        }
    });

});