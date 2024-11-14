<div class="content-wrapper">
    <br>
    <section class="content-header text-center">
        <h2>Búsqueda de Recetas</h2>
    </section>
    <br>
    <p style="text-align: justify;">
        La Información de Alimentos permite realizar una búsqueda basada en calorías diarias,
        mostrando una lista de recetas junto con su contenido calórico. Cada receta incluye
        su nombre y la cantidad precisa de calorías que aporta.
    </p>
    <hr>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-primary">
                    <form id="form-buscar-recetas">
                        <div class="form-group">
                            <label for="calorias_diarias">Ingrese las calorías diarias:</label>
                            <input type="number" id="calorias_diarias" class="form-control" placeholder="Ejemplo: 2000">
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar Recetas</button>
                    </form>
                    <hr>
                    <div id="loader" class="text-center" style="display: none;">
                        <img src="https://i.gifer.com/ZZ5H.gif" alt="Cargando..." style="width: 50px;">
                        <p>Cargando búsqueda...</p>
                    </div>
                    <div id="resultado-recetas" style="display: none;">
                        <div class="row" id="lista-recetas"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Búsqueda de recetas por calorías
        $('#form-buscar-recetas').on('submit', function(e) {
            e.preventDefault();

            let calorias_diarias = $('#calorias_diarias').val();

            if (calorias_diarias === '') {
                alert('Por favor, ingrese las calorías diarias.');
                return;
            }

            $.ajax({
                url: '<?= base_url("informacion-nutricional-buscarAlimento") ?>',
                type: 'POST',
                data: {
                    calorias_diarias: calorias_diarias
                },
                dataType: 'json',
                beforeSend: function() {
                    // Mostrar el loader antes de enviar la solicitud
                    $('#loader').show();
                    $('#resultado-recetas').hide();
                    $('#lista-recetas').empty();
                },
                success: function(response) {
                    $('#loader').hide();
                    if (response.success) {
                        $('#lista-recetas').empty();
                        let recetasFiltradas = response.recetas.filter(function(receta) {
                            return receta.recipe.calories <= parseFloat(calorias_diarias);
                        });

                        if (recetasFiltradas.length > 0) {
                            $.each(recetasFiltradas, function(index, receta) {
                                $('#lista-recetas').append(`
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <img class="card-img-top" src="${receta.recipe.image}" alt="${receta.recipe.label}" style="height: 150px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title">${receta.recipe.label}</h5>
                                                <p class="card-text">Calorías: ${receta.recipe.calories.toFixed(2)} kcal</p>
                                                <a href="${receta.recipe.url}" target="_blank" class="btn btn-sm btn-info">Ver receta</a>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            });
                            $('#resultado-recetas').show();
                        } else {
                            $('#resultado-recetas').html('<p>No se encontraron recetas con las calorías especificadas.</p>').show();
                        }
                    } else {
                        $('#resultado-recetas').html('<p>' + response.message + '</p>').show();
                    }
                },
                error: function() {
                    $('#loader').hide();
                    $('#resultado-recetas').html('<p>Ocurrió un error al intentar buscar las recetas.</p>').show();
                }
            });
        });
    });
</script>