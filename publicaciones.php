<?php require_once "header.php" ?>
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
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalControl" onclick="startForm()">
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
                                    <button class="btn btn-small btn-primary" data-bs-toggle="modal" data-bs-target="#modalControl" onclick="viewAction('<?php echo $data['id_accion']; ?>','V')">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                            
                                    <button class="btn btn-small btn-warning" data-bs-toggle="modal" data-bs-target="#modalControl" onclick="viewAction('<?php echo $data['id_accion']; ?>', 'U')">
                                        <i class="fas fa-edit    "></i>
                                    </button>

                                    <button class="btn btn-small btn-danger" onclick="deleteAction('acciones','<?php echo $data['id_accion']; ?>')">
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
<?php require_once "footer.php" ?>