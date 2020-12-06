<?php
session_id();
session_start();

if (strlen(session_id()) > 6){?>
<script type="text/javascript">
    alert("Inicie sesión para ingresar al sistema.");
    location.href="iniciar-sesion.php";
</script>
<?php    
}

include_once 'funciones/common.php';
$valido = (filter_input(INPUT_POST,'nomplat') != null && filter_input(INPUT_POST,'password') != null);
$error = 0;
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);
$user = session_id();
$directorio = filter_input(INPUT_POST, 'nomplat');
$r = mysql_query("SELECT * FROM users WHERE id_user='$user'", $link);
$priv = mysql_fetch_array($r);
$r2 = mysql_query("SELECT * FROM plataforma WHERE nombre='$directorio'", $link);
$iduser_plat = mysql_fetch_array($r2);

//-----------INICIAR FUNCIONES PARA ELIMINAR REGISTRO DEL GESTOR DE ARCHIVOS------------------
if ($valido && $priv['privilegios'] == 1 && $iduser_plat[1] == $user) {
    $c1 = 1;        //Este contador delimita el numero de archivos y de veces que se repetira el ciclo for
    $c2 = 1;        //Define el numero de iteraciones para eliminar todos los registros de la BD

    if ($priv['password'] == filter_input(INPUT_POST, 'password')) {
        
        $pdir = mysql_query("SELECT * FROM plataforma WHERE nombre='$directorio'", $link);
        $prow = mysql_fetch_array($pdir);
        $idplat = $prow['id_plataforma'];    //Recogemos el id de la plataforma-pk

        if ($prow == false){
            ?>
        <script type="text/javascript">
            alert("El registro que desea eliminar no existe, revise los datos del formulario e intentelo nuevamente.");
            location.href="eliminar-registro.php";
        </script>
        <?php
            exit;
        }
        //-----------------ELIMINAR REGISTRO DE LA BASE DE DATOS----------------------------
        //Tenemos que eliminar tanto de la tabla plataforma como de la de files para quitar por completo los registros
        //para  que se ejecute correctamente debemos tener identificadores en ambas tablas, en este caso de manera provisional "nomplat"
        //-----------------Listamos y eliminamos todos los archivos de las carpetas coincidentes con la ruta----------------------
        foreach (glob("files/*/*/$directorio/*.*") as $files) {
            if (is_file($files)) {
                unlink($files);
                $c1 ++;
            }
        }
        //-----------------Listamos y eliminamos cada carpeta coincidente con la ruta--------------------
        foreach (glob("files/12MPI/*/$directorio/") as $carpeta) {
            if (is_dir($carpeta)) {
                rmdir($carpeta);
            }
        }
        foreach (glob("files/SASP/*/$directorio/") as $carpeta) {
            if (is_dir($carpeta)) {
                rmdir($carpeta);
            }
        }
        foreach (glob("files/SAST/*/$directorio/") as $carpeta) {
            if (is_dir($carpeta)) {
                rmdir($carpeta);
            }
        }
        foreach (glob("files/SAA/*/$directorio/") as $carpeta) {
            if (is_dir($carpeta)) {
                rmdir($carpeta);
            }
        }
            
        for ($c2 = 1; $c2 <= $c1; $c2 ++) {
            $consult = mysql_query("SELECT * FROM files WHERE id_plataforma='$idplat'", $link); //recogemos el registro de archivos
            $frow = mysql_fetch_array($consult);
            $idfiles = $frow['id_files'];
            $msgError = "";
            mysql_query("START TRANSACTION");
            $res = mysql_query("DELETE FROM files WHERE id_files='$idfiles'");
            $msgError = $msgError . mysql_error();
            $result = mysql_query("COMMIT;");
            if ($consult && !$result) {
                echo $msgError;
                showMYSQLError();
                mysql_query("ROLLBACK;");
                $error = 2;
                break 2;
            }
            if ($c2 == $c1) {
                $msgError = "";
                mysql_query("START TRANSACTION");
                $res1 = mysql_query("DELETE FROM plataforma WHERE id_plataforma='$idplat'");
                $msgError = $msgError . mysql_error();
                $result1 = mysql_query("COMMIT;");
                if ($result1) {
                    $error = 1;
                } else if (!$result1) {
                    echo $msgError;
                    showMYSQLError();
                    mysql_query("ROLLBACK;");
                    $error = 2;
                    break 3;
                }
            }
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("La contraseña que ha proporcionado es incorrecta, intentelo nuevamente.");
        </script>
        <?php
    }
} else if ($priv['privilegios'] != 1) {
    ?>
        <script type="text/javascript">
            alert("Lo sentimos, no cuenta con los privilegios necesarios para realizar esta acción.\n\
                Es posible que el registro no le corresponda, o bien, que su cuenta no esté autorizada para modificar registros.");
            location.href="inicio.php";
        </script>
    <?php
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Eliminar registro</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function validateForm() {
                nombre = document.getElementById("carpeta").value;
                contrasena = document.getElementById("password").value;

                if (nombre === "null" || contrasena === "") {
                    alert("Debe rellenar todos los campos del formulario.");
                    return false;
                }
                else {
                    return true;
                }
            }
            function confirmDelete() {
                aprobar = confirm("Si elimina el registro se borraran todos los archivos y la carpeta relacionada directamente a esta plataforma.\n\
                \n\¿Desea continuar con la operación?");
                if (aprobar === false) {
                    return false;
                }
                else {
                    return true;
                }
            }
        </script>
    </head>
    <body style="background: lavender">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <a style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</a>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta">ELIMINAR REGISTRO</div>
        <br/><br/>
        <br/><br/><br/>
        <div align="center">
            <fieldset class="fieldsetForm"><legend><b>"Complete el siguiente formulario"</b></legend>
                <form action="" method="post" onsubmit="if (!confirmDelete())
                                    return false;">
                    <table align="center">
                        <br/>
                        <tr>
                            <td><label>Nombre de la instalaci&oacute;n:</label></td>
                            <td><select  id="carpeta" name="nomplat" required="">
                                    <option value="null" selected="" disabled="" hidden="">Seleccionar</option>
                                    <?php
                                        $consulta = mysql_query("SELECT * FROM plataforma", $link);
                                        while($plataforma = mysql_fetch_row($consulta)){
                                            echo "<option>",$plataforma[2],"</option>";
                                        }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label>Contrase&ntilde;a:</label></td><td><input id="password" name="password" type="password" required=""></td>
                        </tr>
                    </table>
                    <br/>
                    <div align="center">
                        <input type="submit" value="Eliminar" onclick="if (!validateForm())
                                    return false;" name="eliminar">&nbsp;&nbsp;&nbsp;
                        <input type="reset" value="Cancelar" name="cancelar">
                    </div></form>
                <br/>
            </fieldset>
        </div>
        <br/><br/><br/>
        <div align="center" style="clear:both; font: 14pt sans-serif; color: slategray;">
            <?php
            if ($error == 1) {
                echo "¡OPERACIÓN EXITOSA!";
            }
            if ($error == 2) {
                showMYSQLError();
                echo "El registro especificado no existe, contacte al administrador del sitio para resolver este problema.";
            }
            ?>
        </div>        
        <div class="footer2">&REG;PEMEX - Exploración y Producción - 2016&nbsp;&nbsp;</div>
    </body>
</html>
