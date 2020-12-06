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
include_once 'funciones/arrays.php';   //---------------> ARRAYS PARA SUBCARPETAS
$user = session_id();
$error = true;

//---------------------CONEXION CON BASE DE DATOS MYSQL----------------
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);

//----------------------VARIABLE DE VALIDACIÓN DEL ENVIO DE DATOS-----------------------------
$valido = (null !== filter_input(INPUT_POST, 'nomplat') && null !== filter_input(INPUT_POST, 'tipo') && null !== filter_input(INPUT_POST, 'interv') && null !== filter_input(INPUT_POST, 'company') && null !== filter_input(INPUT_POST, 'modalidad'));
// --------------Con esto se obtiene el id del usuario----------    
$res = mysql_query("SELECT * FROM users WHERE id_user='$user'", $link);
$fetch = mysql_fetch_array($res);
$iduser = $fetch['id_user']; //---> id de usuario 
//--------------------------ESCRITURA EN LA BASE DE DATOS Y CREACION DE DIRECTORIO---------------------------
if ($valido && $fetch['privilegios'] == 1) {
    $nombre = filter_input(INPUT_POST, 'nomplat');
    $tipo = filter_input(INPUT_POST, 'tipo');
    $modalidad = filter_input(INPUT_POST, 'modalidad');
    $compania = filter_input(INPUT_POST, 'company');
    $intervencion = filter_input(INPUT_POST, 'interv');

    //------------------------HACEMOS EL REGISTRO EN LA BASE DE DATOS DE MYSQL----------------------    

    $res1 = mysql_query("SELECT MAX(id_plataforma) AS idplataforma FROM plataforma");
    $idplataforma = 1;

    if ($res1) {
        $row = mysql_fetch_array($res1);
        if ($row['idplataforma'] != NULL) {
            $idplataforma = $row['idplataforma'] + 1;
        }
    }

    $msgError = "";
    mysql_query("START TRANSACTION");
    $res2 = mysql_query("INSERT INTO plataforma (id_plataforma, id_user, nombre, tipo, intervencion, compania, modalidad) " .
            "VALUES ('$idplataforma', '$iduser', '$nombre', '$tipo', '$intervencion', '$compania', '$modalidad');");
    $msgError = $msgError . mysql_error();
    $result = mysql_query("COMMIT;");

    //--------------------------------CREAMOS SUBDIRECTORIOS DE LAS PLATAFORMAS----------------------------------
    if ($result && $res && $res1 && $res2) {
        $error = false;

        foreach ($sasp as $folders) {
            $dirmake = mkdir("files/SASP/$folders/" . $nombre, 0777);
        }
        foreach ($sast as $folders) {
            $dirmake = mkdir("files/SAST/$folders/" . $nombre, 0777);
        }
        foreach ($saa as $folders) {
            $dirmake = mkdir("files/SAA/$folders/" . $nombre, 0777);
        }
        foreach ($mpi as $folders) {
            $dirmake = mkdir("files/12MPI/$folders/" . $nombre, 0777);
        }
        ?>
        <script type="text/javascript">
            alert("Gracias, hemos recibido sus datos.");
        </script>
        <?php
    } else {
        echo "Ha ocurrido algo, no se pudo completar el registro.";
        echo $msgError;
        mysql_query("ROLLBACK;");
        showMYSQLError();
        return false;
    }
    //-----------------------------------------------------
} else if ($fetch['privilegios'] != 1) {
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
                nombre = document.getElementById("nomplat").value;
                tipo = document.getElementById("tipo").value;
                intervencion = document.getElementById("interv").value;
                compania = document.getElementById("company").value;
                modalidad = document.getElementById("modalidad").value;

                if (nombre === "" || tipo === "null" || intervencion === "null" || compania === "" || modalidad === "null") {
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
        <div class="etiqueta">NUEVO REGISTRO</div>
        <br/><br/><br/><br/><br/>
        <div align="center">
            <fieldset class="fieldsetForm"><legend><b>"Complete el siguiente formulario"</b></legend>
                <form action="" method="post" onsubmit="if (!validRegistery())
                            return false;">
                    <br/>
                    <label style="color:red"><b>AVISO: Consulte el sistema antes de realizar el registro, para evitar duplicados.</b></label>
                    <br/><br/>
                    <table align="center">
                        <br/>
                        <tr>
                            <td><label>Nombre de la plataforma:</label></td>
                            <td><input type="text" size="30" name="nomplat" id="nomplat" required=""></td>
                        </tr>
                        <tr>
                            <td><label>Tipo de instalaci&oacute;n:</label></td><td><select name="tipo" id="tipo">
                                    <option value="null" selected="" disabled="" hidden="">Seleccionar</option>
                                    <option>Auto-elevable</option>
                                    <option>Modular</option>
                                    <option>Fija</option>
                                </select> </td>
                        </tr>
                        <tr>
                            <td><label>Tipo de intervenci&oacute;n:</label></td><td><select name="interv" id="interv">
                                    <option value="null" selected="" disabled="" hidden="">Seleccionar</option>
                                    <option>N/A</option>
                                    <option>Reparaci&oacute;n menor</option>
                                    <option>Reparaci&oacute;n mayor</option>
                                    <option>Exploraci&oacute;n</option>
                                    <option>Terminaci&oacute;n</option>
                                </select> </td>
                        </tr>
                        <tr>
                            <td><label>Compa&ntilde;&iacute;a:</label></td>
                            <td><input type="text" size="30" name="company" id="company" required=""></td>
                        </tr>
                        <tr>
                            <td><label>Modalidad:</label></td><td><select name="modalidad" id="modalidad">
                                    <option value="null" selected="" disabled="" hidden="">Seleccionar</option>
                                    <option>REMI</option>
                                    <option>REMI-MIXTO</option>
                                    <option>ADMIN</option>                               
                                </select></td>
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
if ($error == false) {
    echo "¡OPERACIÓN EXITOSA!";
}
?>
        </div>
        <br/><br/>
        <div class="footer2">&REG;PEMEX - Exploraci&oacute;n y Producci&oacute;n - 2016&nbsp;&nbsp;</div>
    </body>
</html>