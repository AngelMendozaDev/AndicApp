<?php require_once "header.php"; ?>
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
            En este apartado podras gestionar la comunidad ANDIC, dar de alta, modificar o eliminar el personal
            <br>
            <strong>LUMEGA-MX [Marzo - 2022]</strong>
        </div>
    </div>
    <hr>
    <div class="cont-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalControl">
            Nuevo Registro <i class="fa fa-plus" aria-hidden="true"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="ModalControl" tabindex="-1" aria-labelledby="ModalControlLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalControlLabel">Control de registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" onsubmit="return setInfo()">
                            <h5 id="title-form"></h5>
                            <div class="cont-form">
                                <!-- Parte Info Personal -->
                                <div class="part" id="part-0">
                                    <div class="input-group">
                                        <span class="input-group-text">Nombre:</span>
                                        <input type="text" class="form-control" name="campo-1" required>
                                    </div>
                                </div>
                                <!-- Parte de Domicilio -->
                                <div class="part" id="part-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Apellido Paterno:</span>
                                        <input type="text" class="form-control" name="campo-2" required>
                                    </div>
                                </div>
                                <!-- Parte de Foto -->
                                <div class="part" id="part-2">
                                    <div class="input-group">
                                        <span class="input-group-text">Apellido Materno</span>
                                        <input type="text" class="form-control" name="campo-3" required>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-controllers mt-3 mb-3">
                                <button type="button" id="arrow-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                </button>
                                <button type="button" id="arrow-right">
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </button>
                            </div>
                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cont-footer">

    </div>
</div>

<?php require_once "footer.php" ?>
<script src="static/js/comunity.js"></script>