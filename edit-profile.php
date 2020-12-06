<?php
session_id();
session_start();
$user = session_id();
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);

if (strlen(session_id()) > 6) {
    ?>
    <script type="text/javascript">
        alert("Inicie sesión para ingresar al sistema.");
        location.href = "iniciar-sesion.php";
    </script>
    <?php
}

$result = mysql_query("SELECT * FROM users WHERE id_user='$user';", $link);
$user_data = mysql_fetch_array($result);

$sent = (filter_input(INPUT_POST, 'nombre') != null && filter_input(INPUT_POST, 'ap_pat') != null && filter_input(INPUT_POST, 'ap_mat') != null && filter_input(INPUT_POST, 'correo') != null);

if ($sent) {
    $nombre = filter_input(INPUT_POST, 'nombre');
    $ap_pat = filter_input(INPUT_POST, 'ap_pat');
    $ap_mat = filter_input(INPUT_POST, 'ap_mat');
    $correo = filter_input(INPUT_POST, 'correo');
    $compania = filter_input(INPUT_POST, 'compania');
    $puesto = filter_input(INPUT_POST, 'puesto');
    $area = filter_input(INPUT_POST, 'area');
    $extension = filter_input(INPUT_POST, 'extension');
    $nomarch = $_FILES['foto']['name'];
    $tipo = $_FILES['foto']['type'];
    $tamanio = $_FILES['foto']['size'];
    $src = $_FILES['foto']['tmp_name'];
    $arherror = $_FILES['foto']['error'];
    $destino = "users/" . $nomarch;

    $msgError = "";
    mysql_query("START TRANSACTION");
    $res = mysql_query("UPDATE users SET name='$nombre', apellido_paterno='$ap_pat', apellido_materno='$ap_mat', correo='$correo', compania='$compania', puesto='$puesto', area='$area', extension='$extension' WHERE id_user='$user'");
    $msgError = $msgError . mysql_error();
    $res1 = mysql_query("COMMIT;");

    if ($res && $res1) {
        if ($nomarch != null) {
            copy($src, $destino);
            mysql_query("START TRANSACTION");
            mysql_query("UPDATE users SET profile_pic='$nomarch' WHERE id_user='$user'");
            mysql_query("COMMIT;");
        }
        ?>        
        <script type="text/javascript">
            alert("Gracias, por actualizar sus datos.");
            window.close();
        </script>
        <?php
    } else {
        echo $msgError;
        echo $arherror;
        mysql_query("ROLLBACK;");
        showMYSQLError();
        return false;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit-profile</title>
        <link rel="stylesheet" href="EstilosSias.css" type="text/css">
        <script type="text/javascript">
            function validEdit() {
                nombre = document.getElementById('nombre').value;
                ap_pat = document.getElementById('ap_pat').value;
                ap_mat = document.getElementById('ap_mat').value;
                correo = document.getElementById('correo').value;
                password = document.getElementById('con_act').value;
                nu_pass = document.getElementById('con_nu').value;
                rnu_pass = document.getElementById('rcon_nu').value;

                if (nombre === "" || ap_pat === "" || ap_mat === "" || correo === "") {
                    alert("No puede dejar vacios los campos siguientes: NOMBRE, APELLIDO PATERNO, APELLIDO MATERNO, CORREO.");
                    return false;
                }
                if (password === "" || nu_pass === "" || rnu_pass === "") {
                    alert("No puede dejar campos vacíos.");
                    return false;
                }
                if (nu_pass !== rnu_pass) {
                    alert("La nueva contraseña no coincide, asegurese se repetirla en ambos campos.");
                    return false;
                }
                else {
                    return true;
                }
            }
            function passEdit() {
                document.getElementById("con_nu").type = "password";
            }
        </script>
    </head>
    <body>
        <div style="text-align: center; background-color:silver; color:#0066cc; font: bold  12pt sans-serif;line-height: 2em;">
            <label>Editar informaci&oacute;n</label>
        </div>
        <br/><br/><br/>
        <div align="center">
            <fieldset style="background-color: honeydew; font:11pt sans-serif; width: 400px">
                <form method="post" action="" onsubmit="if (!validEdit())
                            return false;" enctype="multipart/form-data">
                    <table style="text-align: left; float: left; line-height: 2em">
                            <tr>
                                <td><label><b>Imagen de perfil:</b></label></td>
                                <td><input type="file" name="foto" id="foto"></td>
                            </tr>
                            <tr>
                                <td><label><b>Nombre(s):</b></label></td>
                                <td><input type="text" size="30" name="nombre" id="nombre" value="<?php echo $user_data['name']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label><b>Apellido paterno:</b></label></td>
                                <td><input type="text" size="30" name="ap_pat" id="ap_pat" value="<?php echo $user_data['apellido_paterno']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label><b>Apellido materno:</b></label></td>
                                <td><input type="text" size="30" name="ap_mat" id="ap_mat" value="<?php echo $user_data['apellido_materno']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label><b>Correo:</b></label></td>
                                <td><input type="text" size="30" name="correo" id="correo" value="<?php echo $user_data['correo']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label><b>Compa&ntilde;ia:&nbsp;</b></label></td>
                                <td><input type="text" size="30" name="compania" id="compania" value="<?php echo $user_data['compania']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label><b>Puesto:</b></label></td>
                                <td><input type="text" size="30" name="puesto" id="puesto" value="<?php echo $user_data['puesto']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label><b>&Aacute;rea:</b></label></td>
                                <td><input type="text" size="30" name="area" id="area" value="<?php echo $user_data['area']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label><b>Extensi&oacute;n:</b></label></td>
                                <td><input type="text" size="30" name="extension" id="extension" value="<?php echo $user_data['extension']; ?>"></td>
                            </tr>
                    </table>
                    <br/><br/>
                    <div style="clear:both">
                        <br/> 
                        <input type="submit" value="Actualizar datos">
                        <input style="margin-left: 15px" type="reset" value="Restablecer campos">
                    </div>                    
                </form>
            </fieldset>
        </div>
        <br/><br/><br/>
        <div class="footer2"><label>&REG;PEMEX - Exploraci&oacute;n y Producci&oacute;n - 2016&nbsp;&nbsp;</label></div>
    </body>
</html>
