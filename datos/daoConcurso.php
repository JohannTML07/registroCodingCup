<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../modelos/concurso.php'; 

class DAOConcurso
{
    
	private $conexion;
    
    /**
     * Permite obtener la conexión a la BD
     */
    private function conectar(){
        try{
			$this->conexion = Conexion::conectar(); 
		}
		catch(Exception $e)
		{
			die($e->getMessage()); /*Si la conexion no se establece se cortara el flujo enviando un mensaje con el error*/
		}
    }
    
   /**
    * Metodo que obtiene todos los concursos de la base de datos y los
    * retorna como una lista de objetos  
    */
	public function obtenerTodos()
	{
		try
		{
            $this->conectar();
            
			$lista = array();
            /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
			$sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,fechaInscripcion,fechaCierre,estatus FROM concursos order by estatus desc, fechaCierre desc");
			
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
			$sentenciaSQL->execute();
            
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
            
			foreach($resultado as $fila)
			{
				$obj = new Concurso();
                $obj->id = $fila->id;
	            $obj->nombre = $fila->nombre;
	            $obj->fechaInscripcion = $fila->fechaInscripcion;
	            $obj->fechaCierre = $fila->fechaCierre;
                $obj->estatus = $fila->estatus;
				//Agrega el objeto al arreglo, no necesitamos indicar un índice, usa el próximo válido
                $lista[] = $obj;
			}
            
			return $lista;
		}
		catch(PDOException $e){
			return null;
		}finally{
            Conexion::desconectar();
        }
	}
    
    
	/**
     * Metodo que obtiene un registro de la base de datos, retorna un objeto  
     */
    public function obtenerUno($id)
	{
		try
		{ 
            $this->conectar();
            
            //Almacenará el registro obtenido de la BD
			$obj = null; 
            
			$sentenciaSQL = $this->conexion->prepare("SELECT nombre,fechaInscripcion,fechaCierre FROM concursos WHERE id=?"); 
			//Se ejecuta la sentencia sql con los parametros dentro del arreglo 
            $sentenciaSQL->execute([$id]);
            
            /*Obtiene los datos*/
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			
            $obj = new Concurso();

	        $obj->nombre = $fila->nombre;
	        $obj->fechaInscripcion = $fila->fechaInscripcion;
	        $obj->fechaCierre = $fila->fechaCierre;
           
            return $obj;
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}
    
    /**
     * Elimina el concurso con el id indicado como parámetro
     */
	public function eliminar($id)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM concursos WHERE id = ?");			          
			$resultado=$sentenciaSQL->execute(array($id));
			return $resultado;
		} catch (PDOException $e) 
		{
			//Si quieres acceder expecíficamente al numero de error
			//se puede consultar la propiedad errorInfo
			return false;	
		}finally{
            Conexion::desconectar();
        }
	}

    /**
     * Activa el concurso con el id indicado como parámetro
     */
	public function activar($id)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("UPDATE concursos SET estatus = 'desactivado' WHERE id>=1; UPDATE concursos SET estatus = 'activado' WHERE id = ?");			          
			$resultado=$sentenciaSQL->execute(array($id));
			return $resultado;
		} catch (PDOException $e) 
		{
			//Si quieres acceder expecíficamente al numero de error
			//se puede consultar la propiedad errorInfo
			return false;	
		}finally{
            Conexion::desconectar();
        }
	}

	/**
     * Elimina el concurso con el id indicado como parámetro
     */
	public function buscarActivo()
	{
		try 
		{
			$this->conectar();
            
			$obj = null;
            $sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,fechaCierre FROM concursos WHERE estatus='activado';");			          
			$sentenciaSQL->execute();
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			
            $obj = new Concurso();

	        $obj->id = $fila->id;
	        $obj->nombre = $fila->nombre;
	        $obj->fechaCierre = $fila->fechaCierre;
           
            return $obj;
		} catch (PDOException $e) 
		{
			//Si quieres acceder expecíficamente al numero de error
			//se puede consultar la propiedad errorInfo
			return false;	
		}finally{
            Conexion::desconectar();
        }
	}
    
	/**
     * Función para editar el concurso de acuerdo al objeto recibido como parámetro
     */
	public function editar(Concurso $obj)
	{
		try 
		{
			$sql = "UPDATE concursos
                    SET
                    nombre = ?,
                    fechaInscripcion = ?,
                    fechaCierre = ?
                    WHERE id = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->nombre,
                      $obj->fechaInscripcion,
                      $obj->fechaCierre,
					  $obj->id)
					);
            return true;
		} catch (PDOException $e){
			//Si quieres acceder expecíficamente al numero de error
			//se puede consultar la propiedad errorInfo
			return false;
		}finally{
            Conexion::desconectar();
        }
	}

	
	/**
     * Agrega un nuevo concurso de acuerdo al objeto recibido como parámetro
     */
    public function agregar(Concurso $obj)
	{
        $clave=0;
		try 
		{
            $sql = "INSERT INTO concursos
                (nombre,fechaInscripcion,fechaCierre)
                VALUES
                (:nombre,
                :fechaInscripcion,
                :fechaCierre);";
                
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(array(
                    ':nombre'=>$obj->nombre,
                 ':fechaInscripcion'=>$obj->fechaInscripcion,
                 ':fechaCierre'=>$obj->fechaCierre
                ));
                 
            $clave=$this->conexion->lastInsertId();
            return $clave;
		} catch (Exception $e){
			return $clave;
		}finally{
            
            /*En caso de que se necesite manejar transacciones, 
			no deberá desconectarse mientras la transacción deba 
			persistir*/
            
            Conexion::desconectar();
        }
	}
}