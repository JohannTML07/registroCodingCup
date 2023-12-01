var tabla;

document.addEventListener("DOMContentLoaded", () => {
    //setTimeout(()=>alert('Mensaje con retardo de 3 segundos'),3000);
    document.getElementById("btnAgregar").addEventListener('click',
        () => {
            sessionStorage.removeItem('claveAEditar');
            //window.location.replace('registrarEquipo.php');
            window.location.href='registrarEquipo.php';
        });
    //document.getElementById("btnConfirmar").addEventListener('click', eliminar);
    document.getElementById("mdlConfirmacion").addEventListener('show.bs.modal', (e) => {
        if(sessionStorage.getItem('equipoAEliminar')){
            document.getElementById("btnConfirmar").value = e.relatedTarget;
            document.getElementById("spnPersona").innerText = sessionStorage.getItem('equipoAEliminar');
        }
    });

});

/**
 * Crear dinámicamente una alerta que después de 5 segundos se cierre automáticamente
 * si el usuario no la cierra
 * @param {*} texto Mensaje a mostrar en la alerta (puede ser HTML)
 * @param {*} tipo Puede ser "success", "danger" o "warning"
 * @param {*} callback Función que contiene las instrucciones que necesitamos
 *  que se ejecuten hasta que la alerta se cierre
 */
function crearAlerta(callback) {
    if (callback)
        callback(); //Llamar a la función si es que se recibió
}


function llenarTabla(datos) {
    let tbody = document.querySelector("#tblEquipos tbody"), fila, celda;
    tbody.innerHTML = '';
    datos.forEach(equipo => {
        fila = document.createElement('tr');

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(equipo.clave));
        fila.appendChild(celda);

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(equipo.nombre));
        fila.appendChild(celda);

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(equipo.miembro1));
        fila.appendChild(celda);

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(equipo.miembro2));
        fila.appendChild(celda);

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(equipo.miembro3));
        fila.appendChild(celda);

        let btnDescargar = document.createElement('button');
        celda = document.createElement('td');
        celda.appendChild(btnDescargar);
        btnDescargar.innerText = 'Descargar';
        btnDescargar.className = "btn btn-success";
        fila.appendChild(celda);
        
        let btnEditar = document.createElement('button'),
            btnEliminar = document.createElement('button');
        btnEditar.className = "btn btn-primary";
        btnEliminar.className = "btn btn-danger";
        btnEditar.innerText = 'Editar';
        btnEditar.addEventListener('click', () => {
            sessionStorage.setItem('claveAEditar', equipo.clave);
            window.location.href='registrarEquipo.php';
        });

        celda = document.createElement('td');
        celda.appendChild(btnEditar);
        btnEliminar.innerText = 'Eliminar';
        btnEliminar.value = equipo.clave;
        btnEliminar.onclick = e => {
            const mdlEliminar = new bootstrap.Modal('#mdlConfirmacion', {
                backdrop: 'static'
            });
            const mdlEliminado = new bootstrap.Modal('#mdlMensajeEliminado', {
                backdrop: 'static'
            });
            mdlEliminar.show(e.target);
            
        };

        celda.appendChild(btnEliminar);
        fila.appendChild(celda);

        tbody.appendChild(fila);
    });

    //$("selector").funcion();
    tabla = $("#tblEquipos").DataTable({
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        order: [[1, 'asc'], [2, 'desc']],

    });
}

function previoEliminar(e, nombre){
    const mdlEliminar = new bootstrap.Modal('#mdlConfirmacion', {
        backdrop: 'static'
    });
    const mdlEliminado = new bootstrap.Modal('#mdlMensajeEliminado', {
        backdrop: 'static'
    });
    sessionStorage.setItem('equipoAEliminar', nombre);
    mdlEliminar.show(e.value);
}

function eliminar(bandera) {
    //e trae el id del equipo a eliminar
    if (bandera) {
        crearAlerta(() => location.reload());           
    } else {
        alert('Equipo no encontrado');
    }
}