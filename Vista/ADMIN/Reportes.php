<?php include('head.php'); ?>

<h2 class="text-center">REPORTES</h2> 
    <details class="accordion">
    <summary class="accordion-btn">Gráfica por Género</summary>
        <div class="accordion-content">
            <div class="row">
                <form action="Graficas/Grafica1.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="ID_Cuatrimestre" class="form-label">Cuatrimestre:</label>
                        <select class="form-select" id="ID_Cuatrimestre" name="ID_Cuatrimestre" required>
                            <option value="" selected disabled>-- Seleccionar Cuatrimestre --</option>
                                <?php
                                    // Incluye el archivo de conexión a la base de datos
                                    include('../../Modelo/Conexion.php');
                                                
                                    // Establece la conexión a la base de datos
                                    $conexion = (new Conectar())->conexion();
                                    $busqueda_Cuatrimestre = $conexion->query("SELECT Id_Cuatrimestre, Nombre_Cuatrimestre FROM Cuatrimestre");
                                    while($resultado_Cuatrimestre = $busqueda_Cuatrimestre->fetch_assoc()){
                                        echo "<option value='".$resultado_Cuatrimestre['Id_Cuatrimestre']."'>".$resultado_Cuatrimestre['Nombre_Cuatrimestre']."</option>";
                                    }
                                ?>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona una opción.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="genero_e">Género</label>
                        <select class="form-control" id="genero" name="genero" required>
                            <option value="" selected disabled>-- Salecciona Opción--</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, ingresa tu Nombre.
                        </div>
                    </div>
                    <button type="submit" class="btn-custom">
                        <span class="bgContainer"><span>Generar Gráfica</span></span>
                        <span class="arrowContainer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-pie-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9.883 2.207a1.9 1.9 0 0 1 2.087 1.522l.025 .167l.005 .104v7a1 1 0 0 0 .883 .993l.117 .007h6.8a2 2 0 0 1 2 2a1 1 0 0 1 -.026 .226a10 10 0 1 1 -12.27 -11.933l.27 -.067l.11 -.02z" stroke-width="0" fill="currentColor" />
                                <path d="M14 3.5v5.5a1 1 0 0 0 1 1h5.5a1 1 0 0 0 .943 -1.332a10 10 0 0 0 -6.11 -6.111a1 1 0 0 0 -1.333 .943z" stroke-width="0" fill="currentColor" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </details>

    <details class="accordion">
    <summary class="accordion-btn">Gráfica de Estudiante por citas</summary>
        <div class="accordion-content">
            <div class="row">
                <form action="Graficas/Grafica2.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="Fecha_Inicio" class="form-label">Fecha de Inicio:</label>
                        <input class="form-control" type="date" id="Fecha_Inicio" name="Fecha_Inicio" required>
                        <div class="invalid-feedback">
                            Por favor, selecciona una opción.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Fecha_Fin" class="form-label">Fecha de Fin:</label>
                        <input class="form-control" type="date" id="Fecha_Fin" name="Fecha_Fin" required>
                        <div class="invalid-feedback">
                            Por favor, selecciona una opción.
                        </div>
                    </div>
                    <button type="submit" class="btn-custom">
                        <span class="bgContainer"><span>Generar Gráfica</span></span>
                        <span class="arrowContainer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-pie-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9.883 2.207a1.9 1.9 0 0 1 2.087 1.522l.025 .167l.005 .104v7a1 1 0 0 0 .883 .993l.117 .007h6.8a2 2 0 0 1 2 2a1 1 0 0 1 -.026 .226a10 10 0 1 1 -12.27 -11.933l.27 -.067l.11 -.02z" stroke-width="0" fill="currentColor" />
                                <path d="M14 3.5v5.5a1 1 0 0 0 1 1h5.5a1 1 0 0 0 .943 -1.332a10 10 0 0 0 -6.11 -6.111a1 1 0 0 0 -1.333 .943z" stroke-width="0" fill="currentColor" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </details>

    <details class="accordion">
        <summary class="accordion-btn">Gráfica de Topicos mas Solicitados</summary>
        <div class="accordion-content">
            <div class="row">
                <form action="Graficas/Grafica3.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="Fecha_Inicio" class="form-label">Fecha de Inicio:</label>
                        <input class="form-control" type="date" id="Fecha_Inicio" name="Fecha_Inicio" required>
                        <div class="invalid-feedback">
                            Por favor, selecciona una opción.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Fecha_Fin" class="form-label">Fecha de Fin:</label>
                        <input class="form-control" type="date" id="Fecha_Fin" name="Fecha_Fin" required>
                        <div class="invalid-feedback">
                            Por favor, selecciona una opción.
                        </div>
                    </div>
                    <button type="submit" class="btn-custom">
                        <span class="bgContainer"><span>Generar Gráfica</span></span>
                        <span class="arrowContainer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-pie-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9.883 2.207a1.9 1.9 0 0 1 2.087 1.522l.025 .167l.005 .104v7a1 1 0 0 0 .883 .993l.117 .007h6.8a2 2 0 0 1 2 2a1 1 0 0 1 -.026 .226a10 10 0 1 1 -12.27 -11.933l.27 -.067l.11 -.02z" stroke-width="0" fill="currentColor" />
                                <path d="M14 3.5v5.5a1 1 0 0 0 1 1h5.5a1 1 0 0 0 .943 -1.332a10 10 0 0 0 -6.11 -6.111a1 1 0 0 0 -1.333 .943z" stroke-width="0" fill="currentColor" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </details>

    <details class="accordion">
        <summary class="accordion-btn">Gráfica Grado Satisfacción</summary>
        <div class="accordion-content">
            <div class="row">
                <form action="Graficas/Grafica4.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="IDTopicos" class="form-label">Topicos:</label>
                            <select class="form-select" id="IDTopicos" name="IDTopicos" required>
                                    <option value="" selected disabled>-- Seleccionar Tópico --</option>
                                        <?php
                                            $busqueda_IDEstudiante = $conexion->query("SELECT ID_Topico, Nombre FROM Topicos");
                                            while($resultado_IDEstudiante = $busqueda_IDEstudiante->fetch_assoc()){
                                                echo "<option value='".$resultado_IDEstudiante['ID_Topico']."'>".$resultado_IDEstudiante['Nombre']."</option>";
                                            }
                                        ?>
                                </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona una opción.
                        </div>
                    </div>
                    <button type="submit" class="btn-custom">
                        <span class="bgContainer"><span>Generar Gráfica</span></span>
                        <span class="arrowContainer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-pie-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9.883 2.207a1.9 1.9 0 0 1 2.087 1.522l.025 .167l.005 .104v7a1 1 0 0 0 .883 .993l.117 .007h6.8a2 2 0 0 1 2 2a1 1 0 0 1 -.026 .226a10 10 0 1 1 -12.27 -11.933l.27 -.067l.11 -.02z" stroke-width="0" fill="currentColor" />
                                <path d="M14 3.5v5.5a1 1 0 0 0 1 1h5.5a1 1 0 0 0 .943 -1.332a10 10 0 0 0 -6.11 -6.111a1 1 0 0 0 -1.333 .943z" stroke-width="0" fill="currentColor" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </details>

    <details class="accordion">
        <summary class="accordion-btn">Gráfica Calificación Material</summary>
        <div class="accordion-content">
            <div class="row">
                <a href="Graficas/Grafica5.php" class="btn-custom">
                <span class="bgContainer"><span>Generar Gráfica</span></span>
                    <span class="arrowContainer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-pie-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9.883 2.207a1.9 1.9 0 0 1 2.087 1.522l.025 .167l.005 .104v7a1 1 0 0 0 .883 .993l.117 .007h6.8a2 2 0 0 1 2 2a1 1 0 0 1 -.026 .226a10 10 0 1 1 -12.27 -11.933l.27 -.067l.11 -.02z" stroke-width="0" fill="currentColor" />
                            <path d="M14 3.5v5.5a1 1 0 0 0 1 1h5.5a1 1 0 0 0 .943 -1.332a10 10 0 0 0 -6.11 -6.111a1 1 0 0 0 -1.333 .943z" stroke-width="0" fill="currentColor" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </details>

    <details class="accordion">
        <summary class="accordion-btn">Gráfica Horas Asiste Estudiante</summary>
        <div class="accordion-content">
            <div class="row">
                <form action="Graficas/Grafica6.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="Fecha_Inicio" class="form-label">Fecha de Inicio:</label>
                        <input class="form-control" type="date" id="Fecha_Inicio" name="Fecha_Inicio" required>
                        <div class="invalid-feedback">
                            Por favor, selecciona una opción.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Fecha_Fin" class="form-label">Fecha de Fin:</label>
                        <input class="form-control" type="date" id="Fecha_Fin" name="Fecha_Fin" required>
                        <div class="invalid-feedback">
                            Por favor, selecciona una opción.
                        </div>
                    </div>    
                    <div class="mb-3">
                        <label for="IDEstudiante" class="form-label">Estudiante:</label>
                            <select class="form-select" id="IDEstudiante" name="IDEstudiante" required>
                                    <option value="" selected disabled>-- Seleccionar Estudiante --</option>
                                        <?php
                                            $busqueda_IDEstudiante = $conexion->query("SELECT ID_Usuario_E, Nombre_Usuario_E, Apellido_Materno_E, Apellido_Paterno_E FROM Estudiante");
                                            while($resultado_IDEstudiante = $busqueda_IDEstudiante->fetch_assoc()){
                                                echo "<option value='".$resultado_IDEstudiante['ID_Usuario_E']."'>".$resultado_IDEstudiante['Nombre_Usuario_E']." ".$resultado_IDEstudiante['Apellido_Materno_E']." ".$resultado_IDEstudiante['Apellido_Paterno_E']."</option>";
                                            }
                                        ?>
                                </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona una opción.
                        </div>
                    </div>
                    <button type="submit" class="btn-custom">
                        <span class="bgContainer"><span>Generar Gráfica</span></span>
                        <span class="arrowContainer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-pie-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9.883 2.207a1.9 1.9 0 0 1 2.087 1.522l.025 .167l.005 .104v7a1 1 0 0 0 .883 .993l.117 .007h6.8a2 2 0 0 1 2 2a1 1 0 0 1 -.026 .226a10 10 0 1 1 -12.27 -11.933l.27 -.067l.11 -.02z" stroke-width="0" fill="currentColor" />
                                <path d="M14 3.5v5.5a1 1 0 0 0 1 1h5.5a1 1 0 0 0 .943 -1.332a10 10 0 0 0 -6.11 -6.111a1 1 0 0 0 -1.333 .943z" stroke-width="0" fill="currentColor" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </details>

<?php include('footer.php'); ?>