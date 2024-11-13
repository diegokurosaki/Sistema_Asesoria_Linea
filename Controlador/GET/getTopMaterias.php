<?php
include('../../Modelo/Conexion.php');

$id_cuatrimestre = $_POST['id_cuatrimestre'];

$conexion = (new Conectar())->conexion();

$query = "SELECT DISTINCT M.ID_Materia, M.Nombre_Materia
          FROM Materias M
          INNER JOIN Carre_Cuatri_Mater CCM ON M.ID_Materia = CCM.IdMaterias
          WHERE CCM.IdCuatrimestres = ?";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_cuatrimestre);
$stmt->execute();
$result = $stmt->get_result();

$options = '<option value="" selected disabled>-- Seleccionar Materia --</option>';
while ($row = $result->fetch_assoc()) {
    $options .= '<option value="' . $row['ID_Materia'] . '">' . $row['Nombre_Materia'] . '</option>';
}

echo $options;

$stmt->close();
?>