<?php

use function PHPSTORM_META\type;

require_once "../classes/funciones.php";
$model = new Procedures();

$caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTWXYZ0123456789';
$long = 10;
$pass = substr(str_shuffle($caracteres), 0, $long);

$type = explode("-", $_POST['person']);

if ($type[0] == 'e') {
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
} else if ($type[0] == 'c') {
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
        "perfil" => '2'
    );
    $res = $model->setPerson($data);
    $to = $data['mail'];
    $message = "<style>".
        "body {".
            "background-color: #2874A6;".
        "}".
    
        "img {".
            "border-radius: 10px;".
        "}".
    
        ".cabecera-box {".
            "display: flex;".
            "align-items: center;".
            "align-self: center;".
        "}".
    
        ".container {".
            "width: 800px;".
            "padding: 10px;".
        "}".
    
        "#btn {".
            "padding: 10px;".
            "border-radius: 5px;".
            "border: 2px solid rgba(0, 0, 0, 0.5);".
            "background: #229954;".
            "text-decoration: none;".
            "color: white;".
        "}".
    
        "#btn:hover {".
            "background: rgba(34, 153, 84, 0.5);".
            "text-decoration: underline;".
            "color: white;".
            "transition: all 1.5s;".
        "}".
    "</style>".
    
    "<div class='container'>".
        "<div class='cabecera-box'>".
            "<img src='https://app.andic.org.mx/static/media/icons/Logo.png' width='100px' alt='ANDIC A.C. Logo'>".
            "<h1>Bienvenido a la gran familia ANDIC A.C.</h1>".
        "</div>".
        "<h2>Hola</h2>".
        "<center>".
            "<h2>".$data['name']. " " .$data['app']."</h2>".
        "</center>".
    
        "<p>".
            "Confirmamos tu registro a la plataforma ANDIC A.C.".
        "</p>".
        "<h3>".$to."</h3>".
        "<p>Contraseña asignada:</p>".
        "<h3>".$data['pass']."</h3>".
        "<a href='https://app.andic.org.mx/' target='_blank' id='btn'>".
            "Iniciar Sesión".
        "</a>".
    "</div>";

    $cabeceras = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $cabeceras .= 'From: Andic A.C.';

    if($res == 1)
        $enviado = mail($to, "Confirmación de Registro", $message, $cabeceras);
    
    echo $res;

} else if ($type[0] == 'd') {
    echo $model->deletePerson($type[1]);
}
