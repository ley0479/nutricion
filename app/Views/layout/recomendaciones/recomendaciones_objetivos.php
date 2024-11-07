<div class="content-wrapper">
    <br>
    <section class="content-header text-center">
        <h2>Recomendaciones Nutricionales Según Tus Objetivos</h2>
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
        <p> La sección de Recomendaciones Nutricionales Según Tus Objetivos
            proporciona asesoramiento personalizado basado en los objetivos específicos,
            como perder peso, ganar masa muscular o mantener un estilo de vida saludable. Al ingresar detalles
            sobre tus metas y necesidades nutricionales, la herramienta genera recomendaciones adaptadas,
            incluyendo sugerencias de alimentos, proporciones de macronutrientes y calorías diarias recomendadas.
            Esta funcionalidad es ideal para quienes buscan orientación profesional para alcanzar sus metas de
            salud y bienestar de manera efectiva y sostenible.
        </p>
    </div>
    <br>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-primary">
                    <h3>Tus Objetivos y Requerimientos:</h3>
                    <ul>
                        <li><strong>Objetivo de Salud:</strong> <?= esc($objetivos['objetivo_salud']) ?></li>
                        <li><strong>Calorías Diarias:</strong> <?= esc($objetivos['calorias_diarias']) ?> kcal</li>
                        <li><strong>Carbohidratos Diarios:</strong> <?= esc($objetivos['carbohidratos_diarios']) ?> g
                        </li>
                        <li><strong>Proteínas Diarias:</strong> <?= esc($objetivos['proteinas_diarias']) ?> g</li>
                        <li><strong>Grasas Diarias:</strong> <?= esc($objetivos['grasas_diarias']) ?> g</li>
                    </ul>
                    <hr>
                    <div id="loader" class="text-center" style="display: none;">
                        <img src="https://i.gifer.com/ZZ5H.gif" alt="Cargando..." style="width: 50px;">
                        <p>Cargando recomendaciones...</p>
                    </div>
                    <!-- Div para mostrar recomendaciones -->
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

    // Realiza la solicitud AJAX para obtener las recomendaciones según los objetivos
    $.ajax({
        url: '<?= base_url('recetas-recomendaciones-por-objetivos') ?>',
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
                resultadosHtml += '<h2>Resultados:</h2><div class="row">';
                recetas.forEach(function(receta) {
                    resultadosHtml += '<div class="col-md-4">';
                    resultadosHtml += '<div class="card mb-4">';
                    resultadosHtml += '<img src="' + receta.image +
                        '" class="card-img-top" alt="' + receta.label + '">';
                    resultadosHtml += '<div class="card-body">';
                    resultadosHtml += '<h5 class="card-title">' + receta.label + '</h5>';
                    resultadosHtml += '<p class="card-text">Calorías: ' + Math.round(receta
                        .nutrition.calories) + '</p>';

                    if (receta.nutrition.totalNutrients) {
                        resultadosHtml += '<ul class="list-unstyled">';
                        $.each(receta.nutrition.totalNutrients, function(nutriente, info) {
                            resultadosHtml += '<li><strong>' + info.label +
                                ':</strong> ' + Math.round(info.quantity, 2) + ' ' +
                                info.unit + '</li>';
                        });
                        resultadosHtml += '</ul>';
                    }

                    resultadosHtml += '<a href="' + receta.url +
                        '" class="btn btn-primary" target="_blank">Ver Receta</a>';
                    resultadosHtml += '</div></div></div>';
                });
                resultadosHtml += '</div>';
            } else {
                resultadosHtml = '<p>No se encontraron recetas para tus objetivos.</p>';
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