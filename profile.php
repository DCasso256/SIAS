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
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);

$user = session_id();
$delete = filter_input(INPUT_GET, 'del');
$file = filter_input(INPUT_GET, 'file');
$result = mysql_query("SELECT * FROM users WHERE id_user='$user';", $link);
$perdat = mysql_fetch_array($result);
$nombre = "$perdat[4] $perdat[5] $perdat[6]";

if ($delete && $file) {
    ?>
    <script type=text/javascript>
        function supr() {
            del = confirm("Si elimina este archivo no podrá recuperarlo.\n\¿Desea continuar con esta acción?");

            if (del === true) {
                return true;
            }
            else {
                location.href = 'profile.php';
            }
        }
        supr();
    </script>
    <?php
    $res = mysql_query("SELECT * FROM files WHERE file_name='$file' AND autor='$nombre'", $link);
    $array = mysql_fetch_array($res);
    $id_file = $array['id_files'];
    $sub = $array['subsistema'];
    $elemento = $array['elemento'];
    $idplat = $array['id_plataforma'];
    $array2 = mysql_fetch_array(mysql_query("SELECT * FROM plataforma WHERE id_plataforma='$idplat'", $link));
    $plataforma = $array2['nombre'];
    $filepath = "files/$sub/$elemento/$plataforma/$file";
    
    if ($idplat == "0"){
        if ($elemento == "fomato"){
            $filepath = "formato/$file";
        }
        else{
            $filepath = "guias/$file";
        }
    }

    $msgError = "";
    mysql_query("START TRANSACTION");
    $res1 = mysql_query("DELETE FROM files WHERE id_files='$id_file'");
    $msgError = $msgError . mysql_error();
    $result = mysql_query("COMMIT;");

    if ($result && $res1) {
        if (unlink($filepath)) {
            ?><script type=text/javascript>
                          location.href = "profile.php";
                          alert("Archivo eliminado con exito!");
            </script><?php
        } else {
            ?><script type=text/javascript>alert("Lo sentimos, el archivo no pudo ser eliminado.");</script><?php
            mysql_query("ROLLBACK;");
            echo $msgError;
        }
    } else {
        mysql_query("ROLLBACK;");
        echo $msgError;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mi Perfil</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="EstilosSias.css" type="text/css">
        <script src="profile.js" type="text/javascript"></script>
    </head>
    <body style="background-color: whitesmoke;">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <label style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</label>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta"><label>MI PERFIL</label></div>
        <br/><br/><br/><br/><br/>
        <div>
            <fieldset style="background-color: honeydew; font:11pt sans-serif; width:550px; float:left; margin-left: 6em">
                <div style="float:left">
                    <?php echo "<img src='users/", $perdat['profile_pic'], " 'style='margin:1em; width:130px; height:130px; float:left'>"; ?>
                    <br/>
                </div>
                <div style="float:left">
                    <table style="text-align: left; float: left; line-height: 2em">
                        <tr>
                            <td><label><b>Nombre:</b></label></td>
                            <?php echo "<td><label>", $perdat['name'], "&nbsp;", $perdat['apellido_paterno'], "&nbsp;", $perdat['apellido_materno'], "</label></td>"; ?>

                        </tr>
                        <tr>
                            <td><label><b>Correo:</b></label></td>
                            <?php echo "<td><label>", $perdat['correo'], "</label></td>"; ?>
                        </tr>
                        <tr>
                            <td><label><b>Compa&ntilde;ia:&nbsp;</b></label></td>
                            <?php echo "<td><label>", $perdat['compania'], "</label></td>"; ?>
                        </tr>
                        <tr>
                            <td><label><b>Puesto:</b></label></td>
                            <?php echo"<td><label>", $perdat['puesto'], "</label></td>"; ?>
                        </tr>
                        <tr>
                            <td><label><b>&Aacute;rea:</b></label></td>
                            <?php echo "<td><label>", $perdat['area'], "</label></td>" ?>
                        </tr>
                        <tr>
                            <td><label><b>Extensi&oacute;n:</b></label></td>
                            <?php echo "<td><label>", $perdat['extension'], "</label></td>" ?>
                        </tr>
                    </table>
                </div>
                <div style="font: 8pt sans-serif; position: relative; left: 5em">
                    <ul style="list-style: none">
                        <li>
                            <button onclick="menu();"><img src="imagenes/iconos/config-icon.ico" style="width: 20px; height: 20px"></button>
                            <ul id="option" style="display:none; position: absolute; right:5em; list-style: none; color: #555555">
                                <li style="background-color: #dfdfdf; font-size: 9pt; padding:10px 10px;"><a style="color: #555555; text-decoration:none" href="#" onclick="editInfo();">Editar informaci&oacute;n</a></li>
                                <li style="background-color: #dfdfdf; font-size: 9pt; padding:10px 10px;"><a style="color: #555555; text-decoration:none" href="#" onclick="editPassword();">Cambiar contrase&ntilde;a</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </fieldset>
            <div style="float: left; max-height: 400px; border:gray solid thin; margin-left: 6em; overflow: hidden">
                <div style="background-color: darkcyan; color: white; font: bold 11pt sans-serif; line-height: 2em; text-align: center;">
                    <label>Archivos recientes</label>
                </div>
                <div style="max-height: 350px; overflow-y: scroll;" >
                <table style=" width: 400px; line-height: 1.5em; background: white">
                    <?php
                    $x = 1;
                    $res = mysql_query("SELECT * FROM files WHERE autor='$nombre' ORDER BY id_files DESC", $link);
                    while ($array = mysql_fetch_row($res)) {
                        $file_name = $array[2];                        
                        echo "<tr><td><a style='font: 10pt sans-serif; text-decoration: none; padding-left: 5px;'>$file_name</a><a id='delButton' href='profile.php?del=1&file=$file_name' style='display:none' class='delButton'>x</a></td><tr>";
                        if ($x < 10){
                            $x++;
                        }
                        else{
                            break;
                        }                        
                    }
                    ?>
                </table>
                </div>
                <div id="divDel" style="background: orangered; color:white; font:bolder 9pt sans-serif; text-align: center; cursor: pointer" onclick="stateToogle();">
                    <label  style="line-height: 1.3em" id="displayDel">Eliminar un archivo</label>
                </div>
            </div>
        </div>
        <br/><br/><br/>
        <br/><br/>
        <div class="footer2"><label>&REG;PEMEX - Exploraci&oacute;n y Producci&oacute;n - 2016&nbsp;&nbsp;</label></div>
    </body>
</html>
