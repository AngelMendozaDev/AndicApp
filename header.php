<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header("location:index.php");
}
require_once "classes/funciones.php";
$model = new Procedures();
$foto = $model->getPicture($_SESSION['ID']);
$picture =  $foto != -1 ? $foto : "NO_DATA.png";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="static/media/icons/Logo.png">
    <link rel="stylesheet" href="static/libs/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/libs/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="static/libs/datatable/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="static/libs/datatable/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="static/css/plant.css">
</head>

<body>
    <header class="menu-sup">
        <div class="left-cont">
            <h5>
                <label for="status" style="cursor: pointer;"><i class="fa fa-bars menu-icon" aria-hidden="true"></i></label>
                &nbsp;
                <span class="nameUs"><?php echo $_SESSION['Name'] ?></span>
            </h5>
        </div>
        <div class="right-cont">
            <ul class="options">
                <li>
                    <a href="main.php" class="my-btns-circle">
                        <i class="fa fa-home icons-menub" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="" class="my-btns-circle">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                    </a>
                </li>
                <li id="more-opt">
                    <a class="my-btns-circle">
                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </a>
                    <div id="lienzo-opt"></div>
                </li>
            </ul>
        </div>
    </header>

    <div class="slide-menu" id="slide-menu">
        <input type="checkbox" id="status" hidden>
        <label for="status" class="close-controller"><i class="fa fa-times-circle" aria-hidden="true"></i></label>
        <div class="slide-header mt-5 mb-2">
            <div class="img-box">
                <img src="static/media/pictures/<?php echo $picture ?>">
            </div>
            <center>
                <h5 class="name-user"><?php echo $_SESSION['Name'] ?></h5>
            </center>
        </div>
        <hr class="separador">
        <div class="slide-body mt-5 mb-3">
            <div class="accordion accordion-flush" id="accordionOptions">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            &nbsp;
                            Comunidad Andic
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionOptions">
                        <ul class="sub-menu">
                            <li class="option">
                                <a href="comunity.php">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    &nbsp;
                                    Comunidad
                                </a>
                            </li>
                            <li class="option">
                                <a href="practicas.php">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    &nbsp;
                                    Servicio / Practicas
                                </a>
                            </li>
                            <li class="option">
                                <a href="personal.php">
                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                    &nbsp;
                                    Personal
                                </a>
                            </li>
                            <li class="option">
                                <a href="convenios.php">
                                    <i class="fa fa-address-book" aria-hidden="true"></i>
                                    &nbsp;
                                    Convenios
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            &nbsp;
                            Eventos
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionOptions">
                        <ul class="sub-menu">
                            <li class="option">
                                <a href="eventos.php">
                                    <i class="fas fa-calendar-plus"></i>
                                    &nbsp;
                                    Gestionar Eventos
                                </a>
                            </li>
                            <li class="option">
                                <a href="evtIns.php">
                                    <i class="fas fa-address-card"></i>
                                    &nbsp;
                                    Inscripciones
                                </a>
                            </li>
                            <li class="option">
                                <a href="">
                                    <i class="fas fa-address-book"></i>
                                    &nbsp;
                                    Control de asistencias
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            &nbsp;
                            Controles de Pagina
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionOptions">
                        <ul class="sub-menu">
                            <li class="option">
                                <a href="metas.php">
                                    <i class="fas fa-calendar-plus"></i>
                                    &nbsp;
                                    Linea temporal
                                </a>
                            </li>
                            <!-- <li class="option">
                                <a href="">
                                    <i class="fab fa-xbox    "></i>
                                    optionx
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <center>
                <a class="btn btn-danger btn-block w-50 mt-5 mb-5" href="controllers/close.php">
                    Cerrar Sesión
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
            </center>
        </div>
        <div class="slide-foot mt-5">
            <h6 class="foot-slide">Sistema ANDIC A.C. realizado por <a class="importante" href="https://lumega-mx.com" target="_blank">LUMEGA-MX ESTUDIOS</a> Mayo 2022</h6>
        </div>
    </div>