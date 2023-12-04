<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio administrador</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>
  <?php 
    session_start();
    if($_SESSION["tipo"]=="coach"){
      header("Location:index.php");
      return;
    }
    
    require('navbar_admin.php');
  ?>
  <div id="contenido" class="container mt-3">
    <table id="tblPersonas" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Concurso actual</th>
          <th>Equipos actuales</th>
          <th>Fecha de inscripción</th>
          <th>Fecha de cierre</th>
          <th>Equipo ganador</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="modal" id="mdlConfirmacion" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header primary">
          <h5 class="modal-title">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Está a punto de eliminar a: <strong id="spnPersona"></strong> ¿Desea continuar? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" id="btnConfirmar" data-bs-toggle="modal" 
          data-bs-target="#mdlAvisoEliminación">Si, continuar con la eliminación</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="mdlAvisoEliminación" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header secundary">
          <h5 class="modal-title">Catálogo de personas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>El registro ha sido eliminado</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="btnConfirmar" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="dt/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
  <script src="dt/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="dt/DataTables-1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="js/llenarTabla.js"></script>
</body>

</html>