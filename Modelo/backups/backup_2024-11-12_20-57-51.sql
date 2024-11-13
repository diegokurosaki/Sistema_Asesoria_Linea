-- MySQL Host: localhost
-- MySQL User: root
-- MySQL Password: 
-- Database Name: Asesoria_Linea

-- Table structure for table `Materias`
CREATE TABLE `materias` (
  `ID_Materia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Materia` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Materia`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Materias`
INSERT INTO Materias VALUES ("1","Desarrollo Humano y Valores");
INSERT INTO Materias VALUES ("2","Proceso Administrativo");
INSERT INTO Materias VALUES ("3","Economia de la Empresa");
INSERT INTO Materias VALUES ("4","Lesgislacion Laboral");
INSERT INTO Materias VALUES ("5","Econometria");
INSERT INTO Materias VALUES ("6","Formulacion de Proyectos");
INSERT INTO Materias VALUES ("7","Consultoria");
INSERT INTO Materias VALUES ("8","Quimica Basica");
INSERT INTO Materias VALUES ("9","Quimica Inorganica");
INSERT INTO Materias VALUES ("10","Bioquimica");
INSERT INTO Materias VALUES ("11","Biologia Molecular");
INSERT INTO Materias VALUES ("12","Control Estadistico");
INSERT INTO Materias VALUES ("13","Metabolomica");
INSERT INTO Materias VALUES ("14","Mejora de Bioprocesos");
INSERT INTO Materias VALUES ("15","Fisica");
INSERT INTO Materias VALUES ("16","Biologia");
INSERT INTO Materias VALUES ("17","Analisis Instrumental");
INSERT INTO Materias VALUES ("18","Termodinamica");
INSERT INTO Materias VALUES ("19","Fisicoquimica");
INSERT INTO Materias VALUES ("20","Optativa");
INSERT INTO Materias VALUES ("21","Tratamiento de Agua");
INSERT INTO Materias VALUES ("22","Dibujo para la Ingeneria");
INSERT INTO Materias VALUES ("23","Mecanica Clasica");
INSERT INTO Materias VALUES ("24","Metrologia");
INSERT INTO Materias VALUES ("25","Estudio del Trabajo");
INSERT INTO Materias VALUES ("26","Ergonomia");
INSERT INTO Materias VALUES ("27","Logistica");
INSERT INTO Materias VALUES ("28","Industria Sustentable");
INSERT INTO Materias VALUES ("29","Herramientas Ofimaticas");
INSERT INTO Materias VALUES ("30","Arquitectura de Computadoras");
INSERT INTO Materias VALUES ("31","Programacion");
INSERT INTO Materias VALUES ("32","Base de datos");
INSERT INTO Materias VALUES ("33","Sistemas Operativos");
INSERT INTO Materias VALUES ("34","Sistemas Inteligentes");
INSERT INTO Materias VALUES ("35","Programacion Movil");
INSERT INTO Materias VALUES ("36","Fundamentos Fisica");
INSERT INTO Materias VALUES ("37","Electricidad y Magnetismo");
INSERT INTO Materias VALUES ("38","Circuitos Logicos");
INSERT INTO Materias VALUES ("39","Metodos Numericos");
INSERT INTO Materias VALUES ("40","Microcontroladores");
INSERT INTO Materias VALUES ("41","Comunicaciones Digitales");
INSERT INTO Materias VALUES ("42","Comunicaciones Opticas");
INSERT INTO Materias VALUES ("43","Microeconomia");
INSERT INTO Materias VALUES ("44","Administracion Estrategica");
INSERT INTO Materias VALUES ("45","Estructura Financiera");
INSERT INTO Materias VALUES ("46","Presupuestos");
INSERT INTO Materias VALUES ("47","Planeacion Financiera");
INSERT INTO Materias VALUES ("48","Finanzas Publicas");
INSERT INTO Materias VALUES ("49","Valuacion de Empresas");
INSERT INTO Materias VALUES ("50","Estancia 1");
INSERT INTO Materias VALUES ("51","Estancia 2");
INSERT INTO Materias VALUES ("52","Estadia");

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Carre_Cuatri_Mater`
INSERT INTO Carre_Cuatri_Mater VALUES ("1","1","1","1");
INSERT INTO Carre_Cuatri_Mater VALUES ("2","1","2","2");
INSERT INTO Carre_Cuatri_Mater VALUES ("3","1","3","3");
INSERT INTO Carre_Cuatri_Mater VALUES ("4","1","4","50");
INSERT INTO Carre_Cuatri_Mater VALUES ("5","1","5","4");
INSERT INTO Carre_Cuatri_Mater VALUES ("6","1","6","5");
INSERT INTO Carre_Cuatri_Mater VALUES ("7","1","7","51");
INSERT INTO Carre_Cuatri_Mater VALUES ("8","1","8","6");
INSERT INTO Carre_Cuatri_Mater VALUES ("9","1","9","7");
INSERT INTO Carre_Cuatri_Mater VALUES ("10","1","10","52");
INSERT INTO Carre_Cuatri_Mater VALUES ("11","2","1","8");
INSERT INTO Carre_Cuatri_Mater VALUES ("12","2","2","9");
INSERT INTO Carre_Cuatri_Mater VALUES ("13","2","3","10");
INSERT INTO Carre_Cuatri_Mater VALUES ("14","2","4","50");
INSERT INTO Carre_Cuatri_Mater VALUES ("15","2","5","11");
INSERT INTO Carre_Cuatri_Mater VALUES ("16","2","6","12");
INSERT INTO Carre_Cuatri_Mater VALUES ("17","2","7","51");
INSERT INTO Carre_Cuatri_Mater VALUES ("18","2","8","13");
INSERT INTO Carre_Cuatri_Mater VALUES ("19","2","9","14");
INSERT INTO Carre_Cuatri_Mater VALUES ("20","2","10","52");
INSERT INTO Carre_Cuatri_Mater VALUES ("21","3","1","15");
INSERT INTO Carre_Cuatri_Mater VALUES ("22","3","2","16");
INSERT INTO Carre_Cuatri_Mater VALUES ("23","3","3","17");
INSERT INTO Carre_Cuatri_Mater VALUES ("24","3","4","50");
INSERT INTO Carre_Cuatri_Mater VALUES ("25","3","5","18");
INSERT INTO Carre_Cuatri_Mater VALUES ("26","3","6","19");
INSERT INTO Carre_Cuatri_Mater VALUES ("27","3","7","51");
INSERT INTO Carre_Cuatri_Mater VALUES ("28","3","8","20");
INSERT INTO Carre_Cuatri_Mater VALUES ("29","3","9","21");
INSERT INTO Carre_Cuatri_Mater VALUES ("30","3","10","52");
INSERT INTO Carre_Cuatri_Mater VALUES ("31","4","1","22");
INSERT INTO Carre_Cuatri_Mater VALUES ("32","4","2","23");
INSERT INTO Carre_Cuatri_Mater VALUES ("33","4","3","24");
INSERT INTO Carre_Cuatri_Mater VALUES ("34","4","4","50");
INSERT INTO Carre_Cuatri_Mater VALUES ("35","4","5","25");
INSERT INTO Carre_Cuatri_Mater VALUES ("36","4","6","26");
INSERT INTO Carre_Cuatri_Mater VALUES ("37","4","7","51");
INSERT INTO Carre_Cuatri_Mater VALUES ("38","4","8","27");
INSERT INTO Carre_Cuatri_Mater VALUES ("39","4","9","28");
INSERT INTO Carre_Cuatri_Mater VALUES ("40","4","10","52");
INSERT INTO Carre_Cuatri_Mater VALUES ("41","5","1","29");
INSERT INTO Carre_Cuatri_Mater VALUES ("42","5","2","30");
INSERT INTO Carre_Cuatri_Mater VALUES ("43","5","3","31");
INSERT INTO Carre_Cuatri_Mater VALUES ("44","5","4","50");
INSERT INTO Carre_Cuatri_Mater VALUES ("45","5","5","32");
INSERT INTO Carre_Cuatri_Mater VALUES ("46","5","6","33");
INSERT INTO Carre_Cuatri_Mater VALUES ("47","5","7","51");
INSERT INTO Carre_Cuatri_Mater VALUES ("48","5","8","34");
INSERT INTO Carre_Cuatri_Mater VALUES ("49","5","9","35");
INSERT INTO Carre_Cuatri_Mater VALUES ("50","5","10","52");
INSERT INTO Carre_Cuatri_Mater VALUES ("51","6","1","36");
INSERT INTO Carre_Cuatri_Mater VALUES ("52","6","2","37");
INSERT INTO Carre_Cuatri_Mater VALUES ("53","6","3","38");
INSERT INTO Carre_Cuatri_Mater VALUES ("54","6","4","50");
INSERT INTO Carre_Cuatri_Mater VALUES ("55","6","5","39");
INSERT INTO Carre_Cuatri_Mater VALUES ("56","6","6","40");
INSERT INTO Carre_Cuatri_Mater VALUES ("57","6","7","51");
INSERT INTO Carre_Cuatri_Mater VALUES ("58","6","8","41");
INSERT INTO Carre_Cuatri_Mater VALUES ("59","6","9","42");
INSERT INTO Carre_Cuatri_Mater VALUES ("60","6","10","52");
INSERT INTO Carre_Cuatri_Mater VALUES ("61","7","1","43");
INSERT INTO Carre_Cuatri_Mater VALUES ("62","7","2","44");
INSERT INTO Carre_Cuatri_Mater VALUES ("63","7","3","45");
INSERT INTO Carre_Cuatri_Mater VALUES ("64","7","4","50");
INSERT INTO Carre_Cuatri_Mater VALUES ("65","7","5","46");
INSERT INTO Carre_Cuatri_Mater VALUES ("66","7","6","47");
INSERT INTO Carre_Cuatri_Mater VALUES ("67","7","7","51");
INSERT INTO Carre_Cuatri_Mater VALUES ("68","7","8","48");
INSERT INTO Carre_Cuatri_Mater VALUES ("69","7","9","49");
INSERT INTO Carre_Cuatri_Mater VALUES ("70","7","10","52");

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Estudiante`
INSERT INTO Estudiante VALUES ("1","Vania","Montoya","Medina","1234567890","2024-10-07","Masculino","Usuario1@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.","1");
INSERT INTO Estudiante VALUES ("2","Mickey","Silva","Trevor","1234567890","2024-09-07","Femenino","Usuario2@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.","2");
INSERT INTO Estudiante VALUES ("3","CRIs","Castro","Gonzalez","1234567890","2024-08-07","Masculino","Usuario3@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.","3");
INSERT INTO Estudiante VALUES ("4","Monica","Silva","Gonzalez","1234567890","2024-07-07","Femenino","Usuario4@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.","4");
INSERT INTO Estudiante VALUES ("5","CRIs","Silva","Medina","1234567890","2024-06-07","Masculino","Usuario5@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.","5");
INSERT INTO Estudiante VALUES ("6","Yessica","Daniel","Diaz","1234567890","2024-05-07","Femenino","Usuario6@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.","6");
INSERT INTO Estudiante VALUES ("7","Diego","Medina","Cruz","1234567890","2024-04-07","Masculino","Usuario7@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.","7");

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Docente`
INSERT INTO Docente VALUES ("1","Juan Paulo","Pena","Medina","1234567890","2024-10-07","","quierotuculitomami@gmail.com","$2y$10$dbO9sBaiplgfnIUyBNM/R.AV58gwioufuoU7.azVbM4x5NZSjt0Dy");
INSERT INTO Docente VALUES ("2","Alma Delia","Gonzalez","Cruz","1234567892","2024-01-07","Femenino","mochito618@gmail.com","$2y$10$F9USxy2cHI5JVxwVt.xsgOYGvesSaJDfNX.tEbNWfuj.0IVkOZf3i");

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Docente_Materia`
INSERT INTO Docente_Materia VALUES ("4","1","50","Doctorado, Profesor a Tiempo Completo");
INSERT INTO Docente_Materia VALUES ("5","1","51","Doctorado, Profesor a Tiempo Completo");
INSERT INTO Docente_Materia VALUES ("6","1","52","Doctorado, Profesor a Tiempo Completo");
INSERT INTO Docente_Materia VALUES ("7","1","34","Doctorado, Profesor a Tiempo Completo");
INSERT INTO Docente_Materia VALUES ("8","1","31","Doctorado, Profesor a Tiempo Completo");
INSERT INTO Docente_Materia VALUES ("9","2","14","doctor a tiempo completo");
INSERT INTO Docente_Materia VALUES ("10","2","16","doctor a tiempo completo");
INSERT INTO Docente_Materia VALUES ("11","2","15","doctor a tiempo completo");
INSERT INTO Docente_Materia VALUES ("12","2","11","doctor a tiempo completo");
INSERT INTO Docente_Materia VALUES ("13","2","10","doctor a tiempo completo");

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
INSERT INTO Administrador VALUES ("1","Diego","Pena","Medina","1234567890","2024-10-07","Femenino","mochito619@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.");

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Topicos`
INSERT INTO Topicos VALUES ("1","recursamiento estadia","jj","prueba","5","10","52","1","1");

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Datos`
INSERT INTO Datos VALUES ("1","P1","6","esta wey","5","29");
INSERT INTO Datos VALUES ("2","P2","7","esta menos","5","29");
INSERT INTO Datos VALUES ("3","EFO","5","esta bien pendejo","5","29");

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
INSERT INTO Documentos VALUES ("1","Proceso de estadia","proceso de documentacion","2024-10-20","Documentos/Docente/1/AutoCritica_671584b4dce1b.pdf","1");

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Citas`

-- Table structure for table `Registrar_Cita_Doc_Alumno`
CREATE TABLE `registrar_cita_doc_alumno` (
  `ID_RegCitDocAlum` int(11) NOT NULL AUTO_INCREMENT,
  `IdCitas` int(11) DEFAULT NULL,
  `FechaActual` datetime NOT NULL,
  `Respuesta` int(11) DEFAULT NULL,
  `Observacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_RegCitDocAlum`),
  KEY `IdCitas` (`IdCitas`),
  CONSTRAINT `registrar_cita_doc_alumno_ibfk_1` FOREIGN KEY (`IdCitas`) REFERENCES `citas` (`ID_Cita`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Registrar_Cita_Doc_Alumno`
INSERT INTO Registrar_Cita_Doc_Alumno VALUES ("3","4","2024-10-23 20:28:28","1","esta wey");

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
INSERT INTO Compartir_Recursos VALUES ("1","1","5","1","1","2024-10-20 16:32:02");

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
  `calificacionCita` int(11) NOT NULL,
  PRIMARY KEY (`ID_Evaluacion_Cita`),
  KEY `ID_Citas` (`ID_Citas`),
  CONSTRAINT `evaluacion_citas_ibfk_1` FOREIGN KEY (`ID_Citas`) REFERENCES `citas` (`ID_Cita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Evaluacion_Citas`

-- Table structure for table `Encuesta`
CREATE TABLE `encuesta` (
  `ID_Encuesta` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_Encuesta` datetime NOT NULL,
  `ID_Topicos` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Encuesta`),
  KEY `ID_Topicos` (`ID_Topicos`),
  CONSTRAINT `encuesta_ibfk_1` FOREIGN KEY (`ID_Topicos`) REFERENCES `topicos` (`ID_Topico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Encuesta`

-- Table structure for table `Pregunta`
CREATE TABLE `pregunta` (
  `ID_Pregunta` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Pregunta` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Pregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Pregunta`

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Encuesta_Pregunta`

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Evaluacion_Estudiante_Topico`

