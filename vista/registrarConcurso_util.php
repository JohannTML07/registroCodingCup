<?php
    $concurso=new Concurso();
    $clsNombre=$clsFechaInscripcion=$clsFechaCierre="";
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        $dao = new DAOConcurso();
        $concurso = $dao->obtenerUno($_POST["id"]);
    }
    elseif(count($_POST)>1){
        $clsNombre=$clsFechaInscripcion=$clsFechaCierre="is-invalid";
        $valido = true;
        if(ISSET($_POST["nombre"]) && (strlen(trim($_POST["nombre"]))>2 && strlen(trim($_POST["nombre"]))<51)){
            $clsNombre="is-valid";
        }else{
            $valido=false;
        }

        if(ISSET($_POST["fechaInscripcion"])){
            $clsFechaInscripcion="is-valid";
        }else{
            $valido=false;
        }

        if(ISSET($_POST["fechaCierre"])){
            $clsFechaCierre="is-valid";
        }else{
            $valido=false;
        }

        $concurso->nombre=ISSET($_POST["nombre"])?trim($_POST["nombre"]):"";
        $concurso->fechaInscripcion=ISSET($_POST["fechaInscripcion"])?trim($_POST["fechaInscripcion"]):"";
        $concurso->fechaCierre=ISSET($_POST["fechaCierre"])?trim($_POST["fechaCierre"]):"";

        if($valido){
            if(ISSET($_POST["id"]) && strlen($_POST["id"])>0){ //llega el campo "id" con un dato, se va a editar
                $concurso->id=$_POST["id"];
                $dao = new DAOConcurso();
                //editar() regresa true o false si se editó o no
                if($dao->editar($concurso)){
                    header("Location: index_admin.php");
                }
                else{
                    echo "Error al modificar el concurso";
                }
            }
            else{ //llega el campo "id" vacio, se va a agregar
                $dao= new DAOConcurso();
                //agregar() regresa el id del registro insertado en bd
                $agregar = $dao->agregar($concurso);
                if($agregar==0){
                    echo "Error al guardar el concurso";
                }else{
                    //Al finalizar el guardado redireccionar a la lista
                    header("Location: index_admin.php");
                }
            }
        }
    }
?>