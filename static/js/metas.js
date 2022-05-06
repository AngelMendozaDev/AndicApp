function viewAction(action){
    $.ajax({
        url:"controllers/getInfo.php",
        type:'POST',
        data:{tipo:"getAction", action},
        success:function(response){
            console.log(response);
        }
    });
}

$(function(){
    $("#tabla").dataTable();
     
    $("#mult").change(function(){
        dato = $('#mult').val();
        $('')
        if(dato == 'I'){
            $('#lienzo').append("<div class='input-group'>"+
                            "<span class='input-group-text'>"+
                                "<i class='fas fa-image'></i>"+
                            "</span>"+
                            "<input type='file' accept='.jpeg, .jpg, .png' class='form-control' name='media' required>"+
                        "</div>");
        }
    });
})