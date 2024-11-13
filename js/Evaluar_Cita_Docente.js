// Obtener el ID de la cita y mostrarlo en el formulario
$('.evalua-cita').click(function () {
    var idCita = $(this).data('id-cita');
    $('#idCita').val(idCita);
});

// Manejo del formulario para guardar la evaluación
$('#formEvalua').submit(function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
    var idCita = $('#idCita').val();
    var Respuesta = $('#Respuesta').val();
    var Observacion = $('#Observacion').val();

    // Enviar los datos a un archivo PHP para guardar la evaluación
    $.ajax({
        url: '../../Controlador/Docente/INSERT/Funcion_Insert_DocEvaEst.php', // Ruta del archivo PHP que guarda la evaluación
        type: 'POST',
        data: { idCita: idCita, Respuesta: Respuesta, Observacion: Observacion },
        success: function (response) {
            alert('¡Evaluación de Cita del Docente Guardada Exitosamente!');
            location.reload(); // Recargar la página para actualizar la lista de evaluaciones
        },
        error: function () {
            alert('Error al guardar la evaluación');
        }
    });
});