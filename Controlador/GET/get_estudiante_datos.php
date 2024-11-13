<?php
include('../../Modelo/Conexion.php');

header('Content-Type: application/json');

try {
    $conexion = (new Conectar())->conexion();
    
    // Obtener el ID de la solicitud
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Preparar y ejecutar la primera consulta
    $stmt = $conexion->prepare("SELECT 
                                    E.Nombre_Usuario_E, E.Apellido_Paterno_E, E.Apellido_Materno_E, 
                                    M.Nombre_Materia, D.Registro_parcial, D.Calificacion, D.Observacion
                                FROM 
                                    Datos D
                                JOIN 
                                    Estudiante E ON D.ID_Estudiant = E.ID_Usuario_E
                                JOIN 
                                    Materias M ON D.ID_Materi = M.ID_Materia
                                WHERE 
                                    E.ID_Usuario_E = ?
                                GROUP BY 
                                    E.Nombre_Usuario_E, E.Apellido_Paterno_E, E.Apellido_Materno_E, 
                                    M.Nombre_Materia, D.Registro_parcial, D.Calificacion, D.Observacion");

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Preparar y ejecutar la segunda consulta
    $stmt2 = $conexion->prepare("SELECT 
                                    t.Nombre, 
                                    t.Clave,
                                    COUNT(c.ID_Cita) AS totalCitas,
                                    SUM(CASE WHEN r.Respuesta = 1 THEN 1 ELSE 0 END) AS citasAsistidas
                                FROM 
                                    topicos t 
                                LEFT JOIN 
                                    citas c ON t.ID_Topico = c.ID_Topicos
                                LEFT JOIN
                                    registrar_cita_doc_alumno r ON c.ID_Cita = r.IdCitas
                                JOIN
                                    carrera ca ON t.IdCarre = ca.Id_Carrera
                                JOIN
                                    estudiante e ON ca.Id_Carrera = e.IdCarrera
                                WHERE
                                    e.ID_Usuario_E = ?
                                GROUP BY 
                                    t.Nombre, t.Clave");
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $resultado2 = $stmt2->get_result();

    $registros = [];
    $registrosTop = [];
    
    // Recoger los resultados de la primera consulta
    while ($row = $resultado->fetch_assoc()) {
        $registros[] = [
            'nombreEstudiante' => $row['Nombre_Usuario_E'] . ' ' . $row['Apellido_Paterno_E'] . ' ' . $row['Apellido_Materno_E'],
            'nombreMateria' => $row['Nombre_Materia'],
            'registro' => $row['Registro_parcial'],
            'cali' => $row['Calificacion'],
            'observaciones' => $row['Observacion']
        ];
    }

    // Recoger los resultados de la segunda consulta
    while ($row2 = $resultado2->fetch_assoc()) {
        $registrosTop[] = [
            'nombre' => $row2['Nombre'],
            'clave' => $row2['Clave'],
            'totalcitas' => $row2['totalCitas'],
            'citasasistidas' => $row2['citasAsistidas']
        ];
    }

    // Enviar la respuesta en formato JSON
    if ($registros && $registrosTop) {
        echo json_encode([
            'success' => true,
            'registros' => $registros,
            'registrosTop' => $registrosTop
        ]);
    } else {
        echo json_encode(['success' => false]);
    }

    // Cerrar los statements y la conexión
    $stmt->close();
    $stmt2->close();
    $conexion->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>