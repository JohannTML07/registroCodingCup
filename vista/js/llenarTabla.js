var tabla;
function cargarPersonas() {
    //Verificar que no exista en el localstorage
    //solo si no existen se añadirán
    if (!localStorage.getItem('concursos')) {
        let concursos = [
            { concurso: 'Concurso 1', equipos: 5, fechaInscr: '02/05/2023', fechaCierre: '06/06/2023', equipoGanador: 'equipo 1'},
            { concurso: 'Concurso 2', equipos: 78, fechaInscr: '08/01/2023', fechaCierre: '13/05/2023', equipoGanador: 'equipo 2'},
            { concurso: 'Concurso 3', equipos: 12, fechaInscr: '12/01/2023', fechaCierre: '23/04/2023', equipoGanador: 'equipo 3'},
            { concurso: 'Concurso 4', equipos: 33, fechaInscr: '23/05/2023', fechaCierre: '01/06/2023', equipoGanador: 'equipo 2'},
        ];
        localStorage.setItem('concursos',
            JSON.stringify(concursos)
        );
    }
}

document.addEventListener("DOMContentLoaded", () => {
    cargarPersonas();
    let concursos = [];
    if (localStorage.getItem('concursos')) {
        personas = JSON.parse(localStorage.getItem('concursos'));
    }
    llenarTabla(personas);
});

function llenarTabla(datos) {
    let tbody = document.querySelector("#tblPersonas tbody"), fila, celda;
    tbody.innerHTML = '';
    let x, y, z;
    x = y = z = 3;
    datos.forEach(concurso => {
        fila = document.createElement('tr');

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(concurso.concurso));
        fila.appendChild(celda);

        let div2=document.createElement('div');
        div2.className="d-grid gap-2 d-md-flex justify-content-md-between";

        celda = document.createElement('td');
        let btnVer = document.createElement('button')
        btnVer.className = "btn btn-success";
        btnVer.innerText = 'Ver';
        btnVer.style.textAlign="end"
        celda.appendChild(div2);
        div2.appendChild(document.createTextNode(concurso.equipos));
        div2.appendChild(btnVer);
        fila.appendChild(celda);

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(concurso.fechaInscr));
        fila.appendChild(celda);

        let div=document.createElement('div');
        div.className="d-grid gap-2 d-md-flex justify-content-md-start";

        celda = document.createElement('td');
        let btnEditar = document.createElement('button')
        btnEditar.className = "btn  btn-warning";
        btnEditar.innerText = 'Editar';
        celda.appendChild(div);
        div.appendChild(document.createTextNode(concurso.fechaCierre));
        div.appendChild(btnEditar);
        fila.appendChild(celda);

        celda = document.createElement('td');
        celda.appendChild(document.createTextNode(concurso.equipoGanador));
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
    let persconcursosonas = [];
    if (localStorage.getItem('concursos')) {
        concursos = JSON.parse(localStorage.getItem('concursos'));
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

