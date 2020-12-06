<?php
session_id();
session_start();

if (strlen(session_id()) > 6) {
    ?>
    <script type="text/javascript">
        alert("Inicie sesión para ingresar al sistema.");
        location.href = "iniciar-sesion.php";
    </script>
    <?php
}

include_once 'funciones/common.php';
include_once 'funciones/arrays.php';
$error = 0;
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);

//--------------------------ASIGNACION DEL VALOR DEL SUBSISTEMA POR URL-----------------------------------------------
$sub = filter_input(INPUT_GET, 'sub');
$subsistema = "";
$id_user = session_id();
$res = mysql_query("SELECT * FROM users WHERE id_user='$id_user'", $link);
$array = mysql_fetch_array($res);

switch ($sub) {
    case 1:
        $subsistema = "SASP";
        break;
    case 2:
        $subsistema = "SAST";
        break;
    case 3:
        $subsistema = "SAA";
        break;
    case 4:
        $subsistema = "12MPI";
        break;
    default:
        $subsistema = "";
        break;
}

//--------------------------SUBIDA DEL ARCHIVO SELECCIONADO---------------------------------------------------------       

if (filter_input(INPUT_POST, "upload")) {
    
    $path = filter_input(INPUT_POST, 'nomplat');
    $elemento = filter_input(INPUT_POST, 'elemento');
    $doctype = filter_input(INPUT_POST, 'doctype');
    $autor = $array['name'] . " " . $array['apellido_paterno'] . " " . $array['apellido_materno'];
    $file_post = $_FILES;
    if($path == "N/A"){
        $path = filter_input(INPUT_POST,"doctype");
    }
        
    if ($_FILES['userfile']) {
        $file_ary = reArrayFiles($_FILES['userfile']);

        foreach ($file_ary as $file) {

            if ($file['error'] == 0) {
                $nomarch = $file['name'];
                $tipo = explode(".", $nomarch)[1];
                $tamanio = $file['size'] / 1048576;
                $src = $file['tmp_name'];
                $destino = "files/$subsistema/$elemento/$path/" . $nomarch; 
                
                                
                //-------Registro en la base de datos--------
                $sql = "SELECT MAX(id_files) AS idfiles FROM files";
                $res = mysql_query($sql);
                $idfiles = 1;

                if ($res) {
                    $row = mysql_fetch_array($res);
                    if ($row['idfiles'] != NULL) {
                        $idfiles = $row['idfiles'] + 1;
                    }
                }
                
                if ($path == filter_input(INPUT_POST, "doctype")){
                    $idplataforma = "0";
                    if ($path == "Formato"){
                        $destino = "formatos/" . $nomarch;
                        $elemento = "formato";
                    }
                    else{
                        $destino = "guias/$subsistema/" . $nomarch;
                        $elemento = "guia";
                    }
                }
                else{
                    $res1 = mysql_query("SELECT * FROM plataforma WHERE nombre LIKE '$path'", $link);
                    $fetch = mysql_fetch_array($res1);
                    $idplataforma = $fetch['id_plataforma'];
                }
                
                $msgError = "";
                mysql_query("START TRANSACTION");
                $res2 = mysql_query("INSERT INTO files (id_files, id_plataforma, file_name, autor, ext, tamanio_mb, elemento, subsistema) " .
                        "VALUES ('$idfiles', '$idplataforma','$nomarch', '$autor', '$tipo', '$tamanio', '$elemento', '$subsistema');");
                $msgError = $msgError . mysql_error();
                $result = mysql_query("COMMIT;");

                if ($result && $res && $res2) {
                    if(copy($src, $destino)){
                    $error = 1;
                    }
                }
                else{
                    $error = 3;
                    ?><script type="text/javascript">
                        alert("<?php echo $msgError;?>");
                    </script><?php
                    mysql_query("ROLLBACK;");
                    showMYSQLError();
                }
            } else {
                $error = 2;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SIAS</title>
        <link href="EstilosSias.css" rel="stylesheet" type="text/css" />
        <script src="upload.js" type="text/javascript"></script>
    </head>
    <body style="background-color: whitesmoke;">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <label style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</label>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta">SUBIR UN ARCHIVO A <?php echo"$subsistema"; ?></div>
        <br/><br/><br/><br/><br/>
        <div align="center">
            <fieldset class="fieldsetForm"><legend><b>"Completa el siguiente formulario"</b></legend> 
                <form method="post" action="" enctype="multipart/form-data" onsubmit="if (!validateForm())
                            return false;">
                    <table id="tabla" align="center">
                        <br/>
                        <tr>
                            <td><label>Elemento:</label></td>
                            <td><select id="elemento" name="elemento">
                                    <option value="null" disabled="" selected="" hidden="">Seleccionar</option>
                                    <option>Todos</option>
                                                                        <?php
                                    if (!empty($sub)) {
                                        switch ($sub) {
                                            case 1:
                                                foreach ($sasp as $option) {
                                                    echo "<option>", $option, "</option>";
                                                }
                                                break;
                                            case 2:
                                                foreach ($sast as $option) {
                                                    echo "<option>", $option, "</option>";
                                                }
                                                break;
                                            case 3:
                                                foreach ($saa as $option) {
                                                    echo "<option>", $option, "</option>";
                                                }
                                                break;
                                            case 4:
                                                foreach ($mpi as $option) {
                                                    echo "<option>", $option, "</option>";
                                                }
                                            default:
                                                break;
                                        }
                                    }
                                    ?>    
                                </select></td>
                        </tr>
                        <tr>
                            <td><label>Plataforma:</label></td>
                            <td><select id="carpeta" name="nomplat" required="" onchange="docType();">
                                    <option value="null" selected="" disabled="" hidden="">Seleccionar</option>
                                    <option>N/A</option>
                                    <?php
                                    $consulta = mysql_query("SELECT * FROM plataforma", $link);
                                    while ($plataforma = mysql_fetch_row($consulta)) {
                                        echo "<option>", $plataforma[2], "</option>";
                                    }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label>Tipo de documento:</label></td>
                            <td><select disabled="" id="doctype" name="doctype">
                                    <option value="null" selected="" disabled="" hidden="">Seleccionar</option>
                                    <option>Gu&iacute;a o Manual</option>
                                    <option>Formato</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label>Archivo:</label></td>
                            <td><input name="userfile[]" id="archivo" type="file" style="margin-right: 10px;">
                                <a id="boton" title="Agregar otro archivo" class="addInput" onclick="newInput()" onmousedown="mouseDown()" onmouseup="mouseUp()">+</a></td>
                        </tr>
                    </table>
                    <br/><br/>
                    <label style="font-size:10pt"><b>Tama&ntilde;o m&aacute;ximo de subida total 50MB.</b></label>
                    <br/><br/>
                    <input name="upload" value="Subir archivo(s)" type="submit">&nbsp;&nbsp;&nbsp;
                    <input name="clear" value="Cancelar" type="reset">
                </form>
            </fieldset>
        </div>
        <br/><br/><br/>
        <div align="center" style="clear:both; font: 14pt sans-serif; color: slategray;">
            <?php
            switch ($error) {
                case 1:
                    ?>
                    <script type="text/javascript">
                        alert("Gracias, hemos recibido sus datos.");
                    </script>
                    <?php
                    echo "¡ARCHIVO(S) CARGADO EXITOSAMENTE!";
                    break;
                case 2:
                    echo "¡ERROR AL CARGAR EL ARCHIVO!";
                    break;
                case 3:
                    echo "¡REGISTRO ERRONEO EN BASE DE DATOS";
                    break;
                default:
                    break;
            }
            ?>
        </div>
        <br/><br/>
        <div class="footer2">&REG;PEMEX - Exploración y Producción - 2016&nbsp;&nbsp;</div>
    </body>
</html>
