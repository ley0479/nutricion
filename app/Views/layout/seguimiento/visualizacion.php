<div class="content-wrapper">
    <br>
    <section class="content-header text-center">
        <h2>Visualización Progreso de Peso</h2>
    </section>
    <br>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Gráfico de Progreso -->
                <div class="box box-primary">
                    <canvas id="chartPeso" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <hr>
        <br><br>
        <!-- Tabla de Progreso -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <!-- Mostrar errores si existen -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-align: center;">Histórico de Progreso</h3>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaProgreso" class="table table-striped display" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de Registro</th>
                                    <th>Peso (kg)</th>
                                    <th>Grasa Corporal (%)</th>
                                    <th>Masa Muscular (kg)</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datosProgresoRestantes as $dato): ?>
                                    <tr>
                                        <td><?= $dato['id'] ?></td>
                                        <td><?= $dato['fecha_registro'] ?></td>
                                        <td><?= $dato['peso'] ?></td>
                                        <td><?= $dato['grasa_corporal'] ?></td>
                                        <td><?= $dato['masa_muscular'] ?></td>
                                        <td>
                                            <!-- Formulario para eliminar el registro -->
                                            <form action="<?= base_url('eliminar-progreso') ?>" method="POST" style="display:inline;">
                                                <input type="hidden" name="user_id" value="<?= $dato['user_id'] ?>">
                                                <input type="hidden" name="fecha_registro" value="<?= $dato['fecha_registro'] ?>">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts de Bootstrap y DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> -->

<script>
    $(document).ready(function() {
        // Inicializar la gráfica
        var ctx = document.getElementById('chartPeso').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($fechas) ?>,
                datasets: [{
                    label: 'Progreso de Peso',
                    data: <?= json_encode($pesos) ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Peso (kg)'
                        }
                    }
                }
            }
        });

        // Inicializar DataTable con orden descendente
        $('#tablaProgreso').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es_es.json'
            },
            columnDefs: [{
                    className: "text-center",
                    targets: [5] // Alineación de la columna de acciones
                },
                {
                    className: "text-left",
                    targets: [0, 1, 2, 3, 4] // Alineación de las demás columnas
                }
            ],
            order: [
                [1, 'desc'] // Ordenar por la segunda columna (Fecha de Registro) en orden descendente
            ]
        });
    });
</script>
</body>

</html>