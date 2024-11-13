-- MySQL Host: localhost
-- MySQL User: root
-- MySQL Password: 
-- Database Name: Asesoria_Linea

-- Table structure for table `Materias`
CREATE TABLE `materias` (
  `ID_Materia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Materia` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Materias`

-- Table structure for table `Cuatrimestre`
CREATE TABLE `cuatrimestre` (
  `Id_Cuatrimestre` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Cuatrimestre` varchar(200) NOT NULL,
  PRIMARY KEY (`Id_Cuatrimestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Cuatrimestre`

-- Table structure for table `Cuatri_Mater`
CREATE TABLE `cuatri_mater` (
  `ID_CuaMat` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Cuatrimestres` int(11) DEFAULT NULL,
  `ID_Materias` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_CuaMat`),
  KEY `Id_Cuatrimestres` (`Id_Cuatrimestres`),
  KEY `ID_Materias` (`ID_Materias`),
  CONSTRAINT `cuatri_mater_ibfk_1` FOREIGN KEY (`Id_Cuatrimestres`) REFERENCES `cuatrimestre` (`Id_Cuatrimestre`),
  CONSTRAINT `cuatri_mater_ibfk_2` FOREIGN KEY (`ID_Materias`) REFERENCES `materias` (`ID_Materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Cuatri_Mater`

-- Table structure for table `Estudiante`
CREATE TABLE `estudiante` (
  `ID_Usuario_E` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Usuario_E` varchar(200) NOT NULL,
  `Apellido_Materno_E` varchar(200) NOT NULL,
  `Apellido_Paterno_E` varchar(200) NOT NULL,
  `Telefono_E` varchar(20) NOT NULL,
  `Fecha_Nacimiento_E` date NOT NULL,
  `Genero_E` varchar(100) NOT NULL,
  `Correo_electronico_E` varchar(100) NOT NULL,
  `Contrasena_E` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Usuario_E`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Estudiante`
INSERT INTO Estudiante VALUES ("1","Diego","Pena","Medina","1234567890","2024-07-17","Femenino","PMDO200685@upemor.edu.mx","12345");

-- Table structure for table `Estudiante_Cuatri`
CREATE TABLE `estudiante_cuatri` (
  `ID_Estu_Cuatri` int(11) NOT NULL AUTO_INCREMENT,
  `IdEstudiante` int(11) DEFAULT NULL,
  `IdCuatrimestre` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Estu_Cuatri`),
  KEY `IdEstudiante` (`IdEstudiante`),
  KEY `IdCuatrimestre` (`IdCuatrimestre`),
  CONSTRAINT `estudiante_cuatri_ibfk_1` FOREIGN KEY (`IdEstudiante`) REFERENCES `estudiante` (`ID_Usuario_E`),
  CONSTRAINT `estudiante_cuatri_ibfk_2` FOREIGN KEY (`IdCuatrimestre`) REFERENCES `cuatrimestre` (`Id_Cuatrimestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Estudiante_Cuatri`

-- Table structure for table `Docente`
CREATE TABLE `docente` (
  `ID_Usuario_D` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Usuario_D` varchar(200) NOT NULL,
  `Apellido_Materno_D` varchar(200) NOT NULL,
  `Apellido_Paterno_D` varchar(200) NOT NULL,
  `Telefono_D` varchar(20) NOT NULL,
  `Fecha_Nacimiento_D` date NOT NULL,
  `Genero_D` varchar(100) NOT NULL,
  `Correo_electronico_D` varchar(100) NOT NULL,
  `Contrasena_D` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Usuario_D`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Docente`
INSERT INTO Docente VALUES ("1","Diego","Pena","Medina","1234567890","2024-07-17","Femenino","quierotuculitomami@gmail.com","12345");

-- Table structure for table `Docente_Materia`
CREATE TABLE `docente_materia` (
  `ID_Doc_Mate` int(11) NOT NULL AUTO_INCREMENT,
  `IdDocente` int(11) DEFAULT NULL,
  `IdMateria` int(11) DEFAULT NULL,
  `Grado_academico` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_Doc_Mate`),
  KEY `IdDocente` (`IdDocente`),
  KEY `IdMateria` (`IdMateria`),
  CONSTRAINT `docente_materia_ibfk_1` FOREIGN KEY (`IdDocente`) REFERENCES `docente` (`ID_Usuario_D`),
  CONSTRAINT `docente_materia_ibfk_2` FOREIGN KEY (`IdMateria`) REFERENCES `materias` (`ID_Materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Docente_Materia`

-- Table structure for table `Administrador`
CREATE TABLE `administrador` (
  `ID_Usuario_A` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Usuario_A` varchar(200) NOT NULL,
  `Apellido_Materno_A` varchar(200) NOT NULL,
  `Apellido_Paterno_A` varchar(200) NOT NULL,
  `Telefono_A` varchar(20) NOT NULL,
  `Fecha_Nacimiento_A` date NOT NULL,
  `Genero_A` varchar(100) NOT NULL,
  `Correo_electronico_A` varchar(100) NOT NULL,
  `Contrasena_A` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Usuario_A`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Administrador`
INSERT INTO Administrador VALUES ("1","Diego","Pena","Medina","1234567890","2024-07-17","Femenino","mochito619@gmail.com","12345");

-- Table structure for table `Topicos`
CREATE TABLE `topicos` (
  `ID_Topico` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `Temas` text NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `IdCuatri` int(11) DEFAULT NULL,
  `IdMateri` int(11) DEFAULT NULL,
  `IdDocent` int(11) DEFAULT NULL,
  `ID_Administrador_Autorizo` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Topico`),
  KEY `IdCuatri` (`IdCuatri`),
  KEY `IdMateri` (`IdMateri`),
  KEY `IdDocent` (`IdDocent`),
  KEY `ID_Administrador_Autorizo` (`ID_Administrador_Autorizo`),
  CONSTRAINT `topicos_ibfk_1` FOREIGN KEY (`IdCuatri`) REFERENCES `cuatrimestre` (`Id_Cuatrimestre`),
  CONSTRAINT `topicos_ibfk_2` FOREIGN KEY (`IdMateri`) REFERENCES `materias` (`ID_Materia`),
  CONSTRAINT `topicos_ibfk_3` FOREIGN KEY (`IdDocent`) REFERENCES `docente` (`ID_Usuario_D`),
  CONSTRAINT `topicos_ibfk_4` FOREIGN KEY (`ID_Administrador_Autorizo`) REFERENCES `administrador` (`ID_Usuario_A`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Topicos`

-- Table structure for table `Datos`
CREATE TABLE `datos` (
  `ID_Datos` int(11) NOT NULL AUTO_INCREMENT,
  `Registro_parcial` varchar(50) NOT NULL,
  `Calificacion` int(11) NOT NULL,
  `Observacion` text NOT NULL,
  `ID_Estudiant` int(11) DEFAULT NULL,
  `ID_Materi` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Datos`),
  KEY `ID_Estudiant` (`ID_Estudiant`),
  KEY `ID_Materi` (`ID_Materi`),
  CONSTRAINT `datos_ibfk_1` FOREIGN KEY (`ID_Estudiant`) REFERENCES `estudiante` (`ID_Usuario_E`),
  CONSTRAINT `datos_ibfk_2` FOREIGN KEY (`ID_Materi`) REFERENCES `materias` (`ID_Materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Datos`

-- Table structure for table `Documentos`
CREATE TABLE `documentos` (
  `ID_Documento` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo_doc` varchar(100) NOT NULL,
  `Tema` varchar(200) NOT NULL,
  `Fch_subida` date NOT NULL,
  `Ubicacion` varchar(250) NOT NULL,
  `ID_Docente_Subio` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Documento`),
  KEY `ID_Docente_Subio` (`ID_Docente_Subio`),
  CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`ID_Docente_Subio`) REFERENCES `docente` (`ID_Usuario_D`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Documentos`

-- Table structure for table `Citas`
CREATE TABLE `citas` (
  `ID_Cita` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(200) NOT NULL,
  `Fch_Cita` date NOT NULL,
  `Hora_Cita` time NOT NULL,
  `Link` text NOT NULL,
  `ID_Estudiante_Citado` int(11) DEFAULT NULL,
  `ID_Topicos` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Cita`),
  KEY `ID_Estudiante_Citado` (`ID_Estudiante_Citado`),
  KEY `ID_Topicos` (`ID_Topicos`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`ID_Estudiante_Citado`) REFERENCES `estudiante` (`ID_Usuario_E`),
  CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`ID_Topicos`) REFERENCES `topicos` (`ID_Topico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Citas`

-- Table structure for table `Compartir_Recursos`
CREATE TABLE `compartir_recursos` (
  `ID_Compartir_Recurso` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Docente_Com` int(11) DEFAULT NULL,
  `ID_Estudiante_Com` int(11) DEFAULT NULL,
  `ID_Documento_Com` int(11) DEFAULT NULL,
  `Fecha_Compartida` date NOT NULL,
  `Hora_Compartida` time NOT NULL,
  PRIMARY KEY (`ID_Compartir_Recurso`),
  KEY `ID_Docente_Com` (`ID_Docente_Com`),
  KEY `ID_Estudiante_Com` (`ID_Estudiante_Com`),
  KEY `ID_Documento_Com` (`ID_Documento_Com`),
  CONSTRAINT `compartir_recursos_ibfk_1` FOREIGN KEY (`ID_Docente_Com`) REFERENCES `docente` (`ID_Usuario_D`),
  CONSTRAINT `compartir_recursos_ibfk_2` FOREIGN KEY (`ID_Estudiante_Com`) REFERENCES `estudiante` (`ID_Usuario_E`),
  CONSTRAINT `compartir_recursos_ibfk_3` FOREIGN KEY (`ID_Documento_Com`) REFERENCES `documentos` (`ID_Documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Compartir_Recursos`

-- Table structure for table `Evaluacion_Material`
CREATE TABLE `evaluacion_material` (
  `ID_Evaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `Calificacion` int(11) NOT NULL,
  `Comentarios` text NOT NULL,
  `Fecha_Evaluacion` datetime NOT NULL,
  `ID_Compartir_Recursos` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Evaluacion`),
  KEY `ID_Compartir_Recursos` (`ID_Compartir_Recursos`),
  CONSTRAINT `evaluacion_material_ibfk_1` FOREIGN KEY (`ID_Compartir_Recursos`) REFERENCES `compartir_recursos` (`ID_Compartir_Recurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Evaluacion_Material`

-- Table structure for table `Evaluacion_Citas`
CREATE TABLE `evaluacion_citas` (
  `ID_Evaluacion_Cita` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Citas` int(11) NOT NULL,
  `Fecha_Evaluacion` date NOT NULL,
  `Hora_Evaluacion` time NOT NULL,
  `Comentarios` text DEFAULT NULL,
  PRIMARY KEY (`ID_Evaluacion_Cita`),
  KEY `ID_Citas` (`ID_Citas`),
  CONSTRAINT `evaluacion_citas_ibfk_1` FOREIGN KEY (`ID_Citas`) REFERENCES `citas` (`ID_Cita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Evaluacion_Citas`

-- Table structure for table `Encuesta`
CREATE TABLE `encuesta` (
  `ID_Encuesta` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Topico_evaluados` int(11) DEFAULT NULL,
  `puntaje` int(11) NOT NULL,
  `estatus` varchar(100) NOT NULL,
  `Comentario` text NOT NULL,
  PRIMARY KEY (`ID_Encuesta`),
  KEY `ID_Topico_evaluados` (`ID_Topico_evaluados`),
  CONSTRAINT `encuesta_ibfk_1` FOREIGN KEY (`ID_Topico_evaluados`) REFERENCES `topicos` (`ID_Topico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Encuesta`

