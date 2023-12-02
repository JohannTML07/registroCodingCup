var tabla;

document.addEventListener("DOMContentLoaded", () => {
    //setTimeout(()=>alert('Mensaje con retardo de 3 segundos'),3000);
    document.getElementById("btnAgregar").addEventListener('click',
        () => {
            //window.location.replace('registrarEquipo.php');
            window.location.href='registrarEquipo.php';
        });
    //document.getElementById("btnConfirmar").addEventListener('click', eliminar);
    document.getElementById("mdlConfirmacion").addEventListener('show.bs.modal', (e) => {
        if(sessionStorage.getItem('equipoAEliminar')){
            document.getElementById("btnConfirmar").value = e.relatedTarget;
            document.getElementById("spnEquipo").innerText = sessionStorage.getItem('equipoAEliminar');
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

/*
    //$("selector").funcion();
    tabla = $("#tblEquipos").DataTable({
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        order: [[1, 'asc'], [2, 'desc']],

    });
*/

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