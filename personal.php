<?php
require_once "header.php";
require_once "classes/funciones.php";
$model = new Procedures();
$result = $model->getPersons();
?>
<link rel="stylesheet" href="static/css/comunity.css">

<div class="cont-general">
    <div class="cont-header">
        <center>
            <h3>Gestion de comunidad</h3>
        </center>
        <div class="alert alert-danger text-center" role="alert" id="my-alert">
            <button type="button" style="background: none; border: none; position: absolute; top: 5px; right: 10px;" onclick="$('#my-alert').remove()">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </button>
            En este apartado podras gestionar la comunidad ANDIC, dar de alta, modificar o eliminar la Comunidad
            <br>
            <strong>LUMEGA-MX [Marzo - 2022]</strong>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalControl" onclick="prepareForm()">
            Nuevo Registro <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </div>
    <hr>
    <div class="cont-body" style="overflow-y: scroll;">
        <div class="table-box">
            <table class="table table-hover table-bordered table-responsive" id="myTable">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>Nombre(s)</th>
                        <th>App</th>
                        <th>Apm</th>
                        <th>Sex</th>
                        <th>Mail</th>
                        <th>Foto</th>
                        <th>Controles</th>
                    </tr>
                </thead>
                <tbody class="bodyMyTable">
                    <?php while ($data = $result->fetch_assoc()) { ?>
                        <tr class="text-center">
                            <td><?php echo $data['nombre'] ?></td>
                            <td><?php echo $data['app'] ?></td>
                            <td><?php echo $data['apm'] ?></td>
                            <td><?php echo $data['sexo'] ?></td>
                            <td><?php echo $data['correo'] ?></td>
                            <td>
                                <img src="static/media/pictures/<?php echo $data['picture'] ?>" class="table-picture" alt="">
                            </td>
                            <td>
                                <button class="btn btn-info btn-small" data-bs-toggle="modal" data-bs-target="#pictureModal" onclick="getImage(<?php echo $data['id_p'] ?>)">
                                    <i class="fas fa-image"></i>
                                </button>

                                <button class="btn btn-primary btn-small" data-bs-toggle="modal" data-bs-target="#ModalControl" onclick="getInfo('v','<?php echo $data['id_p'] ?>')">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>

                                <button class="btn btn-warning btn-small" data-bs-toggle="modal" data-bs-target="#ModalControl" onclick="getInfo('e','<?php echo $data['id_p']  ?>')">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>

                                <button class="btn btn-danger btn-small" onclick="deletePerson('<?php echo $data['id_p'] ?>')">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Número a 10 digitos" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
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
                                    <input type="text" class="form-control" maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="cp" id="cp" required>
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
</div>
<?php require_once "footer.php" ?>
<script src="static/js/personal.js"></script>