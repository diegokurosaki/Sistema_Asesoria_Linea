<?php
// Iniciar sesión
session_start();
setlocale(LC_ALL, 'es_ES');
date_default_timezone_set('America/Mexico_City');

// Incluir archivo de conexión a la base de datos
include("../../Modelo/Conexion.php");

// Incluir archivo de la plantilla del PDF
require("../../Modelo/plantilla.php");

try {
    // Establecer conexión a la base de datos
    $conexion = (new Conectar())->conexion();

    // Obtener las fechas enviadas por el formulario
    $fecha_inicio = $_POST['Fecha_Inicio'];
    $fecha_fin = $_POST['Fecha_Fin'];
    
    // Preparar la consulta para obtener la información de las citas
    $sql = "WITH TotalEstudiantes AS (
                SELECT 
                    COUNT(DISTINCT ID_Estudiante_Citado) AS TotalGlobal
                FROM 
                    Citas
                WHERE
                    Fch_Cita BETWEEN ? AND ? )
                SELECT 
                    CASE
                        WHEN MONTH(Fch_Cita) = 1 THEN 'Enero'
                        WHEN MONTH(Fch_Cita) = 2 THEN 'Febrero'
                        WHEN MONTH(Fch_Cita) = 3 THEN 'Marzo'
                        WHEN MONTH(Fch_Cita) = 4 THEN 'Abril'
                        WHEN MONTH(Fch_Cita) = 5 THEN 'Mayo'
                        WHEN MONTH(Fch_Cita) = 6 THEN 'Junio'
                        WHEN MONTH(Fch_Cita) = 7 THEN 'Julio'
                        WHEN MONTH(Fch_Cita) = 8 THEN 'Agosto'
                        WHEN MONTH(Fch_Cita) = 9 THEN 'Septiembre'
                        WHEN MONTH(Fch_Cita) = 10 THEN 'Octubre'
                        WHEN MONTH(Fch_Cita) = 11 THEN 'Noviembre'
                        WHEN MONTH(Fch_Cita) = 12 THEN 'Diciembre'
                    END AS Mes,
                    COUNT(DISTINCT ID_Estudiante_Citado) AS Total_Estudiantes,
                    ROUND((COUNT(DISTINCT ID_Estudiante_Citado) / (SELECT TotalGlobal FROM TotalEstudiantes)) * 100, 2) AS Porcentaje
                FROM 
                    Citas
                WHERE 
                    Fch_Cita BETWEEN ? AND ?
                GROUP BY 
                    MONTH(Fch_Cita)
                ORDER BY 
                    MONTH(Fch_Cita)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ssss', $fecha_inicio, $fecha_fin, $fecha_inicio, $fecha_fin); // Protección contra inyección SQL
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si la consulta devolvió resultados
    if ($resultado->num_rows > 0) {

        // Crear un nuevo objeto PDF
        $pdf = new PDF("P", "mm", "letter");
        $pdf->AliasNbPages();
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // Agregar la frase con letra cursiva
        $pdf->SetFont("Arial", "I", 12);
        $pdf->Cell(0, 10, utf8_decode('El Éxito es la suma de pequeños esfuerzos repetidos día tras día'), 0, 1, "C");

        // Agregar un salto de página antes de la tabla
        $pdf->Ln();

        // Establecer el ancho de la tabla y centrarla
        $anchoTabla = 130;
        $margenIzquierdo = ($pdf->GetPageWidth() - $anchoTabla) / 2;
        $pdf->SetLeftMargin($margenIzquierdo);

        // Estilo de la tabla
        $pdf->SetFillColor(200, 220, 255); // Color de fondo de las celdas
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Cell(50, 7, "Mes", 1, 0, "C", true);
        $pdf->Cell(50, 7, "Total Estudiantes", 1, 0, "C", true);
        $pdf->Cell(35, 7, "Porcentaje", 1, 1, "C", true);

        // Agregar datos a la tabla
        $pdf->SetFont("Arial", "", 9); // Restaurar el estilo de fuente normal
        while ($fila = $resultado->fetch_assoc()) {
            $pdf->Cell(50, 7, utf8_decode($fila['Mes']), 1, 0, "C");
            $pdf->Cell(50, 7, $fila['Total_Estudiantes'], 1, 0, "C");
            $pdf->Cell(35, 7, $fila['Porcentaje'], 1, 1, "C");
        }

        // Agregar un salto de página antes de la gráfica
        $pdf->Ln();

        // Incrustar la imagen de la gráfica en el PDF
        if (isset($_POST['variable'])) {
            $grafico = $_POST['variable'];
        
            // Verificar si la cadena contiene una coma antes de intentar explotar
            if (strpos($grafico, ',') !== false) {
                $img = explode(',', $grafico, 2);
                if (count($img) === 2) {
                    $pic = 'data://text/plain;base64,' . $img[1];
                    // Ajusta las coordenadas según sea necesario
                    $pdf->Image($pic, 10, 70, 200, 0, 'png');
                } else {
                    $pdf->Cell(0, 10, "No se pudo extraer la imagen del gráfico.", 0, 1, "C");
                }
            } else {
                $pdf->Cell(0, 10, "La cadena no contiene una coma (,).", 0, 1, "C");
            }
        } else {
            $pdf->Cell(0, 10, "No se recibió la imagen del gráfico.", 0, 1, "C");
        }
        
        // Salida del PDF
        ob_end_clean(); // Limpiar el buffer de salida para evitar salida no deseada
        $pdf->Output();
    } else {
        echo "La consulta no devolvió resultados.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>