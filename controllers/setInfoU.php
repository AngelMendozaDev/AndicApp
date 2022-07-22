<?php

use function PHPSTORM_META\type;

    require_once "../classes/funciones.php";
    $model = new Procedures();

    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTWXYZ0123456789';
    $long = 10;
    $pass = substr(str_shuffle($caracteres),0,$long);

    $type = explode("-",$_POST['person']);
    
    if($type[0] == 'e'){
        $data = array(
            "name" => strtoupper($_POST['nombre']),
            "app" => strtoupper($_POST['app']),
            "apm" => strtoupper($_POST['apm']),
            "mail" => $_POST['mail'],
            "sex" => $_POST['sex'],
            "date" => $_POST['nacimiento'],
            "phone" => $_POST['phone'],
            "street" => strtoupper($_POST['calle']),
            "cp" => $_POST['colonia'],
            "person" => $type[1]
        );
        echo $model->updatePerson($data);
    }
    else if($type[0] == 'c'){
        $data = array(
            "name" => strtoupper($_POST['nombre']),
            "app" => strtoupper($_POST['app']),
            "apm" => strtoupper($_POST['apm']),
            "mail" => $_POST['mail'],
            "sex" => $_POST['sex'],
            "date" => $_POST['nacimiento'],
            "phone" => $_POST['phone'],
            "street" => strtoupper($_POST['calle']),
            "cp" => $_POST['colonia'],
            "pass" => $pass,
            "perfil" => '1'
        );
        echo $model->setPerson($data);
    }
    else if($type[0] == 'd'){
        echo $model->deletePerson($type[1]);
    }
?>