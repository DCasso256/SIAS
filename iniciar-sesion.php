<?php
//Es necesario iniciar la sesión para después terminarla por completo
session_start();
//Ahora destruimos todas las variables de sesión
$_SESSION = array();
//Para destruir la sesión por completo debemos borrar también la cookie de sesion
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 4200, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
//Finalmente destruimos la sesión
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Iniciar sesi&oacute;n</title>
        <meta charset="UTF-8">
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function enviarFormulario() {
                user = document.getElementById("usr").value;
                password = document.getElementById("pass").value;
                error = false;

                if (user.length < 1) {
                    alert("Introduzca su correo");
                    error = true;
                }

                if (password.length < 1) {
                    alert("Introduzca contraseña");
                    error = true;
                }

                if (error)
                    return false;
                else
                    return true;
            }
        </script>
    </head>
    <body class="body">
        <div style="width:100%; height: 100%; background-image: url('imagenes/platinicioses.jpg'); background-repeat: no-repeat; 
             background-size: 100% 100%;">
            <div align="center" style ="opacity: 0.8; background-color: white; font: 20pt sans-serif; color: black; width: 100%;">
                <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
                <label style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</label>
                <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
            </div>

            <div align="center" style="font-family: sans-serif">
                <fieldset style="width: 50%; margin-top: 10%; background-color: whitesmoke; opacity: 0.8"><legend><b>Iniciar sesi&oacute;n</b></legend>
                    <form id="frmInicioSesion" onsubmit="if (!enviarFormulario())
                                return false;" action="inicio.php"  method="post">
                        <table>
                            <tr>
                                <td><label for="usr">Correo:</label></td>
                                <td><input name="user" id="usr" required=""></td>
                            </tr>

                            <tr>
                                <td><label for="pass">Contrase&ntilde;a:</label></td>
                                <td><input type="password" name="password" id="pass" required=""></td>
                            </tr>

                        </table>
                        <br/>
                        <div align="center">
                            <input type="submit" value="Entrar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="reset" value="Limpiar">
                        </div> </form>
                </fieldset>
            </div>
            <br/><br/>
            <div style="margin-top: 23.5em; position: relative; width: 100%; font: 8pt sans-serif; background-color: #555555; text-align: right;
                 clear: both; line-height: 2em;">
                &REG;PEMEX - Exploración y Producción - 2016&nbsp;&nbsp;
            </div>
        </div>
    </body>
</html>
