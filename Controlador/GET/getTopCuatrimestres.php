<?php
include('../../Modelo/Conexion.php');

$id_carrera = $_POST['id_carrera'];

$conexion = (new Conectar())->conexion();

$query = "SELECT DISTINCT C.Id_Cuatrimestre, C.Nombre_Cuatrimestre
          FROM Cuatrimestre C
          INNER JOIN Carre_Cuatri_Mater CCM ON C.Id_Cuatrimestre = CCM.IdCuatrimestres
          WHERE CCM.IdCarreras = ?";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_carrera);
$stmt->execute();
$result = $stmt->get_result();

$options = '<option value="" selected disabled>-- Seleccionar Cuatrimestre --</option>';
while ($row = $result->fetch_assoc()) {
    $options .= '<option value="' . $row['Id_Cuatrimestre'] . '">' . $row['Nombre_Cuatrimestre'] . '</option>';
}

echo $options;

$stmt->close();
?>