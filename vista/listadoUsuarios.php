<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="dt/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
  <?php 
    session_start();
    if(!ISSET($_SESSION["usuario"])){
      header("Location:index.php");
      return;
    }
    require('navbar_admin.php');
    require_once('../datos/daoUsuario.php');
    $dao=new DAOUsuario();
    $listaUsuarios=$dao->obtenerTodos();

    //esto cuando se acepta la eliminación
    if(count($_POST)==1 && ISSET($_POST["eliminarId"]) && is_numeric($_POST["eliminarId"])){
      if($dao->eliminar($_POST["eliminarId"])){
        header("Location: ".$_SERVER["PHP_SELF"]);
      }
    }
  ?>
  <div id="contenido" class="container mt-3">
    <span><h1>GESTIÓN DE USUARIOS</h1></span>
    <button id="btnAgregar" class="btn btn-success mb-5">Agregar Usuario</button>
    <table id="tblUsuarios" class="table table-striped table-hover">
      <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Institución</th>
            <th>Tipo de usuario</th>
            <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($listaUsuarios as $usuario){
        echo "<tr><td>".$usuario->id."</td>".
                  "<td>".trim($usuario->nombre)."</td>".
                  "<td>".trim($usuario->correo)."</td>".
                  "<td>".trim($usuario->institucion)."</td>".
                  "<td>".trim($usuario->tipo)."</td>".
                  "<td><form method='post'>".
                    "<button formaction='registrarUsuario.php' class='btn btn-primary' name='id' value='".$usuario->id."'>Editar</button>".
                    //"<span>$usuario->nombre</span>"
                    "<button type='button' class='btn btn-danger' onclick='previoEliminar(this,".'"'.$usuario->nombre.'"'.")' name='id' value='".$usuario->id."'>Eliminar</button>".
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
          <p>Está a punto de eliminar a: <strong id="spnUsuario"></strong></p>
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
          <h5 class="modal-title fs-5" id="eliminadoSeguro">Usuario eliminado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Se ha eliminado correctamente al usuario</p>
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
  <script src="js/llenarTablaUsuarios.js"></script>
</body>
</html>