<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Registro de Equipo</title>
</head>
<body class="text-center">
    <!--Página Principal-->
    <?php
        session_start();
        if(!ISSET($_SESSION["usuario"])){
        header("Location:index.php");
        return;
        }
        require_once('../datos/daoEquipo.php');
        require_once('registrarEquipo_util.php');
    ?>

    <div class="container vh-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="row p-3 justify-content-center col-5" id="contenido">
                <h1 class="text-white m-4 w-auto" id="tituloLogin">Registro de equipo</h1>
                    <form method="post" class="needs-validation" id="formularioReg" novalidate>
                        <div class="text-white text-start">
                            <div>
                                <input type="hidden" name="id" value="<?php echo ISSET($_POST["id"])?$_POST["id"]:"" ?>">
                                <label>Nombre del equipo</label>
                                <input type="text" class="form-control <?=$clsNombre?>" id="txtNombreEquipo" name="nombre" value="<?=$equipo->nombre?>" placeholder="Ingrese nombre del equipo" minlength="5" maxlength="50" required>
                                <div class="invalid-feedback text-start">No debe estar vacío y debe contener entre 5 y 50 caracteres</div>
                            </div>
                            <div>
                                <label>Nombre del participante 1</label>
                                <input type="text" class="form-control <?=$clsMiembro1?>" id="txtMiembro1" name="miembro1" value="<?=$equipo->miembro1?>" placeholder="Ingrese nombre participante 1" minlength="3" maxlength="50" required>
                                <div class="invalid-feedback text-start">No debe estar vacío y debe contener entre 3 y 50 letras</div>
                            </div>
                            <div>
                                <label>Nombre del participante 2</label>
                                <input type="text" class="form-control <?=$clsMiembro2?>" id="txtMiembro2" name="miembro2" value="<?=$equipo->miembro2?>" placeholder="Ingrese nombre participante 2" minlength="3" maxlength="50" required>
                                <div class="invalid-feedback text-start">No debe estar vacío y debe contener entre 3 y 50 letras</div>
                            </div>
                            <div>
                                <label>Nombre del participante 3</label>
                                <input type="text" class="form-control <?=$clsMiembro3?>" id="txtMiembro3" name="miembro3" value="<?=$equipo->miembro3?>" placeholder="Ingrese nombre participante 3" minlength="3" maxlength="50" required>
                                <div class="invalid-feedback text-start">No debe estar vacío y debe contener entre 3 y 50 letras</div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
                        <button class="btn btn-danger" id="btnCancelar">Cancelar</button>
                    </form>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/registrarEquipo.js"></script>
</body>
</html>
