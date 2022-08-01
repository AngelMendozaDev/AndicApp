<?php
require_once "../classes/funciones.php";
$model = new Procedures();

//print_r($_POST);
$headers = "From: pablomonteserin@pablomonteserin.com\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";

$mensaje = "<style>
body{
    background-color: #2874A6;
}

img{
    border-radius: 10px;
}

.cabecera-box{
    display: flex;
    align-items: center;
    align-self: center;
}

.container{
    width: 800px;
    padding: 10px;
}

#btn{
    padding: 10px;
    border-radius: 5px;
    border: 2px solid rgba(0,0,0,0.5);
    background: #229954;
    text-decoration: none;
    color: white;
}

#btn:hover{
    background: rgba(34, 153, 84,0.5);
    text-decoration: underline;
    color: white;
    transition: all 1.5s;
}
</style>

<div class='container'>
    <div class='cabecera-box'>
        <img src='data:image/jpeg;base64,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' alt=''>
    <h1>Bienvenido a la gran familia ANDIC A.C.</h1>
    </div>
    <h2>Hola</h2>
    <center>
        <h2>LUIS ANGEL MENDOZA GARCIA</h2>
    </center>

    <p>
        Confirmamos tu registro a la plataforma ANDIC A.C.
    </p>
    <h3>miMail@someMail.com</h3>
    <p>Contraseña asignada:</p>
    <h3>Password</h3>
    <a href='https://app.andic.org.mx/' target='_blank' id='btn'>
        Iniciar Sesión
    </a>
</div>";

mail($_POST['mail'], "CONFIRMACIÓN DE REGISTRO", $mensaje, $headers);

echo $model->newResidente($_POST);
