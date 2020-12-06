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
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);

$user = session_id();
$error = 0;
$motivo = "";
$show = "";
$msgError = "";
$mail = filter_input(INPUT_POST, 'search');
$password = filter_input(INPUT_POST, 'password');
$check = filter_input(INPUT_POST, 'check');
$other = filter_input(INPUT_POST, 'other');
$hidden = filter_input(INPUT_POST, 'hidden');
$valido = (filter_input(INPUT_POST, 'check') != null && filter_input(INPUT_POST, 'hidden') != null );
$search = mysql_query("SELECT * FROM users WHERE id_user='$user'", $link);
$ref = mysql_fetch_array($search);

switch ($check) {
    case 1:
        $motivo = "Cambio o relevo de funciones a otro usuario.";
        break;
    case 2:
        $motivo = "El usuario ha infringido las condiciones de uso.";
        break;
    case 3:
        $motivo = "El usuario ha quedado inactivo.";
        break;
    case 4:
        $motivo = "El registro de usuario se realizó por error o de manera erronea.";
        break;
    case 5:
        $motivo = "$other";
        break;
    default:
        $motivo = "";
        break;
}

if ($mail) {
    $result = mysql_query("SELECT * FROM users WHERE correo='$mail'", $link);
    $usuario = mysql_fetch_array($result);
    if ($usuario) {
        $show = true;
    } else {
        $error = 2;
    }
}

if ($valido && $ref['privilegios'] == 1) { 
    if ($ref['password'] == $password) {
             
        $res = mysql_query("SELECT * FROM users WHERE correo='$hidden'", $link);
        $array = mysql_fetch_array($res);
        $del_usr = $array['id_user'];
        $photo = $array['profile_pic'];
        //-----------------ELIMINAR REGISTRO DE LA BASE DE DATOS----------------------------
        //-----------------Listamos y eliminamos todos los archivos de las carpetas coincidentes con la ruta----------------------
        if ($array['profile_pic'] != "usericon.png"){
            foreach (glob("users/$photo") as $files) {
                if (is_file($files)) {
                    unlink($files);
                }
            }
        }
          
        mysql_query("START TRANSACTION");
        $res1 = mysql_query("DELETE FROM users WHERE id_user='$del_usr'");
        $msgError = $msgError . mysql_error();
        $result = mysql_query("COMMIT;");

        if ($result && $res1){
            $error = 1;
        }
        else {
            mysql_query("ROLLBACK;");
            echo $msgError;
            $error = 2;
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("La contraseña que ha proporcionado es incorrecta, intentelo nuevamente.");
        </script>
        <?php
    }
}  else if ($ref['privilegios'] == 0) {
  ?>
  <script type="text/javascript">
  alert("Lo sentimos, no cuenta con los privilegios necesarios para realizar esta acción.");
  location.href="inicio.php";
  </script>
  <?php
  } 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Eliminar registro</title>
        <meta charset="UTF-8">
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function validateForm() {
                check = document.getElementById("check").value; 
                otro = document.getElementById("otro").value;   
                password = document.getElementById("contrasena").value; 
                hidden = document.getElementById("hidden").value;   

                if (((check === 5 && otro === "") || check === null) || password === "" || hidden === ""){
                    alert("Debe rellenar todos los campos del formulario.");
                    return false;
                }
                else {
                    return true;
                }
            }
            function hideTextArea() {
                document.getElementById('otro').disabled = true;
            }
            function confirmDelete() {
                aprobar = confirm("La acción que esta a punto de realizar es irreversible.\n\
                \n\¿Desea continuar con la operación?");
                if (aprobar === false) {
                    return false;
                }
                else {
                    return true;
                }
            }
            function valueHidden(){
                this.form.hidden.value="<?php echo $usuario[0];?>";
            }
        </script>
    </head>
    <body style="background: lavender">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <a style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</a>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta">ELIMINAR USUARIO</div>
        <br/><br/>
        <div align="center" style="font: 12pt sans-serif">
            <form action="" method="post">
                <label><b>Introduzca el correo del usuario:</b></label>&nbsp;<input id="search" name="search"  placeholder="Introducir correo" type="text" size="30" required="">
                <input type="submit" value="Buscar">
            </form>
            <br/><br/>
            <?php
            if ($show == true){
            echo "<table style='border: gray solid thin; background-color: snow; font: 11pt sans-serif; min-width: 500px'><tr><td><b>Nombre</b></td><td><b>Correo</b></td><td><b>Compa&ntilde;ia</b></td></tr><tr><td>", $usuario['name'],"&nbsp;",$usuario['apellido_paterno'],"&nbsp;",$usuario['apellido_materno'],"</td><td>" ,$usuario['correo'],"</td><td>" ,$usuario['compania'],"</td></tr></table>";
            }
            ?>
        </div>
        <br/>
        <div align="center">
            <fieldset style="background-color: honeydew; font:11pt sans-serif; width:550px">
                <form action="" method="post" onsubmit="if (!validateForm())
                            return false;">
                    <label><b>Motivo de la baja</b></label>
                    <table style="text-align: left"><br/>
                        <tr>
                            <td>
                                <input type="radio" name="check" id="check" value="1" onchange="hideTextArea();">
                                <label style="font-size: 10pt">Cambio o relevo de funciones a otro usuario.</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="check" id="check" value="2" onchange="hideTextArea();">
                                <label style="font-size: 10pt">El usuario ha infringido las condiciones de uso.</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="check" id="check" value="3" onchange="hideTextArea();">
                                <label style="font-size: 10pt">El usuario ha quedado inactivo.</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="check" id="check" value="4" onchange="hideTextArea();">
                                <label style="font-size: 10pt">El registro de usuario se realiz&oacute; por error o de manera err&oacute;nea.</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="check" value="5" id="check" onchange="document.getElementById('otro').removeAttribute('disabled')">
                                <label style="font-size: 10pt">Otro. (Especif&iacute;que)</label><br/>
                                <textarea rows="4" cols="63" name="other" id="otro" disabled=""></textarea>
                            </td>
                        </tr>
                    </table>
                    <br/>
                    <label style="font: 10pt sans-serif">Contrase&ntilde;a: </label><input type="password" size="15" name="password" id="contrasena">
                    <br/><br/>
                    <div align="center" >
                        <input type="hidden" id="hidden"  name="hidden" value="<?php echo $usuario['correo']; ?>">
                        <input type="submit" value="Eliminar" onclick="if (!confirmDelete())
                                    return false;" name="eliminar">&nbsp;&nbsp;&nbsp;
                        <input type="reset" value="Cancelar" name="cancelar">
                    </div></form>
            </fieldset>
        </div>
        <br/><br/><br/>
        <div align="center" style="clear:both; font: 14pt sans-serif; color: slategray;">
            <?php
            switch ($error) {
                case 1:
                    echo "¡OPERACIÓN EXITOSA!";
                    break;
                case 2:
                    echo "El registro especificado no existe, verifique su información e intentelo nuevamente.";
                    echo $msgError;
                    break;
                default:
                    echo "";
                    break;
            }
            ?>
        </div><br/>        
        <div class="footer2">&REG;PEMEX - Exploración y Producción - 2016&nbsp;&nbsp;</div>
    </body>
</html>