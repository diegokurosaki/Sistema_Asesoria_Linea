// Función para enviar la evaluación
function enviarEvaluacion(idDocumento) {
    // Obtener el formulario correspondiente
    var form = document.getElementById('formEvaluacion' + idDocumento);

    // Crear un objeto FormData para enviar los datos
    var formData = new FormData(form);

    // Realizar una solicitud AJAX para enviar la evaluación
    fetch('../../Controlador/Estudiante/INSERT/Funcion_Insert_Evaluacion_Documento.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert('¡Evaluación del Documento Guardado Exitosamente!');
        
        // Cerrar el modal después de enviar
        var modal = document.getElementById('evaluarDocumento' + idDocumento);
        var bootstrapModal = bootstrap.Modal.getInstance(modal);
        bootstrapModal.hide();

        // Recargar la página para actualizar la lista
        location.reload();
    })
    .catch(error => {
        console.error('Error al enviar la evaluación:', error);
    });
}