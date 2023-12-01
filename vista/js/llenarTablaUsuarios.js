var tabla;
function cargarPersonas() {
    //Verificar que no exista en el localstorage
    //solo si no existen se añadirán
    if (!localStorage.getItem('usuarios')) {
        let usuarios = [
            { nombre: 'Pancho', usuario: 'User123', tipo: 'Administrador'}
        ];
        localStorage.setItem('usuarios',
            JSON.stringify(usuarios)
        );
    }
}

document.addEventListener("DOMContentLoaded", () => {
    cargarPersonas();
    let usuarios = [];
    if (localStorage.getItem('usuarios')) {
        usuarios = JSON.parse(localStorage.getItem('usuarios'));
    }
    llenarTabla(usuarios);
    document.getElementById("btnAgregar").addEventListener('click',() => {
        //window.location.replace('registrarEquipo.php');
        window.location.href='registroUsuario.php';
    });
});

function llenarTabla(datos) {
    let tbody = document.querySelector("#tblPersonas tbody"), fila, celda;
    tbody.innerHTML = '';
    let x, y, z;
    x = y = z = 3;
    datos.forEach(usuario => {
        fila = document.createElement('tr');

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(usuario.nombre));
        fila.appendChild(celda);

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(usuario.usuario));
        fila.appendChild(celda);

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(usuario.tipo));
        fila.appendChild(celda);

        tbody.appendChild(fila);
    });

    tabla = $("#tblPersonas").DataTable({
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        order: [0, 'asc'],
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
}

function eliminar(e) {
    let usuarios = [];
    if (localStorage.getItem('usuarios')) {
        usuarios = JSON.parse(localStorage.getItem('usuarios'));
    }

    let clave = this.value;
    let index = concursos.findIndex(p => p.concurso == concurso);
    if (index >= 0) {
        concursos.splice(index, 1);
        localStorage.setItem('concursos', JSON.stringify(personas));
        //crearAlerta('Persona eliminada', 'success'), () => location.reload();
        //llenarTabla(personas);            
    } else {
        llenarTabla(concursos);
    }
}

