<?php
require_once "../classes/funciones.php";
$model = new Procedures();

$Type = $_POST['tipo'];

switch($Type){
    case 'getCols':
        print_r(json_encode($model->getCols($_POST['code'])));
        break;

    default:
        echo "error";
        break;
}

?>