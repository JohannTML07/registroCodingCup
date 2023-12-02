<?php
    $equipo=new Equipo();
    //$nombre=$miembro1=$miembro2=$miembro3="";
    $clsNombre=$clsMiembro1=$clsMiembro2=$clsMiembro3="";
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        $dao = new DAOEquipo();
        $equipo = $dao->obtenerUno($_POST["id"]);
        /*$nombre = $equipo->nombre;
        $miembro1 = $equipo->miembro1;
        $miembro2 = $equipo->miembro2;
        $miembro3 = $equipo->miembro3;*/
    }
    elseif(count($_POST)>1){
        $clsNombre=$clsMiembro1=$clsMiembro2=$clsMiembro3="is-invalid";
        $valido = true;
        if(ISSET($_POST["nombre"]) && (strlen(trim($_POST["nombre"]))>4 && strlen(trim($_POST["nombre"]))<51)){
            $clsNombre="is-valid";
        }else{
            $valido=false;
        }

        if(ISSET($_POST["miembro1"]) && 
          (strlen(trim($_POST["miembro1"]))>2 && strlen(trim($_POST["miembro1"]))<51) && preg_match("/^[a-zA-Z.\s]+$/",$_POST["miembro1"])){
            $clsMiembro1="is-valid";
        }else{
            $valido=false;
        }

        if(ISSET($_POST["miembro2"]) && 
          (strlen(trim($_POST["miembro2"]))>2 && strlen(trim($_POST["miembro2"]))<51) && preg_match("/^[a-zA-Z.\s]+$/",$_POST["miembro2"])){
            $clsMiembro2="is-valid";
        }else{
            $valido=false;
        }

        if(ISSET($_POST["miembro3"]) && 
          (strlen(trim($_POST["miembro3"]))>2 && strlen(trim($_POST["miembro3"]))<51) && preg_match("/^[a-zA-Z.\s]+$/",$_POST["miembro3"])){
            $clsMiembro3="is-valid";
        }else{
            $valido=false;
        }

        $equipo->nombre=ISSET($_POST["nombre"])?trim($_POST["nombre"]):"";
        $equipo->idCoach=$_SESSION["idUsuario"];
        $equipo->miembro1=ISSET($_POST["miembro1"])?trim($_POST["miembro1"]):"";
        $equipo->miembro2=ISSET($_POST["miembro2"])?trim($_POST["miembro2"]):"";
        $equipo->miembro3=ISSET($_POST["miembro3"])?trim($_POST["miembro3"]):"";


        if($valido){
            if(ISSET($_POST["id"]) && strlen($_POST["id"])>0){ //llega el campo "id" con un dato, se va a editar
                $equipo->id=$_POST["id"];
                $dao = new DAOEquipo();
                //editar() regresa true o false si se editó o no
                if($dao->editar($equipo)){
                    echo "editado";
                    header("Location: index_coach.php");
                }
                else{
                    echo "Error al modificar el equipo";
                }
            }
            else{ //llega el campo "id" vacio, se va a agregar
                $dao= new DAOEquipo();
                //agregar() regresa el id del registro insertado en bd
                $agregar = $dao->agregar($equipo);
                //var_dump($equipo);
                if($agregar==0){
                    echo "Error al guardar el equipo";
                }else{
                    //Al finalizar el guardado redireccionar a la lista
                    header("Location: index_coach.php");
                }
            }
        }
    }
?>