// Función para cargar las preguntas del tópico seleccionado
function cargarPreguntas() {
    var idTopico = document.getElementById("ID_Topico").value;
    var tableBody = document.getElementById("preguntasTableBody");
    tableBody.innerHTML = ''; // Limpiar las preguntas previas

    // Enviar la solicitud POST con fetch
    fetch('../../Controlador/GET/getPreguntasPorTopico.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'idTopico=' + encodeURIComponent(idTopico)
    })
    .then(function(response) {
        return response.json(); // Parsear la respuesta como JSON
    })
    .then(function(preguntas) {
        if (preguntas.error) {
            console.error('Error en la respuesta del servidor:', preguntas.error);
            tableBody.innerHTML = '<tr><td colspan="2">' + preguntas.error + '</td></tr>';
            return;
        }

        // Generar las filas con las preguntas y opciones
        preguntas.forEach(function(pregunta) {
            var row = document.createElement("tr");
            var cellPregunta = document.createElement("td");
            var cellOpciones = document.createElement("td");

            // Asignar el texto de la pregunta
            cellPregunta.textContent = pregunta.Nombre_Pregunta;

            // Generar las opciones de radio buttons
            var opciones = ['No Aplica', 'Nada Satisfecho', 'Poco Satisfecho', 'Neutral', 'Muy Satisfecho', 'Totalmente Satisfecho'];
            opciones.forEach(function(opcion) {
                var label = document.createElement("label");
                var radio = document.createElement("input");
                radio.type = "radio";
                radio.name = "pregunta_" + pregunta.ID_Pregunta; // El nombre debe ser único para cada pregunta
                radio.value = opcion;
                radio.required = true; // Marcar el radio como requerido para validación

                // Adjuntar elementos
                label.appendChild(radio);
                label.appendChild(document.createTextNode(" " + opcion + " ")); // Añadir espacio
                cellOpciones.appendChild(label);
                cellOpciones.appendChild(document.createElement("br")); // Añadir salto de línea entre opciones
            });

            // Agregar celdas a la fila
            row.appendChild(cellPregunta);
            row.appendChild(cellOpciones);
            tableBody.appendChild(row);
        });
    })
    .catch(function(error) {
        console.error('Error al cargar las preguntas:', error);
        tableBody.innerHTML = '<tr><td colspan="2">Ocurrió un error al cargar las preguntas.</td></tr>';
    });
}

// Función para enviar el formulario con las respuestas seleccionadas
function enviarFormulario() {
    var respuestas = {};
    var inputs = document.querySelectorAll('input[type="radio"]:checked');

    inputs.forEach(function(input) {
        var preguntaId = input.name.split('_')[1]; // Obtener el ID de la pregunta del nombre del input
        var opcionSeleccionada = input.value; // Valor seleccionado

        // Almacenar la pregunta y la opción en el objeto respuestas
        respuestas[preguntaId] = opcionSeleccionada;
    });

    // Guardar las respuestas en el campo oculto
    document.getElementById('DatosTablaPregunta').value = JSON.stringify(respuestas);

    // Enviar el formulario
    document.getElementById('evaluacionForm').submit();
}