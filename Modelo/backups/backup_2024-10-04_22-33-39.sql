-- MySQL Host: localhost
-- MySQL User: root
-- MySQL Password: 
-- Database Name: Asesoria_Linea

-- Table structure for table `Materias`
CREATE TABLE `materias` (
  `ID_Materia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Materia` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Materia`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Materias`
INSERT INTO Materias VALUES ("1","Inglés I");
INSERT INTO Materias VALUES ("2","Inglés II");
INSERT INTO Materias VALUES ("3","Inglés III");
INSERT INTO Materias VALUES ("4","Inglés IV");
INSERT INTO Materias VALUES ("5","Inglés V");
INSERT INTO Materias VALUES ("6","Inglés VI");
INSERT INTO Materias VALUES ("7","Inglés VII");
INSERT INTO Materias VALUES ("8","Inglés VIII");
INSERT INTO Materias VALUES ("9","Inglés IX");
INSERT INTO Materias VALUES ("10","Estancia I");
INSERT INTO Materias VALUES ("11","Estancia II");
INSERT INTO Materias VALUES ("12","Estadía");

-- Table structure for table `Cuatrimestre`
CREATE TABLE `cuatrimestre` (
  `Id_Cuatrimestre` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Cuatrimestre` varchar(250) NOT NULL,
  PRIMARY KEY (`Id_Cuatrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Cuatrimestre`
INSERT INTO Cuatrimestre VALUES ("1","Primer Cuatrimestre");
INSERT INTO Cuatrimestre VALUES ("2","Segundo Cuatrimestre");
INSERT INTO Cuatrimestre VALUES ("3","Tercer Cuatrimestre");
INSERT INTO Cuatrimestre VALUES ("4","Cuarto Cuatrimestre");
INSERT INTO Cuatrimestre VALUES ("5","Quinto Cuatrimestre");
INSERT INTO Cuatrimestre VALUES ("6","Sexto Cuatrimestre");
INSERT INTO Cuatrimestre VALUES ("7","Séptimo Cuatrimestre");
INSERT INTO Cuatrimestre VALUES ("8","Octavo Cuatrimestre");
INSERT INTO Cuatrimestre VALUES ("9","Noveno Cuatrimestre");
INSERT INTO Cuatrimestre VALUES ("10","Décimo Cuatrimestre");

-- Table structure for table `Carrera`
CREATE TABLE `carrera` (
  `Id_Carrera` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Carrera` varchar(250) NOT NULL,
  PRIMARY KEY (`Id_Carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Carrera`
INSERT INTO Carrera VALUES ("1","Licenciatura en Administración y Gestión Empresarial");
INSERT INTO Carrera VALUES ("2","Ingeniería en Biotecnología");
INSERT INTO Carrera VALUES ("3","Ingeniería en Tecnología Ambiental");
INSERT INTO Carrera VALUES ("4","Ingeniería en Industrial");
INSERT INTO Carrera VALUES ("5","Ingeniería en Tecnologías de la Información");
INSERT INTO Carrera VALUES ("6","Ingeniería en Electrónica y Telecomunicaciones");
INSERT INTO Carrera VALUES ("7","Ingeniería en Financiera");

-- Table structure for table `Carre_Cuatri_Mater`
CREATE TABLE `carre_cuatri_mater` (
  `ID_CarCuaMat` int(11) NOT NULL AUTO_INCREMENT,
  `IdCarreras` int(11) DEFAULT NULL,
  `IdCuatrimestres` int(11) DEFAULT NULL,
  `IdMaterias` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_CarCuaMat`),
  KEY `IdCarreras` (`IdCarreras`),
  KEY `IdCuatrimestres` (`IdCuatrimestres`),
  KEY `IdMaterias` (`IdMaterias`),
  CONSTRAINT `carre_cuatri_mater_ibfk_1` FOREIGN KEY (`IdCarreras`) REFERENCES `carrera` (`Id_Carrera`),
  CONSTRAINT `carre_cuatri_mater_ibfk_2` FOREIGN KEY (`IdCuatrimestres`) REFERENCES `cuatrimestre` (`Id_Cuatrimestre`),
  CONSTRAINT `carre_cuatri_mater_ibfk_3` FOREIGN KEY (`IdMaterias`) REFERENCES `materias` (`ID_Materia`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Carre_Cuatri_Mater`
INSERT INTO Carre_Cuatri_Mater VALUES ("1","1","1","1");
INSERT INTO Carre_Cuatri_Mater VALUES ("2","1","2","2");
INSERT INTO Carre_Cuatri_Mater VALUES ("3","1","3","3");
INSERT INTO Carre_Cuatri_Mater VALUES ("4","1","4","4");
INSERT INTO Carre_Cuatri_Mater VALUES ("5","1","4","10");
INSERT INTO Carre_Cuatri_Mater VALUES ("6","1","5","5");
INSERT INTO Carre_Cuatri_Mater VALUES ("7","1","6","6");
INSERT INTO Carre_Cuatri_Mater VALUES ("8","1","7","7");
INSERT INTO Carre_Cuatri_Mater VALUES ("9","1","7","11");
INSERT INTO Carre_Cuatri_Mater VALUES ("10","1","8","8");
INSERT INTO Carre_Cuatri_Mater VALUES ("11","1","9","9");
INSERT INTO Carre_Cuatri_Mater VALUES ("12","1","10","12");
INSERT INTO Carre_Cuatri_Mater VALUES ("13","2","1","1");
INSERT INTO Carre_Cuatri_Mater VALUES ("14","2","2","2");
INSERT INTO Carre_Cuatri_Mater VALUES ("15","2","3","3");
INSERT INTO Carre_Cuatri_Mater VALUES ("16","2","4","4");
INSERT INTO Carre_Cuatri_Mater VALUES ("17","2","4","10");
INSERT INTO Carre_Cuatri_Mater VALUES ("18","2","5","5");
INSERT INTO Carre_Cuatri_Mater VALUES ("19","2","6","6");
INSERT INTO Carre_Cuatri_Mater VALUES ("20","2","7","7");
INSERT INTO Carre_Cuatri_Mater VALUES ("21","2","7","11");
INSERT INTO Carre_Cuatri_Mater VALUES ("22","2","8","8");
INSERT INTO Carre_Cuatri_Mater VALUES ("23","2","9","9");
INSERT INTO Carre_Cuatri_Mater VALUES ("24","2","10","12");
INSERT INTO Carre_Cuatri_Mater VALUES ("25","3","1","1");
INSERT INTO Carre_Cuatri_Mater VALUES ("26","3","2","2");
INSERT INTO Carre_Cuatri_Mater VALUES ("27","3","3","3");
INSERT INTO Carre_Cuatri_Mater VALUES ("28","3","4","4");
INSERT INTO Carre_Cuatri_Mater VALUES ("29","3","4","10");
INSERT INTO Carre_Cuatri_Mater VALUES ("30","3","5","5");
INSERT INTO Carre_Cuatri_Mater VALUES ("31","3","6","6");
INSERT INTO Carre_Cuatri_Mater VALUES ("32","3","7","7");
INSERT INTO Carre_Cuatri_Mater VALUES ("33","3","7","11");
INSERT INTO Carre_Cuatri_Mater VALUES ("34","3","8","8");
INSERT INTO Carre_Cuatri_Mater VALUES ("35","3","9","9");
INSERT INTO Carre_Cuatri_Mater VALUES ("36","3","10","12");
INSERT INTO Carre_Cuatri_Mater VALUES ("37","4","1","1");
INSERT INTO Carre_Cuatri_Mater VALUES ("38","4","2","2");
INSERT INTO Carre_Cuatri_Mater VALUES ("39","4","3","3");
INSERT INTO Carre_Cuatri_Mater VALUES ("40","4","4","4");
INSERT INTO Carre_Cuatri_Mater VALUES ("41","4","4","10");
INSERT INTO Carre_Cuatri_Mater VALUES ("42","4","5","5");
INSERT INTO Carre_Cuatri_Mater VALUES ("43","4","6","6");
INSERT INTO Carre_Cuatri_Mater VALUES ("44","4","7","7");
INSERT INTO Carre_Cuatri_Mater VALUES ("45","4","7","11");
INSERT INTO Carre_Cuatri_Mater VALUES ("46","4","8","8");
INSERT INTO Carre_Cuatri_Mater VALUES ("47","4","9","9");
INSERT INTO Carre_Cuatri_Mater VALUES ("48","4","10","12");
INSERT INTO Carre_Cuatri_Mater VALUES ("49","5","1","1");
INSERT INTO Carre_Cuatri_Mater VALUES ("50","5","2","2");
INSERT INTO Carre_Cuatri_Mater VALUES ("51","5","3","3");
INSERT INTO Carre_Cuatri_Mater VALUES ("52","5","4","4");
INSERT INTO Carre_Cuatri_Mater VALUES ("53","5","4","10");
INSERT INTO Carre_Cuatri_Mater VALUES ("54","5","5","5");
INSERT INTO Carre_Cuatri_Mater VALUES ("55","5","6","6");
INSERT INTO Carre_Cuatri_Mater VALUES ("56","5","7","7");
INSERT INTO Carre_Cuatri_Mater VALUES ("57","5","7","11");
INSERT INTO Carre_Cuatri_Mater VALUES ("58","5","8","8");
INSERT INTO Carre_Cuatri_Mater VALUES ("59","5","9","9");
INSERT INTO Carre_Cuatri_Mater VALUES ("60","5","10","12");
INSERT INTO Carre_Cuatri_Mater VALUES ("61","6","1","1");
INSERT INTO Carre_Cuatri_Mater VALUES ("62","6","2","2");
INSERT INTO Carre_Cuatri_Mater VALUES ("63","6","3","3");
INSERT INTO Carre_Cuatri_Mater VALUES ("64","6","4","4");
INSERT INTO Carre_Cuatri_Mater VALUES ("65","6","4","10");
INSERT INTO Carre_Cuatri_Mater VALUES ("66","6","5","5");
INSERT INTO Carre_Cuatri_Mater VALUES ("67","6","6","6");
INSERT INTO Carre_Cuatri_Mater VALUES ("68","6","7","7");
INSERT INTO Carre_Cuatri_Mater VALUES ("69","6","7","11");
INSERT INTO Carre_Cuatri_Mater VALUES ("70","6","8","8");
INSERT INTO Carre_Cuatri_Mater VALUES ("71","6","9","9");
INSERT INTO Carre_Cuatri_Mater VALUES ("72","6","10","12");
INSERT INTO Carre_Cuatri_Mater VALUES ("73","7","1","1");
INSERT INTO Carre_Cuatri_Mater VALUES ("74","7","2","2");
INSERT INTO Carre_Cuatri_Mater VALUES ("75","7","3","3");
INSERT INTO Carre_Cuatri_Mater VALUES ("76","7","4","4");
INSERT INTO Carre_Cuatri_Mater VALUES ("77","7","4","10");
INSERT INTO Carre_Cuatri_Mater VALUES ("78","7","5","5");
INSERT INTO Carre_Cuatri_Mater VALUES ("79","7","6","6");
INSERT INTO Carre_Cuatri_Mater VALUES ("80","7","7","7");
INSERT INTO Carre_Cuatri_Mater VALUES ("81","7","7","11");
INSERT INTO Carre_Cuatri_Mater VALUES ("82","7","8","8");
INSERT INTO Carre_Cuatri_Mater VALUES ("83","7","9","9");
INSERT INTO Carre_Cuatri_Mater VALUES ("84","7","10","12");

-- Table structure for table `Estudiante`
CREATE TABLE `estudiante` (
  `ID_Usuario_E` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Usuario_E` varchar(200) NOT NULL,
  `Apellido_Materno_E` varchar(200) NOT NULL,
  `Apellido_Paterno_E` varchar(200) NOT NULL,
  `Telefono_E` varchar(20) NOT NULL,
  `Fecha_Nacimiento_E` date NOT NULL,
  `Genero_E` varchar(100) NOT NULL,
  `Correo_electronico_E` varchar(250) NOT NULL,
  `Contrasena_E` varchar(250) NOT NULL,
  `IdCarrera` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Usuario_E`),
  KEY `IdCarrera` (`IdCarrera`),
  CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`IdCarrera`) REFERENCES `carrera` (`Id_Carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Estudiante`
INSERT INTO Estudiante VALUES ("1","CRIs","Silva","Medina","1234567890","2024-09-21","Femenino","PMDO200685@upemor.edu.mx","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.","5");

-- Table structure for table `Docente`
CREATE TABLE `docente` (
  `ID_Usuario_D` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Usuario_D` varchar(200) NOT NULL,
  `Apellido_Materno_D` varchar(200) NOT NULL,
  `Apellido_Paterno_D` varchar(200) NOT NULL,
  `Telefono_D` varchar(20) NOT NULL,
  `Fecha_Nacimiento_D` date NOT NULL,
  `Genero_D` varchar(100) NOT NULL,
  `Correo_electronico_D` varchar(250) NOT NULL,
  `Contrasena_D` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Usuario_D`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Docente`
INSERT INTO Docente VALUES ("1","Juan Paulo","Pena","Medina","1234567890","2024-09-21","Femenino","quierotuculitomami@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.");

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Docente_Materia`
INSERT INTO Docente_Materia VALUES ("1","1","10","Doctorado, Profesor a Tiempo Completo");
INSERT INTO Docente_Materia VALUES ("2","1","11","Doctorado, Profesor a Tiempo Completo");
INSERT INTO Docente_Materia VALUES ("3","1","12","Doctorado, Profesor a Tiempo Completo");

-- Table structure for table `Administrador`
CREATE TABLE `administrador` (
  `ID_Usuario_A` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Usuario_A` varchar(200) NOT NULL,
  `Apellido_Materno_A` varchar(200) NOT NULL,
  `Apellido_Paterno_A` varchar(200) NOT NULL,
  `Telefono_A` varchar(20) NOT NULL,
  `Fecha_Nacimiento_A` date NOT NULL,
  `Genero_A` varchar(100) NOT NULL,
  `Correo_electronico_A` varchar(250) NOT NULL,
  `Contrasena_A` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Usuario_A`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Administrador`
INSERT INTO Administrador VALUES ("1","Diego","Pena","Medina","1234567890","2024-09-21","Femenino","mochito619@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.");

-- Table structure for table `Topicos`
CREATE TABLE `topicos` (
  `ID_Topico` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `Temas` text NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `IdCarre` int(11) DEFAULT NULL,
  `IdCuatri` int(11) DEFAULT NULL,
  `IdMateri` int(11) DEFAULT NULL,
  `IdDocent` int(11) DEFAULT NULL,
  `ID_Administrador_Autorizo` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Topico`),
  KEY `IdCarre` (`IdCarre`),
  KEY `IdCuatri` (`IdCuatri`),
  KEY `IdMateri` (`IdMateri`),
  KEY `IdDocent` (`IdDocent`),
  KEY `ID_Administrador_Autorizo` (`ID_Administrador_Autorizo`),
  CONSTRAINT `topicos_ibfk_1` FOREIGN KEY (`IdCarre`) REFERENCES `carrera` (`Id_Carrera`),
  CONSTRAINT `topicos_ibfk_2` FOREIGN KEY (`IdCuatri`) REFERENCES `cuatrimestre` (`Id_Cuatrimestre`),
  CONSTRAINT `topicos_ibfk_3` FOREIGN KEY (`IdMateri`) REFERENCES `materias` (`ID_Materia`),
  CONSTRAINT `topicos_ibfk_4` FOREIGN KEY (`IdDocent`) REFERENCES `docente` (`ID_Usuario_D`),
  CONSTRAINT `topicos_ibfk_5` FOREIGN KEY (`ID_Administrador_Autorizo`) REFERENCES `administrador` (`ID_Usuario_A`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Topicos`
INSERT INTO Topicos VALUES ("1","recursamiento estadia","final","prueba","5","7","11","1","1");

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
  `Titulo` varchar(100) NOT NULL,
  `Tema` varchar(200) NOT NULL,
  `Fch_subida` date NOT NULL,
  `Ubicacion` varchar(250) NOT NULL,
  `ID_Docente_Subio` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Documento`),
  KEY `ID_Docente_Subio` (`ID_Docente_Subio`),
  CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`ID_Docente_Subio`) REFERENCES `docente` (`ID_Usuario_D`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Documentos`
INSERT INTO Documentos VALUES ("1","prueba ara compartir","subtema","2024-10-01","Documentos/Docente/1/Mercancia_Para_Venta_Piso_66fccbbda009c.pdf","1");

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Citas`
INSERT INTO Citas VALUES ("1","prueba ara ictas","2024-09-21","21:14:00","https://grupopryse.mx/index.php","1","1");

-- Table structure for table `Compartir_Recursos`
CREATE TABLE `compartir_recursos` (
  `ID_Compartir_Recurso` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Docente_Com` int(11) DEFAULT NULL,
  `ID_Estudiante_Com` int(11) DEFAULT NULL,
  `ID_Documento_Com` int(11) DEFAULT NULL,
  `ID_Topico_Com` int(11) DEFAULT NULL,
  `Fecha_Compartida` datetime NOT NULL,
  PRIMARY KEY (`ID_Compartir_Recurso`),
  KEY `ID_Docente_Com` (`ID_Docente_Com`),
  KEY `ID_Estudiante_Com` (`ID_Estudiante_Com`),
  KEY `ID_Documento_Com` (`ID_Documento_Com`),
  KEY `ID_Topico_Com` (`ID_Topico_Com`),
  CONSTRAINT `compartir_recursos_ibfk_1` FOREIGN KEY (`ID_Docente_Com`) REFERENCES `docente` (`ID_Usuario_D`),
  CONSTRAINT `compartir_recursos_ibfk_2` FOREIGN KEY (`ID_Estudiante_Com`) REFERENCES `estudiante` (`ID_Usuario_E`),
  CONSTRAINT `compartir_recursos_ibfk_3` FOREIGN KEY (`ID_Documento_Com`) REFERENCES `documentos` (`ID_Documento`),
  CONSTRAINT `compartir_recursos_ibfk_4` FOREIGN KEY (`ID_Topico_Com`) REFERENCES `topicos` (`ID_Topico`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Compartir_Recursos`
INSERT INTO Compartir_Recursos VALUES ("1","1","1","1","1","2024-10-01 22:35:13");

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Evaluacion_Material`
INSERT INTO Evaluacion_Material VALUES ("2","5","prueba final","2024-10-01 23:03:12","1");

-- Table structure for table `Evaluacion_Citas`
CREATE TABLE `evaluacion_citas` (
  `ID_Evaluacion_Cita` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Citas` int(11) NOT NULL,
  `Fecha_Evaluacion` date NOT NULL,
  `Hora_Evaluacion` time NOT NULL,
  `Comentarios` text DEFAULT NULL,
  `calificacionCita` int(11) NOT NULL,
  PRIMARY KEY (`ID_Evaluacion_Cita`),
  KEY `ID_Citas` (`ID_Citas`),
  CONSTRAINT `evaluacion_citas_ibfk_1` FOREIGN KEY (`ID_Citas`) REFERENCES `citas` (`ID_Cita`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Evaluacion_Citas`

-- Table structure for table `Encuesta`
CREATE TABLE `encuesta` (
  `ID_Encuesta` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_Encuesta` datetime NOT NULL,
  `ID_Topicos` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Encuesta`),
  KEY `ID_Topicos` (`ID_Topicos`),
  CONSTRAINT `encuesta_ibfk_1` FOREIGN KEY (`ID_Topicos`) REFERENCES `topicos` (`ID_Topico`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Encuesta`
INSERT INTO Encuesta VALUES ("39","2024-09-29 22:49:56","1");

-- Table structure for table `Pregunta`
CREATE TABLE `pregunta` (
  `ID_Pregunta` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Pregunta` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Pregunta`
INSERT INTO Pregunta VALUES ("13","F");
INSERT INTO Pregunta VALUES ("14","prueba");
INSERT INTO Pregunta VALUES ("15","moi");
INSERT INTO Pregunta VALUES ("16","9");
INSERT INTO Pregunta VALUES ("17","n");
INSERT INTO Pregunta VALUES ("18","tu");
INSERT INTO Pregunta VALUES ("19","y");
INSERT INTO Pregunta VALUES ("20","¿Fue grato tomar esta clase?");
INSERT INTO Pregunta VALUES ("21","¿Como te sientes con estas clases?");

-- Table structure for table `Encuesta_Pregunta`
CREATE TABLE `encuesta_pregunta` (
  `ID_Encuesta_Pregunta` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Encuestas` int(11) DEFAULT NULL,
  `ID_Preguntas` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Encuesta_Pregunta`),
  KEY `ID_Encuestas` (`ID_Encuestas`),
  KEY `ID_Preguntas` (`ID_Preguntas`),
  CONSTRAINT `encuesta_pregunta_ibfk_1` FOREIGN KEY (`ID_Encuestas`) REFERENCES `encuesta` (`ID_Encuesta`),
  CONSTRAINT `encuesta_pregunta_ibfk_2` FOREIGN KEY (`ID_Preguntas`) REFERENCES `pregunta` (`ID_Pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Encuesta_Pregunta`
INSERT INTO Encuesta_Pregunta VALUES ("36","39","20");
INSERT INTO Encuesta_Pregunta VALUES ("37","39","21");

-- Table structure for table `Evaluacion_Estudiante_Topico`
CREATE TABLE `evaluacion_estudiante_topico` (
  `ID_Evaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `Calificacion` varchar(250) NOT NULL,
  `ID_EstudianteEva` int(11) DEFAULT NULL,
  `ID_TopicoEva` int(11) DEFAULT NULL,
  `Fecha_EvaTopico` datetime NOT NULL,
  PRIMARY KEY (`ID_Evaluacion`),
  KEY `ID_EstudianteEva` (`ID_EstudianteEva`),
  KEY `ID_TopicoEva` (`ID_TopicoEva`),
  CONSTRAINT `evaluacion_estudiante_topico_ibfk_1` FOREIGN KEY (`ID_EstudianteEva`) REFERENCES `estudiante` (`ID_Usuario_E`),
  CONSTRAINT `evaluacion_estudiante_topico_ibfk_2` FOREIGN KEY (`ID_TopicoEva`) REFERENCES `topicos` (`ID_Topico`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Evaluacion_Estudiante_Topico`
INSERT INTO Evaluacion_Estudiante_Topico VALUES ("4","Neutral","1","1","2024-10-04 21:03:44");
INSERT INTO Evaluacion_Estudiante_Topico VALUES ("5","Totalmente Satisfecho","1","1","2024-10-04 21:03:44");

