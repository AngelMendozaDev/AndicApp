<?php 
    require_once "../classes/funciones.php";
    $model = new Procedures();

    $tbl = $_POST['tbl'];
    if($tbl == 'acciones')
        echo $model->deleteRegister($_POST);
    

?>