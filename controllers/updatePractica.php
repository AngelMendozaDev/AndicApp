<?php
require_once "../classes/funciones.php";
$model = new Procedures();

//print_r($_POST);
echo($model->aceptado($_POST));

?>