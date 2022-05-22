<?php
require_once "header.php";
require_once "classes/funciones.php";
$model = new Procedures();
$result = $model->getEvents();
?>

<div class="cont-general mb-5">
    <div class="cont-header">
        <center>
            <h3>Gestion de publicacion pagina principal</h3>
        </center>
        <div class="alert alert-danger text-center" role="alert" id="my-alert">
            <button type="button" style="background: none; border: none; position: absolute; top: 5px; right: 10px;" onclick="$('#my-alert').remove()">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </button>
            En este apartado podras gestionar los eventos
            <br>
            <strong>ANDIC A.C. [Marzo - 2022]</strong>
        </div>
    </div>
    <hr>
    <div class="cont-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalControl" onclick="startForm('C')">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Nuevo Evento
        </button>
        <hr class="separador">

        <div class="cont-tableas">
            <table class="table table-hover" id="tabla">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>Fecha</th>
                        <th>Titúlo</th>
                        <th>Imagen</th>
                        <th>Controles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                    ?>
                            <tr class="text-center">
                                <td><?php echo $data['fecha_inicio']; ?></td>
                                <td><?php echo $data['titulo']; ?></td>
                                <td>
                                    <div class="img-box">
                                        <img src="static/media/events/<?php echo $data['foto']; ?>" width="50px">
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-small btn-primary" data-bs-toggle="modal" data-bs-target="#modalControl" onclick="getEvent('<?php echo $data['id_evento']; ?>','V')">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>

                                    <button class="btn btn-small btn-warning" data-bs-toggle="modal" data-bs-target="#modalControl" onclick="getEvent('<?php echo $data['id_evento']; ?>', 'U')">
                                        <i class="fas fa-edit    "></i>
                                    </button>

                                    <button class="btn btn-small btn-danger" onclick="deleteEvent('evento','<?php echo $data['id_evento']; ?>')">
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
                <h5 class="modal-title" id="modalControlLabel">Control Eventos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" onsubmit="return setEvent()" enctype="multipart/form-data" id="form-event">
                    <input type="text" name="typeAction" id="typeAction" hidden readonly>
                    <input type="text" name="idEvent" id="idEvent" hidden readonly>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Titúlo:</span>
                        <input type="text" name="titleEvent" id="titleEvent" class="form-control" maxlength="40" style="text-transform: uppercase;" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            Fecha Inicio:
                        </span>
                        <input type="datetime-local" name="dateStart" id="dateStart" class="form-control" required>
                    </div>

                    <div class="form-floating mb-2 mt-2">
                        <textarea class="form-control" name="horario" id="horario" placeholder="Leave a comment here" id="textHorario" style="height: 80px" required></textarea>
                        <label for="textHorario">Horario <i class="far fa-clock"></i> </label>
                    </div>

                    <div class="input-group mb-3" id="lienzo">
                        <input type="file" class="form-control" name="picture" id="picture" required>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="textEvent" id="textEvent" placeholder="Leave a comment here" id="etxtEvent" style="height: 100px" required></textarea>
                        <label for="etxtEvent">Descripción del evento.</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" name="register" type="checkbox" id="registerControl">
                        <label class="form-check-label" for="registerControl">Requiere registro Interno</label>
                    </div>

                    <center>
                        <button type="submit" class="btn btn-success mt-3 mb-2">
                            <i class="fa fa-save" aria-hidden="true"></i>
                            &nbsp;
                            Guardar Evento
                        </button>
                    </center>

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
<script src="static/js/eventos.js"></script>