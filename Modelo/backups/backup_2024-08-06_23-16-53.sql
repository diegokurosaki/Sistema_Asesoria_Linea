-- MySQL Host: localhost
-- MySQL User: root
-- MySQL Password: 
-- Database Name: Asesoria_Linea

-- Table structure for table `Materias`
CREATE TABLE `materias` (
  `ID_Materia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Materia` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Materia`)
) ENGINE=InnoDB AUTO_INCREMENT=335 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Materias`
INSERT INTO Materias VALUES ("1","Inglés I");
INSERT INTO Materias VALUES ("2","Desarrollo Humano y Valores");
INSERT INTO Materias VALUES ("3","Introducción a las Matemáticas");
INSERT INTO Materias VALUES ("4","Introducción a la Administración");
INSERT INTO Materias VALUES ("5","Introducción a la Contabilidad");
INSERT INTO Materias VALUES ("6","Marco Legal de las Organizaciones");
INSERT INTO Materias VALUES ("7","Expresión Oral y Escrita I");
INSERT INTO Materias VALUES ("8","Inglés II");
INSERT INTO Materias VALUES ("9","Inteligencia Emocional y Manejo de Conflictos");
INSERT INTO Materias VALUES ("10","Matemáticas Aplicadas a la Administración");
INSERT INTO Materias VALUES ("11","Proceso Administrativo");
INSERT INTO Materias VALUES ("12","Contabilidad");
INSERT INTO Materias VALUES ("13","Derecho Mercantil");
INSERT INTO Materias VALUES ("14","Sistemas de Información en las Organizaciones");
INSERT INTO Materias VALUES ("15","Inglés III");
INSERT INTO Materias VALUES ("16","Habilidades Cognitivas y Creatividad");
INSERT INTO Materias VALUES ("17","Probabilidad y Estadística");
INSERT INTO Materias VALUES ("18","Planeación Estratégica en las Organizaciones");
INSERT INTO Materias VALUES ("19","Contabilidad Administrativa");
INSERT INTO Materias VALUES ("20","Economía de la Empresa");
INSERT INTO Materias VALUES ("21","Metodología de la Investigación");
INSERT INTO Materias VALUES ("22","Inglés IV");
INSERT INTO Materias VALUES ("23","Ética Profesional");
INSERT INTO Materias VALUES ("24","Administración y Gestión del Talento Humano");
INSERT INTO Materias VALUES ("25","Contabilidad de Costos - Productos");
INSERT INTO Materias VALUES ("26","Fundamentos de Mercadotecnia");
INSERT INTO Materias VALUES ("27","Agregados Económicos");
INSERT INTO Materias VALUES ("28","Estancia I");
INSERT INTO Materias VALUES ("29","Inglés V");
INSERT INTO Materias VALUES ("30","Habilidades Gerenciales");
INSERT INTO Materias VALUES ("31","Matemáticas Financieras");
INSERT INTO Materias VALUES ("32","Comportamiento y Desarrollo Empresarial");
INSERT INTO Materias VALUES ("33","Contabilidad de Costos-Servicios");
INSERT INTO Materias VALUES ("34","Investigación de mercados");
INSERT INTO Materias VALUES ("35","Legislación laboral");
INSERT INTO Materias VALUES ("36","Inglés VI");
INSERT INTO Materias VALUES ("37","Liderazgo de Equipos de Alto Desempeño");
INSERT INTO Materias VALUES ("38","Econometría");
INSERT INTO Materias VALUES ("39","Administración Financiera");
INSERT INTO Materias VALUES ("40","Administración de Sueldos y Salarios");
INSERT INTO Materias VALUES ("41","Mercadotecnia Estratégica");
INSERT INTO Materias VALUES ("42","Administración de la Calidad");
INSERT INTO Materias VALUES ("43","Inglés VII");
INSERT INTO Materias VALUES ("44","Comercio Internacional");
INSERT INTO Materias VALUES ("45","Sustentabilidad");
INSERT INTO Materias VALUES ("46","Contribuciones Fiscales");
INSERT INTO Materias VALUES ("47","Administración de la Producción");
INSERT INTO Materias VALUES ("48","Tecnologías de la Información aplicada a los Negocios");
INSERT INTO Materias VALUES ("49","Estancia II");
INSERT INTO Materias VALUES ("50","Inglés VIII");
INSERT INTO Materias VALUES ("51","Negociación y Toma de Decisiones Empresariales");
INSERT INTO Materias VALUES ("52","Emprendimiento");
INSERT INTO Materias VALUES ("53","Auditoría Administrativa");
INSERT INTO Materias VALUES ("54","Formulación de Proyectos");
INSERT INTO Materias VALUES ("55","Logística Administrativa");
INSERT INTO Materias VALUES ("56","Responsabilidad Social Empresarial");
INSERT INTO Materias VALUES ("57","Inglés IX");
INSERT INTO Materias VALUES ("58","Administración de Redes Empresariales");
INSERT INTO Materias VALUES ("59","Consultoría");
INSERT INTO Materias VALUES ("60","Gestión de Marca");
INSERT INTO Materias VALUES ("61","Gestión y Evaluación de Proyectos");
INSERT INTO Materias VALUES ("62","Expresión Oral y Escrita II");
INSERT INTO Materias VALUES ("63","Comercialización Internacional");
INSERT INTO Materias VALUES ("64","Estadía");
INSERT INTO Materias VALUES ("65","Química Básica");
INSERT INTO Materias VALUES ("66","Álgebra Lineal");
INSERT INTO Materias VALUES ("67","Química Orgánica");
INSERT INTO Materias VALUES ("68","Física para Ingeniería");
INSERT INTO Materias VALUES ("69","Biotecnología y Desarrollo Sustentable");
INSERT INTO Materias VALUES ("70","Funciones Matemáticas");
INSERT INTO Materias VALUES ("71","Probabilidad y Estadística");
INSERT INTO Materias VALUES ("72","Química inorgánica");
INSERT INTO Materias VALUES ("73","Biología");
INSERT INTO Materias VALUES ("74","Química analítica");
INSERT INTO Materias VALUES ("75","Cálculo Diferencial");
INSERT INTO Materias VALUES ("76","Fundamentos de Microbiología");
INSERT INTO Materias VALUES ("77","Bioquímica");
INSERT INTO Materias VALUES ("78","Termodinámica");
INSERT INTO Materias VALUES ("79","Análisis de Bioproductos");
INSERT INTO Materias VALUES ("80","Cálculo Integral");
INSERT INTO Materias VALUES ("81","Balance de Materia y Energía");
INSERT INTO Materias VALUES ("82","Microbiología Avanzada");
INSERT INTO Materias VALUES ("83","Fisicoquímica");
INSERT INTO Materias VALUES ("84","Matemáticas para Ingeniería I");
INSERT INTO Materias VALUES ("85","Biocatálisis");
INSERT INTO Materias VALUES ("86","Fundamentos de Bioprocesos");
INSERT INTO Materias VALUES ("87","Fenómenos de Transporte");
INSERT INTO Materias VALUES ("88","Biología Molecular");
INSERT INTO Materias VALUES ("89","Matemáticas para Ingeniería II");
INSERT INTO Materias VALUES ("90","Operaciones Unitarias");
INSERT INTO Materias VALUES ("91","Ingeniería de Biorreactores");
INSERT INTO Materias VALUES ("92","Control Estadístico");
INSERT INTO Materias VALUES ("93","Ingeniería Genética");
INSERT INTO Materias VALUES ("94","Bioinformática");
INSERT INTO Materias VALUES ("95","Ingeniería de Bioprocesos");
INSERT INTO Materias VALUES ("96","Ingeniería de Proyectos");
INSERT INTO Materias VALUES ("97","Bioseguridad e Higiene");
INSERT INTO Materias VALUES ("98","Control de Bioprocesos");
INSERT INTO Materias VALUES ("99","Metabolómica");
INSERT INTO Materias VALUES ("100","Control de Calidad");
INSERT INTO Materias VALUES ("101","Biotecnología Ambiental");
INSERT INTO Materias VALUES ("102","Biotecnología Agropecuaria");
INSERT INTO Materias VALUES ("103","Mejora de Bioprocesos");
INSERT INTO Materias VALUES ("104","Biotecnología en Alimentos");
INSERT INTO Materias VALUES ("105","Biotecnología Médico-Farmacéutica");
INSERT INTO Materias VALUES ("106","Gestión de Proyectos");
INSERT INTO Materias VALUES ("107","Valores del Ser");
INSERT INTO Materias VALUES ("108","Química Inorgánica");
INSERT INTO Materias VALUES ("109","Física");
INSERT INTO Materias VALUES ("110","Álgebra y Sistemas Lineales");
INSERT INTO Materias VALUES ("111","Contaminación Ambiental y Sustentabilidad");
INSERT INTO Materias VALUES ("112","Metodología de la Investigación");
INSERT INTO Materias VALUES ("113","Inteligencia Emocional");
INSERT INTO Materias VALUES ("114","Cálculo Diferencial");
INSERT INTO Materias VALUES ("115","Bioestadística y Muestreo Estadístico");
INSERT INTO Materias VALUES ("116","Química Orgánica");
INSERT INTO Materias VALUES ("117","Química Analítica");
INSERT INTO Materias VALUES ("118","Biología");
INSERT INTO Materias VALUES ("119","Desarrollo Interpersonal");
INSERT INTO Materias VALUES ("120","Cálculo Integral");
INSERT INTO Materias VALUES ("121","Análisis Instrumental");
INSERT INTO Materias VALUES ("122","Química Ambiental");
INSERT INTO Materias VALUES ("123","Microbiología Ambiental");
INSERT INTO Materias VALUES ("124","Legislación Ambiental y Gestión");
INSERT INTO Materias VALUES ("125","Habilidades del Pensamiento");
INSERT INTO Materias VALUES ("126","Modelos Matemáticos");
INSERT INTO Materias VALUES ("127","Diseño Experimental");
INSERT INTO Materias VALUES ("128","Sistemas de Información Geográfica");
INSERT INTO Materias VALUES ("129","Seguridad e Higiene Industrial");
INSERT INTO Materias VALUES ("130","Habilidades Organizacionales");
INSERT INTO Materias VALUES ("131","Métodos Numéricos Asistidos por Computadora");
INSERT INTO Materias VALUES ("132","Bioquímica");
INSERT INTO Materias VALUES ("133","Termodinámica");
INSERT INTO Materias VALUES ("134","Ordenamiento Territorial y Ecológico");
INSERT INTO Materias VALUES ("135","Impacto Ambiental");
INSERT INTO Materias VALUES ("136","Gestión Integral de Residuos");
INSERT INTO Materias VALUES ("137","Planeación Estratégica y Consultoría");
INSERT INTO Materias VALUES ("138","Balance de Materia y Energía");
INSERT INTO Materias VALUES ("139","Fisicoquímica");
INSERT INTO Materias VALUES ("140","Auditoría Ambiental");
INSERT INTO Materias VALUES ("141","Operaciones Unitarias para Sistemas Ambientales");
INSERT INTO Materias VALUES ("142","Transporte de Masa y Momento");
INSERT INTO Materias VALUES ("143","Tecnologías para el Tratamiento de Residuos");
INSERT INTO Materias VALUES ("144","Ingeniería Económica y Evaluación de Proyectos Ambientales");
INSERT INTO Materias VALUES ("145","Ingeniería de Bioprocesos");
INSERT INTO Materias VALUES ("146","Remediación de Suelos");
INSERT INTO Materias VALUES ("147","Transporte de Calor");
INSERT INTO Materias VALUES ("148","Operaciones Unitarias Avanzadas");
INSERT INTO Materias VALUES ("149","Mecánica de Fluidos e Hidráulica");
INSERT INTO Materias VALUES ("150","Optimización de Procesos Ambientales");
INSERT INTO Materias VALUES ("151","Tecnología para el Tratamiento de Aire");
INSERT INTO Materias VALUES ("152","Simulación y Evaluación de Tecnologías Ambientales");
INSERT INTO Materias VALUES ("153","Tratamiento de Agua");
INSERT INTO Materias VALUES ("154","Energías Alternativas");
INSERT INTO Materias VALUES ("155","Valores del Ser");
INSERT INTO Materias VALUES ("156","Probabilidad y Estadística");
INSERT INTO Materias VALUES ("157","Cálculo Diferencial");
INSERT INTO Materias VALUES ("158","Ingeniería Industrial");
INSERT INTO Materias VALUES ("159","Dibujo para la Ingeniería");
INSERT INTO Materias VALUES ("160","Química y Procesos Termodinámicos");
INSERT INTO Materias VALUES ("161","Inteligencia Emocional");
INSERT INTO Materias VALUES ("162","Control Estadístico de Calidad");
INSERT INTO Materias VALUES ("163","Cálculo Integral");
INSERT INTO Materias VALUES ("164","Seguridad e Higiene Industrial");
INSERT INTO Materias VALUES ("165","Mecánica Clásica");
INSERT INTO Materias VALUES ("166","Química y Tecnología de los Materiales");
INSERT INTO Materias VALUES ("167","Desarrollo Interpersonal");
INSERT INTO Materias VALUES ("168","Álgebra Lineal");
INSERT INTO Materias VALUES ("169","Ecuaciones Diferenciales");
INSERT INTO Materias VALUES ("170","Electricidad y Magnetismo");
INSERT INTO Materias VALUES ("171","Metrología");
INSERT INTO Materias VALUES ("172","Procesos de Fabricación");
INSERT INTO Materias VALUES ("173","Habilidades del Pensamiento");
INSERT INTO Materias VALUES ("174","Lógica de Programación");
INSERT INTO Materias VALUES ("175","Estadística Industrial");
INSERT INTO Materias VALUES ("176","Análisis y Enfoque de Sistemas");
INSERT INTO Materias VALUES ("177","Ingeniería de Métodos");
INSERT INTO Materias VALUES ("178","Habilidades Organizacionales");
INSERT INTO Materias VALUES ("179","Administración de la Producción");
INSERT INTO Materias VALUES ("180","Investigación de Operaciones");
INSERT INTO Materias VALUES ("181","Ingeniería de Planta");
INSERT INTO Materias VALUES ("182","Estudio del Trabajo");
INSERT INTO Materias VALUES ("183","Fundamentos de Ingeniería Electrónica");
INSERT INTO Materias VALUES ("184","Planeación de la Producción");
INSERT INTO Materias VALUES ("185","Análisis de Decisiones");
INSERT INTO Materias VALUES ("186","Automatización y Control");
INSERT INTO Materias VALUES ("187","Ergonomía");
INSERT INTO Materias VALUES ("188","Seis Sigma y Análisis de Falla");
INSERT INTO Materias VALUES ("189","Ingeniería Económica");
INSERT INTO Materias VALUES ("190","Sistemas de Manufactura");
INSERT INTO Materias VALUES ("191","Proceso Administrativo y Planeación Estratégica");
INSERT INTO Materias VALUES ("192","Contabilidad Industrial");
INSERT INTO Materias VALUES ("193","Optativa");
INSERT INTO Materias VALUES ("194","Administración de la Calidad Total");
INSERT INTO Materias VALUES ("195","Optativa");
INSERT INTO Materias VALUES ("196","Simulación de Sistemas Productivos");
INSERT INTO Materias VALUES ("197","Optativa");
INSERT INTO Materias VALUES ("198","Logística");
INSERT INTO Materias VALUES ("199","Análisis Financiero");
INSERT INTO Materias VALUES ("200","Sistemas de Gestión de la Calidad");
INSERT INTO Materias VALUES ("201","Evaluación y Administración de Proyectos");
INSERT INTO Materias VALUES ("202","Industria Sustentable");
INSERT INTO Materias VALUES ("203","Optativa");
INSERT INTO Materias VALUES ("204","Administración de Recursos Humanos");
INSERT INTO Materias VALUES ("205","Manufactura de Clase Mundial");
INSERT INTO Materias VALUES ("206","Química Básica");
INSERT INTO Materias VALUES ("207","Introducción a la Programación");
INSERT INTO Materias VALUES ("208","Introducción a las Tecnologías de la Información");
INSERT INTO Materias VALUES ("209","Herramientas Ofimáticas");
INSERT INTO Materias VALUES ("210","Funciones Matemáticas");
INSERT INTO Materias VALUES ("211","Física");
INSERT INTO Materias VALUES ("212","Electricidad y Magnetismo");
INSERT INTO Materias VALUES ("213","Matemáticas Básicas para Computación");
INSERT INTO Materias VALUES ("214","Arquitectura de Computadoras");
INSERT INTO Materias VALUES ("215","Probabilidad y Estadística");
INSERT INTO Materias VALUES ("216","Programación");
INSERT INTO Materias VALUES ("217","Introducción a Redes");
INSERT INTO Materias VALUES ("218","Mantenimiento a Equipo de Cómputo");
INSERT INTO Materias VALUES ("219","Ingeniería de Software");
INSERT INTO Materias VALUES ("220","Estructura de Datos");
INSERT INTO Materias VALUES ("221","Ruteo y Conmutación");
INSERT INTO Materias VALUES ("222","Matemáticas para Ingeniería I");
INSERT INTO Materias VALUES ("223","Física para Ingeniería");
INSERT INTO Materias VALUES ("224","Fundamentos de Programación Orientada a Objetos");
INSERT INTO Materias VALUES ("225","Escalamiento de Redes");
INSERT INTO Materias VALUES ("226","Base de Datos");
INSERT INTO Materias VALUES ("227","Matemáticas para Ingeniería II");
INSERT INTO Materias VALUES ("228","Sistemas Operativos");
INSERT INTO Materias VALUES ("229","Programación Orientada a Objetos");
INSERT INTO Materias VALUES ("230","Interconexión de Redes");
INSERT INTO Materias VALUES ("231","Administración de Base de Datos");
INSERT INTO Materias VALUES ("232","Formulación de Proyectos de Tecnologías de Información");
INSERT INTO Materias VALUES ("233","Lenguajes y Autómatas");
INSERT INTO Materias VALUES ("234","Programación Web");
INSERT INTO Materias VALUES ("235","Ingeniería de Requisitos");
INSERT INTO Materias VALUES ("236","Tecnologías de Virtualización");
INSERT INTO Materias VALUES ("237","Administración de Proyectos de Tecnologías de la Información");
INSERT INTO Materias VALUES ("238","Tecnologías y Aplicaciones en Internet");
INSERT INTO Materias VALUES ("239","Diseño de Interfaces");
INSERT INTO Materias VALUES ("240","Sistemas Inteligentes");
INSERT INTO Materias VALUES ("241","Gestión de Desarrollo de Software");
INSERT INTO Materias VALUES ("242","Inteligencia de Negocios");
INSERT INTO Materias VALUES ("243","Desarrollo de Negocios para Tecnologías de la Información");
INSERT INTO Materias VALUES ("244","Sistemas Embébidos");
INSERT INTO Materias VALUES ("245","Programación Móvil");
INSERT INTO Materias VALUES ("246","Seguridad Informática");
INSERT INTO Materias VALUES ("247","Tópicos de Ingeniería en Electrónica y Telecomunicaciones");
INSERT INTO Materias VALUES ("248","Fundamentos de Química");
INSERT INTO Materias VALUES ("249","Fundamentos de Física");
INSERT INTO Materias VALUES ("250","Cálculo Diferencial e Integral");
INSERT INTO Materias VALUES ("251","Lógica de Programación");
INSERT INTO Materias VALUES ("252","Mantenimiento Electrónico");
INSERT INTO Materias VALUES ("253","Cálculo Vectorial");
INSERT INTO Materias VALUES ("254","Electricidad y Magnetismo");
INSERT INTO Materias VALUES ("255","Álgebra Lineal");
INSERT INTO Materias VALUES ("256","Programación Estructurada");
INSERT INTO Materias VALUES ("257","Circuitos en Corriente Directa");
INSERT INTO Materias VALUES ("258","Ecuaciones Diferenciales");
INSERT INTO Materias VALUES ("259","Circuitos Lógicos");
INSERT INTO Materias VALUES ("260","Probabilidad y Estadística");
INSERT INTO Materias VALUES ("261","Programación de Periféricos");
INSERT INTO Materias VALUES ("262","Circuitos en Corriente Alterna");
INSERT INTO Materias VALUES ("263","Análisis de Dispositivos Electrónicos");
INSERT INTO Materias VALUES ("264","Sistemas Digitales");
INSERT INTO Materias VALUES ("265","Procesos Estocásticos");
INSERT INTO Materias VALUES ("266","Teoría Electromagnética");
INSERT INTO Materias VALUES ("267","Sistemas de Amplificación");
INSERT INTO Materias VALUES ("268","Diseño Digital");
INSERT INTO Materias VALUES ("269","Métodos Numéricos");
INSERT INTO Materias VALUES ("270","Métodos Matemáticos");
INSERT INTO Materias VALUES ("271","Microcontroladores");
INSERT INTO Materias VALUES ("272","Ingeniería de Control");
INSERT INTO Materias VALUES ("273","Modulaciones Analógicas");
INSERT INTO Materias VALUES ("274","Filtros Analógicos");
INSERT INTO Materias VALUES ("275","Redes de Comunicación");
INSERT INTO Materias VALUES ("276","Instrumentación Electrónica");
INSERT INTO Materias VALUES ("277","Control Industrial");
INSERT INTO Materias VALUES ("278","Energías Alternas");
INSERT INTO Materias VALUES ("279","Modulaciones Digitales");
INSERT INTO Materias VALUES ("280","Sistemas de Telefonía");
INSERT INTO Materias VALUES ("281","Procesamiento Digital de Señales");
INSERT INTO Materias VALUES ("282","Control Digital");
INSERT INTO Materias VALUES ("283","Gestión Administrativa");
INSERT INTO Materias VALUES ("284","PLCS");
INSERT INTO Materias VALUES ("285","Comunicaciones Digitales");
INSERT INTO Materias VALUES ("286","Antenas y Líneas de Transmisión");
INSERT INTO Materias VALUES ("287","Control de Calidad");
INSERT INTO Materias VALUES ("288","Seminario de Proyectos");
INSERT INTO Materias VALUES ("289","Sistemas Optoelectrónicos");
INSERT INTO Materias VALUES ("290","Comunicaciones Ópticas");
INSERT INTO Materias VALUES ("291","Temas Selectos de las Telecomunicaciones");
INSERT INTO Materias VALUES ("292","Sistemas de Comunicaciones Inalámbricas");
INSERT INTO Materias VALUES ("293","Microeconomía");
INSERT INTO Materias VALUES ("294","Introducción a las Finanzas");
INSERT INTO Materias VALUES ("295","Introducción a la Ingeniería");
INSERT INTO Materias VALUES ("296","Lógica de la Programación");
INSERT INTO Materias VALUES ("297","Macroeconomía");
INSERT INTO Materias VALUES ("298","Administración Estratégica");
INSERT INTO Materias VALUES ("299","Contabilidad Financiera");
INSERT INTO Materias VALUES ("300","Mercadotecnia Financiera");
INSERT INTO Materias VALUES ("301","Matemáticas Financieras");
INSERT INTO Materias VALUES ("302","Derecho Corporativo");
INSERT INTO Materias VALUES ("303","Administración Financiera");
INSERT INTO Materias VALUES ("304","Estructura Financiera");
INSERT INTO Materias VALUES ("305","Ingeniería del Diseño de Producto");
INSERT INTO Materias VALUES ("306","Economía Geográfica");
INSERT INTO Materias VALUES ("307","Contabilidad de Costos");
INSERT INTO Materias VALUES ("308","Investigación de Operaciones");
INSERT INTO Materias VALUES ("309","Estadística para Negocios");
INSERT INTO Materias VALUES ("310","Derecho Fiscal");
INSERT INTO Materias VALUES ("311","Presupuestos");
INSERT INTO Materias VALUES ("312","Ingeniería de Proceso");
INSERT INTO Materias VALUES ("313","Base de Datos para Negocios");
INSERT INTO Materias VALUES ("314","Evaluación de Proyectos");
INSERT INTO Materias VALUES ("315","Planeación Financiera");
INSERT INTO Materias VALUES ("316","Logística y Comercialización");
INSERT INTO Materias VALUES ("317","Negocios Inteligentes");
INSERT INTO Materias VALUES ("318","Innovación y Emprendimiento");
INSERT INTO Materias VALUES ("319","Finanzas Corporativas");
INSERT INTO Materias VALUES ("320","Sistemas Financieros");
INSERT INTO Materias VALUES ("321","Economía Internacional");
INSERT INTO Materias VALUES ("322","Econometría");
INSERT INTO Materias VALUES ("323","Finanzas Públicas");
INSERT INTO Materias VALUES ("324","Finanzas Internacionales");
INSERT INTO Materias VALUES ("325","Mercados Financieros");
INSERT INTO Materias VALUES ("326","Portafolios e Instrumentos de Inversión");
INSERT INTO Materias VALUES ("327","Derecho Bancario y Bursátil");
INSERT INTO Materias VALUES ("328","Control de Riesgos");
INSERT INTO Materias VALUES ("329","Valuación de Empresas");
INSERT INTO Materias VALUES ("330","Optativa I");
INSERT INTO Materias VALUES ("331","Optativa II");
INSERT INTO Materias VALUES ("332","Optativa III");
INSERT INTO Materias VALUES ("333","Optativa IV");
INSERT INTO Materias VALUES ("334","Estrategias Financieras");

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Carre_Cuatri_Mater`

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
INSERT INTO Estudiante VALUES ("1","Diego","Pena","Medina","1234567890","2024-08-06","Femenino","PMDO200685@upemor.edu.mx","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.","5");

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
INSERT INTO Docente VALUES ("1","Diego","Pena","Medina","1234567890","2024-08-06","Femenino","quierotuculitomami@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.");

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
  `Correo_electronico_A` varchar(250) NOT NULL,
  `Contrasena_A` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Usuario_A`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `Administrador`
INSERT INTO Administrador VALUES ("1","Diego","Pena","Medina","1234567890","2024-08-06","Femenino","mochito619@gmail.com","$2y$10$j2Jdr8RjgOQnNXg4sB6oou8perG0fOSXQhLH2ccDN0S86aGNr0sA.");

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

