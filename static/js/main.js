function log_in(){
    $.ajax({
        url:'controllers/log.php',
        type:'POST',
        data:$('#form-log').serialize(),
        success: function(response){
            console.log(response);
        }
    });
    return false;
}

$(function(){
    console.log("jQuery it´s Working");
})