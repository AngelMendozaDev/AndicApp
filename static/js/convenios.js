contador = 0;
item = 0

function prepareForm() {
    $('#form-inst')[0].reset();
    $('#clave').attr('disabled', false)
}

function setStatus(flag){
    $('#clave').attr('disabled',flag);
    $('#name_ins').attr('disabled',flag);
    $('#tipo_ins').attr('disabled',flag);
    $('#jefe').attr('disabled',flag);
    $('#repre').attr('disabled',flag);
    $('#phone').attr('disabled',flag);
    $('#floatingTextarea2').attr('disabled',flag);
    $('#switchServices').attr('disabled',flag);
    if(flag == true){
        $('#btn-sendData').hide();
    }
    else{
        $('#btn-sendData').show();
    }
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


function setInfo() {
    $.ajax({
        url: 'controllers/convenios.php?act=C',
        type: 'POST',
        data: $('#form-inst').serialize(),
        success: function (response) {
            console.log(response);
            if (response.trim() == 1) {
                swal("Información Guardada con exito!", "ANDIC [2022]", "success")
                    .then((value) => {
                        location.reload();
                    });
            }
            else if (response.trim() == -1) {
                swal("Cuidado, posible duplicado!", "La información que intentas guardar puede estar duplicada, revisa la información e intenta de nuevo... \n Andic A.C. [2022]", "info");
            }
            else {
                swal("Oops! Ocurrio algo inesperado, intenta de nuevo....", "Andic A.C. [2022]", "error");
            }
        }
    });

    return false;
}

function getInst(clave) {
    //Deshabilitamos los campos
    //Set Status Disabled
    setStatus(true)
    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { tipo: "getInst", clave },
        success: function (response) {
            console.log(response);
            item = JSON.parse(response);
            $('#clave').val(item.info.clave);
            $('#name_ins').val(item.info.nombre_ins);
            $('#tipo_ins').val(item.info.tipo_ins);
            $('#jefe').val(item.info.repre);
            $('#repre').val(item.info.sub);
            $('#phone').val(item.info.phone);
            $('#floatingTextarea2').val(item.info.direc);
            for (i = 0; i < item.serv.length; i++) {
                $('#lienzo').append("<div class='input-group' id='item-" + (i + 1) + "'>" +
                    "<span class='input-group-text'>" +
                    "<button type='button' class='btn btn-success' onclick='addItem()' disabled>" +
                    "<i class='fa fa-plus' aria-hidden='true'></i>" +
                    "</button>" +
                    "</span>" +
                    "<input type='text' class='form-control mayus' placeholder='Carrera o Servicio en el que se especializa' name='servicio[]' value='" + item.serv[i].serv + "' disabled required>" +
                    "<button type='button' class='btn btn-danger btn-small' onclick='removeItem(" + (i + 1) + ")' disabled>" +
                    "<i class='fa fa-times' aria-hidden='true'></i>" +
                    "</button>" +
                    "</div>");
            }
            $('#lienzo').show();
        }
    });
}

function newService(){
    data = $('#serv-v').val();
    clave = $('#clave-I').val();
    if(data != "" || data != null){
        $.ajax({
            url:'controllers/convenios.php',
            type:'POST',
            data:$('#service-form').serialize(),
            success: function(response){
                console.log(response);
                if(response.trim() == 1){
                    getServ(clave);
                }
            },
            error: function(response){
                console.log("Error: "+response)
            }
            
        })
    }
    return false;
}

function getServ(clave){
    newServ()
    $('#btn-new').hide();
    $('#clave-I').val(clave);
    $.ajax({
        url:'controllers/getInfo.php',
        type:'POST',
        data:{tipo:'getServices',clave},
        success:function(response){
            //console.log(response);
            myJson = JSON.parse(response);
            $('#lienzo-table').empty();
            $.each(myJson,function(key,item){
                //console.log(item.serv);
                $('#lienzo-table').append("<tr class='text-center'>"+
                "<td>"+clave+"</td>"+
                "<td>"+item.serv+"</td>"+
                "<td>"+
                    "<button class='btn btn-warning btn-small ml-1' onclick='setItem(`"+item.id+" `,` "+item.serv+" `)'>"+
                        "<i class='fas fa-edit'></i>"+
                    "</button>"+
                    "<button class='btn btn-danger btn-small' onclick='deleteServ(`"+item.id+" `,` "+clave+" `)'>"+
                        "<i class='fa fa-trash' aria-hidden='true'></i>"+
                    "</button>"+
                "</td>"+
            "</tr>");
            });
        }
    });
}

function setItem(id,service){
    $('#serv-v').val(service);
    $('#acction').val("E-"+id);
    $('#btn-services').html("Actualizar");
    $('#btn-services').removeClass("btn-success");
    $('#btn-services').addClass("btn-primary");
    $('#btn-new').show();
}

function newServ(){
    $('#serv-v').val("");
    $('#acction').val("CS");
    $('#btn-services').html("Guardar");
    $('#btn-services').addClass("btn-success");
    $('#btn-services').removeClass("btn-primary");
    $('#btn-new').hide();
}

function deleteServ(folio, clave){
    swal({
        title: "Estas segur@?",
        text: "Una vez eliminado, no podras recuperar la información",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:'controllers/convenios.php',
                type:'POST',
                data:{act:'D', serv: folio},
                success:function(response){
                    console.log(response)
                    if(response.trim() == 1){
                        swal("Oops!","Registro eliminado con exito!", "success");
                        getServ(clave);
                    }
                }
            })
          
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