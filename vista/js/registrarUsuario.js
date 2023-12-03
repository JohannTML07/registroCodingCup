document.addEventListener("DOMContentLoaded", ()=>{
    valida();
    if(document.getElementById("nuevaContrasenia").hidden==true){
      if(document.getElementById("cambiarContrasenia").hidden==false){
        if(!document.getElementById("cbxCambiarContrasenia").checked){
          let divContra = document.getElementById("contrasenia");
          let divConfirma = document.getElementById("confirmarContrasenia");
          let txtContra = document.getElementById("txtContrasenia");
          let txtConfirma = document.getElementById("txtConfirmarContrasenia");
          divContra.hidden = true;
          txtContra.name="";
          txtContra.required = false;
          divConfirma.hidden = true;
          txtConfirma.name="";
          txtConfirma.required = false;
        }
      }
    }
    document.getElementById("btnCancelar").addEventListener("click",(e)=>{
        window.location.replace('listadoUsuarios.php');
        e.preventDefault();
    });
    
    document.getElementById("txtConfirmarContrasenia").addEventListener("input", (e)=>{
      let nuevaContra = document.getElementById("nuevaContrasenia");
      let txtNuevaContra = document.getElementById("txtNuevaContrasenia");
      let contra1= document.getElementById("txtContrasenia");
      let contra2= document.getElementById("txtConfirmarContrasenia");
      //el campo de nueva contraseña está activo
      if(nuevaContra.hidden==true){
        if(contra1.value != contra2.value){
          //if(contra2.classList.contains("is-valid")){
            contra2.classList.remove("is-valid");
            contra2.classList.add("is-invalid");
          //}
        }
        else{
          //if(contra2.classList.contains("is-invalid")){
            contra2.classList.remove("is-invalid");
            contra2.classList.add("is-valid");
          //}
        }
      }
      else{
        if(txtNuevaContra.value != contra2.value){
          //if(contra2.classList.contains("is-valid")){
            contra2.classList.remove("is-valid");
            contra2.classList.add("is-invalid");
          //}
        }
        else{
          //if(contra2.classList.contains("is-invalid")){
            contra2.classList.remove("is-invalid");
            contra2.classList.add("is-valid");
          //}
        }
      }
    });

    document.getElementById("cbxCambiarContrasenia").addEventListener("change",()=>{
      let divNuevaContra = document.getElementById("nuevaContrasenia");
      let divContra = document.getElementById("contrasenia");
      let divConfirma = document.getElementById("confirmarContrasenia");
      let txt = document.getElementById("txtNuevaContrasenia");
      let txtContra = document.getElementById("txtContrasenia");
      let txtConfirma = document.getElementById("txtConfirmarContrasenia");
      if(divNuevaContra.hidden == true){
        divNuevaContra.hidden = false;
        txt.name="nuevaContrasenia";
        txt.required = true;
        divContra.hidden = false;
        txtContra.name="contrasenia";
        txtContra.required = true;
        divConfirma.hidden = false;
        txtConfirma.name="confirmarContrasenia";
        txtConfirma.required = true;
      }
      else{
        divNuevaContra.hidden = true;
        txt.name="";
        txt.required = false;
        divContra.hidden = true;
        txtContra.name="";
        txtContra.required = false;
        divConfirma.hidden = true;
        txtConfirma.name="";
        txtConfirma.required = false;
      }
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