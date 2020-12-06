<?php
session_id();
session_start();

include_once 'funciones/common.php';
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);
$list = null;
$lista = null;
$listb = null;
$listc = null;
$listd = null;
$folder1 = opendir("guias/12MPI/");
$folder2 = opendir("guias/SAST/");
$folder3 = opendir("guias/SASP/");
$folder4 = opendir("guias/SAA/");
$path = opendir("formatos/");

if (strlen(session_id()) > 6){?>
<script type="text/javascript">
    alert("Inicie sesión para ingresar al sistema.");
    location.href="iniciar-sesion.php";
</script>
<?php    
}

while ($f1 = readdir($path)) {
    if ($f1 != "." && $f1 != "..") {
        $list .= "<li style='padding: 4px'><img src='imagenes/iconos/document-icon.png' width='17px' height='20px'>&nbsp;<a href='formatos/$f1' target='_blank'>$f1</a></li>";
    }
}
while ($f2 = readdir($folder1)) {
    if ($f2 != "." && $f2 != "..") {
        $lista .= "<li style='padding: 4px'><img src='imagenes/iconos/document-icon.png' width='17px' height='20px'>&nbsp;<a href='guias/12MPI/$f2' target='_blank'>$f2</a></li>";
    }
}
while ($f3 = readdir($folder2)) {
    if ($f3 != "." && $f3 != "..") {
        $listb .= "<li style='padding: 4px'><img src='imagenes/iconos/document-icon.png' width='17px' height='20px'>&nbsp;<a href='guias/SAST/$f3' target='_blank'>$f3</a></li>";
    }
}
while ($f4 = readdir($folder3)) {
    if ($f4 != "." && $f4 != "..") {
        $listc .= "<li style='padding: 4px'><img src='imagenes/iconos/document-icon.png' width='17px' height='20px'>&nbsp;<a href='guias/SASP/$f4' target='_blank'>$f4</a></li>";
    }
}
while ($f5 = readdir($folder4)) {
    if ($f5 != "." && $f5 != "..") {
        $listd .= "<li style='padding: 4px'><img src='imagenes/iconos/document-icon.png' width='17px' height='20px'>&nbsp;<a href='guias/SAA/$f5' target='_blank'>$f5</a></li>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Gu&iacute;as y Formatos</title>
        <link rel="stylesheet" href="EstilosSias.css" type="text/css">
    </head>
    <body style="background: lavender">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <a style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</a>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta">GU&Iacute;AS Y FORMATOS</div>
        <br/><br/>
        <div align="center">
        <div style="float:left; width:400px; margin-left: 240px">
            <div align="center" style="background-color: darkcyan; color: white; font:11pt sans-serif; line-height: 2em;">
                <label><b>Gu&iacute;as</b></label>
            </div>
            <fieldset style="font:10pt sans-serif; text-align: left; background-color: whitesmoke; border: gray solid thin; height: 400px; overflow-y: scroll;">
                <p>
                <ul>
                    <label style="padding: 4px; background-color: red; font:bold 14pt sans-serif; color:white;">12 Mejores Pr&aacute;cticas Internacionales</label>
                    <?php echo $lista; ?>
                    <li style="padding: 4px; background-color: gray; font:bold 14pt sans-serif; color:white;">Administraci&oacute;n de la Salud en el Trabajo</li>
                    <?php echo $listb; ?>
                    <li style="padding: 4px; background-color: dodgerblue; font:bold 14pt sans-serif; color:white;">Administraci&oacute;n de la Seguridad en los Procesos</li>
                    <?php echo $listc; ?>
                    <li style="padding: 4px; background-color: green; font:bold 14pt sans-serif; color:white;">Administraci&oacute;n Ambiental</li>
                    <?php echo $listd; ?>
                </ul>
                </p><br/>

                <br/><br/>
            </fieldset>
        </div>
        <div style="float:left; width:400px; margin-left: 50px">
            <div align="center" style="background-color: darkcyan; color: white; font:11pt sans-serif; line-height: 2em;">
                <label><b>Formatos</b></label>
            </div>
            <fieldset style="font:10pt sans-serif; text-align: left; background-color: whitesmoke; border: gray solid thin; height: 400px; overflow-y: scroll;">
                <p>
                <ul>
                    <?php echo $list; ?>
                </ul>
                </p><br/>

                <br/><br/>
            </fieldset>
        </div>
        </div>
        <?php closedir($folder1);closedir($folder2);closedir($folder3);closedir($folder4);closedir($path);?>
        <br/><br/><br/>      
        <div class="footer2">&REG;PEMEX - Exploración y Producción - 2016&nbsp;&nbsp;</div>
    </body>
</html>
