$(document).ready(function() {
    // Actualizar los cuatrimestres al seleccionar una carrera
    $('#IDCarrera').change(function() {
        var idCarrera = $(this).val();
        if (idCarrera) {
            $.ajax({
                url: '../../../Controlador/GET/getTopCuatrimestres.php',
                type: 'POST',
                data: { id_carrera: idCarrera },
                success: function(data) {
                    $('#IDCuatrimestre').html(data);
                    $('#IDMateria').html('<option value="" selected disabled>-- Seleccionar Materia --</option>');
                    $('#IDDocente').html('<option value="" selected disabled>-- Seleccionar Docente --</option>');
                }
            });
        } else {
            $('#IDCuatrimestre').html('<option value="" selected disabled>-- Seleccionar Cuatrimestre --</option>');
            $('#IDMateria').html('<option value="" selected disabled>-- Seleccionar Materia --</option>');
            $('#IDDocente').html('<option value="" selected disabled>-- Seleccionar Docente --</option>');
        }
    });

    // Actualizar las materias al seleccionar un cuatrimestre
    $('#IDCuatrimestre').change(function() {
        var idCuatrimestre = $(this).val();
        if (idCuatrimestre) {
            $.ajax({
                url: '../../../Controlador/GET/getTopMaterias.php',
                type: 'POST',
                data: { id_cuatrimestre: idCuatrimestre },
                success: function(data) {
                    $('#IDMateria').html(data);
                    $('#IDDocente').html('<option value="" selected disabled>-- Seleccionar Docente --</option>');
                }
            });
        } else {
            $('#IDMateria').html('<option value="" selected disabled>-- Seleccionar Materia --</option>');
            $('#IDDocente').html('<option value="" selected disabled>-- Seleccionar Docente --</option>');
        }
    });

    // Actualizar los docentes al seleccionar una materia
    $('#IDMateria').change(function() {
        var idMateria = $(this).val();
        if (idMateria) {
            $.ajax({
                url: '../../../Controlador/GET/getTopDocentes.php',
                type: 'POST',
                data: { id_materia: idMateria },
                success: function(data) {
                    $('#IDDocente').html(data);
                }
            });
        } else {
            $('#IDDocente').html('<option value="" selected disabled>-- Seleccionar Docente --</option>');
        }
    });
});