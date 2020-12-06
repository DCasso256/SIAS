<?php
session_id();
session_start();

include_once 'funciones/common.php';
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);

if (strlen(session_id()) > 6){?>
<script type="text/javascript">
    alert("Inicie sesión para ingresar al sistema.");
    location.href="iniciar-sesion.php";
</script>
<?php    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Directorio</title>
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
    </head>
    <body style="background: lavender">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <a style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</a>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta">DIRECTORIO</div>
        <br/><br/><br/><br/>
        <div align="center">
            <fieldset style="background-color: honeydew; font:11pt sans-serif; width:850px">
                <table style="line-height: 2em ">
                    <tr style="background-color: dodgerblue; color: white; text-align:center;">
                        <td>Nombre</td><td>Cargo</td><td>&Aacute;rea</td><td>Correro</td><td>Extensi&oacute;n</td>
                    </tr>
                <?php
                    $res = mysql_query("SELECT * FROM users ORDER BY apellido_paterno ASC;", $link);
                    while($array = mysql_fetch_row($res)){
                        $nombre = $array[4];
                        $ap_pat = $array[5];
                        $ap_mat = $array[6];
                        $puesto = $array[8];
                        $area = $array[9];
                        $correo = $array[2];
                        $ext = $array[10];
                        
                        echo"<tr><td style='text-align: left'>",$ap_pat,"&nbsp;",$ap_mat,"&nbsp;",$nombre,"</td><td>",$puesto,"</td><td>",$area,"</td><td>",$correo,"</td><td>",$ext;
                    }
                ?>
                </table>
            </fieldset>
        </div>
        <div class="footer2">&REG;PEMEX - Exploración y Producción - 2016&nbsp;&nbsp;</div>
    </body>
</html>
