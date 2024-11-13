document.addEventListener('DOMContentLoaded', () => {
    const textPregunta = document.getElementById('pregunta'); // Input de texto para agregar pregunta
    const addPreguntaButton = document.getElementById('addPregunta'); // Botón para agregar pregunta
    const preguntaTable = document.getElementById('preguntaTable').querySelector('tbody'); // Cuerpo de la tabla donde se agregan las preguntas
    const DatosTablaPregunta = document.getElementById('DatosTablaPregunta'); // Campo oculto para almacenar los datos de la tabla en formato JSON
    let preguntasSeleccionadas = []; // Array para almacenar las preguntas añadidas

    // Evento para agregar una nueva pregunta a la tabla
    addPreguntaButton.addEventListener('click', function () {
        const pregunta = textPregunta.value.trim(); // Obtener y limpiar el valor del input de texto
        if (pregunta !== "") {
            const preguntaId = preguntaTable.rows.length + 1; // Generar ID para la pregunta
            // Verificar si la pregunta ya está en la lista (opcional)
            const preguntaExiste = preguntasSeleccionadas.some(p => p.pregunta === pregunta);
            if (!preguntaExiste) {
                // Crear una nueva fila en la tabla para la pregunta
                const newRow = preguntaTable.insertRow();
                newRow.innerHTML = `
                    <td>${preguntaId}</td>
                    <td>${pregunta}</td>
                    <td><button type="button" class="btn btn-danger btn-sm removePregunta">Eliminar</button></td>
                `;

                // Agregar la pregunta a la lista de preguntas seleccionadas
                preguntasSeleccionadas.push({ id: preguntaId, pregunta: pregunta });

                // Actualizar el input oculto con las preguntas en formato JSON
                actualizarDatosTablaPregunta();

                // Agregar evento para eliminar la pregunta de la tabla
                newRow.querySelector('.removePregunta').addEventListener('click', function () {
                    preguntaTable.deleteRow(newRow.rowIndex - 1); // Eliminar la fila de la tabla
                    preguntasSeleccionadas = preguntasSeleccionadas.filter(p => p.id !== preguntaId); // Filtrar la lista de preguntas
                    actualizarDatosTablaPregunta(); // Actualizar el campo oculto
                    actualizarIndicesTabla(); // Actualizar los IDs de las filas en la tabla
                });

                // Limpiar el campo de entrada de texto
                textPregunta.value = '';
            } else {
                alert("La pregunta ya ha sido agregada.");
            }
        } else {
            alert("Por favor, ingresa una pregunta válida.");
        }
    });

    // Función para actualizar el campo oculto con los datos de la tabla en formato JSON
    function actualizarDatosTablaPregunta() {
        DatosTablaPregunta.value = JSON.stringify(preguntasSeleccionadas);
    }

    // Función para actualizar los IDs en la tabla y en el array después de eliminar una fila
    function actualizarIndicesTabla() {
        const filas = preguntaTable.getElementsByTagName('tr');
        preguntasSeleccionadas.forEach((pregunta, index) => {
            pregunta.id = index + 1; // Actualizar el ID en el array de preguntas
            filas[index].cells[0].textContent = index + 1; // Actualizar el ID en la tabla
        });
    }
});