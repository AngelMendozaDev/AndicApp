<?php
    require_once "../../Classes/Admin.php";
    $Model = new Admin();

    /*
    Codigo para guartdar foto, 2021
    */
    $person = $_GET['person'];
    $imagen = file_get_contents("php://input");

    if(strlen($imagen) <= 0) exit("Error de envio, no se recibio ningun paquete");

    $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagen));
 
//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
//todo el contenido lo guardamos en un archivo
$imagenDecodificada = base64_decode($imagenCodificadaLimpia);
 
//Calcular un nombre único
$nombreImagenGuardada = $person . ".png";
$Model->updatePicture($person,$nombreImagenGuardada);
//Escribir el archivo
file_put_contents($nombreImagenGuardada, $imagenDecodificada);

//Terminar y regresar el nombre de la foto
exit($nombreImagenGuardada);
