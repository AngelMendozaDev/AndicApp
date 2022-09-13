<?php
require_once "header.php";
require_once "classes/funciones.php";
$model = new Procedures();
$res = $model->getInstituciones();
?>
<link rel="stylesheet" href="static/css/convenios.css">

<div class="cont-general">
    <div class="cont-header">
        <center>
            <h3>Gestion de Convenios</h3>
        </center>
        <div class="alert alert-danger text-center" role="alert" id="my-alert">
            <button type="button" style="background: none; border: none; position: absolute; top: 5px; right: 10px;" onclick="$('#my-alert').remove()">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </button>
            En este apartado podras gestionar los convenios con instituciones educativas para realizar Servicio Social y/o practicas profecionales, asi mismo puede ser usado como
            directorio de contacto de las instituciones.
            <br>
            <strong>LUMEGA-MX [Agosto - 2022]</strong>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAlta" onclick="prepareForm()">
            Nuevo Registro <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </div>
    <hr>
    <div class="cont-body h-100" style="overflow-y: scroll; overflow-x: scroll;">
        <table class="table table-hover table-responsive">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Clave</th>
                    <th>Nombre Institución</th>
                    <th>Representante</th>
                    <th>Telefono</th>
                    <th>Controles</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = $res->fetch_assoc()) { ?>
                    <tr class="text-center">
                        <td><?php echo $data['clave'] ?></td>
                        <td><?php echo $data['nombre_ins'] ?></td>
                        <td><?php echo $data['sub'] ?></td>
                        <td><?php echo $data['phone'] ?></td>
                        <td>
                            <button class="btn btn-primary btn-small pop-cont" data-bs-toggle="modal" data-bs-target="#modalAlta" onclick="getInst('<?php echo $data['clave'] ?>')">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="my-popover">Ver registro</span>
                            </button>
                            <button class="btn btn-info btn-small pop-cont" data-bs-toggle="modal" data-bs-target="#modalServices" onclick="getServ('<?php echo $data['clave'] ?>')">
                                <i class="fa fa-list-ul" aria-hidden="true"></i>
                                <span class="my-popover">Servicios</span>
                            </button>
                            <button class="btn btn-warning btn-small">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-danger btn-small">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal new-view-edit -->
<div class="modal fade" id="modalAlta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAltaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAltaLabel">Control de contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-inst" onsubmit="return setInfo()">
                    <div class="input-group mb-3">
                        <span class="input-group-text">CCT / RFC</span>
                        <input type="text" class="form-control mayus" placeholder="Ingresa el CCT o el RFC de la institución..." maxlength="18" name="clave" id="clave" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Institución:</span>
                        <input type="text" class="form-control mayus" placeholder="Nombre Institución" maxlength="70" name="name_ins" id="name_ins" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Tipo de Institución:</span>
                        <select name="tipo_ins" id="tipo_ins" class="form-select mayus">
                            <option value="" selected="true" disabled>Selecciona una Opcción</option>
                            <option value="1">Institución Educativa</option>
                            <option value="2">Institución Publica</option>
                            <option value="3">Institución Privada</option>
                            <option value="4">ONG (organización no gubernamental)</option>
                            <option value="5">Pime (Pequeña o Mediana Esmpresa)</option>
                            <option value="6">Free Lancer</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Director:</span>
                        <input type="text" class="form-control mayus" placeholder="Nombre del lider" maxlength="30" name="jefe" id="jefe" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Representante:</span>
                        <input type="text" class="form-control mayus" placeholder="¿Con quien te dirigiras?" maxlength="30" name="repre" id="repre" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Telefono de contacto:</span>
                        <input type="number" class="form-control" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="phone" id="phone" required>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control mayus" placeholder="Leave a comment here" id="floatingTextarea2" name="dir" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Direccion de la institución:</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="switchServices">
                        <label class="form-check-label" for="switchServices">Contiene Carreras o Servicios especificos</label>
                    </div>
                    <hr>

                    <div id="lienzo">
                        <!-- Aqui se muestran las carreras -->
                    </div>

                    <hr>
                    <center>
                        <button type="submit" class="btn btn-success" id="btn-sendData">
                            <i class="fa fa-save" aria-hidden="true"></i>
                            &nbsp;
                            Guardar Registro
                        </button>
                    </center>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Servicios -->
<div class="modal fade" id="modalServices" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalServicesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalServicesLabel">Control de Servicios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-g">
                    <center>
                        <h5>Servicios que ofrece</h5>
                    </center>
                    <hr width="80%" style="margin: auto;">
                    <br>
                    <button type="button" class="btn btn-primary" id="btn-new" onclick="newServ()">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo
                    </button>
                    <form method="POST" onsubmit="return newService()" id="service-form">
                        <input type="text" name="act" id="acction" readonly hidden>
                        <input type="text" name="clave" id="clave-I" readonly>
                        <div class="input-group">
                            <span class="input-group-text"> Servicio que ofrece: </span>
                            <input type="text" name="serv-v" id="serv-v" class="form-control" placeholder="Ej. Desarrollo de pagina Web" maxlength="60" required>
                            <button class="btn btn-success" id="btn-services">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Agregar Servicio
                            </button>
                        </div>
                    </form>

                </div>
                <div class="cont-table mt-5">
                    <table class="table table-hover table-responsive table-bordered">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th>institución</th>
                                <th>Servicio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="lienzo-table">
                            <tr class="text-center">
                                <td>16106699</td>
                                <td>Desarrollo de Paginas Web</td>
                                <td>
                                    <button class="btn btn-warning btn-small">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-small">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php" ?>
<script src="static/js/convenios.js"></script>