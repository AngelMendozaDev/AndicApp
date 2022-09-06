contador = 0;
item = 0

function prepareForm() {
    $('#form-inst')[0].reset();
    $('#clave').attr('disabled',false)
}

function removeItem(folio) {
    $('#item-' + folio).empty();
    contador--;
    if (contador <= 0) {
        item = 0;
        contador = 0;
        $('#lienzo').hide();
        $('#lienzo').empty();
        $('#switchServices').prop('checked', false);
    }
}

function addItem() {
    contador++;
    item++;
    $('#lienzo').append("<div class='input-group' id='item-" + item + "'>" +
        "<span class='input-group-text'>" +
        "<button type='button' class='btn btn-success' onclick='addItem()'>" +
        "<i class='fa fa-plus' aria-hidden='true'></i>" +
        "</button>" +
        "</span>" +
        "<input type='text' class='form-control mayus' placeholder='Carrera o Servicio en el que se especializa' name='servicio[]' required>" +
        "<button type='button' class='btn btn-danger btn-small' onclick='removeItem(" + item + ")'>" +
        "<i class='fa fa-times' aria-hidden='true'></i>" +
        "</button>" +
        "</div>");
}


function setInfo(){

    $.ajax({
        url:'controllers/convenios.php?act=C',
        type:'POST',
        data:$('#form-inst').serialize(),
        success:function(response){
            console.log(response);
            if(response.trim() == 1){
                swal("Información Guardada con exito!", "ANDIC [2022]", "success")
                        .then((value) => {
                            location.reload();
                        });
            }
            else if(response.trim() == -1){
                swal("Cuidado, posible duplicado!","La información que intentas guardar puede estar duplicada, revisa la información e intenta de nuevo... \n Andic A.C. [2022]", "info");
            }
            else{
                swal("Oops! Ocurrio algo inesperado, intenta de nuevo....","Andic A.C. [2022]", "error");
            }
        }
    });

    return false;
}

function getInst(clave){
    $('#clave').prop('disabled',true);
    $.ajax({
        url:'controllers/getInfo.php',
        type: 'POST',
        data:{tipo:"getInst",clave},
        success:function(response){
            console.log(response);
            item = JSON.parse(response);
            console.log(item);
            $('#clave').val(item.clave);
            $('#name_ins').val(item.nombre_ins);
            $('#tipo_ins').val(item.tipo_ins);
            $('#jefe').val(item.repre);
            $('#repre').val(item.sub);
            $('#phone').val(item.phone);
            $('#floatingTextarea2').val(item.direc);
            $('#phone').append("<h1>Hola Perro</h1>")
        }
    });
}

$(function () {
    $('#lienzo').hide();
    $('#switchServices').change(function () {
        if ($('#switchServices').prop('checked')) {
            $('#lienzo').show();
            if (contador <= 0) {
                contador++;
                item++;
                $('#lienzo').append("<div class='input-group' id='item-" + item + "'>" +
                    "<span class='input-group-text'>" +
                    "<button type='button' class='btn btn-success' onclick='addItem()'>" +
                    "<i class='fa fa-plus' aria-hidden='true'></i>" +
                    "</button>" +
                    "</span>" +
                    "<input type='text' class='form-control mayus' placeholder='Carrera o Servicio en el que se especializa' name='servicio[]' required>" +
                    "<button type='button' class='btn btn-danger btn-small' onclick='removeItem(" + item + ")'>" +
                    "<i class='fa fa-times' aria-hidden='true'></i>" +
                    "</button>" +
                    "</div>");
            }
        }
        else {
            $('#lienzo').hide();
            $('#lienzo').empty();
        }
    });
})