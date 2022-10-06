<?php

require_once("DbConexion.php");

class DbProgramita extends DbConexion {
	  
	public function insertStores($id_usuario, $arr_datos, $tmp_filas){
						
		try{

			$sql = "CALL pa_insert_stores('".$arr_datos."', ".$tmp_filas.", @id)";
			echo($sql);
			$arrCampos[0] = "@id";
			$arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
			$resultado_out = $arrResultado["@id"];	
			return $resultado_out;
					
		} catch (Exception $e) {
			return -2;
		}			
	}

	public function insertProducts($id_usuario, $arr_datos, $tmp_filas){
						
		try{
			$sql = "CALL pa_insert_products('".$arr_datos."', ".$tmp_filas.", @id)";
			echo($sql);
			$arrCampos[0] = "@id";
			$arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
			$resultado_out = $arrResultado["@id"];	
			return $resultado_out;
				
		} catch (Exception $e) {
			return -2;
		}
	}	

	public function insertCategories($id_usuario, $arr_datos, $tmp_filas){
						
		try{
			$sql = "CALL pa_insert_categories('".$arr_datos."', ".$tmp_filas.", @id)";
			echo($sql);
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
 