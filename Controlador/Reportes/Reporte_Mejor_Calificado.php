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

    // Preparar la consulta para obtener la información de las citas
    $sql = "SELECT 
                cr.ID_Documento_Com AS ID_Material,
                d.Titulo AS Titulo, 
                ROUND(AVG(em.Calificacion), 2) AS Calificacion_Promedio, 
                COUNT(em.ID_Evaluacion) AS Total_Evaluaciones
            FROM 
                Evaluacion_Material em
            INNER JOIN 
                Compartir_Recursos cr ON em.ID_Compartir_Recursos = cr.ID_Compartir_Recurso
            INNER JOIN
                Documentos d ON cr.ID_Documento_Com = d.ID_Documento
            GROUP BY 
                cr.ID_Documento_Com
            ORDER BY 
                Calificacion_Promedio DESC
            LIMIT 5";

    $stmt = $conexion->prepare($sql);
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
        $anchoTabla = 100;
        $margenIzquierdo = ($pdf->GetPageWidth() - $anchoTabla) / 2;
        $pdf->SetLeftMargin($margenIzquierdo);

        // Estilo de la tabla
        $pdf->SetFillColor(200, 220, 255); // Color de fondo de las celdas
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Cell(50, 7, "Titulo", 1, 0, "C", true);
        $pdf->Cell(50, 7, "Mejor Calificación", 1, 1, "C", true);

        // Agregar datos a la tabla
        $pdf->SetFont("Arial", "", 9); // Restaurar el estilo de fuente normal
        while ($fila = $resultado->fetch_assoc()) {
            $pdf->Cell(50, 7, utf8_decode($fila['Titulo']), 1, 0, "C");
            $pdf->Cell(50, 7, $fila['Calificacion_Promedio'], 1, 1, "C");
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