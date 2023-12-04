<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Equipos</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>
  <?php 
    session_start();
    if($_SESSION["tipo"]=="coach" || !ISSET($_SESSION["usuario"])){
      header("Location:index.php");
      return;
    }
    
    require('navbar_admin.php');
    require_once('../datos/daoEquipo.php');
    require_once('../datos/daoConcurso.php');

    $daoConcurso = new DAOConcurso();
    $concursoActivo=$daoConcurso->buscarActivo();
    $dao=new DAOEquipo();
    $listaEquipos=$dao->obtenerTodosEquipos($concursoActivo->id);

    //esto cuando se acepta la eliminación
    if(count($_POST)==1 && ISSET($_POST["eliminarId"]) && is_numeric($_POST["eliminarId"])){
      if($dao->eliminar($_POST["eliminarId"])){
        header("Location: ".$_SERVER["PHP_SELF"]);
      }
    }

    if(count($_POST)==1 && ISSET($_POST["aprobarId"]) && is_numeric($_POST["aprobarId"])){
      if($dao->aprobar($_POST["aprobarId"])){
        header("Location: ".$_SERVER["PHP_SELF"]);
      }
    }

    if(count($_POST)==1 && ISSET($_POST["desaprobarId"]) && is_numeric($_POST["desaprobarId"])){
      if($dao->desaprobar($_POST["desaprobarId"])){
        header("Location: ".$_SERVER["PHP_SELF"]);
      }
    }
  ?>
  <div id="contenido" class="container mt-3">
    <span><h2><?php echo strtoupper("CONCURSO ACTIVO: ".$concursoActivo->nombre);?></h2></span>
    <h2>Equipos:</h2>
    <button id="btnDescargarCorreos" class="btn btn-primary mb-5">Descargar Correos de Coachs</button>
    <table id="tblEquipos" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Clave</th>
          <th>Nombre</th>
          <th>Miembro 1</th>
          <th>Miembro 2</th>
          <th>Miembro 3</th>
          <th>Institucion</th>
          <th>Coach</th>
          <th>Estatus</th>
          <!--<th>Reconocimiento</th>-->
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
                    "<td>".trim($equipo->institucion)."</td>".
                    "<td>".trim($equipo->nombreCoach)."</td>".
                    "<td>".trim($equipo->estatus)."</td>".
                    //"<td>"."<button class='btn btn-success'>Descargar</button>"."</td>".
                    "<td><form method='post'>".
                      "<button type='button' class='btn btn-success' onclick='previoAprobar(this,".'"'.$equipo->nombre.'"'.")' name='aprobar' value='".$equipo->id."'>Aprobar</button>".
                      "<button type='button' class='btn btn-warning' onclick='previoDesaprobar(this,".'"'.$equipo->nombre.'"'.")' name='desaprobar' value='".$equipo->id."'>No Aprobar</button>".
                      //"<button formaction='registrarEquipo.php' class='btn btn-primary' name='id' value='".$equipo->id."'>Editar</button>".
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

  <!-- modal aprobar equipo -->
  <div class="modal fade" id="mdlAprobacion" aria-hidden="true" aria-labelledby="confirmarAprobacion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="confirmarAprobacion">Confirmar Aprobación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Está a punto de aprobar al equipo: <strong id="spnEquipoAprobar"></strong></p>
          <p>¿Desea continuar?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#mdlMensajeAprobado">Si</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="mdlMensajeAprobado" aria-hidden="true" aria-labelledby="aprobadoSeguro" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="aprobadoSeguro">Equipo aprobado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Se ha aprobado correctamente al equipo</p>
        </div>
        <div class="modal-footer">
          <form method='post'>
            <button type="submit" class="btn btn-secondary" id="btnConfirmarAprobar" name="aprobarId" data-bs-dismiss="modal">Cerrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- modal desaprobar equipo -->
  <div class="modal fade" id="mdlDesaprobacion" aria-hidden="true" aria-labelledby="confirmarDesaprobacion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="confirmarDesaprobacion">Confirmar Desaprobación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Está a punto de desaprobar al equipo: <strong id="spnEquipoDesaprobar"></strong></p>
          <p>¿Desea continuar?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#mdlMensajeDesaprobado">Si</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="mdlMensajeDesaprobado" aria-hidden="true" aria-labelledby="desaprobadoSeguro" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="desaprobadoSeguro">Equipo desaprobado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Se ha desaprobado correctamente al equipo</p>
        </div>
        <div class="modal-footer">
          <form method='post'>
            <button type="submit" class="btn btn-secondary" id="btnConfirmarDesaprobar" name="desaprobarId" data-bs-dismiss="modal">Cerrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="dt/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
  <script src="dt/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="dt/DataTables-1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <script src="dt/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="dt/Buttons-2.4.2/js/buttons.bootstrap5.min.js"></script>
  <script src="dt/JSZip-3.10.1/jszip.min.js"></script>
  <script src="dt/pdfmake-0.2.7/pdfmake.min.js"></script>
  <script src="dt/pdfmake-0.2.7/vfs_fonts.js"></script>
  <script src="dt/Buttons-2.4.2/js/buttons.html5.min.js"></script>
  <script src="dt/Buttons-2.4.2/js/buttons.print.min.js"></script>
  <script src="dt/Buttons-2.4.2/js/buttons.colVis.min.js"></script>

  <script src="js/llenarTablaEquipos.js"></script>
</body>

</html>