<?php 
//Hacemos la clase para la conexion con la base de datos
	class Conectar{
		public function conexion() {
			$servidor = "localhost"; //nombre del servidor de la base de datos
			$usuario = "root"; //nombre del usuario de la base de datos
			$password = ""; //contraseña de usuario de la base de datos
			$base = "Asesoria_Linea"; //nombre de la base de datos

			$conexion = mysqli_connect($servidor, 
										$usuario, 
										$password, 
										$base);
			$conexion->set_charset('utf8mb4'); //setencia para hacer la conexion con el servidor de la base de datos
			return $conexion;
			//regresamos la respuesta
		}
	}
?>