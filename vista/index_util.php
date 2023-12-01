<?php 
    $usuario = new Usuario();
    $clsCorreo=$clsPassword=$clsEncontrado="";

    if(count($_POST)>1 && count($_POST)<3){
        $clsCorreo=$clsPassword="is-invalid";
        $valido = true;
        if(ISSET($_POST["email"]) && filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
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
                if($existe->tipo=="admin"){
                    header("Location: index_admin.php");
                }
                else if($existe->tipo=="coach"){
                    header("Location: index_coach.php");
                }
                else{
                    header("Location: index_admin.php");
                }
            }else{
                //Al finalizar el guardado redireccionar a la lista
                $clsEncontrado="is-invalid";
            }
        }
    }
?>