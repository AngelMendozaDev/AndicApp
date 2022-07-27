<?php
require_once "header.php";
require_once "classes/funciones.php";
$model = new Procedures();
$result = $model->getPersons();
?>
<link rel="stylesheet" href="static/css/comunity.css">
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

<!-- Modal New/ Update -->
<div class="modal fade" id="ModalControl" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalControlLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalControlLabel">Control de registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" onsubmit="return setPerson()" class="needs-validation" id="form-person">
                    <h5 id="title-form">some</h5>
                    <input type="text" id="person" name="person" hidden>
                    <div class="cont-form">
                        <!-- Parte Info Personal -->
                        <div class="part" id="part-0">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nombre:</span>
                                <input type="text" class="form-control c-mayusc" name="nombre" id="nombre" placeholder="Nombre(s)" maxlength="30" required>
                            </div>
                            <div class="form-flex">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Ap. Paterno:</span>
                                    <input type="text" class="form-control c-mayusc" maxlength="25" placeholder="Apellido Paterno" name="app" id="app" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Ap. Materno:</span>
                                    <input type="text" class="form-control c-mayusc" maxlength="25" placeholder="Apellido Materno" name="apm" id="apm" required>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    &nbsp;
                                    Correo:
                                </span>
                                <input type="email" class="form-control" name="mail" id="mail" placeholder="someMail@andic.org.mx" maxlength="60" required>
                            </div>
                            <div class="form-flex">
                                <div class="input-group h-100 mb-3 cont-sex">
                                    <span class="input-group-text">Sexo:</span>
                                    <div class="sex-group mx-auto">
                                        <input type="radio" name="sex" value="F" class="myCampo" id="sex-f" required>
                                        <label for="sex-f">
                                            <i class="fa fa-female mr-5" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                    <div class="sex-group mx-auto">
                                        <input type="radio" name="sex" value="M" class="myCampo" id="sex-m" required>
                                        <label for="sex-m">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-check" aria-hidden="true"></i>
                                    </span>
                                    <input type="date" class="form-control" name="nacimiento" id="nacimiento" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Número a 10 digitos" required>
                                </div>
                            </div>
                        </div>
                        <!-- Parte de Domicilio -->
                        <div class="part" id="part-1">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Calle:</span>
                                <input type="text" class="form-control" name="calle" id="calle" style="text-transform: uppercase;" maxlength="60" required>
                            </div>
                            <div class="form-flex">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Código Postal:</span>
                                    <input type="text" class="form-control" name="cp" id="cp" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Colonia:</span>
                                    <select name="colonia" id="colonia" class="form-select" required>
                                        <option value="" selected="true" disabled> Selecciona una opcion...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-flex">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Alcaldía:</span>
                                    <input type="text" class="form-control" name="alc" id="alc" readonly required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Estado:</span>
                                    <input type="text" class="form-control" name="edo" id="edo" readonly required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="school-info">
                        <div class="input-groups mb-3">
                            <label for="school-text" class="form-label">Institución educativa:</label>
                            <input class="form-control" list="datalistOptions" id="school-text" placeholder="Type to search...">
                            <datalist id="datalistOptions">
                                <option value="San Francisco">
                                <option value="New York">
                                <option value="Seattle">
                                <option value="Los Angeles">
                                <option value="Chicago">
                            </datalist>
                        </div>

                        <div class="input-groups mb-3">
                            <label for="carrera-text" class="form-label">Carrera:</label>
                            <input class="form-control" list="carrera-options" id="carrera-text" placeholder="Type to search...">
                            <datalist id="carrera-options">
                                <option value="San Francisco">
                                <option value="New York">
                                <option value="Seattle">
                                <option value="Los Angeles">
                                <option value="Chicago">
                            </datalist>
                        </div>

                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected>Selecciona tu grado</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                                <option value="4">4°</option>
                                <option value="5">5°</option>
                                <option value="6">6°</option>
                                <option value="7">7°</option>
                                <option value="8">8°</option>
                                <option value="9">9°</option>
                                <option value="10">10°</option>
                                <option value="11">11°</option>
                                <option value="12">12°</option>
                                <option value="13">13°</option>
                                <option value="14">14°</option>
                                <option value="15">15°</option>
                                <option value="16">16°</option>
                            </select>
                            <label for="floatingSelect">Semestre / Cuatrimestre Cursado</label>
                        </div>
                    </div>
                    <div class="control-form">
                        <button type="submit" class="btn btn-success" id="btn-send">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="closeModal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Image -->
<div class="modal fade" id="pictureModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pictureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pictureModalLabel">Gestor de Imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="image-box">
                    <img src="" alt="" id="imagePerson">
                </div>
                <hr>
                <form method="POST" id="changeImageForm" onsubmit="return setImage()" enctype="multipart/form-data">
                    <input type="text" name="persona" id="folP" hidden>
                    <div class="input-group">
                        <input type="file" name="picture" id="foto" class="form-control" required>
                    </div>
                    <br>
                    <center>
                        <button type="submit" id="btn-foto" class="btn btn-success">
                            <i class="fas fa-sync"></i>
                            &nbsp;
                            Actualizar imagen
                        </button>
                    </center>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

    <?php require_once "footer.php" ?>