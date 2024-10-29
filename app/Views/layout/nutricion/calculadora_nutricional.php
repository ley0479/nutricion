<div class="content-wrapper">
    <br>
    <section class="content-header text-center">
        <h2>Búsqueda de Información Nutricional de Recetas</h2>
    </section>
    <br>
    <hr>
    <p style="text-align: justify;">La Calculadora Nutricional ofrece a los usuarios la capacidad de calcular
        y analizar la información nutricional de las recetas en función de los ingredientes
        que ingresen. Al proporcionar un ingrediente específico, puedes recibir
        detalles completos sobre las recetas que lo contienen, incluyendo datos como el
        contenido de calorías, proteínas, grasas y carbohidratos. Esta herramienta es
        ideal si buscas mejorar su dieta y ajustar tus comidas para cumplir
        con tus objetivos nutricionales específicos, facilitando así una alimentación más consciente y saludable.</p>
    <hr>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-primary">
                    <!-- Formulario para ingresar los ingredientes -->
                    <form id="form-buscar-recetas" method="post">
                        <div class="form-group">
                            <label for="ingrediente">Ingrese un ingrediente:</label>
                            <input type="text" class="form-control" id="ingrediente" name="ingrediente" placeholder="Ej: pollo, arroz, carne de res, pescado etc.">
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar Recetas</button>

                    </form>
                    <hr>
                    <!-- Contenedor del loader -->
                    <div id="loader" class="text-center" style="display: none;">
                        <img src="https://i.gifer.com/ZZ5H.gif" alt="Cargando..." style="width: 50px;">
                        <p>Cargando búsqueda...</p>
                    </div>
                    <!-- Mostrar el resultado de la búsqueda -->
                    <div id="resultado-recetas" style="display: none; margin-top: 20px;">
                        <div class="row" id="lista-recetas">
                            <!-- Las recetas se mostrarán aquí -->
                        </div>
                    </div>
                    <!-- Mensaje de error -->
                    <div id="mensaje-error" class="text-center" style="display: none; margin-top: 20px;">
                        <p id="error-texto"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Estilos personalizados -->
<style>
    .receta-card {
        border: 2px solid;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
    }

    .receta-card img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .receta-card:nth-child(1) {
        border-color: #ff5733;
        /* Rojo */
    }

    .receta-card:nth-child(2) {
        border-color: #33c4ff;
        /* Azul */
    }

    .receta-card:nth-child(3) {
        border-color: #33ff8e;
        /* Verde */
    }

    /* Haz que las tarjetas ocupen 1/3 del ancho en pantallas grandes, y se ajusten a 1/2 o 1/1 en pantallas más pequeñas */
    @media (min-width: 768px) {
        .receta-col {
            flex: 0 0 33.3333%;
            max-width: 33.3333%;
        }
    }

    @media (max-width: 767.98px) {
        .receta-col {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 575.98px) {
        .receta-col {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#form-buscar-recetas').on('submit', function(e) {
            e.preventDefault();

            let ingrediente = $('#ingrediente').val();

            if (ingrediente === '') {
                alert('Por favor, ingrese un ingrediente.');
                return;
            }

            $.ajax({
                url: '<?= base_url("/calculadora-nutricional-informacionReceta") ?>', // Ruta al controlador de búsqueda de recetas
                type: 'POST',
                data: {
                    ingrediente: ingrediente
                },
                dataType: 'json',
                beforeSend: function() {
                    // Mostrar el loader antes de enviar la solicitud
                    $('#loader').show();
                    $('#resultado-recetas').hide();
                    $('#mensaje-error').hide();
                    $('#lista-recetas').html('');
                },
                success: function(response) {
                    $('#loader').hide();
                    if (response.recetas.length > 0) {
                        $('#lista-recetas').empty();
                        // Verifica si hay información nutricional disponible
                        response.recetas.forEach(function(receta) {
                            let recetaHTML = '';

                            if (receta.recipe.totalNutrients) {
                                let nutrients = receta.recipe.totalNutrients;

                                recetaHTML = `
                                    <div class="col receta-col">
                                        <div class="receta-card">
                                            <img src="${receta.recipe.image}" alt="Imagen de ${receta.recipe.label}">
                                            <strong>${receta.recipe.label}</strong><br>
                                            Calorías: ${receta.recipe.calories.toFixed(2)} kcal<br>
                                            Proteínas: ${(nutrients.PROCNT ? nutrients.PROCNT.quantity.toFixed(2) : 'N/A')} g<br>
                                            Grasas: ${(nutrients.FAT ? nutrients.FAT.quantity.toFixed(2) : 'N/A')} g<br>
                                            Carbohidratos: ${(nutrients.CHOCDF ? nutrients.CHOCDF.quantity.toFixed(2) : 'N/A')} g<br>
                                        </div>
                                    </div>`;
                            } else {
                                recetaHTML = `
                                    <div class="col receta-col">
                                        <div class="receta-card">
                                            <img src="${receta.recipe.image}" alt="Imagen de ${receta.recipe.label}">
                                            <strong>${receta.recipe.label}</strong><br>
                                            Calorías: ${receta.recipe.calories.toFixed(2)} kcal<br>
                                            Información nutricional no disponible<br>
                                        </div>
                                    </div>`;
                            }

                            $('#lista-recetas').append(recetaHTML);
                        });

                        $('#resultado-recetas').show();
                    } else {
                        $('#mensaje-error').show();
                        $('#error-texto').text('No se encontraron recetas para el ingrediente ingresado.');
                    }
                },
                error: function() {
                    $('#loader').hide();
                    $('#mensaje-error').show();
                    $('#error-texto').text('Ocurrió un error al intentar buscar las recetas.');
                }
            });
        });
    });
</script>