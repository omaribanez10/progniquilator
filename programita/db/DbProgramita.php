<?php

require_once("DbConexion.php");

class DbProgramita extends DbConexion {
	  
	public function crearActualizarDatosMaestro($id_usuario, $arr_datos, $tmp_filas){
						
			try{
				$sql = "CALL pa_crear_actualizar_datos_maestro(".$id_usuario.",'".$arr_datos."', ".$tmp_filas.", @id)";
				//echo($sql);
				$arrCampos[0] = "@id";
				$arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
				$resultado_out = $arrResultado["@id"];	
				return $resultado_out;
					
			} catch (Exception $e) {
				return -2;
		}			
	}
}
?>
 