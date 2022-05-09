<?php
    require_once "../classes/funciones.php";
    $model = new Procedures();
    $nameFoto = $_FILES['media']['name'];
    $data = explode(".",$nameFoto);
    $foto = $model->getLastAct()+1 .".". $data[1];
    move_uploaded_file($_FILES['media']['tmp_name'],'../static/media/pictures/'.$foto);
    echo $model->setAction($_GET);
?>