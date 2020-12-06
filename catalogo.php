<?php
session_id();
session_start();

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
$s = filter_input(INPUT_GET, "s");
$count = 0;
$id = 1;
$nxt = 2;
$prev = 0;
$consult = mysql_query("SELECT * FROM plataforma", $link);
while ($res = mysql_fetch_row($consult)) {
    $count++;
}

if ($s) {
    $id = $s;
    $nxt = $id + 1;
    $prev = $id - 1;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Catalogo</title>
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
    </head>
    <body style="background-color: whitesmoke;">
        <div class="modal" id="modal" style="display:none">
            <div style="overflow-y:scroll;">
                <label style="padding-right: 2em;">Archivos</label><label onclick="document.getElementById('modal').style.display ='none';">X</label>
                <table style="background-color: #555555; color: #fff; font:bold 11pt sans-serif; width:100%; padding: 2em; max-height:316px; height:100%;">
                    <?php
                    $res = mysql_query("SELECT * FROM files WHERE id_plataforma='$id'");
                    while ($array = mysql_fetch_array($res)) {
                        echo "<tr><td><a title='", $array[2], "'>", $array[2], "</a></td><td style='text-align: right;'>", $array[5], " MB</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <input type="hidden" id="vurl" value="<?php echo $s; ?>">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <label style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</label>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta"><label>CAT&Aacute;LOGO</label></div>
        <br/><br/><br/>
        <div align="center">
            <a style="background-color: #555555; color:#fff; text-decoration:none; padding:7px 7px; float:left; font: 12pt sans-serif; margin-left: 15px" id="prev">
                Anterior</a>
            <script type="text/javascript">
                function previousSlide() {
                    anchor1 = document.getElementById('prev');
                    value = document.getElementById('vurl').value;

                    if (<?php echo $prev; ?> === 0) {
                        anchor1.removeAttribute('href');
                        anchor1.style.opacity = "0.6";
                    } else {
                        anchor1.href = "catalogo.php?s=<?php echo $prev; ?>";
                        anchor1.style.opacity = "1";
                    }
                }
                previousSlide();
            </script>
            <a style="float: right; background-color: #555555; color:#fff; text-decoration:none; padding:7px 7px; font: 12pt sans-serif; margin-right: 15px" id="nxt">Siguiente</a>
            <script type="text/javascript">
                function nextSlide() {
                    anchor2 = document.getElementById('nxt');
                    value = document.getElementById('vurl').value;

                    if (value >= <?php echo $count; ?>) {
                        anchor2.removeAttribute('href');
                        anchor2.style.opacity = "0.6";
                    } else {
                        anchor2.href = "catalogo.php?s=<?php echo $nxt; ?>";
                        anchor2.style.opacity = "1";
                    }
                }
                nextSlide();
            </script>
            <fieldset style="background-color: honeydew; font:11pt sans-serif; width:550px; ">
                <img src="imagenes/ejemplo-catalogo.png" style="width: 550px; height: 400px;">
                <div onclick="document.getElementById('modal').style.display='block';" style="text-align: left; cursor: pointer; background-color: black; color: white; position: absolute; bottom: 90px; opacity: 0.8; z-index: 1">
                    <table title="Ver expediente">
<?php
$result = mysql_query("SELECT * FROM plataforma WHERE id_plataforma='$id'");

while ($array = mysql_fetch_array($result)) {
    echo "<tr><td style='font: 18pt sans-serif'>", $array[2], "</td></tr><tr><td>Tipo: ", $array[3], "</td></tr><tr><td>Intervención: ", $array[4], "</td></tr><tr><td>Empresa: ", $array[5], "</td></tr><tr><td>Modalidad: ", $array[6], "</td></tr>";
}
?>
                    </table>
                </div>
            </fieldset>

        </div>        
        <br/><br/><br/>
        <div class="footer2"><label>&REG;PEMEX - Exploraci&oacute;n y Producci&oacute;n - 2016&nbsp;&nbsp;</label></div>
    </body>
</html>
