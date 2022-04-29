let cont = 0;
$(function(){
    $('.part').attr('hidden',true);
    $('#part-0').attr('hidden',false);

    $('#arrow-left').click(function(){
        if(cont > 0){
            cont--;
            $('.part').attr('hidden',true);
            $('#part-'+cont).attr('hidden',false);
        }
        else{
            $('.part').attr('hidden',true);
            $('#part-0').attr('hidden',false);
        }
    });

    $('#arrow-right').click(function(){
        if(cont < 2){
            cont++;
            $('.part').attr('hidden',true);
            $('#part-'+cont).attr('hidden',false);
        }
        else{
            $('.part').attr('hidden',true);
            $('#part-2').attr('hidden',false);
        }
    });
});