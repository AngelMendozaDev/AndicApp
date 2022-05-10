<?php
    require_once "../classes/funciones.php";
    $model = new Procedures();

    print_r($_POST);
    if($_POST['typeAction'] == 'C')
        echo ($model->setAction($_POST));
    else if($_POST['typeAction'] == 'U')
        echo ($model->updateAction($_POST));

?>