document.addEventListener("DOMContentLoaded", ()=>{
    valida();
    document.getElementById("btnCancelar").addEventListener("click",(e)=>{
        window.location.replace('listadoUsuarios.php');
        e.preventDefault();
    });
    
    document.getElementById("txtConfirmarContrasenia").addEventListener("input", (e)=>{
      let contra1= document.getElementById("txtContrasenia");
      let contra2= document.getElementById("txtConfirmarContrasenia");
      if(contra1.value != contra2.value){
        if(contra2.classList.contains("is-valid")){
          contra2.classList.remove("is-valid");
          contra2.classList.add("is-invalid");
        }
      }
      else{
        if(contra2.classList.contains("is-invalid")){
          contra2.classList.remove("is-invalid");
          contra2.classList.add("is-valid");
        }
      }
    })
});

function valida(){
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        
        form.classList.add('was-validated');
      }, false);
    });
}