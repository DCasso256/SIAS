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
$user = session_id();
$error = 0;

//---------------------CONEXION CON BASE DE DATOS MYSQL----------------
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);

//----------------------VARIABLE DE VALIDACIÓN DEL ENVIO DE DATOS-----------------------------
$valido = (filter_input(INPUT_POST, 'nomusr') != null && filter_input(INPUT_POST, 'ap_pat') != null && filter_input(INPUT_POST, 'ap_mat') != null && filter_input(INPUT_POST, 'correo') != null && filter_input(INPUT_POST, 'tipousr') != null && filter_input(INPUT_POST, 'company') != null);
$res = mysql_query("SELECT * FROM users WHERE id_user='$user'", $link);
$fetch = mysql_fetch_array($res);
$privilegio = $fetch['privilegios']; //---> privilegios del usuario para realizar ciertas acciones
//--------------------------ESCRITURA EN LA BASE DE DATOS Y CREACION DE DIRECTORIO---------------------------
if ($valido && $privilegio == 1) {
    $nombre = filter_input(INPUT_POST, 'nomusr');
    $apellido_p = filter_input(INPUT_POST, 'ap_pat');
    $apellido_m = filter_input(INPUT_POST, 'ap_mat');
    $compania = filter_input(INPUT_POST, 'company');
    $tipousr = filter_input(INPUT_POST, 'tipousr');
    $correo = filter_input(INPUT_POST, 'correo');
    //------------------------HACEMOS EL REGISTRO EN LA BASE DE DATOS DE MYSQL----------------------    

    $res1 = mysql_query("SELECT MAX(id_user) AS iduser FROM users");
    $iduser = 1;

    if ($res1) {
        $row = mysql_fetch_array($res1);
        if ($row['iduser'] != NULL) {
            $iduser = $row['iduser'] + 1;
        }
    }

    $rndstr1 = rand(1, 26);
    $rndstr2 = rand(1, 26);
    $prim = $caps[$rndstr1];
    $sec = "$lowcase[$rndstr2]_";
    $random = rand(12345, 98765);
    $password = "$prim$sec$random";

    $msgError = "";
    mysql_query("START TRANSACTION");
    $res2 = mysql_query("INSERT INTO users (id_user, privilegios, correo, password, name, apellido_paterno, apellido_materno, compania, puesto, area, extension) " .
            "VALUES ('$iduser', '$tipousr', '$correo', '$password','$nombre', '$apellido_p', '$apellido_m', '$compania', '', '', '');");
    $msgError = $msgError . mysql_error();
    $result = mysql_query("COMMIT;");

    if ($result && $res && $res1 && $res2) {
        $error = 1;
    } else {
        $error = 2;
        mysql_query("ROLLBACK;");
        return false;
    }
    //-----------------------------------------------------
} else if ($privilegio != 1) {
    ?>
    <script type="text/javascript">
        alert("Lo sentimos, no cuenta con los privilegios necesarios para realizar esta acción.");
        location.href = "inicio.php";
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registro</title>
        <meta charset="UTF-8">
        <link href="EstilosSias.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            function validRegistery() {
                nombre = document.getElementById("nomusr").value;
                ap_pat = document.getElementById("ap_pat").value;
                ap_mat = document.getElementById("ap_mat").value;
                tipousr = document.getElementById("tipousr").value;
                correo = document.getElementById("correo").value;
                compania = document.getElementById("company").value;

                if (nombre === "" || ap_pat === "" || ap_mat === "" || tipousr === "null" || correo === "" || compania === "") {
                    alert("Rellene por favor todos los campos del formulario.");
                    return false;
                }
                else {
                    return true;
                }
            }
        </script>
    </head>
    <body style="background-color: whitesmoke;">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <label style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</label>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta">REGISTRO DE USUARIO</div>

        <br/><br/><br/><br/><br/>
        <div align="center">
            <fieldset class="fieldsetForm"><legend><b>"Complete el siguiente formulario"</b></legend>
                <form action="" method="post" onsubmit="if (!validRegistery())
                            return false;">
                    <br/>
                    <table align="center">
                        <br/>
                        <tr>
                            <td><label>Nombre(s):</label></td>
                            <td><input type="text" size="30" name="nomusr" id="nomusr" required=""></td>
                        </tr>
                        <tr>
                            <td><label>Apellido Paterno:</label></td>
                            <td><input type="text" size="30" name="ap_pat" id="ap_pat" required=""></td>
                        </tr>
                        <tr>
                            <td><label>Apellido Materno:</label></td>
                            <td><input type="text" size="30" name="ap_mat" id="ap_mat" required=""></td>
                        </tr>
                        <tr>
                            <td><label>Tipo de usuario:</label></td><td><select name="tipousr" id="tipousr">
                                    <option value="null" selected="" disabled="" hidden="">Seleccionar</option>
                                    <option value="1">Jefatura</option>
                                    <option value="0">Línea Operativa</option>
                                    <option value="2">Línea de Mando</option>
                                </select> </td>
                        </tr>
                        <tr>
                            <td><label>Correo:</label></td>
                            <td><input type="email" size="30" name="correo" id="correo" required=""></td>
                        </tr>
                        <tr>
                            <td><label>Compa&ntilde;&iacute;a:</label></td>
                            <td><input type="text" size="30" name="company" id="company" required=""></td>
                        </tr>
                    </table>
                    <br/>
                    <div align="center">
                        <input type="submit" value="Confirmar registro">&nbsp;&nbsp;&nbsp;
                        <input type="reset" value="Limpiar campos">
                    </div></form>
                <br/>
            </fieldset>
        </div>
        <br/><br/><br/>
        <div align="center" style="clear:both; font: 14pt sans-serif; color: slategray;">            
<?php
if ($error == 1) {
    echo "<script type='text/javascript'>alert('Gracias, hemos recibido sus datos. La contraseña del nuevo usuario es: ", "$password", "');</script>";
    echo "¡OPERACIÓN EXITOSA!";
} else if ($error == 2) {
    echo "Ha ocurrido algo, no se pudo completar el registro.";
    showMYSQLError();
}
?>
        </div>
        <br/><br/>
        <div class="footer2">&REG;PEMEX - Exploraci&oacute;n y Producci&oacute;n - 2016&nbsp;&nbsp;</div>
    </body>
</html>