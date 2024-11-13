function mostrarInformacion(button) {
    const id = button.getAttribute('data-id');
    
    // Hacer solicitud AJAX para obtener la información
    fetch(`../../Controlador/GET/get_estudiante_datos.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const tbody = document.getElementById('infoTableBody');
                tbody.innerHTML = ''; // Limpiar contenido previo
                
                // Mostrar datos de "registros"
                data.registros.forEach(registro => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="table-primary">${registro.nombreEstudiante}</td>
                        <td class="table-primary">${registro.nombreMateria}</td>
                        <td class="table-primary">${registro.registro}</td>
                        <td class="table-info">${registro.cali}</td>
                        <td class="table-warning">${registro.observaciones}</td>
                    `;
                    tbody.appendChild(row);
                });

                // Mostrar datos de "registrosTop"
                const tbodyTop = document.getElementById('topicosTableBody');
                tbodyTop.innerHTML = ''; // Limpiar contenido previo
                
                data.registrosTop.forEach(topico => {
                    const rowTop = document.createElement('tr');
                    rowTop.innerHTML = `
                        <td class="table-primary">${topico.nombre}</td>
                        <td class="table-primary">${topico.clave}</td>
                        <td class="table-success">${topico.totalcitas}</td>
                        <td class="table-danger">${topico.citasasistidas}</td>
                    `;
                    tbodyTop.appendChild(rowTop);
                });

                // Mostrar el modal
                var myModal = new bootstrap.Modal(document.getElementById('infoModal'));
                myModal.show();
            } else {
                alert('Error al obtener los datos.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al obtener los datos.');
        });
}