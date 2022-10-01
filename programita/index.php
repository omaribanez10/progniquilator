<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo("Programita"); ?></title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="./css/programita.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono&display=swap" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     
        <script type="text/javascript" src="./js/jquery-3.6.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="./js/ajax.js"></script>
        <script type="text/javascript" src="./js/programita_v1.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
       
    </head>
    <body>
    <?php     
        require_once("./BarraProgreso.php");
        $barra_progreso = new BarraProgreso();
    ?>
      	<main>
            <div class="caja-principal">
                <div id="contenedor"></div>
                <form id="frm_cargar_archivo" name="frm_cargar_archivo" method="post">
                    <table style="width:100%; margin: 0 auto;">
                        <tr>
                            <td>
                                <input class="form-control" type="file" id="archivo" name="archivo" accept=".csv" />
                            </td>                       
                        </tr>
                        <tr>
                            <td>
                                <input style="width:100%; margin-top:1vh; margin-bottom:1vh; background:#E09F3E !important;" type="submit" value="Subir .csv" onclick="cargarArchivo();" class="btn btn-warning"/>
                                <?php $barra_progreso->get("d_barra_progreso_adj", "100%", false, 0); ?>
                            </td>
                        </tr>
                    </table>
                </form>
            
            </div>
		</main>

    </body>
</html>
