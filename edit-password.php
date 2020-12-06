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

$sent = (filter_input(INPUT_POST, 'con_act') != null && filter_input(INPUT_POST, 'con_nu') != null && filter_input(INPUT_POST, 'rcon_nu') != null);

if ($sent) {
    $con_act = filter_input(INPUT_POST, 'con_act');
    $con_nu = filter_input(INPUT_POST, 'con_nu');

    if ($con_act == $user_data['password']) {
        $msgError = "";
        mysql_query("START TRANSACTION");
        $res = mysql_query("UPDATE users SET password='$con_nu' WHERE id_user='$user'");
        $msgError = $msgError . mysql_error();
        mysql_query("COMMIT;");
        if ($res) {
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
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar contrase&ntilde;a</title>
        <link rel="stylesheet" href="EstilosSias.css" type="text/css">
        <script type="text/javascript">
            function validEdit() {
                password = document.getElementById('con_act').value;
                nu_pass = document.getElementById('con_nu').value;
                rnu_pass = document.getElementById('rcon_nu').value;

                if (password === "" || nu_pass === "" || rnu_pass === "") {
                    alert("No puede dejar campos vacíos.");
                    return false;
                }
                if (nu_pass !== rnu_pass) {
                    alert("La nueva contraseña no coincide, asegurese de repetirla tal cual en ambos campos.");
                    return false;
                }
                else {
                    return true;
                }
            }
            function passEdit() {
                document.getElementById("con_nu").type = "password";
            }
            function passEdit2(){
                document.getElementById("rcon_nu").type = "password";
            }
        </script>
    </head>
    <body>
        <div style="text-align: center; background-color:silver; color:#0066cc; font: bold  12pt sans-serif;line-height: 2em;">
            <label>Cambiar contrase&ntilde;a</label>
        </div>
        <br/><br/><br/>
        <div align="center">
            <fieldset style="background-color: honeydew; font:11pt sans-serif; width: 400px">
                <form method="post" action="" onsubmit="if (!validEdit())
                            return false;" enctype="multipart/form-data">
                    <table style="text-align: left; float: left; line-height: 2em">
                            <tr>
                                <td><label><b>Contrase&ntilde;a actual:</b></label></td>
                                <td><input type="password" size="25" name="con_act" id="con_act"></td>
                            </tr>
                            <tr>
                                <td><label><b>Contrase&ntilde;a nueva:</b></label></td>
                                <td><input type="text" size="25" name="con_nu" id="con_nu" onchange="passEdit();"></td>
                            </tr>
                            <tr>
                                <td><label><b>Reescriba la nueva contrase&ntilde;a:</b></label></td>
                                <td><input type="text" size="25" name="rcon_nu" id="rcon_nu" onchange="passEdit2();"></td>
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
