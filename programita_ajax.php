<?php 
    header("Content-Type: text/xml; charset=UTF-8");
    
    require_once("./db/DbProgramita.php");
    $dbProgramita = new DbProgramita();
    
    $opcion = str_decode($_POST["opcion"]);
    
    switch ($opcion){
        case 1:
            @$file = $_FILES["archivo"]["name"];
            $rta = copy($_FILES["archivo"]["tmp_name"], "data/" . $_FILES["archivo"]["name"]);
            ?>  
                <input type="hidden" name="hdd_rta_carga" id="hdd_rta_carga" value="<?= $rta ?>"/>
                <input type="hidden" id="hdd_archivo" name="hdd_archivo" value="<?= $_FILES["archivo"]["name"] ?>" /> 
            <?php
             
        break;
        case 2:
            @$archivo = str_decode($_POST["archivo"]);
            $ruta_archivo = "data/".$archivo;
            $contador = 0;
            $arr_datos = "";
            if ($fp = file($ruta_archivo)) {
			
                $filas = count($fp);
                if ($filas > 0) {
                    $columnas = 0;
                    for ($index = 1; $index < 2; $index++) {
                        $columnas = count(explode(";", $fp[$index]));
                        if ($columnas ==8) {
                            $autoincremental = "";
                            $numero_tag = "";
                            $tag = "";
                            $serial = "";
                            $no_GTIN = "";
                            $poder = "";
                            $fecha_vence = "";
                            $tipo_lente = "";
                            $arr_dato = array();
                            for ($index = 1; $index <= $filas; $index++) {
                                $contador++;
                                $arr_dato = explode(";", $fp[$index]);
                                $autoincremental = trim($arr_dato[0]);
                                $numero_tag = trim($arr_dato[1]);
                                $tag = (trim($arr_dato[2]));
                                $serial = trim($arr_dato[3]);
                                $no_GTIN = trim($arr_dato[4]);
                                $poder = (trim($arr_dato[5]));
                                $fecha_vence = trim($arr_dato[6]);
                                $tipo_lente = (trim($arr_dato[7]));
                                
                                $guarda = false;
                                if ($contador < 1000) {
                                    if ($index == $filas) {
                                        $guarda = true;
                                    }
                                    if ($numero_tag != "") {
                                        if ($arr_datos != "") {
                                            $arr_datos .= "|";
                                        }
                                        $arr_datos .= $autoincremental.";".$numero_tag.";".$tag.";".$serial.";".$no_GTIN.";".$poder.";".$fecha_vence.";".$tipo_lente;
                                    }
                                } else {
                                    if ($arr_datos != "") {
                                        $arr_datos .= "|";
                                    }
                                        $arr_datos .= $autoincremental.";".$numero_tag.";".$tag.";".$serial.";".$no_GTIN.";".$poder.";".$fecha_vence.";".$tipo_lente;
                                    $guarda = true;
                                }
            
                                if ($guarda) {
                                    $tmp_filas = count(explode("|", $arr_datos)); 
                                    
                                    $rta = $dbProgramita->crearActualizarDatosMaestro(5, $arr_datos, $tmp_filas);

                                    if ($rta<0) { break; }
            
                                    $arr_datos = "";
                                    $contador = 0;
                                    $guarda = false;
                                }

                            }
                        }else{
                            $rta=-5;
                        }
                    }
                }else{
                    $rta=0;
                }
                   

            }

            ?><input type="hidden" id="hdd_rta_import" name="hdd_rta_import" value="<?=  $rta ?>" /> <?php
        break;
    }

    function str_decode($texto) {
        $texto_rta = str_replace("|PLUS|", "+", $texto);
        $texto_rta = str_replace("|ENTER|", chr(10), $texto_rta);
        $texto_rta = str_replace("|AMP|", "&", $texto_rta);
        $texto_rta = str_replace("'", "", $texto_rta);
        $texto_rta = str_replace('"', "", $texto_rta);
        return $texto_rta;
    }   
?>