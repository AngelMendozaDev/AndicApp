<?php
require_once "../classes/funciones.php";
$model = new Procedures();

// print_r($_POST);

$Type = $_POST['tipo'];

switch ($Type) {
    case 'getCols':
        echo json_encode($model->getCols($_POST['code']));
        break;
    case 'getAction':
        echo json_encode($model->getAction($_POST['action']));
        break;
    case 'getEvent':
        echo json_encode($model->getEvent($_POST['evento']));
        break;
    case 'getPerson':
        echo json_encode($model->getPerson($_POST['persona']));
        break;
    case 'getImage':
        echo json_encode($model->getImage($_POST['person']));
        break;
    default:
        echo "error";
        break;
}
