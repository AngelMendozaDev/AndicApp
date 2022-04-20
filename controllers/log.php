<?php
session_start();
require_once "../classes/funciones.php";
$model = new Procedures();

$data = $model->login($_POST['user'], $_POST['pass']);
if ($data != -1) {
    $data = $data->fetch_assoc();
    if ($data['perfil'] == 1) {
        $_SESSION['ID'] = $data['id_p'];
        $_SESSION['Name'] = $data['nombre'] . " " . $data['app'];
        echo 1;
    } else
        echo -2;
} else
    echo $data;
