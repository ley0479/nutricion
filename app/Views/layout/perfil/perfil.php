<div class="content-wrapper">
    <br>
    <section class="content-header text-center">
        <h3>Perfil de usuario - Actualizar</h3>
    </section>
    <br>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Profile Update Form -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" action="<?= base_url('perfil/actualizar') ?>" method="post">
                        <div class="box-body">
                            <!-- Datos Personales -->
                            <fieldset>
                                <legend>Datos Personales</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            placeholder=" Juan" value="<?= esc($user['nombre']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                                            placeholder=" Pérez López" value="<?= esc($user['apellidos']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder=" juan.perez@mail.com" value="<?= esc($user['email']) ?>"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Deja en blanco si no deseas cambiarla">
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Información Física -->
                            <fieldset>
                                <legend>Información Física</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="edad">Edad</label>
                                        <input type="number" class="form-control" id="edad" name="edad"
                                            placeholder=" 25" value="<?= esc($user['edad']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="peso">Peso (kg)</label>
                                        <input type="number" class="form-control" id="peso" name="peso"
                                            placeholder=" 70" value="<?= esc($user['peso']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="altura">Altura (cm)</label>
                                        <input type="number" class="form-control" id="altura" name="altura"
                                            placeholder=" 175" value="<?= esc($user['altura']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="genero">Género</label>
                                        <select class="form-control" id="genero" name="genero" required>
                                            <option value="masculino"
                                                <?= $user['genero'] == 'masculino' ? 'selected' : '' ?>>Masculino
                                            </option>
                                            <option value="femenino"
                                                <?= $user['genero'] == 'femenino' ? 'selected' : '' ?>>Femenino</option>
                                            <option value="otro" <?= $user['genero'] == 'otro' ? 'selected' : '' ?>>Otro
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nivel_actividad">Nivel de Actividad Física</label>
                                        <select class="form-control" id="nivel_actividad" name="nivel_actividad"
                                            required>
                                            <option value="bajo"
                                                <?= $user['nivel_actividad'] == 'bajo' ? 'selected' : '' ?>>Bajo
                                            </option>
                                            <option value="moderado"
                                                <?= $user['nivel_actividad'] == 'moderado' ? 'selected' : '' ?>>Moderado
                                            </option>
                                            <option value="alto"
                                                <?= $user['nivel_actividad'] == 'alto' ? 'selected' : '' ?>>Alto
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Objetivos y Requerimientos -->
                            <fieldset>
                                <legend>Objetivos y Requerimientos</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="objetivo_salud">Objetivo de Salud</label>
                                        <select class="form-control" id="objetivo_salud" name="objetivo_salud" required
                                            onchange="toggleOtroObjetivo()">
                                            <option value="bajar peso"
                                                <?= $user['objetivo_salud'] == 'bajar peso' ? 'selected' : '' ?>>Bajar
                                                de Peso</option>
                                            <option value="aumentar musculo"
                                                <?= $user['objetivo_salud'] == 'aumentar musculo' ? 'selected' : '' ?>>
                                                Aumentar Masa Muscular</option>
                                            <option value="mantener salud"
                                                <?= $user['objetivo_salud'] == 'mantener salud' ? 'selected' : '' ?>>
                                                Mantener Salud</option>
                                            <option value="otro"
                                                <?= $user['objetivo_salud'] == 'otro' ? 'selected' : '' ?>>Otro</option>
                                        </select>
                                        <div class="form-group mt-2">
                                            <label for="otro_objetivo">Especifica</label>
                                            <input type="text" class="form-control" id="otro_objetivo"
                                                name="otro_objetivo" placeholder=" Especifica tu objetivo"
                                                value="<?= esc($user['otro_objetivo']) ?>"
                                                <?= $user['objetivo_salud'] != 'otro' ? 'style="display:none;"' : '' ?>>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="calorias_diarias">Calorías Diarias</label>
                                        <input type="number" class="form-control" id="calorias_diarias"
                                            name="calorias_diarias" placeholder="2000"
                                            value="<?= esc($user['calorias_diarias']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="carbohidratos_diarios">Carbohidratos Diarios (g)</label>
                                        <input type="number" class="form-control" id="carbohidratos_diarios"
                                            name="carbohidratos_diarios" placeholder="250"
                                            value="<?= esc($user['carbohidratos_diarios']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="proteinas_diarias">Proteínas Diarias (g)</label>
                                        <input type="number" class="form-control" id="proteinas_diarias"
                                            name="proteinas_diarias" placeholder="150"
                                            value="<?= esc($user['proteinas_diarias']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="grasas_diarias">Grasas Diarias (g)</label>
                                        <input type="number" class="form-control" id="grasas_diarias"
                                            name="grasas_diarias" placeholder="70"
                                            value="<?= esc($user['grasas_diarias']) ?>" required>
                                    </div>

                                </div>
                            </fieldset>

                            <!-- Condiciones Médicas, Alergias, Intolerancias y Dietas -->
                            <fieldset>
                                <legend>Condiciones Médicas y Dietas</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="condiciones_medicas">Condiciones Médicas</label>
                                        <select class="form-control" id="condiciones_medicas" name="condiciones_medicas"
                                            onchange="toggleDescripcionYCampo(this, 'otro_condicion', 'desc_condiciones_medicas', 'condiciones')">
                                            <option value="">Selecciona una opción</option>
                                            <option value="diabetes"
                                                <?= $user['condiciones_medicas'] == 'diabetes' ? 'selected' : '' ?>>
                                                Diabetes</option>
                                            <option value="hipertension"
                                                <?= $user['condiciones_medicas'] == 'hipertension' ? 'selected' : '' ?>>
                                                Hipertensión</option>
                                            <option value="asma"
                                                <?= $user['condiciones_medicas'] == 'asma' ? 'selected' : '' ?>>Asma
                                            </option>
                                            <option value="otro"
                                                <?= $user['condiciones_medicas'] == 'otro' ? 'selected' : '' ?>>Otro
                                            </option>
                                        </select>
                                        <input type="text" class="form-control mt-2" id="otro_condicion"
                                            name="otro_condicion" placeholder="Especifica"
                                            value="<?= esc($user['otro_condicion']) ?>"
                                            <?= $user['condiciones_medicas'] != 'otro' ? 'style="display:none;"' : '' ?>>

                                        <small id="desc_condiciones_medicas" class="form-text text-muted">
                                            <?= $user['condiciones_medicas'] == 'diabetes' ? 'Diabetes: Trastorno que afecta la forma en que el cuerpo utiliza el azúcar en sangre.' : '' ?>
                                            <?= $user['condiciones_medicas'] == 'hipertension' ? 'Hipertensión: Condición en la que la presión arterial es demasiado alta.' : '' ?>
                                            <?= $user['condiciones_medicas'] == 'asma' ? 'Asma: Enfermedad que causa dificultad para respirar debido a la inflamación de las vías respiratorias.' : '' ?>
                                            <?= $user['condiciones_medicas'] == 'otro' ? 'Otro: Especifica tu condición médica.' : '' ?>
                                        </small>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="alergias">Alergias</label>
                                        <select class="form-control" id="alergias" name="alergias"
                                            onchange="toggleDescripcionYCampo(this, 'otro_alergia', 'desc_alergias', 'alergias')">
                                            <option value="">Selecciona una opción</option>
                                            <option value="penicilina"
                                                <?= $user['alergias'] == 'penicilina' ? 'selected' : '' ?>>Penicilina
                                            </option>
                                            <option value="pollen"
                                                <?= $user['alergias'] == 'pollen' ? 'selected' : '' ?>>Pólen</option>
                                            <option value="mariscos"
                                                <?= $user['alergias'] == 'mariscos' ? 'selected' : '' ?>>Mariscos
                                            </option>
                                            <option value="otro" <?= $user['alergias'] == 'otro' ? 'selected' : '' ?>>
                                                Otro</option>
                                        </select>
                                        <input type="text" class="form-control mt-2" id="otro_alergia"
                                            name="otro_alergia" placeholder="Especifica"
                                            value="<?= esc($user['otro_alergia']) ?>"
                                            <?= $user['alergias'] != 'otro' ? 'style="display:none;"' : '' ?>>

                                        <small id="desc_alergias" class="form-text text-muted">
                                            <?= $user['alergias'] == 'penicilina' ? 'Penicilina: Antibiótico que puede causar reacciones alérgicas en algunas personas.' : '' ?>
                                            <?= $user['alergias'] == 'pollen' ? 'Pólen: Puede causar alergias estacionales o rinitis alérgica.' : '' ?>
                                            <?= $user['alergias'] == 'mariscos' ? 'Mariscos: Puede causar reacciones alérgicas graves en algunas personas.' : '' ?>
                                            <?= $user['alergias'] == 'otro' ? 'Otro: Especifica tu alergia.' : '' ?>
                                        </small>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="intolerancias">Intolerancias</label>
                                        <select class="form-control" id="intolerancias" name="intolerancias"
                                            onchange="toggleDescripcionYCampo(this, 'otra_intolerancia', 'desc_intolerancias', 'intolerancias')">
                                            <option value="">Selecciona una opción</option>
                                            <option value="lactosa"
                                                <?= $user['intolerancias'] == 'lactosa' ? 'selected' : '' ?>>Lactosa
                                            </option>
                                            <option value="gluten"
                                                <?= $user['intolerancias'] == 'gluten' ? 'selected' : '' ?>>Gluten
                                            </option>
                                            <option value="fructosa"
                                                <?= $user['intolerancias'] == 'fructosa' ? 'selected' : '' ?>>Fructosa
                                            </option>
                                            <option value="otro"
                                                <?= $user['intolerancias'] == 'otro' ? 'selected' : '' ?>>Otro</option>
                                        </select>
                                        <input type="text" class="form-control mt-2" id="otra_intolerancia"
                                            name="otra_intolerancia" placeholder="Especifica"
                                            value="<?= esc($user['otra_intolerancia']) ?>"
                                            <?= $user['intolerancias'] != 'otro' ? 'style="display:none;"' : '' ?>>

                                        <small id="desc_intolerancias" class="form-text text-muted">
                                            <?= $user['intolerancias'] == 'lactosa' ? 'Lactosa: Azúcar presente en la leche y productos lácteos que puede causar molestias.' : '' ?>
                                            <?= $user['intolerancias'] == 'gluten' ? 'Gluten: Proteína en el trigo, cebada y centeno que puede causar problemas digestivos.' : '' ?>
                                            <?= $user['intolerancias'] == 'fructosa' ? 'Fructosa: Azúcar en frutas y algunos alimentos procesados que puede causar malestar.' : '' ?>
                                            <?= $user['intolerancias'] == 'otro' ? 'Otro: Especifica tu intolerancia.' : '' ?>
                                        </small>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="tipo_dieta">Tipo de Dieta</label>
                                        <select class="form-control" id="tipo_dieta" name="tipo_dieta"
                                            onchange="toggleDescripcionYCampo(this, 'otra_dieta', 'desc_tipo_dieta', 'tipo_dieta')">
                                            <option value="">Selecciona una opción</option>
                                            <option value="vegetariana"
                                                <?= $user['tipo_dieta'] == 'vegetariana' ? 'selected' : '' ?>>
                                                Vegetariana</option>
                                            <option value="vegana"
                                                <?= $user['tipo_dieta'] == 'vegana' ? 'selected' : '' ?>>Vegana</option>
                                            <option value="cetogenica"
                                                <?= $user['tipo_dieta'] == 'cetogenica' ? 'selected' : '' ?>>Cetogénica
                                            </option>
                                            <option value="omnívora"
                                                <?= $user['tipo_dieta'] == 'omnívora' ? 'selected' : '' ?>>Omnívora
                                            </option>
                                            <option value="otro" <?= $user['tipo_dieta'] == 'otro' ? 'selected' : '' ?>>
                                                Otro</option>
                                        </select>
                                        <input type="text" class="form-control mt-2" id="otra_dieta" name="otra_dieta"
                                            placeholder="Especifica" value="<?= esc($user['otra_dieta']) ?>"
                                            <?= $user['tipo_dieta'] != 'otro' ? 'style="display:none;"' : '' ?>>

                                        <small id="desc_tipo_dieta" class="form-text text-muted">
                                            <?= $user['tipo_dieta'] == 'vegetariana' ? 'Vegetariana: Dieta que excluye carne y pescado.' : '' ?>
                                            <?= $user['tipo_dieta'] == 'vegana' ? 'Vegana: Dieta que excluye todos los productos de origen animal.' : '' ?>
                                            <?= $user['tipo_dieta'] == 'cetogenica' ? 'Cetogénica: Dieta alta en grasas y baja en carbohidratos.' : '' ?>
                                            <?= $user['tipo_dieta'] == 'omnívora' ? 'Omnívora: Dieta que incluye carne, pescado, vegetales y otros alimentos.' : '' ?>
                                            <?= $user['tipo_dieta'] == 'otro' ? 'Otro: Especifica tu tipo de dieta.' : '' ?>
                                        </small>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>
</div>
<script>
function toggleOtro(selectId, inputId) {
    var selectElement = document.getElementById(selectId);
    var inputElement = document.getElementById(inputId);

    if (selectElement.value === "otro") {
        inputElement.style.display = "block";
    } else {
        inputElement.style.display = "none";
    }
}

function toggleOtroObjetivo() {
    const objetivoSalud = document.getElementById('objetivo_salud').value;
    document.getElementById('otro_objetivo').style.display = objetivoSalud === 'otro' ? 'block' : 'none';
}

function toggleDescripcionYCampo(selectElement, inputId, descId, category) {
    let inputField = document.getElementById(inputId);
    let descField = document.getElementById(descId);
    if (selectElement.value === 'otro') {
        inputField.style.display = 'block';
    } else {
        inputField.style.display = 'none';
        inputField.value = ''; // Clear the input field if not 'otro'
    }

    switch (selectElement.value) {
        case 'diabetes':
            descField.innerHTML =
                'Diabetes: Trastorno que afecta la forma en que el cuerpo utiliza el azúcar en sangre.';
            break;
        case 'hipertension':
            descField.innerHTML = 'Hipertensión: Condición en la que la presión arterial es demasiado alta.';
            break;
        case 'asma':
            descField.innerHTML =
                'Asma: Enfermedad que causa dificultad para respirar debido a la inflamación de las vías respiratorias.';
            break;
        case 'penicilina':
            descField.innerHTML = 'Penicilina: Antibiótico que puede causar reacciones alérgicas en algunas personas.';
            break;
        case 'pollen':
            descField.innerHTML = 'Pólen: Puede causar alergias estacionales o rinitis alérgica.';
            break;
        case 'mariscos':
            descField.innerHTML = 'Mariscos: Puede causar reacciones alérgicas graves en algunas personas.';
            break;
        case 'lactosa':
            descField.innerHTML =
                'Lactosa: Azúcar presente en la leche y productos lácteos que puede causar molestias.';
            break;
        case 'gluten':
            descField.innerHTML =
                'Gluten: Proteína en el trigo, cebada y centeno que puede causar problemas digestivos.';
            break;
        case 'fructosa':
            descField.innerHTML =
                'Fructosa: Azúcar en frutas y algunos alimentos procesados que puede causar malestar.';
            break;
        case 'vegetariana':
            descField.innerHTML = 'Vegetariana: Dieta que excluye carne y pescado.';
            break;
        case 'vegana':
            descField.innerHTML = 'Vegana: Dieta que excluye todos los productos de origen animal.';
            break;
        case 'cetogenica':
            descField.innerHTML = 'Cetogénica: Dieta alta en grasas y baja en carbohidratos.';
            break;
        case 'omnívora':
            descField.innerHTML = 'Omnívora: Dieta que incluye carne, pescado, vegetales y otros alimentos.';
            break;
        default:
            descField.innerHTML = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    let selects = document.querySelectorAll('select');
    selects.forEach(function(select) {
        toggleDescripcionYCampo(select, select.nextElementSibling.id, select.nextElementSibling
            .nextElementSibling.id, select.id);
    });
});
</script>
<style>
/* Centrar el formulario */
.content-wrapper .row {
    display: flex;
    justify-content: center;
}

/* Añadir margen y fondo al contenedor del formulario */
.box {
    border: 1px solid #ccc;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
    border-radius: 8px;
}

/* Centrar los títulos */
.box-header,
.content-header {
    text-align: center;
}

/* Margen superior para que el formulario no esté pegado al título */
.content {
    margin-top: 20px;
}
</style>