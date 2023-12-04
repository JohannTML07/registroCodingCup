document.addEventListener("DOMContentLoaded", () => {
    valida();

    document.getElementById("btnCancelar").addEventListener("click",(e)=>{
        window.location.replace('index_admin.php');
        e.preventDefault();
    });
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