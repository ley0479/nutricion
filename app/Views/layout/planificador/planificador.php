<div class="content-wrapper">
    <br>
    <section class="content-header text-center">
        <h2>Planificador de Comidas</h2>
    </section>
    <br>
    <style>
    .contenedor {
        width: 100%;
        max-width: 800px;
        /* Ajusta el ancho máximo del contenedor según tus necesidades */
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #253544;
        color: white;
        text-align: justify;
        border-radius: 25px;

    }

    p {
        text-align: justify;
    }
    </style>
    <hr>

    <div class="contenedor">
        <p>El Planificador de Comidas es una herramienta diseñada para ayudarte a organizar
            y planificar tus comidas diarias de manera eficiente...</p>
    </div>
    <br>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-primary">
                    <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('errors') ?>
                    </div>
                    <?php endif; ?>

                    <form method="post" action="<?= base_url('planificador/guardar_planificacion') ?>">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Día</th>
                                    <th>Desayuno</th>
                                    <th>Almuerzo</th>
                                    <th>Cena</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dias_semana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                                foreach ($dias_semana as $dia) :
                                    $desayuno = $planificacion[$dia]['desayuno'] ?? '';
                                    $almuerzo = $planificacion[$dia]['almuerzo'] ?? '';
                                    $cena = $planificacion[$dia]['cena'] ?? '';
                                ?>
                                <tr>
                                    <td><?= $dia ?></td>
                                    <td><input type="text" class="form-control"
                                            name="planificacion[<?= $dia ?>][desayuno]" value="<?= $desayuno ?>"></td>
                                    <td><input type="text" class="form-control"
                                            name="planificacion[<?= $dia ?>][almuerzo]" value="<?= $almuerzo ?>"></td>
                                    <td><input type="text" class="form-control" name="planificacion[<?= $dia ?>][cena]"
                                            value="<?= $cena ?>"></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Guardar Planificación</button>
                    </form>
                </div>

                <br>
                <h3>Planificación de Comidas</h3>
                <div class="row">
                    <?php foreach ($planificacion as $dia => $comidas): ?>
                    <?php if (!empty($comidas['desayuno']) || !empty($comidas['almuerzo']) || !empty($comidas['cena'])): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $comidas['dia'] ?></h5>
                                <p class="card-text">
                                    <strong>Desayuno:</strong><?= htmlspecialchars($comidas['desayuno'] ?? '') ?><br>
                                    <strong>Almuerzo:</strong> <?= htmlspecialchars($comidas['almuerzo'] ?? '') ?><br>
                                    <strong>Cena:</strong> <?= htmlspecialchars($comidas['cena'] ?? '') ?><br>
                                    <strong>Fecha de
                                        Creación:</strong><?= htmlspecialchars($comidas['creado_en'] ?? '') ?>
                                </p>
                                <button class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal<?= $comidas['dia'] ?>">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                                <a href="<?= base_url('planificador/eliminar/' . $comidas['user_id'] . '/' . $comidas['dia'] . '/' . $comidas['id']) ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta planificación?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modal<?= $comidas['dia'] ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: dodgerblue; color:aliceblue;">
                                    <h5 class="modal-title">Detalles de la Planificación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Día:</strong> <?= $comidas['id'] ?></p>
                                    <p><strong>Desayuno:</strong> <?= htmlspecialchars($comidas['desayuno'] ?? '') ?>
                                    </p>
                                    <p><strong>Almuerzo:</strong> <?= htmlspecialchars($comidas['almuerzo'] ?? '') ?>
                                    </p>
                                    <p><strong>Cena:</strong> <?= htmlspecialchars($comidas['cena'] ?? '') ?></p>
                                    <p><strong>Fecha de Creación:</strong>
                                        <?= htmlspecialchars($comidas['creado_en'] ?? '') ?></p>
                                    <p><strong>¿Realizado?:</strong> <?= !empty($comidas['realizado']) ? 'Sí' : 'No' ?>
                                    </p>
                                    <!-- Guardar si cumplio con la planificacion -->
                                    <form method="post"
                                        action="<?= base_url('planificador/marcar_realizado/' . $comidas['id']) ?>">
                                        <input type="hidden" name="dia" value="<?= $comidas['dia']?>">
                                        <div class="form-group">
                                            <label for="realizado">¿Realizado?</label>
                                            <select name="realizado" class="form-control">
                                                <option value="0" <?= empty($comidas['realizado']) ? 'selected' : '' ?>>
                                                    No</option>
                                                <option value=" 1"
                                                    <?= !empty($comidas['realizado']) ? 'selected' : '' ?>>Sí
                                                </option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    // Puedes inicializar cualquier funcionalidad adicional aquí
});
</script>