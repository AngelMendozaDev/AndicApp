<?php

use function PHPSTORM_META\type;

require_once "../classes/funciones.php";
$model = new Procedures();
//print_r($_POST);
//print_r($_GET);

if(isset($_GET['act'])){
    $type = $_GET['act'];
}
else
    $type = $_POST['act'];


switch ($type) {
    case 'C':
        echo $model->setInst($_POST);
        break;
    case 'CS':
        echo $model->setService($_POST);
        break;
    case 'D':
        echo $model->deleteService($_POST['serv']);
        break;
    default:
        echo "Option not aviable";
        break;
}
