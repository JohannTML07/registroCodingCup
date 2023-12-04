var tabla;
document.addEventListener("DOMContentLoaded", () => {
    //setTimeout(()=>alert('Mensaje con retardo de 3 segundos'),3000);
    
    //document.getElementById("btnConfirmar").addEventListener('click', eliminar);
    document.getElementById("mdlConfirmacion").addEventListener('show.bs.modal', (e) => {
        if(sessionStorage.getItem('equipoAEliminar')){
            document.getElementById("btnConfirmar").value = e.relatedTarget;
            document.getElementById("spnEquipo").innerText = sessionStorage.getItem('equipoAEliminar');
        }
    });

    document.getElementById("mdlAprobacion").addEventListener('show.bs.modal', (e) => {
        if(sessionStorage.getItem('equipoAAprobar')){
            document.getElementById("btnConfirmarAprobar").value = e.relatedTarget;
            document.getElementById("spnEquipoAprobar").innerText = sessionStorage.getItem('equipoAAprobar');
        }
    });

    document.getElementById("mdlDesaprobacion").addEventListener('show.bs.modal', (e) => {
        if(sessionStorage.getItem('equipoADesaprobar')){
            document.getElementById("btnConfirmarDesaprobar").value = e.relatedTarget;
            document.getElementById("spnEquipoDesaprobar").innerText = sessionStorage.getItem('equipoADesaprobar');
        }
    });

    $("#tblEquipos").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [1,5,6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [1,5,6]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [1,5,6]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [1,5,6]
                }
            },
            'colvis'
        ],
        stateSave: true,
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        order: [[1, 'asc'],[2,'desc']]
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

function previoAprobar(e, nombre){
    const mdlAprobacion = new bootstrap.Modal('#mdlAprobacion', {
        backdrop: 'static'
    });
    const mdlAprobado = new bootstrap.Modal('#mdlMensajeAprobado', {
        backdrop: 'static'
    });
    sessionStorage.setItem('equipoAAprobar', nombre);
    mdlAprobacion.show(e.value);
}

function previoDesaprobar(e, nombre){
    const mdlDesaprobacion = new bootstrap.Modal('#mdlDesaprobacion', {
        backdrop: 'static'
    });
    const mdlDesaprobado = new bootstrap.Modal('#mdlMensajeDesaprobado', {
        backdrop: 'static'
    });
    sessionStorage.setItem('equipoADesaprobar', nombre);
    mdlDesaprobacion.show(e.value);
}

function eliminar(bandera) {
    //e trae el id del equipo a eliminar
    if (bandera) {
        crearAlerta(() => location.reload());           
    } else {
        alert('Equipo no encontrado');
    }
}

function aprobar(bandera) {
    //e trae el id del equipo a eliminar
    if (bandera) {
        crearAlerta(() => location.reload());           
    } else {
        alert('Equipo no encontrado');
    }
}