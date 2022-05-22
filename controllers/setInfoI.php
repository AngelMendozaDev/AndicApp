<?php
    require_once "../classes/funciones.php";
    $model = new Procedures();
    $nameFoto = $_FILES['media']['name'];
    $data = explode(".",$nameFoto);
    
    // print_r($_GET);

    if($_GET['typeAction'] == 'C'){
        echo $model->setAction($_GET);
        $foto = $model->getLastAct() . "." . $data[1];
    }
    else if($_GET['typeAction'] == 'U'){
        echo $model->updateAction($_GET);
        $foto = $_GET['folioAction'] . "." . $data[1];
    }
    
    move_uploaded_file($_FILES['media']['tmp_name'],'../static/media/imgs/'.$foto);
?>