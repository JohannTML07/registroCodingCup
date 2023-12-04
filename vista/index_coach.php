<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio Coach</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">

  <style>
    .menor {
      background: lightcoral;
    }
  </style>
</head>

<body>
  <?php
    session_start();
    if($_SESSION["tipo"]!="coach"){
      header("Location:index.php");
      return;
    }
    require('navbar_coach.php');
    require_once('../datos/daoEquipo.php');
    $dao=new DAOEquipo();
    $listaEquipos=$dao->obtenerTodos($_SESSION["idUsuario"]);

    //esto cuando se acepta la eliminación
    if(count($_POST)==1 && ISSET($_POST["eliminarId"]) && is_numeric($_POST["eliminarId"])){
      if($dao->eliminar($_POST["eliminarId"])){
        header("Location: ".$_SERVER["PHP_SELF"]);
      }
    }
  ?>
  <div id="contenido" class="container mt-3">
    <span><h1><?php echo strtoupper("BIENVENIDO COACH: ".$_SESSION["usuario"]);?></h1></span>
    <h2>Equipos:</h2>
    <button id="btnAgregar" class="btn btn-success mb-5">Agregar Equipo</button>
    <table id="tblEquipos" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Clave</th>
          <th>Nombre</th>
          <th>Miembro 1</th>
          <th>Miembro 2</th>
          <th>Miembro 3</th>
          <th>Estatus</th>
          <th>Reconocimiento</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($listaEquipos as $equipo){
          echo "<tr><td>".$equipo->id."</td>".
                    "<td>".trim($equipo->nombre)."</td>".
                    "<td>".trim($equipo->miembro1)."</td>".
                    "<td>".trim($equipo->miembro2)."</td>".
                    "<td>".trim($equipo->miembro3)."</td>".
                    "<td>".trim($equipo->estatus)."</td>".
                    "<td>"."<button class='btn btn-success'>Descargar</button>"."</td>".
                    "<td><form method='post'>".
                      "<button formaction='registrarEquipo.php' class='btn btn-primary' name='id' value='".$equipo->id."'>Editar</button>".
                      //"<span>$equipo->nombre</span>"
                      "<button type='button' class='btn btn-danger' onclick='previoEliminar(this,".'"'.$equipo->nombre.'"'.")' name='id' value='".$equipo->id."'>Eliminar</button>".
                    "</form></td></tr>";
        }
      ?>
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="mdlConfirmacion" aria-hidden="true" aria-labelledby="confirmarEliminacion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="confirmarEliminacion">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Está a punto de eliminar a: <strong id="spnEquipo"></strong></p>
          <p>¿Desea continuar?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#mdlMensajeEliminado">Si</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="mdlMensajeEliminado" aria-hidden="true" aria-labelledby="eliminadoSeguro" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="eliminadoSeguro">Equipo eliminado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Se ha eliminado correctamente al equipo</p>
        </div>
        <div class="modal-footer">
          <form method='post'>
            <button type="submit" class="btn btn-secondary" id="btnConfirmar" name="eliminarId" data-bs-dismiss="modal">Cerrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="dt/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
  <script src="dt/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="dt/DataTables-1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="js/llenarTabla_coach.js"></script>
</body>

</html>