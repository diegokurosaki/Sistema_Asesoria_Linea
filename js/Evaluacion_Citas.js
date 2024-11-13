// Obtener el ID de la cita y mostrarlo en el formulario
$('.evaluar-cita').click(function () {
    var idCita = $(this).data('id-cita');
    $('#idCita').val(idCita);
});

// Manejo del formulario para guardar la evaluación
$('#formEvaluacion').submit(function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
    var idCita = $('#idCita').val();
    var comentarios = $('#comentarios').val();
    var calificacionCita = $('#calificacionCita').val();

    // Enviar los datos a un archivo PHP para guardar la evaluación
    $.ajax({
        url: '../../Controlador/Estudiante/INSERT/Funcion_Insert_Evaluacion_Cita.php', // Ruta del archivo PHP que guarda la evaluación
        type: 'POST',
        data: { idCita: idCita, comentarios: comentarios, calificacionCita: calificacionCita },
        success: function (response) {
            alert('¡Evaluación de Cita Guardada Exitosamente!');
            location.reload(); // Recargar la página para actualizar la lista de evaluaciones
        },
        error: function () {
            alert('Error al guardar la evaluación');
        }
    });
});