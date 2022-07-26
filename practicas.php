<?php
require_once "header.php";
require_once "classes/funciones.php";
$model = new Procedures();
$result = $model->getPersons();
?>

<link rel="stylesheet" href="static/css/practicas.css">

<div class="cont-general">
    <div class="cont-header">
        <center>
            <h3>Servicio Social y Practicas</h3>
        </center>
        <div class="alert alert-danger text-center" role="alert" id="my-alert">
            <button type="button" style="background: none; border: none; position: absolute; top: 5px; right: 10px;" onclick="$('#my-alert').remove()">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </button>
            En este apartado podras gestionar la comunidad ANDIC, que realizara practicas o Servicio Social, dar de alta, modificar o eliminar la comunidad
            <br>
            <strong>LUMEGA-MX [Julio - 2022]</strong>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalControl" onclick="prepareForm()">
            Nuevo Proceso <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </div>
    <hr>
</div>
<div class="Tablero">
    <div class="columna">
        <div class="header-colum">
            <h3>Solicitudes</h3>
        </div>
        <div class="body-colum">
            <div class="tarjeta-alumno" id="">
                <span class="name-al">LUIS ANGEL MENDOZA GARCIA</span>
                <p>
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <span class="escuela">TecNM Tláhuac</span>
                </p>
                <p>
                    <span class="carrera">Ingenieria en Sistemas Computacionales [8°]</span>
                </p>
                <p class="proyect">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque, hic!</p>

                <div class="controls">
                    <button class="btn btn-outline-success btn-small">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-small">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="columna">
        <div class="header-colum">
            <h3>Aceptados</h3>
        </div>
        <div class="body-colum">
            <div class="tarjeta-alumno" id="">
                <h1>persona</h1>
            </div>
        </div>
    </div>
    <div class="columna">
        <div class="header-colum">
            <h3>Trabajando</h3>
        </div>
        <div class="body-colum">
            <div class="tarjeta-alumno" id="">
                <h1>persona</h1>
            </div>
        </div>
    </div>
    <div class="columna">
        <div class="header-colum">
            <h3>Liberados</h3>
        </div>
        <div class="body-colum">
            <div class="tarjeta-alumno" id="">
                <h1>persona</h1>
            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php" ?>