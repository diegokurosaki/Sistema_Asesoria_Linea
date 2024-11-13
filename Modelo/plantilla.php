<?php
// Establecer configuración regional y zona horaria
setlocale(LC_ALL, 'es_ES');
date_default_timezone_set('America/Mexico_City');

// Incluir la librería FPDF
require("../../librerias/fpdf/fpdf.php");

// Definir la clase PDF que extiende la clase FPDF
class PDF extends FPDF{
    // Cabecera de página
    function Header(){
        // Logo
        $this->Image("../../img/logo.png", 10, 5, 13);
        
        // Configuración de fuente para el título
        $this->SetFont("Arial", "B", 12);
        
        // Título
        $this->Cell(25);
        $this->Cell(140, 5, utf8_decode("Reporte"), 0, 0, "C");
        
        // Configuración de fuente para la fecha
        $this->SetFont("Arial", "", 10);
        
        // Fecha
        $this->Cell(25, 5, "Fecha: ". date("d/m/Y"), 0, 1, "C");
        
        // Salto de línea
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        
        // Configuración de fuente para el número de página
        $this->SetFont('Arial', 'I', 8);
        
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
?>