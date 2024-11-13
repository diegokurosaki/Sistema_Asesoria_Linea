<?php
include('../../Modelo/Conexion.php');

$id_materia = $_POST['id_materia'];

$conexion = (new Conectar())->conexion();

$query = "SELECT DISTINCT D.ID_Usuario_D, CONCAT(D.Nombre_Usuario_D, ' ', D.Apellido_Paterno_D, ' ', D.Apellido_Materno_D) AS Nombre_Completo
          FROM Docente D
          INNER JOIN Docente_Materia DM ON D.ID_Usuario_D = DM.IdDocente
          WHERE DM.IdMateria = ?";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_materia);
$stmt->execute();
$result = $stmt->get_result();

$options = '<option value="" selected disabled>-- Seleccionar Docente --</option>';
while ($row = $result->fetch_assoc()) {
    $options .= '<option value="' . $row['ID_Usuario_D'] . '">' . $row['Nombre_Completo'] . '</option>';
}

echo $options;

$stmt->close();
?>