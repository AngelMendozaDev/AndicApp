<?php
require_once "../classes/funciones.php";
$model = new Procedures();
$nameFoto = $_FILES['picture']['name'];
$data = explode(".", $nameFoto);

$foto = $_GET['persona'] . "." . $data[1];
echo $model->setImage($foto,$_GET['persona']);



move_uploaded_file($_FILES['picture']['tmp_name'], '../static/media/pictures/' . $foto);
