document.addEventListener('DOMContentLoaded',(() => {
    valida();
    document.getElementById("btnIniciarSesion").addEventListener('click',inicioORegistro);
    document.getElementById("btnRegistrarse").addEventListener('click',inicioORegistro);
    document.getElementById("btnEnviarLogin").addEventListener('click',enviar);
    document.getElementById("btnEnviarReg").addEventListener('click',enviar);
}));

function inicioORegistro(e){
    let formL = document.getElementById("formularioLogin");
    let formR = document.getElementById("formularioReg");

    if(e.target.id=='btnIniciarSesion'){
        document.getElementById("tituloLogin").innerText = "INICIO DE SESIÓN";
        formL.hidden=false;
        formR.hidden=true;
    }
    else{
        document.getElementById("tituloLogin").innerText = "REGISTRARSE";
        formL.hidden=true;
        formR.hidden=false;
    }
    //document.getElementById("btnEnviar").addEventListener('click',enviar); //restaurarle el evento a btnEnviar
}

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

function enviar(e){
    if(e.target.id=="btnEnviarLogin"){
        let formL = document.getElementById("formularioLogin");
        if(!formL.checkValidity()){
            //e.preventDefault();
            //location.replace('index_admin.php');
        }
    }
    else{
        let formR = document.getElementById("formularioReg");
        if(!formR.checkValidity()){
            //e.preventDefault();
            //location.replace('index_coach.php');
        }
    }
}
