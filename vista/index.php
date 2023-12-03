<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login Coding Cup</title>
</head>
<body class="text-center">

    <?php 
        require_once('../datos/daoUsuario.php');
        require_once('index_util.php');
    ?>
    <!--Página Principal-->
    <div class="container vh-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="row p-3 justify-content-center col-5" id="contenido">
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnIniciarSesion" autocomplete="off" checked>
                    <label class="btn btn-outline-light" for="btnIniciarSesion">Iniciar Sesión</label>
                
                    <input type="radio" class="btn-check" name="btnradio" id="btnRegistrarse" autocomplete="off">
                    <label class="btn btn-outline-light" for="btnRegistrarse">Registrarse</label>
                </div>
                <h1 class="text-white m-4 w-auto" id="tituloLogin">INICIO DE SESIÓN</h1>
                <div>
                    <form method="post" class="needs-validation" id="formularioLogin" novalidate>
                        <div>
                            <input type="email" class="form-control <?=$clsCorreo?>" id="txtCorreoLogin" name="email" value="<?=$usuario->correo?>" placeholder="Correo" maxlength="50" required>
                            <div class="invalid-feedback text-start">
                                <ul><li>No debe estar vacío</li><li>El correo debe Debe cumplir con el formato de un correo</li></ul>
                            </div>
                        </div>
                        <div>
                            <input type="password" class="form-control <?=$clsPassword?>" id="txtContraLogin" name="password" value="<?=$usuario->contrasenia?>" placeholder="Contraseña" maxlength="25" required>
                            <div class="invalid-feedback text-start">No debe estar vacío</div>
                        </div>
                        <div>
                            <input hidden type="text" class="form-control <?=$clsEncontrado?>">
                            <div class="invalid-feedback text-start">Usuario y/o Contraseña Incorrectos</div>
                        </div>
                        <button class="btn btn-success" id="btnEnviarLogin">Enviar</button>
                    </form>

                    <form method="post" class="needs-validation" id="formularioReg" novalidate hidden>
                        <div>
                            <input type="text" class="form-control" id="txtNombreCoachReg" placeholder="Nombre del Coach" maxlength="50" required>
                            <div class="invalid-feedback text-start">No debe estar vacío</div>
                        </div>
                        <div>
                            <input type="email" class="form-control" id="txtCorreoReg" placeholder="Correo" maxlength="50" required>
                            <div class="invalid-feedback text-start">
                                <ul><li>No debe estar vacío</li><li>Debe cumplir con el formato de un correo (@ y .)</li></ul>
                            </div>
                        </div>
                        <div>
                            <input type="password" class="form-control" id="txtContraReg" placeholder="Contraseña" minlength="8" maxlength="25" required>
                            <div class="invalid-feedback text-start">
                                <ul><li>No debe estar vacío</li><li>Debe contener entre 8 y 25 caracteres</li></ul>
                            </div>
                        </div>
                        <div>
                            <input type="password" class="form-control" id="txtConfirmaContraReg" placeholder="Confirma Contraseña" minlength="8" maxlength="25" required>
                            <div class="invalid-feedback text-start">
                                <ul><li>No debe estar vacío</li><li>Debe ser igual a la contraseña</li></ul>
                            </div>
                        </div>
                        <div>
                            <input type="text" class="form-control" id="txtInstitucionReg" placeholder="Institución" minlength="1" maxlength="100" required>
                            <div class="invalid-feedback text-start">No debe estar vacío</div>
                        </div>
                        <button class="btn btn-success" id="btnEnviarReg">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Registro-->

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/validacion.js"></script>
</body>
</html>
