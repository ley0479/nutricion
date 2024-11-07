<div class="content-wrapper">
    <br>
    <section class="content-header text-center">
        <h2>Registro de Progreso de Salud</h2>
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
    }

    p {
        text-align: justify;
    }
    </style>
    <hr>

    <div class="contenedor">
        <p>El Registro de Progreso de Salud es una funcionalidad que
            te permite monitorear y registrar tus avances en relación con tus objetivos de salud y bienestar.
            A través de este registro, puedes documentar y seguir indicadores clave como peso, medidas corporales,
            niveles de actividad física y métricas de salud relevantes. La herramienta proporciona gráficos
            en el modulo de "Gráfico" para ayudarte a visualizar tu progreso a lo largo del tiempo, identificar
            patrones y ajustar tus hábitos según sea necesario. Esta función es esencial para evaluar
            la efectividad de tus esfuerzos en salud y hacer ajustes informados a tu plan de bienestar.
        </p>
    </div>
    <br>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Profile Update Form -->
                <div class="box box-primary">
                    <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                    <?php endif; ?>

                    <!-- Mostrar errores si existen -->
                    <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('errors') ?>

                    </div>
                    <?php endif; ?>

                    <form action="<?= base_url('seguimiento/guardar') ?>" method="post">
                        <div class="form-group">
                            <label for="peso">Peso (kg)</label>
                            <input type="text" class="form-control" id="peso" name="peso" placeholder="65" required>
                        </div>
                        <div class="form-group">
                            <label for="grasa_corporal">Grasa Corporal (%)</label>
                            <input type="text" class="form-control" id="grasa_corporal" placeholder="24.9%"
                                name="grasa_corporal" required>
                        </div>
                        <div class="form-group">
                            <label for="masa_muscular">Masa Muscular (%)</label>
                            <input type="text" class="form-control" id="masa_muscular" placeholder="19.2"
                                name="masa_muscular" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Progreso</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>