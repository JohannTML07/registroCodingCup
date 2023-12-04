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
    <?php
        session_start();
        if($_SESSION["tipo"]!="admin"){
            header("Location:index.php");
            return;
          }
        require_once('../datos/daoUsuario.php');
        require_once('registrarUsuario_util.php');
    ?>
    <div class="container col-md-5 vh-100 ">
        <div class="row justify-content-center align-items-center h-100 ">
            <div class="align-items-center col-md-8 marco">
                <h2 class="contenido">Registro de Usuario</h2>
                <form method="post" class="needs-validation" id="formularioReg" novalidate>
                    <div>
                    <input type="hidden" name="id" value="<?php echo ISSET($_POST["id"])?$_POST["id"]:"" ?>">
                        <label for="txtNombre">Nombre Completo</label>
                        <input type="text" class="form-control <?=$clsNombre?>" id="txtNombre" name="nombre" value="<?=$usuario->nombre?>" placeholder="Ingrese nombre completo del usuario" maxlength="70" required>
                        <div class="invalid-feedback text-start">No debe estar vacío y debe contener solo letras y/o "."</div>
                    </div>
                    <div>
                        <label for="txtCorreo">Correo (Usuario)</label>
                        <input type="email" class="form-control <?=$clsCorreo?>" id="txtCorreo" name="correo" value="<?=$usuario->correo?>" placeholder="Ingrese correo (será usado para login)" maxlength="50" required>
                        <div class="invalid-feedback text-start">
                            <ul><li>No debe estar vacío</li><li>Debe cumplir con el formato de un correo (@ y .)</li><span id="correoYaExiste"><?=$correoYaExiste?></ul>
                        </div>
                    </div>
                    <div id="cambiarContrasenia"<?=ISSET($_POST["id"])&&$_POST["id"]!=""?"":"hidden" ?>>
                        <label for="cbxCambiarContrasenia">Modificar Contraseña</label>
                        <input type="checkbox" class="form-check-input" id="cbxCambiarContrasenia">
                    </div>
                    <div id="contrasenia">
                        <label for="txtContrasenia">Contraseña</label>
                        <input type="password" class="form-control <?=$clsContrasenia?>" id="txtContrasenia" name="contrasenia" value="<?=$usuario->contrasenia?>" placeholder="Ingrese contraseña del usuario" minlength="8" maxlength="25" required>
                        <div class="invalid-feedback text-start">
                            <ul><li>No debe estar vacío</li><li>Debe contener entre 8 y 25 caracteres</li><span id="spnNoCoincide"></span></ul>
                        </div>
                    </div>
                    <div id="nuevaContrasenia" hidden>
                        <label for="txtNuevaContrasenia">Nueva Contraseña</label>
                        <input type="password" class="form-control <?=$clsNuevaContrasenia?>" id="txtNuevaContrasenia" name="" value="<?=$usuario->nuevaContrasenia?>" placeholder="Ingrese nueva contraseña" minlength="8" maxlength="25">
                        <div class="invalid-feedback text-start">
                            <ul><li>No debe estar vacío</li><li>Debe contener entre 8 y 25 caracteres</li></ul>
                        </div>
                    </div>
                    <div id="confirmarContrasenia">
                        <label for="txtConfirmarContrasenia">Confirmar Contraseña</label>
                        <input type="password" class="form-control <?=$clsConfirmaContrasenia?>" id="txtConfirmarContrasenia" name="confirmarContrasenia" value="<?=$usuario->confirmarContrasenia?>" placeholder="Confirme contraseña" minlength="8" maxlength="25" required>
                        <div class="invalid-feedback text-start">Debe ser igual a la contraseña</div>
                    </div>
                    <div>
                        <label for="txtInstitucion">Institución</label>
                        <input type="text" class="form-control <?=$clsInstitucion?>" id="txtInstitucion" name="institucion" value="<?=$usuario->institucion?>" placeholder="Ingrese institución" maxlength="100" required>
                        <div class="invalid-feedback text-start">No debe estar vacío</div>
                    </div>
                    <div>
                        <label for="cmbTipoUsuario">Tipo de Usuario:</label>
                        <select class="form-control" id="cmbTipoUsuario" name="tipoUsuario" value="<?=$usuario->tipo?>">
                            <!--<option value="administrador">Administrador</option>-->
                            <option value="coach" <?=($usuario->tipo=="coach")?"selected":"";?>>Coach</option>
                            <option value="auxiliar" <?=($usuario->tipo=="auxiliar")?"selected":"";?>>Auxiliar</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    <button class="btn btn-danger" id="btnCancelar">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/registrarUsuario.js"></script>
</body>
</html>