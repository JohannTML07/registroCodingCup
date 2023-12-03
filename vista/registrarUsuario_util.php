<?php
    $usuario=new Usuario();
    $correoYaExiste="";
    $clsNombre=$clsCorreo=$clsContrasenia=$clsNuevaContrasenia=$clsConfirmaContrasenia=$clsInstitucion="";
    //caso de si llega por post solo un id, quiere decir que se va a editar y el id se envió desde pagina index_admin
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        $dao = new DAOUsuario();
        //se obtienen los datos del usuario que se va a editar
        $usuario = $dao->obtenerUno($_POST["id"]);
    }
    elseif(count($_POST)>1){
        $clsNombre=$clsCorreo=$clsContrasenia=$clsNuevaContrasenia=$clsConfirmaContrasenia=$clsInstitucion="is-invalid";
        $valido = true;
        if(ISSET($_POST["nombre"]) && (strlen(trim($_POST["nombre"]))>0 && strlen(trim($_POST["nombre"]))<71) &&
            preg_match("/^[a-zA-Z.\s]+$/",$_POST["nombre"])){
            $clsNombre="is-valid";
        }else{
            $valido=false;
        }

        $dao = new DAOUsuario();
        if(ISSET($_POST["correo"]) &&
            filter_var($_POST["correo"],FILTER_VALIDATE_EMAIL)&& !$dao->existeCorreo($_POST["correo"])){
                $clsCorreo="is-valid";
        }else{
            $valido=false;
            $correoYaExiste="Este correo ya está en uso";
        }

        if(ISSET($_POST["contrasenia"])){
            if((strlen(trim($_POST["contrasenia"]))>7 && strlen(trim($_POST["contrasenia"]))<26)){
                $clsContrasenia="is-valid";
            }
            else{
                $valido=false;
            }
        }
        

        if(ISSET($_POST["confirmarContrasenia"])){
            if((strlen(trim($_POST["confirmarContrasenia"]))>7 && strlen(trim($_POST["confirmarContrasenia"]))<26)){
            if(ISSET($_POST["nuevaContrasenia"])){
                if($_POST["nuevaContrasenia"] == $_POST["confirmarContrasenia"]){
                    $clsNuevaContrasenia="is-valid";
                }
                else{
                    $clsNuevaContrasenia="is-invalid";
                    $valido=false;
                }
            }
            else{
                if($_POST["contrasenia"] == $_POST["confirmarContrasenia"]){
                    $clsConfirmaContrasenia="is-valid";
                }
                else{
                    $clsConfirmaContrasenia="is-invalid";
                    $valido=false;
                }
            }
            }else{
              $valido=false;
            }
        }
        else{
            $valido=false;
        }
        

        if(ISSET($_POST["institucion"]) && (strlen(trim($_POST["institucion"]))>0 && strlen(trim($_POST["institucion"]))<101)){
            $clsInstitucion="is-valid";
        }else{
            $valido=false;
        }

        if(ISSET($_POST["tipoUsuario"]) && ($_POST["tipoUsuario"]=="coach"||$_POST["tipoUsuario"]=="auxiliar")){
            $clsInstitucion="is-valid";
        }else{
            $valido=false;
        }

        $usuario->nombre=ISSET($_POST["nombre"])?trim($_POST["nombre"]):"";
        $usuario->correo=ISSET($_POST["correo"])?trim($_POST["correo"]):"";
        $usuario->contrasenia=ISSET($_POST["contrasenia"])?$_POST["contrasenia"]:"";
        $usuario->nuevaContrasenia=ISSET($_POST["nuevaContrasenia"])?$_POST["nuevaContrasenia"]:"";
        $usuario->confirmarContrasenia=ISSET($_POST["confirmarContrasenia"])?$_POST["confirmarContrasenia"]:"";
        $usuario->institucion=ISSET($_POST["institucion"])?$_POST["institucion"]:"";
        $usuario->tipo=ISSET($_POST["tipoUsuario"])?$_POST["tipoUsuario"]:"";

        if($valido){
            if(ISSET($_POST["id"]) && strlen($_POST["id"])>0){ //llega el campo "id" con un dato, se va a editar
                $usuario->id=$_POST["id"];
                $dao = new DAOUsuario();
                //si se va a cambiar la contraseña
                if(ISSET($_POST["nuevaContrasenia"])){
                    if($dao->editarContra($usuario)){
                        header("Location: listadoUsuarios.php");
                    }
                    else{
                        echo "La contrasenia no coincide";
                    }
                }
                else{
                    //editar() regresa true o false si se editó o no
                    if($dao->editar($usuario)){
                        header("Location: listadoUsuarios.php");
                    }
                    else{
                        echo "Error al actualizar";
                    }
                }
            }
            else{ //llega el campo "id" vacio, se va a agregar
                $dao= new DAOUsuario();
                //agregar() regresa el id del registro insertado en bd
                $agregar = $dao->agregar($usuario);
                if($agregar==0){
                    echo "Error al guardar el usuario";
                }else{
                    //Al finalizar el guardado redireccionar a la lista
                    header("Location: listadoUsuarios.php");
                }
            }
        }
    }
?>