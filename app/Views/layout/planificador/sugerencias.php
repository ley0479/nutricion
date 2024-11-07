<div class="content-wrapper">
    <br>
    <section class="content-header text-center">
        <h2>Busqueda de Recetas</h2>
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
        <p>La función de Búsqueda de Recetas te facilita a encontrar
            recetas basadas en ingredientes específicos que deseen utilizar. Al ingresar un
            ingrediente en el formulario de búsqueda, obtendrás una lista de recetas que
            lo incorporan, junto con detalles sobre las calorías y la información nutricional de cada receta.
            Esta herramienta es especialmente valiosa para la busqueda de inspiración culinaria y si deseas
            descubrir nuevas formas de utilizar ingredientes que ya tienes a mano, optimizando así su cocina diaria.</p>
    </div>
    <br>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Profile Update Form -->
                <div class="box box-primary">
                    <form id="search-form">
                        <div class="form-group">
                            <label for="ingrediente">Buscar por Ingrediente</label>
                            <input type="text" class="form-control" id="ingrediente" name="ingrediente"
                                placeholder="Ej. Pollo, arroz, etc.">
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                    <hr>
                    <div id="loader" class="text-center" style="display: none;">
                        <img src="https://i.gifer.com/ZZ5H.gif" alt="Cargando..." style="width: 50px;">
                        <p>Cargando busqueda...</p>
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
    $('#search-form').submit(function(event) {
        event.preventDefault();

        let ingrediente = $('#ingrediente').val();
        $.ajax({
            url: '<?= base_url('recetas-buscar_recetas') ?>',
            type: 'POST',
            data: {
                ingrediente: ingrediente
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
                    resultadosHtml += '<h3>Resultados de busqueda:</h3><div class="row">';
                    recetas.forEach(function(receta) {
                        resultadosHtml += '<div class="col-md-4">';
                        resultadosHtml += '<div class="card mb-4">';
                        resultadosHtml += '<img src="' + receta.recipe.image +
                            '" class="card-img-top" alt="' + receta.recipe.label +
                            '">';
                        resultadosHtml += '<div class="card-body">';
                        resultadosHtml += '<h5 class="card-title">' + receta.recipe
                            .label + '</h5>';
                        resultadosHtml += '<p class="card-text">Calorías: ' + Math
                            .round(receta.recipe.calories) + '</p>';

                        if (receta.nutrition.totalNutrients) {
                            resultadosHtml += '<ul class="list-unstyled">';
                            $.each(receta.nutrition.totalNutrients, function(
                                nutriente, info) {
                                resultadosHtml += '<li><strong>' + info
                                    .label + ':</strong> ' + Math.round(info
                                        .quantity, 2) + ' ' + info.unit +
                                    '</li>';
                            });
                            resultadosHtml += '</ul>';
                        }

                        resultadosHtml += '<a href="' + receta.recipe.url +
                            '" class="btn btn-primary" target="_blank">Ver Receta</a>';
                        resultadosHtml += '</div></div></div>';
                    });
                    resultadosHtml += '</div>';
                } else {
                    resultadosHtml =
                        '<p>No se encontraron recetas para el ingrediente seleccionado.</p>';
                }

                $('#resultados').html(resultadosHtml);
            },
            error: function() {
                $('#loader').hide();
                $('#resultados').html(
                    '<p>Ocurrió un error al cargar las recomendaciones.</p>');
            }
        });
    });
});
</script>