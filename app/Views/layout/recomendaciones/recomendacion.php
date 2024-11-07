<div class="content-wrapper">
    <br>
    <section class="content-header text-center">
        <h2>Recomendaciones de Recetas</h2>
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
        <p>Estas Son las Recomendaciones de Acuerdo a
            Tus Condiciones ofrece asesoramiento específico basado en las condiciones de salud
            individuales del usuario, tales como diabetes, hipertensión o alergias alimentarias.
            Al ingresar información relevante sobre tu estado de salud y condiciones médicas,
            recibirás recomendaciones adaptadas que incluyen alimentos recomendados,
            restricciones dietéticas y pautas para una alimentación adecuada.
            Esta herramienta es especialmente útil para quienes necesitan ajustar su dieta
            para manejar condiciones de salud particulares y mejorar su bienestar general a través de una nutrición
            adecuada.</p>
    </div>
    <br>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-primary">
                    <h3>Estas son las recomendaciones de acuerdo a tus condiciones:</h3>

                    <ul>
                        <li><strong>Condiciones Médicas:</strong> <?= esc($condiciones['condiciones_medicas']) ?></li>
                        <li><strong>Alergias:</strong> <?= esc($condiciones['alergias']) ?></li>
                        <li><strong>Intolerancias:</strong> <?= esc($condiciones['intolerancias']) ?></li>
                        <li><strong>Tipo de Dieta:</strong> <?= esc($condiciones['tipo_dieta']) ?></li>
                    </ul>
                    <hr>
                    <div id="loader" class="text-center" style="display: none;">
                        <img src="https://i.gifer.com/ZZ5H.gif" alt="Cargando..." style="width: 50px;">
                        <p>Cargando recomendaciones...</p>
                    </div>
                    <div id="resultados" class="mt-4"></div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let userId = <?= $userId ?>; // Asegúrate de pasar el ID del usuario desde el backend

    $.ajax({
        url: '<?= base_url('recetas-recomendaciones-nutricionales') ?>',
        type: 'GET',
        data: {
            user_id: userId
        },
        beforeSend: function() {
            // Mostrar el loader antes de enviar la solicitud
            $('#loader').show();
            $('#resultados').html('');
        },
        success: function(response) {
            $('#loader').hide();

            let recetas = response.recetas;
            let resultadosHtml = '';

            if (recetas.length > 0) {
                resultadosHtml += '<h3>Resultados de recomendaciones:</h3><div class="row">';
                recetas.forEach(function(receta) {
                    resultadosHtml += '<div class="col-md-4">';
                    resultadosHtml += '<div class="card mb-4">';
                    resultadosHtml += '<img src="' + receta.recipe.image +
                        '" class="card-img-top" alt="' + receta.recipe.label + '">';
                    resultadosHtml += '<div class="card-body">';
                    resultadosHtml += '<h5 class="card-title">' + receta.recipe.label +
                        '</h5>';
                    resultadosHtml += '<p class="card-text">Calorías: ' + Math.round(receta
                        .recipe.calories) + '</p>';

                    if (receta.nutrition.totalNutrients) {
                        resultadosHtml += '<ul class="list-unstyled">';
                        $.each(receta.nutrition.totalNutrients, function(nutriente, info) {
                            resultadosHtml += '<li><strong>' + info.label +
                                ':</strong> ' + Math.round(info.quantity, 2) + ' ' +
                                info.unit + '</li>';
                        });
                        resultadosHtml += '</ul>';
                    }

                    resultadosHtml += '<a href="' + receta.recipe.url +
                        '" class="btn btn-primary" target="_blank">Ver Receta</a>';
                    resultadosHtml += '</div></div></div>';
                });
                resultadosHtml += '</div>';
            } else {
                resultadosHtml = '<p>No se encontraron recetas para el perfil del usuario.</p>';
            }

            $('#resultados').html(resultadosHtml);
        },
        error: function() {
            $('#loader').hide();
            $('#resultados').html('<p>Ocurrió un error al cargar las recomendaciones.</p>');
        }
    });
});
</script>