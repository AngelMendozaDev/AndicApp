<?php
require_once "header.php";
require_once "classes/funciones.php";
$model = new Procedures();
$result = $model->getActions();
?>

<style>
    .form-flex {
        display: flex;
        width: 100%;
        padding: 10px;
        margin: auto;
        margin-top: 5px;
    }

    .form-flex .input-group {
        margin: 0px 5px 0px 5px;
    }

    @media (max-width:700px) {
        .form-flex {
            display: block;
        }
    }
</style>

<div class="cont-general mb-5">
    <div class="cont-header">
        <center>
            <h3>Gestion de linea del Tiempo</h3>
        </center>
        <div class="alert alert-danger text-center" role="alert" id="my-alert">
            <button type="button" style="background: none; border: none; position: absolute; top: 5px; right: 10px;" onclick="$('#my-alert').remove()">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </button>
            En este apartado podras gestionar la linea del tiempo mostrada en el sitio web
            <br>
            <strong>ANDIC A.C. [Marzo - 2022]</strong>
        </div>
    </div>
    <hr>
    <div class="cont-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalControl">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Nuevo acontecimiento
        </button>
        <hr class="separador">

        <div class="cont-tableas">
            <table class="table table-hover" id="tabla">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>Año</th>
                        <th>Title</th>
                        <th>Media</th>
                        <th>Controles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                    ?>
                            <tr class="text-center">
                                <td><?php echo $data['ano']; ?></td>
                                <td><?php echo $data['titulo']; ?></td>
                                <td><?php echo $data['multimedia']; ?></td>
                                <td>
                                    <button class="btn btn-small btn-primary" data-bs-toggle="modal" data-bs-target="#modalControl" onclick="viewAction('<?php echo $data['id_accion']; ?>')">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>

                                    <button class="btn btn-small btn-warning" onclick="('<?php echo $data['id_accion']; ?>')">
                                        <i class="fas fa-edit    "></i>
                                    </button>

                                    <button class="btn btn-small btn-danger" onclick="('<?php echo $data['id_accion']; ?>')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php
                        } //While
                    } //if
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalControl" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalControlLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalControlLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="myForm">
                    <div class="input-group">
                        <span class="input-group-text">Titúlo:</span>
                        <input type="text" class="form-control" maxlength="60" style="text-transform: uppercase;" required>
                    </div>

                    <div class="form-flex">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Año:</span>
                            <?php
                            $cont = date('Y');
                            ?>
                            <select name="año" id="year" class="form-select" required>
                                <?php while ($cont >= 2000) { ?>
                                    <option value="<?php echo ($cont); ?>"><?php echo ($cont); ?></option>
                                <?php $cont = ($cont - 1);
                                } ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Media</span>
                            <select name="multimedia" id="mult" class="form-select" required>
                                <option value="" selected="true" disabled>--Selecciona una Opción</option>
                                <option value="N">Sin media</option>
                                <option value="I">Imagen</option>
                                <option value="V">Video</option>
                            </select>
                        </div>
                    </div>
                    <div id="lienzo" class="mb-3"></div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="textoArea"></textarea>
                        <label for="textoArea">Descripción de Acción</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php" ?>
<script src="static/js/metas.js"></script>