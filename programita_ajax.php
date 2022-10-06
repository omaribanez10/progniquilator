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
        case 2://Stores
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
                            $increment = "";
                            $store_id = "";
                            $name = "";
                            $nit = "";
                            $phone = "";
                            $email = "";
                            $website = "";
                            $address = "";
                            $arr_dato = array();
                            for ($index = 1; $index <= $filas; $index++) {
                                $contador++;
                                $arr_dato = explode(";", $fp[$index]);
                                $increment = trim($arr_dato[0]);
                                $store_id = trim($arr_dato[1]);
                                $name = (trim($arr_dato[2]));
                                $nit = trim($arr_dato[3]);
                                $phone = trim($arr_dato[4]);
                                $email = (trim($arr_dato[5]));
                                $website = trim($arr_dato[6]);
                                $address = (trim($arr_dato[7]));
                                
                                $guarda = false;
                                if ($contador < 1000) {
                                    if ($index == $filas) {
                                        $guarda = true;
                                    }
                                    if ($store_id != "") {
                                        if ($arr_datos != "") {
                                            $arr_datos .= "|";
                                        }
                                        $arr_datos .= $increment.";".$store_id.";".$name.";".$nit.";".$phone.";".$email.";".$website.";".$address;
                                    }
                                } else {
                                    if ($arr_datos != "") {
                                        $arr_datos .= "|";
                                    }
                                        $arr_datos .= $increment.";".$store_id.";".$name.";".$nit.";".$phone.";".$email.";".$website.";".$address;
                                    $guarda = true;
                                }
            
                                if ($guarda) {
                                    $tmp_filas = count(explode("|", $arr_datos)); 
                                    
                                    $rta = $dbProgramita->insertStores(5, $arr_datos, $tmp_filas);

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
        case 3://Products
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
                        if ($columnas == 15) {
                            $increment = "";
                            $product_id = "";
                            $store_id = "";
                            $code = "";
                            $name = "";
                            $img = "";
                            $price = "";
                            $discount = "";
                            $tricoins = "";
                            $premium_discount = "";
                            $is_valid = "";
                            $is_digital = "";
                            $is_sustainable = "";
                            $is_recyclable = "";
                            $category_id = "";

                            $arr_dato = array();
                            for ($index = 1; $index <= $filas; $index++) {
                                $contador++;
                                $arr_dato = explode(";", $fp[$index]);
                                $increment = trim($arr_dato[0]);
                                
                                $product_id = trim($arr_dato[1]);
                                $store_id = (trim($arr_dato[2]));
                                $code = (trim($arr_dato[3]));
                                $name = trim($arr_dato[4]);
                                $img = trim($arr_dato[5]);
                                $price = (trim($arr_dato[6]));
                                $discount = trim($arr_dato[7]);
                                $tricoins = (trim($arr_dato[8]));
                                $premium_discount = (trim($arr_dato[9]));
                                $is_valid = trim($arr_dato[10]);
                                $is_digital = trim($arr_dato[11]);
                                $is_sustainable = (trim($arr_dato[12]));
                                $is_recyclable = trim($arr_dato[13]);
                                $category_id = trim($arr_dato[14]);
                                                            
                                $guarda = false;
                                if ($contador < 1000) {
                                    if ($index == $filas) {
                                        $guarda = true;
                                    }
                                    if ($product_id != "") {
                                        if ($arr_datos != "") {
                                            $arr_datos .= "|";
                                        }
                                        $arr_datos .= $increment.";".$product_id.";".$store_id.";".$code.";".$name.";".$img.";".$price.";".$discount.";".$tricoins.
                                        ";".$premium_discount.";".$is_valid.";".$is_digital.";".$is_sustainable.";".$is_recyclable.";".$category_id;
                                    }
                                } else {
                                    if ($arr_datos != "") {
                                        $arr_datos .= "|";
                                    }
                                        $arr_datos .= $increment.";".$product_id.";".$store_id.";".$code.";".$name.";".$img.";".$price.";".$discount.";".$tricoins.
                                        ";".$premium_discount.";".$is_valid.";".$is_digital.";".$is_sustainable.";".$is_recyclable.";".$category_id;

                                    $guarda = true;
                                }
            
                                if ($guarda) {
                                    $tmp_filas = count(explode("|", $arr_datos)); 
                                    
                                    $rta = $dbProgramita->insertProducts(5, $arr_datos, $tmp_filas);

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

        case 4://Categories
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
                        if ($columnas == 2) {
                            $id = "";
                            $name = "";
                           
                            $arr_dato = array();
                            for ($index = 1; $index <= $filas; $index++) {
                                $contador++;
                                $arr_dato = explode(";", $fp[$index]);
                                $id = trim($arr_dato[0]);
                                $name = trim($arr_dato[1]);
                               
                                $guarda = false;
                                if ($contador < 1000) {
                                    if ($index == $filas) {
                                        $guarda = true;
                                    }
                                    if ($id != "") {
                                        if ($arr_datos != "") {
                                            $arr_datos .= "|";
                                        }
                                        $arr_datos .= $id.";".$name;
                                    }
                                } else {
                                    if ($arr_datos != "") {
                                        $arr_datos .= "|";
                                    }
                                        $arr_datos .= $id.";".$name;
                                    $guarda = true;
                                }
            
                                if ($guarda) {
                                    $tmp_filas = count(explode("|", $arr_datos)); 
                                    
                                    $rta = $dbProgramita->insertCategories(5, $arr_datos, $tmp_filas);

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

        case 5://Stocks
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
                        if ($columnas == 5) {
                            $id = "";
                            $product_id = "";
                            $product_stock = "";
                            $purchases = "";
                            $store_id = "";
                           
                            $arr_dato = array();
                            for ($index = 1; $index <= $filas; $index++) {
                                $contador++;
                                $arr_dato = explode(";", $fp[$index]);
                                $id = trim($arr_dato[0]);
                                $product_id = trim($arr_dato[1]);
                                $product_stock = trim($arr_dato[2]);
                                $purchases = trim($arr_dato[3]);
                                $store_id = trim($arr_dato[4]);
                               
                                $guarda = false;
                                if ($contador < 1000) {
                                    if ($index == $filas) {
                                        $guarda = true;
                                    }
                                    if ($id != "") {
                                        if ($arr_datos != "") {
                                            $arr_datos .= "|";
                                        }
                                        $arr_datos .= $id.";".$product_id.";".$product_stock.";".$purchases.";".$store_id;
                                    }
                                } else {
                                    if ($arr_datos != "") {
                                        $arr_datos .= "|";
                                    }
                                    $arr_datos .= $id.";".$product_id.";".$product_stock.";".$purchases.";".$store_id;
                                    $guarda = true;
                                }
            
                                if ($guarda) {
                                    $tmp_filas = count(explode("|", $arr_datos)); 
                                    
                                    $rta = $dbProgramita->insertCategories(5, $arr_datos, $tmp_filas);

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