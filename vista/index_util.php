<?php 
    $formulario = "";
    $correoYaExiste="";

    $checkedReg = false;
    $esconderReg = true;

    $usuario = new Usuario();
    $usuarioReg = new Usuario();
    $clsCorreo=$clsPassword=$clsEncontrado="";
    $clsNombreReg=$clsCorreoReg=$clsContraseniaReg=$clsConfirmaContraseniaReg=$clsInstitucionReg="";
    if(count($_POST)>1 && count($_POST)<3){
        $clsCorreo=$clsPassword="is-invalid";
        $valido = true;
        if(ISSET($_POST["email"])){
            $clsCorreo="is-valid";
        }else{
            $valido=false;
        }

        if(ISSET($_POST["password"]) && (strlen($_POST["password"])>0) && (strlen($_POST["password"])<25)){
            $clsPassword="is-valid";
        }else{
            $valido=false;
        }

        $usuario->correo=ISSET($_POST["email"])?trim($_POST["email"]):"";
        $usuario->contrasenia=ISSET($_POST["password"])?$_POST["password"]:"";

        if($valido){
            //buscar usuario
            $dao= new DAOUsuario();
            //regresa un usuario solo con los campos nombre y tipo, los demás vacios
            $existe = $dao->login($usuario->correo, $usuario->contrasenia);
            if($existe){
                session_start();
                $_SESSION["idUsuario"]=$existe->id;
                $_SESSION["usuario"]=$existe->nombre;
                $_SESSION["tipo"]=$existe->tipo;
                var_dump($_SESSION);
                if($existe->tipo=="admin"){
                    header("Location: index_admin.php");
                }
                else if($existe->tipo=="coach"){
                    header("Location: index_coach.php");
                }
                else{
                    //auxiliar enviará a página de auxiliar
                    header("Location: index_admin.php");
                }
            }else{
                //Al finalizar el guardado redireccionar a la lista
                $clsEncontrado="is-invalid";
            }
        }
    }
    else if(count($_POST)>2){ //si llegan más de 2 datos por post quiere decir que se va a registrar
        $checkedReg = true;
        $esconderReg = false;
        $clsNombreReg=$clsCorreoReg=$clsContraseniaReg=$clsConfirmaContraseniaReg=$clsInstitucionReg="is-invalid";
        $valido = true;
        if(ISSET($_POST["nombre"]) && (strlen(trim($_POST["nombre"]))>0 && strlen(trim($_POST["nombre"]))<71) &&
            preg_match("/^[a-zA-Z.\s]+$/",$_POST["nombre"])){
            $clsNombreReg="is-valid";
        }else{
            $valido=false;
        }

        $dao = new DAOUsuario();
        if(ISSET($_POST["correo"]) &&
            filter_var($_POST["correo"],FILTER_VALIDATE_EMAIL)){
                if(!$dao->existeCorreo($_POST["correo"])){
                    $clsCorreoReg="is-valid";
                }
                else{
                    $valido=false;
                    $correoYaExiste="Este correo ya está en uso";
                }
        }else{
            $valido=false;
        }

        if(ISSET($_POST["contrasenia"])){
            if((strlen(trim($_POST["contrasenia"]))>7 && strlen(trim($_POST["contrasenia"]))<26)){
                $clsContraseniaReg="is-valid";
            }
            else{
                $valido=false;
            }
        }

        if(ISSET($_POST["confirmarContrasenia"])){
            if($_POST["contrasenia"] == $_POST["confirmarContrasenia"]){
                $clsConfirmaContraseniaReg="is-valid";
            }
            else{
                $clsConfirmaContraseniaReg="is-invalid";
                $valido=false;
            }
        }
        else{
            $valido=false;
        }

        $usuarioReg->nombre=ISSET($_POST["nombre"])?trim($_POST["nombre"]):"";
        $usuarioReg->correo=ISSET($_POST["correo"])?trim($_POST["correo"]):"";
        $usuarioReg->contrasenia=ISSET($_POST["contrasenia"])?$_POST["contrasenia"]:"";
        $usuarioReg->confirmarContrasenia=ISSET($_POST["confirmarContrasenia"])?$_POST["confirmarContrasenia"]:"";
        $usuarioReg->institucion=ISSET($_POST["institucion"])?$_POST["institucion"]:"";
        $usuarioReg->tipo="coach";

        if($valido){
            $dao= new DAOUsuario();
            //agregar() regresa el id del registro insertado en bd
            $agregar = $dao->agregar($usuarioReg);
            if($agregar==0){
                echo "Error al guardar el usuario";
            }else{
                //Al finalizar el guardado redireccionar a la lista
                header("location: index.php");
            }
        }
    }
?>