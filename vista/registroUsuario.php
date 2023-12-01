<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/usuarios.css">
</head>
<body>
    <div class="container col-md-8 vh-100 ">
        <div class="row justify-content-center align-items-center h-100 ">
            <div class="align-items-center col-md-8 marco">
                <h2 class="contenido">Registro de Usuario</h2>
                <form>
                    <div class="form-group">
                        <label for="nombreCompleto">Nombre Completo:</label>
                        <input type="text" class="form-control form-control-sm" id="nombreCompleto" name="nombreCompleto">
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control form-control-sm " id="usuario" name="usuario">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control form-control-sm" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirmarPassword">Confirmar Contraseña:</label>
                        <input type="password" class="form-control form-control-sm" id="confirmarPassword" name="confirmarPassword">
                    </div>
                    <div class="form-group">
                        <label for="tipoUsuario">Tipo de Usuario:</label>
                        <select class="form-control form-control-sm" id="tipoUsuario" name="tipoUsuario">
                            <option value="administrador">Administrador</option>
                            <option value="coach">Coach</option>
                            <option value="auxiliar">Auxiliar</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    <button type="submit" class="btn btn-danger" id="btnCancelar">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/registroUsuario.js"></script>
</body>
</html>