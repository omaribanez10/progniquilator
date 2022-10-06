const cargarArchivo = () => {
  
    if ($("#archivo").val() == "") {
      alert("Debe seleccionar un archivo.");    
    }else{
        $("#frm_cargar_archivo").validate({
            rules: {
                archivo: { required: true, }
            },
            submitHandler: function () {
                var params = "opcion=1";
                llamarAjaxUploadFiles("./programita_ajax.php", params, "contenedor", "continuarCargarArchivo()", "d_barra_progreso_adj", "archivo");
            },
        });  
    }

}

const continuarCargarArchivo = () =>{
    let respuesta = document.getElementById('hdd_rta_carga').value
    if(parseInt(respuesta) === 1){
        let archivo = document.getElementById('hdd_archivo').value
        var params = "opcion=3&archivo=" + archivo;
        llamarAjax("./programita_ajax.php", params, "contenedor", "validarCargarArchivo()");
    }
}

const validarCargarArchivo = () =>{
   let rta_importacion =  $("#hdd_rta_import").val();
   switch(parseInt(rta_importacion)){
        case 1:
            alert("Se han importado los datos correctamente.");
        break;
        case -5:
            alert("El archivo no tiene el número de columnas válidas o no tiene el formato válido.");
        break;
        case 0:
            alert("El archivo está vacío.");
        break;
        case -1:
            alert("Error interno al guardar los datos");
        break;
        default:
            alert("Error en el dato " + rta_importacion);
            break;

   }
   
}