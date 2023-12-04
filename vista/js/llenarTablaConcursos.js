var tabla;

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("btnAgregar").addEventListener('click',
    () => {
        window.location.href='registrarConcurso.php';
    });
    document.getElementById("mdlConfirmacion").addEventListener('show.bs.modal', (e) => {
        if(sessionStorage.getItem('concursoAEliminar')){
            document.getElementById("btnConfirmar").value = e.relatedTarget;
            document.getElementById("spnConcurso").innerText = sessionStorage.getItem('concursoAEliminar');
        }
    });
});

function crearAlerta(callback) {
    if (callback)
        callback(); //Llamar a la función si es que se recibió
}

/*
tabla = $("#tblPersonas").DataTable({
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        order: [0, 'asc'],
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
*/

function previoEliminar(e, nombre){
    const mdlEliminar = new bootstrap.Modal('#mdlConfirmacion', {
        backdrop: 'static'
    });
    const mdlEliminado = new bootstrap.Modal('#mdlMensajeEliminado', {
        backdrop: 'static'
    });
    sessionStorage.setItem('concursoAEliminar', nombre);
    mdlEliminar.show(e.value);
}

function eliminar(bandera) {
    //e trae el id del concurso a eliminar
    if (bandera) {
        crearAlerta(() => location.reload());           
    } else {
        alert('Concurso no encontrado');
    }
}
