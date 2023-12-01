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
    require('navbar_admin.php');
  ?>
    <div id="contenido" class="container mt-3">
      <button id="btnAgregar" class="btn btn-success mb-5">Agregar Usuario</button>
      <table id="tblPersonas" class="table table-striped table-hover">
        <thead>
          <tr>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Tipo de usuario</th>
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
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="dt/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
    <script src="dt/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="dt/DataTables-1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/llenarTablaUsuarios.js"></script>
    </script>
</body>
</html>