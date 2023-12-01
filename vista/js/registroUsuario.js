document.addEventListener("DOMContentLoaded", ()=>{
    document.getElementById("btnCancelar").addEventListener("click",(e)=>{
        window.location.replace('listadoUsuarios.php');
        e.preventDefault();
    });
    
    document.getElementById("btnGuardar").addEventListener("click",(e)=>{
        window.location.replace('listadoUsuarios.php');
        e.preventDefault();
    });
})