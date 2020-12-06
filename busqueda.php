<?php
session_id();
session_start();

$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);

$valid = filter_input(INPUT_POST, 'buscar') != null;
$field = "";

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
        <title>Resultado de la b&uacute;squeda</title>
        <link rel="stylesheet" href="EstilosSias.css" type="text/css">
    </head>
    <body style="background: lavender">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <a style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</a>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta">Resultados</div>
        <br/><br/>
        <div align="center">
            <fieldset style="background-color: honeydew; font:11pt sans-serif; width:750px; text-align: left;">
                    <table style="width: 100%">
                        
                        <?php
                        if ($valid) {
                            $buscar = filter_input(INPUT_POST, 'buscar');

                            $res = mysql_query("SELECT * FROM files WHERE file_name LIKE '%$buscar%'", $link);
                                                       
                            if ($res){
                                while($array = mysql_fetch_row($res)){
                                    $plataf = $array[1];
                                    $result = $array[2];
                                    $autor = $array[3];
                                    $sist = $array[7];
                                    $elmnt = $array[6];
                                    $res2 = mysql_query("SELECT * FROM plataforma WHERE id_plataforma=$plataf", $link);
                                    $ar = mysql_fetch_array($res2);
                                    $nomplat = $ar[2];
                                    if($elmnt == "guia"){
                                        echo "<tr style='line-height: 1.5em'><td><a title='$result' href='guias/$result'>$result</a></td><td><label style='font: 8pt sans-serif; color: inherit'>Subido por: $autor</label></td></tr>";
                                    }
                                    else if($elmnt == "formato"){
                                        echo "<tr style='line-height: 1.5em'><td><a title='$result' href='formatos/$result'>$result</a></td><td><label style='font: 8pt sans-serif; color: inherit'>Subido por: $autor</label></td></tr>";
                                    }
                                    else{
                                        echo "<tr style='line-height: 1.5em'><td><a title='$result' href='files/$sist/$elmnt/$nomplat/$result'>$result</a></td><td><label style='font: 8pt sans-serif; color: inherit'>Subido por: $autor</label></td></tr>";
                                    }
                                }
                            }
                            else{
                                echo "No se encontraron resultados coincidentes.";
                            }
                        }                        
                        ?>
                    </table>
            </fieldset>
        </div>
        <br/><br/><br/>      
        <div class="footer2">&REG;PEMEX - Exploración y Producción - 2016&nbsp;&nbsp;</div>
    </body>
</html>
