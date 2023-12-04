<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../modelos/equipo.php'; 

class DAOEquipo
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
    * Metodo que obtiene todos los equipos de la base de datos y los
    * retorna como una lista de objetos  
    */
	public function obtenerTodos($idCoach)
	{
		try
		{
            $this->conectar();
            
			$lista = array();
            /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
			$sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,miembro1,miembro2,miembro3,estatus FROM equipos WHERE idCoach=?");
			
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
			$sentenciaSQL->execute([$idCoach]);
            
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
			foreach($resultado as $fila)
			{
				$obj = new Equipo();
                $obj->id = $fila->id;
	            $obj->nombre = $fila->nombre;
	            $obj->miembro1 = $fila->miembro1;
	            $obj->miembro2 = $fila->miembro2;
	            $obj->miembro3 = $fila->miembro3;
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
            
			$sentenciaSQL = $this->conexion->prepare("SELECT nombre, miembro1, miembro2, miembro3 FROM equipos WHERE id=?"); 
			//Se ejecuta la sentencia sql con los parametros dentro del arreglo 
            $sentenciaSQL->execute([$id]);
            
            /*Obtiene los datos*/
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			
            $obj = new Equipo();
            
            $obj->nombre = $fila->nombre;
            $obj->miembro1 = $fila->miembro1;
            $obj->miembro2 = $fila->miembro2;
            $obj->miembro3 = $fila->miembro3;
           
            return $obj;
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}
    
    /**
     * Elimina el usuario con el id indicado como parámetro
     */
	public function eliminar($id)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM equipos WHERE id = ?");			          
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
     * Función para editar al empleado de acuerdo al objeto recibido como parámetro
     */
	public function editar(Equipo $obj)
	{
		try 
		{
			$sql = "UPDATE equipos
                    SET
                    nombre = ?,
                    miembro1 = ?,
                    miembro2 = ?,
                    miembro3 = ?,
                    foto = ?
                    WHERE id = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->nombre,
                      $obj->miembro1,
                      $obj->miembro2,
                      $obj->miembro3,
					  $obj->foto,
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
     * Agrega un nuevo usuario de acuerdo al objeto recibido como parámetro
     */
    public function agregar(Equipo $obj)
	{
        $clave=0;
		try 
		{
            $sql = "INSERT INTO equipos
                (nombre,idCoach,miembro1,miembro2,miembro3,foto)
                VALUES
                (:nombre,
                :idCoach,
                :miembro1,
                :miembro2,
                :miembro3,
                :foto);";
                
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(array(
                    ':nombre'=>$obj->nombre,
                 ':idCoach'=>$obj->idCoach,
                 ':miembro1'=>$obj->miembro1,
                 ':miembro2'=>$obj->miembro2,
                 ':miembro3'=>$obj->miembro3,
                 ':foto'=>$obj->foto
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