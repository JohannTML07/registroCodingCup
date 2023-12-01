document.addEventListener("DOMContentLoaded", () => {
    valida();
    if(sessionStorage.getItem('claveAEditar')){
        cargarDatos(sessionStorage.getItem('claveAEditar'));
    }

    document.getElementById("btnCancelar").addEventListener("click",(e)=>{
        window.location.replace('index_coach.php');
        e.preventDefault();
    });

    /*document.getElementById("btnGuardar").addEventListener("click",(e)=>{
        let form = document.getElementById('formularioReg');
        if(form.checkValidity()){
            let nombreEquipo = document.getElementById('txtNombreEquipo').value.trim();
            let miembro1 = document.getElementById('txtMiembro1').value.trim();
            let miembro2 = document.getElementById('txtMiembro2').value.trim();
            let miembro3 = document.getElementById('txtMiembro3').value.trim();
            agregar(nombreEquipo,miembro1,miembro2,miembro3);
            e.preventDefault();
            window.location.replace('index_coach.php');
        }
    });*/
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

function agregar(nomEquipo,m1,m2,m3){
    let equipos = [];
    //si hay algo en sessionstorage con clave a editar, se va a modificar un registro
    let claveAEditar = sessionStorage.getItem('claveAEditar'); 
    if(claveAEditar){
        if(localStorage.getItem('equipos')){
            equipos = JSON.parse(localStorage.getItem('equipos'));
            equipos.forEach(equipo =>{
                if(equipo.clave == claveAEditar){
                    equipo.nombre = nomEquipo;
                    equipo.miembro1 = m1;
                    equipo.miembro2 = m2;
                    equipo.miembro3 = m3;
                    return;
                }
            });
            localStorage.setItem('equipos',
                JSON.stringify(equipos)
            );
        }
    }
    //Si no se va a modificar se agrega un registro nuevo
    else{
        if(localStorage.getItem('equipos') && localStorage.getItem('equipos').length==0){
            equipos = JSON.parse(localStorage.getItem('equipos'));
            let equipo = { clave: equipos[equipos.length-1].clave+1, nombre: nomEquipo, miembro1: m1, miembro2: m2 ,miembro3: m3};
            equipos.push(equipo);
            localStorage.setItem('equipos',
                JSON.stringify(equipos)
            );
        }
        else{
            let equipo = { clave: 1, nombre: nomEquipo, miembro1: m1, miembro2: m2 ,miembro3: m3};
            equipos.push(equipo);
            localStorage.setItem('equipos',
                JSON.stringify(equipos)
            );
        }
    }
    
}

function cargarDatos(clave){
    let equipos = [];
    if(localStorage.getItem('equipos')){
        equipos = JSON.parse(localStorage.getItem('equipos'));
    }
    equipos.forEach(equipo =>{
        if(equipo.clave == clave){
            document.getElementById('txtNombreEquipo').value = equipo.nombre;
            document.getElementById('txtMiembro1').value = equipo.miembro1;
            document.getElementById('txtMiembro2').value = equipo.miembro2;
            document.getElementById('txtMiembro3').value = equipo.miembro3;
        }
    });
}