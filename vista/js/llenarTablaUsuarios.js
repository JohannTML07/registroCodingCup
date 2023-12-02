var tabla;

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("btnAgregar").addEventListener('click',() => {
        //window.location.replace('registrarUsuario.php');
        window.location.href='registrarUsuario.php';
    });
    document.getElementById("mdlConfirmacion").addEventListener('show.bs.modal', (e) => {
        if(sessionStorage.getItem('usuarioAEliminar')){
            document.getElementById("btnConfirmar").value = e.relatedTarget;
            document.getElementById("spnUsuario").innerText = sessionStorage.getItem('usuarioAEliminar');
        }
    });
});
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
    sessionStorage.setItem('usuarioAEliminar', nombre);
    mdlEliminar.show(e.value);
}

function eliminar(bandera) {
    //e trae el id del usuario a eliminar
    if (bandera) {
        crearAlerta(() => location.reload());           
    } else {
        alert('Usuario no encontrado');
    }
}