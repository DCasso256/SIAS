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

$user = $_SESSION['id_user'];
$sent = (filter_input(INPUT_POST, "asunto") != null && filter_input(INPUT_POST, "mensaje") != null);

if ($sent){
    $mensaje = filter_input(INPUT_POST, "mensaje");
    $asunto = filter_input(INPUT_POST, "asunto");
    $query = mysql_query("SELECT * FROM users WHERE id_user='$user';", $link);
    $array = mysql_fetch_array($query);
    $iduser = $array['correo'];
    
    $query2 = mysql_query("SELECT max(id_sugerencia) AS idsugerencia FROM sugerencias;", $link);
    $idsugerencia = 1;
    
    if($query2){
        $array2 = mysql_fetch_array($query2);
        if($array2['idsugerencia'] != null){
            $idsugerencia = $array2['idsugerencia'] + 1;
        }
    }
    
    $msgError = "";
    mysql_query("START TRANSACTION;");
    $result = mysql_query("INSERT INTO sugerencias (id_sugerencia, asunto, mensaje, usuario)".
            "VALUES ('$idsugerencia', '$asunto', '$mensaje', '$iduser');");
    $msgError = $msgError . mysql_error();
    $res = mysql_query("COMMIT;");
    
    if ($result && $res){?>
    <script type="text/javascript">
        alert("Gracias, hemos recibido sus datos.");
        window.close();
    </script>        
    <?php
    exit;
    }
    else{
        echo $msgError;
        showMYSQLError();
        mysql_query("ROLLBACK;");
    }    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sugerencias</title>
        <link rel="stylesheet" href="EstilosSias.css" type="text/css">
        <script type="text/javascript">
            function validar(){
                asunto = document.getElementById("asunto").value;
                mensaje = document.getElementById("mensaje").value;
                
                if(asunto === "null" || mensaje === ""){
                    alert("Por favor rellene todos los campos.");
                    return false;
                }
                else{
                    return true;
                }
            }
        </script>
    </head>
    <body style="background-color: whitesmoke;">
        <div class="etiqueta">Quejas y Sugerencias</div>

        <br/><br/>
        <div align="center"><label style="font: 16pt sans-serif; color: darkcyan"><b>Su opini&oacute;n es muy importante, agradecemos todos sus comentarios.</b></label></div>
        <br/><br/><br/>
        <div align="center">
            <fieldset class="fieldsetForm">
                <form action="" method="post" onsubmit="if (!validar())
                            return false;">
                    <br/>
                    <table align="center">
                        <br/>
                        <tr>
                            <td><label>Asunto:</label></td><td><select name="asunto" id="asunto">
                                    <option value="null" selected="" disabled="" hidden="">Seleccionar</option>
                                    <option>Aclaración</option>
                                    <option>Sugerencia</option>
                                    <option>Queja</option>
                                </select> </td>
                        </tr>
                        <tr>
                            <td><label>Mensaje:</label></td>
                            <td>
                                <textarea cols="30" rows="10" name="mensaje" id="mensaje" required="">M&aacute;ximo 300 caracteres.</textarea>
                            </td>
                        </tr>
                    </table>
                    <br/>
                    <div align="center">
                        <input type="submit" value="Enviar">&nbsp;&nbsp;&nbsp;
                        <input type="reset" value="Limpiar campos">
                    </div></form>
                <br/>
            </fieldset>
        </div>
        <br/><br/><br/><br/>
        <div class="footer2">&REG;PEMEX - Exploraci&oacute;n y Producci&oacute;n - 2016&nbsp;&nbsp;</div>
    </body>
</html>