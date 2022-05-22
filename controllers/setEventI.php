<?php
    require_once "../classes/funciones.php";
    $model = new Procedures();

    $nameFoto = $_FILES['picture']['name'];
    $data = explode(".",$nameFoto);

    if($_GET['typeAction'] == 'C'){
        echo $model->setEvent($_GET);
        $foto = $model->getLastEvent() . "." . $data[1];
    }
    else if($_GET['typeAction'] == 'U'){
        echo $model->updateEvent($_GET);
        $foto = $_GET['idEvent'] . "." . $data[1];
    }
    
    move_uploaded_file($_FILES['picture']['tmp_name'],'../static/media/events/'.$foto);
?>