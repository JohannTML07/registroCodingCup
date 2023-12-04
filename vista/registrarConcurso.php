<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Registro de Concurso</title>
</head>
<body class="text-center">
    <!--Página Principal-->
    <?php
        /*session_start();
        if($_SESSION["tipo"]=="coach"){
            header("Location:index.php");
            return;
        }*/
        require_once('../datos/daoConcurso.php');
        require_once('registrarConcurso_util.php');
    ?>

    <div class="container vh-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="row p-3 justify-content-center col-5" id="contenido">
                <h1 class="text-white m-4 w-auto" id="tituloLogin">Registro de concurso</h1>
                    <form method="post" class="needs-validation" id="formularioReg" novalidate>
                        <div class="text-white text-start">
                            <div>
                                <input type="hidden" name="id" value="<?php echo ISSET($_POST["id"])?$_POST["id"]:"" ?>">
                                <label>Nombre del concurso</label>
                                <input type="text" class="form-control <?=$clsNombre?>" id="txtNombreConcurso" name="nombre" value="<?=$concurso->nombre?>" placeholder="Ingrese nombre del concurso" minlength="2" maxlength="50" required>
                                <div class="invalid-feedback text-start">No debe estar vacío y debe contener entre 2 y 50 caracteres</div>
                            </div>
                            <div>
                                <label>Fecha de Inscripción</label>
                                <input type="date" class="form-control <?=$clsFechaInscripcion?>" id="txtFechaInscripcion" name="fechaInscripcion" value="<?=$concurso->fechaInscripcion?>" required>
                                <div class="invalid-feedback text-start">No debe estar vacío</div>
                            </div>
                            <div>
                                <label>Fecha de cierre</label>
                                <input type="date" class="form-control <?=$clsFechaCierre?>" id="txtFechaCierre" name="fechaCierre" value="<?=$concurso->fechaCierre?>" required>
                                <div class="invalid-feedback text-start">No debe estar vacío</div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
                        <button class="btn btn-danger" id="btnCancelar">Cancelar</button>
                    </form>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/registrarConcurso.js"></script>
</body>
</html>
