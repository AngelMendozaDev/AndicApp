function log_in(){
    $.ajax({
        url:'controllers/log.php',
        type:'POST',
        data:$('#form-log').serialize(),
        success: function(response){
            console.log(response);
            if(response.trim() == 1){
                location.href = "main.php";
            }
            else if(response.trim() == -1){
                swal("Usuario / Contraseña erroneos","verifica las credenciales e intente de nuevo","info");
            }
            else if(response.trim() ==  "err"){
                swal("Conexión perdida!!!","verifica tu conexión", "error");
            }
        }
    });
    return false;
}