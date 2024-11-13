// Función para cargar estudiantes y materias según la carrera seleccionada
document.getElementById('IdCarrera').addEventListener('change', function() {
    const carreraId = this.value;

    // Cargar estudiantes
    fetch(`../../../Controlador/GET/getDatEstudiantes.php?IdCarrera=${carreraId}`)
        .then(response => response.json())
        .then(data => {
            const selectEstudiantes = document.getElementById('IdAlumnos');
            selectEstudiantes.innerHTML = '<option value="" selected>-- Seleccionar Alumnos --</option>';
            data.forEach(estudiante => {
                selectEstudiantes.innerHTML += `<option value="${estudiante.ID_Usuario_E}">${estudiante.Nombre_Alumno}</option>`;
            });
        })
        .catch(error => console.error('Error al cargar estudiantes:', error));

    // Cargar materias
    fetch(`../../../Controlador/GET/getDatMaterias.php?IdCarrera=${carreraId}`)
        .then(response => response.json())
        .then(data => {
            const selectMaterias = document.getElementById('IdMaterias');
            selectMaterias.innerHTML = '<option value="" selected>-- Seleccionar Materia --</option>';
            data.forEach(materia => {
                selectMaterias.innerHTML += `<option value="${materia.ID_Materia}">${materia.Nombre_Materia}</option>`;
            });
        })
        .catch(error => console.error('Error al cargar materias:', error));
});

// Función para agregar filas a la tabla
document.getElementById('addMateria').addEventListener('click', function() {
    const idAlumno = document.getElementById('IdAlumnos').value;
    const idMateria = document.getElementById('IdMaterias').value;
    const registroParcial = document.getElementById('Registro_parcial').value;
    const calificacion = document.getElementById('Calificacion').value;
    const observaciones = document.getElementById('Observacion').value;

    if (!idAlumno || !idMateria || !registroParcial || !calificacion || !observaciones) {
        alert('Por favor, completa todos los campos.');
        return;
    }

    const tabla = document.getElementById('materiasTable').getElementsByTagName('tbody')[0];
    const filas = tabla.getElementsByTagName('tr');
    
    // Verificar si ya existe un registro con el mismo estudiante, materia y parcial
    for (let i = 0; i < filas.length; i++) {
        const fila = filas[i];
        const celdas = fila.getElementsByTagName('td');
        if (celdas[1].textContent === document.getElementById('IdAlumnos').selectedOptions[0].text &&
            celdas[2].textContent === document.getElementById('IdMaterias').selectedOptions[0].text &&
            celdas[3].textContent === registroParcial) {
            alert('Al parecer ya habías registrado la calificación del parcial.');
            return;
        }
    }

    // Agregar fila a la tabla
    const fila = tabla.insertRow();
    fila.insertCell(0).textContent = tabla.rows.length; // Número
    fila.insertCell(1).textContent = document.getElementById('IdAlumnos').selectedOptions[0].text; // Nombre Alumno
    fila.insertCell(2).textContent = document.getElementById('IdMaterias').selectedOptions[0].text; // Materia
    fila.insertCell(3).textContent = registroParcial; // Parcial
    fila.insertCell(4).textContent = calificacion; // Calificación
    fila.insertCell(5).textContent = observaciones; // Observaciones

    // Crear botón Eliminar
    const btnEliminar = document.createElement('button');
    btnEliminar.textContent = 'Eliminar';
    btnEliminar.classList.add('btn', 'btn-danger');
    btnEliminar.addEventListener('click', function() {
        tabla.deleteRow(fila.rowIndex - 1); // Elimina la fila
        actualizarCampoDatosTabla(); // Actualiza el campo oculto
    });
    fila.insertCell(6).appendChild(btnEliminar);

    // Actualizar campo oculto
    actualizarCampoDatosTabla();

    // Limpiar campos
    document.getElementById('IdAlumnos').value = '';
    document.getElementById('IdMaterias').value = '';
    document.getElementById('Registro_parcial').value = '';
    document.getElementById('Calificacion').value = '';
    document.getElementById('Observacion').value = '';
});

// Función para actualizar el campo oculto con la información de la tabla
function actualizarCampoDatosTabla() {
    const tabla = document.getElementById('materiasTable').getElementsByTagName('tbody')[0];
    const filas = tabla.getElementsByTagName('tr');
    const datos = [];
    
    for (let i = 0; i < filas.length; i++) {
        const fila = filas[i];
        const celdas = fila.getElementsByTagName('td');
        
        // Buscar ID del Alumno
        const nombreAlumno = celdas[1].textContent;
        const idAlumno = Array.from(document.getElementById('IdAlumnos').options)
                              .find(option => option.text === nombreAlumno)?.value;
        
        // Buscar ID de la Materia
        const nombreMateria = celdas[2].textContent;
        const idMateria = Array.from(document.getElementById('IdMaterias').options)
                              .find(option => option.text === nombreMateria)?.value;
        
        datos.push({
            idAlumno: idAlumno || '', // Usar '' si no se encuentra
            idMateria: idMateria || '', // Usar '' si no se encuentra
            registroParcial: celdas[3].textContent,
            calificacion: celdas[4].textContent,
            observaciones: celdas[5].textContent
        });
    }
    document.getElementById('DatosTablaAlumnos').value = JSON.stringify(datos);
}