<?php
session_id();
session_start();
$lista = null;
$listb = null;
$listc = null;
$listd = null;
$directorio = opendir("files/");

$cpt = filter_input(INPUT_GET, 'cpt');
$cpt2 = filter_input(INPUT_GET, 'cpt2');
$cpt3 = filter_input(INPUT_GET, 'cpt3');

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

//Muestra los archivos que contienen , las carpetas de las plataformas
if ($cpt3) {
    $arch = opendir("files/$cpt/$cpt2/$cpt3/");
    while ($f4 = readdir($arch)) {
        if ($f4 != "." && $f4 != "..") {
            if (is_dir("files/$cpt/$cpt2/$cpt3/" . $f4)) {
                $listd .= "<li><img src='imagenes/iconos/yellowfolder-icon.png' width='25px' height='25px'>&nbsp;"
                        . "<a style='text-decoration:none' href='consulta.php'>$f4</a></li><hr/>";
            } else {
                $res = mysql_query("SELECT * FROM files WHERE file_name LIKE '$f4'", $link);
                $array = mysql_fetch_array($res);
                $autor = $array['autor'];
                $tamanio = $array['tamanio_mb'];
                $listd .= "<li><img src='imagenes/iconos/document-icon.png' width='25px' height='25px'>&nbsp;"
                        . "<a style='text-decoration:none' href='files/$cpt/$cpt2/$cpt3/$f4'>$f4</a><label style='margin-top: 10px; font: 8pt sans-serif; float: right; '>"
                        . "$tamanio MB / Subido por: $autor</label></li><hr/>";
            }
        }
    }
}

//Muestra las carpetas de las plataformas
if ($cpt && $cpt2 && !$cpt3) {
    $platf = opendir("files/$cpt/$cpt2/");
    while ($f3 = readdir($platf)) {
        if ($f3 != "." && $f3 != "..") {
            if (is_dir("files/$cpt/$cpt2/" . $f3)) {
                $listc .= "<li><img src='imagenes/iconos/yellowfolder-icon.png' width='25px' height='25px'>&nbsp;<a style='text-decoration:none' href='consulta.php?cpt3=$f3&cpt2=$cpt2&cpt=$cpt' target=''>$f3</a></li><hr/>";
            } else {
                $listc .= "<li><img src='imagenes/iconos/document-icon.png' width='25px' heigth='25px'>&nbsp;<a style='text-decoration:none' href='files/$cpt/$cpt2/$f3' target='_blank'>$f3</a></li><hr/>";
            }
        }
        if ($cpt3) {
            break;
        }
    }
}

//Muestra las carpetas elemento del subsistema seleccionado
if ($cpt && !$cpt2) {
    $subdir = opendir("files/$cpt/");
    closedir($directorio);
    while ($f2 = readdir($subdir)) {
        if ($f2 != "." && $f2 != "..") {
            if (is_dir("files/$cpt/" . $f2)) {
                $listb .= "<li><img src='imagenes/iconos/yellowfolder-icon.png' width='25px' height='25px'>&nbsp;<a style='text-decoration:none' href='consulta.php?cpt2=$f2&cpt=$cpt' target=''>$f2</a></li><hr/>";
            } else {
                $listb .= "<li><img src='imagenes/iconos/document-icon.png' width='25px' height='25px'>&nbsp;<a style='text-decoration:none' href='files/$cpt/$f2' target='_blank'>$f2</a></li><hr/>";
            }
        }
        if ($cpt2) {
            closedir($subdir);
            break;
        }
    }
}

// Muestra las carpetas iniciales de los subsistemas
if (!$cpt && !$cpt2 && !$cpt3) {
    while ($f1 = readdir($directorio)) {
        if ($f1 != "." && $f1 != "..") {
            if (is_dir("files/" . $f1)) {
                $lista .= "<li><img src='imagenes/iconos/yellowfolder-icon.png' width='25px' height='25px'>&nbsp;<a style='text-decoration:none' href='consulta.php?cpt=$f1' target=''>$f1</a></li><hr/>";
            } else {
                $lista .= "<li><img src='imagenes/iconos/document-icon.png' width='25px' height='25px'>&nbsp;<a style='text-decoration:none' href='files/$f1' target='_blank'>$f1</a></li><hr/>";
            }
        }
        if ($cpt) {
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Consulta</title>
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function retroceso() {
                history.go(-1);
            }
        </script>        
    </head>
    <body style="background-color: whitesmoke;">
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <label style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</label>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <div class="etiqueta">CONSULTA</div>
        <br/><br/>
        <div align="center">
            <label style="font: bold 12pt sans-serif">
                <?php
                if (!$cpt2 && $cpt) {
                    echo "<button style='background-color: heneydew; margin-right: 2em' onclick='retroceso();'><img src='imagenes/iconos/back-icon.png' style='width: 17px; height: 17px'></button><label>", $cpt, "</label>";
                } else if ($cpt2 && !$cpt3) {
                    echo "<button style='background-color: heneydew; margin-right: 2em' onclick='retroceso();'><img src='imagenes/iconos/back-icon.png' style='width: 17px; height: 17px'></button><label>", $cpt2, "</label>";
                } else if ($cpt3) {
                    echo "<button style='background-color: heneydew; margin-right: 2em' onclick='retroceso();'><img src='imagenes/iconos/back-icon.png' style='width: 17px; height: 17px'></button><label>", $cpt3, "</label>";
                }
                ?></label>
            <div align="left" style="background-color: honeydew; font: 11pt sans-serif">
                <ul>
                <?php
                if (!$cpt) {
                    echo "$lista";
                } else if ($cpt && !$cpt2) {
                    echo "$listb";
                } else if ($cpt2 && !$cpt3) {
                    echo "$listc";
                } else if ($cpt3) {
                    echo "$listd";
                }
                ?>
                </ul>
            </div>
        </div>
        <br/><br/>
        <div class="footer2">&REG;PEMEX - Exploración y Producción - 2016&nbsp;&nbsp;</div>
    </body>
</html>
