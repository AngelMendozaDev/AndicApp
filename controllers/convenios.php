<?php

use function PHPSTORM_META\type;

    require_once "../classes/funciones.php";
    $model = new Procedures();
    //print_r($_POST);
    //print_r($_GET);

    $type= $_GET['act'];
    
    switch($type){
        case 'C':
            echo $model->setInst($_POST);
            break;
    }
