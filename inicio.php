<?php
//---------------SE INICIA SESION Y SE ASIGNA COMO ID EL NOMBRE DE USUARIO-----------------
if (filter_input(INPUT_POST, "user") == null) {
    session_id();
} else {
    $user = filter_input(INPUT_POST, "user");
    $link = mysql_connect("127.0.0.1", "root");
    mysql_select_db("pemex-sias", $link);
    $array = mysql_query("SELECT * FROM users WHERE correo ='$user'", $link);
    $user_data = mysql_fetch_array($array);
    $id_user = $user_data['id_user'];
    session_id($id_user);
}
session_start();

if (strlen(session_id()) > 6) {
    ?>
    <script type="text/javascript">
        alert("Inicie sesión para ingresar al sistema.");
        location.href = "iniciar-sesion.php";
    </script>
    <?php
}

include 'funciones/common.php';
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);
$user = session_id();
$usuario = filter_input(INPUT_POST, "user");
$pass = filter_input(INPUT_POST, "password");
$valido = ($usuario != null && $pass != null);
$array = mysql_query("SELECT * FROM users WHERE id_user='$user'", $link);
$user_data = mysql_fetch_array($array);
$name = $user_data['name'];

if ($valido) {

    $result = mysql_query("SELECT * FROM users WHERE correo = '$usuario' AND password = '$pass'", $link);

    if ($result) {
        if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_array($result);
            $_SESSION['id_user'] = $row['id_user'];
        } else {
            ?>
            <script type="text/javascript">
                alert("Nombre de usuario o contraseña incorrecta.");
                location.href = "iniciar-sesion.php";
            </script> 
            <?php
        }
    } else {
        showMYSQLError();
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inicio</title>
        <meta charset="UTF-8">
        <script src="SpryAccordion.js" type="text/javascript"></script>
        <script src="frontPages.js" type="text/javascript"></script>
        <link href="SpryAccordion.css" rel="stylesheet" type="text/css">
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <link href="MenuUsuario.css" rel="stylesheet" type="text/css">
    </head>
    <body onload="clock()">
        <div class="modal" id="modal" style="display:none">
            <div>
                <label onclick="modal();">X</label>
                <iframe id="video" src=""></iframe>
            </div>
        </div>
        <div align="center" class="header" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <label style="color: #555555">M&Oacute;DULO INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SISTEMA SSPA</label>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>        
        <div align="center" style=" width:1349px; height: 1370px;  background-image: url('imagenes/bg-white.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="header2">
                <ul class="nav">
                    <li><a href="inicio.php"><b>Inicio</b></a></li>
                    <li><a><b>Usuarios</b></a>
                        <ul>
                            <li><a href="registro-usuario.php">Registrar usuario</a></li>
                            <li><a href="directorio.php">Directorio</a></li>
                            <li><a href="eliminar-usuario.php">Eliminar usuario</a></li>
                        </ul>
                    </li>
                    <li><a><b>Plataformas</b></a>
                        <ul>
                            <li><a href="registro-plataforma.php">Registrar equipo</a></li>
                            <li><a href="catalogo.php">Cat&aacute;logo</a></li>
                            <li><a href="eliminar-registro.php">Eliminar registro</a></li>
                        </ul>
                    </li>
                    <li><a><b>Archivos</b></a>
                        <ul>
                            <li><a>Subir archivo</a>
                                <ul>
                                    <li><a href="upload.php?sub=1">SASP</a></li>
                                    <li><a href="upload.php?sub=2">SAST</a></li>
                                    <li><a href="upload.php?sub=3">SAA</a></li>
                                    <li><a href="upload.php?sub=4">12 MPI</a></li>
                                </ul>
                            </li>
                            <li><a href="consulta.php">Explorador</a></li>
                        </ul>
                    </li>
                    <li><a href="download.php"><b>Gu&iacute;as y Formatos</b></a></li>
                    <li><a>-</a></li>
                    <li><a style="color: #2accae;"><b>Bienvenido: <?php echo $name; ?></b></a>
                        <ul>
                            <li><a href="profile.php">Mi perfil</a></li>
                            <li><a style="cursor: pointer" onclick="confirmar();">Cerrar sesi&oacute;n</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <br/><br/>
            <div align="center" style="width: 1250px">
                <hr/>
                <div style=" position: absolute; top: 20em; z-index: 1">
                    <table style="background-color: black; opacity: 0.7; float: left">
                        <tr>
                            <td style="border-right: silver thin solid; color: silver"><label style="font: bold 25pt sans-serif; padding: 5px 5px">Bienvenido al</label>
                                <br/><label style="font: bold 41pt sans-serif; padding: 5px 5px">MIDAS</label></td>
                            <td style="font:19pt sans-serif; color: silver; text-align: left"><p style="padding: 5px 5px">Conoce m&aacute;s del nuevo m&oacute;dulo<br/> electr&oacute;nico para el respaldo
                                    y <br/>administraci&oacute;n de evidencias <br/>del SSPA.</p></td>
                        </tr>
                    </table>
                </div>
                <div align="center" style="position: relative;">
                    <div id="slideShowImages">
                        <img src="imagenes/cabecera/barco-pemex.jpg" alt="Slide 1" />
                        <img src="imagenes/cabecera/sasp-t2.jpg" alt="Slide 2" />
                        <img src="imagenes/cabecera/saa-t1.gif" alt="Slide 3" />
                        <img src="imagenes/cabecera/servicio.jpg" alt="Slide 4" />
                        <img src="imagenes/cabecera/sast-t1.png" alt="Slide 5" />
                    </div>
                    <script src="slideShow.js"></script>
                </div><hr/>
            </div>            
            <div class="contenido">
                <div class="anuncios">
                    <div>
                        <label style="padding-left: 1em"><b>Anuncios</b></label>
                    </div>
                    <ul>
                        <li style="padding-left:5px">&nbsp;<label><b>Anuncio</b></label></li>
                        <li class="enlace">&nbsp;<a><b>>Enlace 1</b></a></li>
                        <li class="enlace">&nbsp;<a><b>>Enlace 2</b></a></li>
                        <li class="enlace">&nbsp;<a><b>>Enlace 3</b></a></li>
                        <li class="enlace">&nbsp;<a><b>>Enlace 4</b></a></li>
                    </ul>
                </div>
                <div class="videos">
                    <div>
                        <label style="padding-left: 1em" value="" id="selection"><b>Videos</b></label>
                    </div>
                    <ul>
                        <li style="padding-left: 5px">&nbsp;
                            <a><b>>Plataformas de Pemex - Reportaje</b></a><br/>
                            <img src="imagenes/posters/reportaje.jpg" class="imgVideo" title="Ver video" onclick="watchVideo(); document.getElementById('selection').value='1'; selectVideo();">
                        </li>
                        <li class="enlace">&nbsp;
                            <a><b>>Visita y recorrido por la plataforma Yunuen</b></a><br/>
                            <img src="imagenes/posters/visita.jpg" class="imgVideo" title="Ver video" onclick="watchVideo(); document.getElementById('selection').value='2'; selectVideo();">
                        </li>
                        <li class="enlace">&nbsp;
                            <a><b>>Logros de Pemex</b></a><br/>
                            <img src="imagenes/posters/logros.jpg" class="imgVideo" title="Ver video" onclick="watchVideo(); document.getElementById('selection').value='3'; selectVideo();">
                        </li>
                        <li class="enlace">&nbsp;
                            <a><b>>Proyectos de inversi&oacute;n de Pemex</b></a><br/>
                            <img src="imagenes/posters/inversion.jpg" class="imgVideo" title="Ver video" onclick="watchVideo(); document.getElementById('selection').value='4'; selectVideo();">
                        </li>
                        <li class="enlace">&nbsp;
                            <a><b>>Pemex Exploraci&oacute;n y Producci&oacute;n</b></a><br/>
                            <img src="imagenes/posters/exploracion.jpg" class="imgVideo" title="Ver video" onclick="watchVideo(); document.getElementById('selection').value='5'; selectVideo();">
                        </li>
                        <li class="enlace">&nbsp;
                            <a><b>>Cuidando tu seguridad</b></a><br/>
                            <img src="imagenes/posters/panchito.jpg" class="imgVideo" title="Ver video" onclick="watchVideo(); document.getElementById('selection').value='6'; selectVideo();">
                        </li>
                    </ul>
                </div>
            </div>           

            <div style="float:left; margin-bottom:20px; margin-top: 50px; margin-left: 30px; margin-right: 30px;">
                <div align="center" style="background-color: darkcyan; color: white; font:11pt sans-serif; line-height: 2em;">
                    <label><b>¿Qu&eacute; es MIDAS?</b></label>
                </div>
                <fieldset class="fieldsetInfo">
                    <p  style="padding: 15px 17px;">
                        MIDAS SSPA es el portal con el cual se administran las evidencias generadas a partir del cumplimiento de los 
                        requisitos y lineamientos del sistema PEMEX-SSPA, en este m&oacute;dulo los coordinadores podrán registrar las diferentes
                        plataformas a su cargo y a su vez subir los archivos que evidencien el cumplimiento del sistema SSPA. El módulo genera una estructura
                        organizada de los datos para permitir consultas más eficientes a trav&eacute;s del navegador de archivos, localizado en el menu
                        lateral del usuario. Adicionalmente, se encuentra disponible información relevante de los 4 subsistemas con la opci&oacute;n de 
                        visualizar y descargar formatos correspondientes a los mismos y al Manual del Sistema SSPA, si tienes problemas con el funcionamiento
                        de este modulo, utilice los enlaces al final de esta página.

                    </p><br/>
                    <div align="center" style="background-color: darkcyan; color: white; font: oblique sans-serif">
                        <label><b>Seguridad, Salud y Protecci&oacute;n Ambiental</b></label>
                    </div>
                    <p style="padding: 15px 17px;">El sistema PEMEX-SSPA tiene como finalidad guiar a la empresa hacia una mejora continua en 
                        su desempeño en materia de Seguridad, Salud en el Trabajo y Protección Ambiental, mediante 
                        la administración de los riesgos de sus operaciones y/o procesos productivos, a través de 
                        la implantación de los elementos que lo componen y la interrelación entre ellos, actuando 
                        como herramienta de apoyo al proceso homologado y mejorado de Seguridad, Salud en el Trabajo
                        y Protección Ambiental, consolidando así una cultura en la materia con énfasis en la prevención.</p>
                    <br/><br/>
                    <div align="center">
                        <img src="imagenes/macrosspa.png" width="400px" height="300px">
                    </div>
                    <br/><br/>
                </fieldset>
            </div>

            <div class="institucional">
                <ul>
                    <li style="background-color: darkcyan; font-size: 11pt; color: white; border-top-right-radius: 2em; text-align:center"><label style="padding-left: 1em"><b>Informaci&oacute;n institucional</b></label></li>
                    <li style="padding-left:5px">&nbsp;<a style="text-decoration: none" href="sasp.php"><b>> Administraci&oacute;n de la Seguridad en los Procesos</b></a></li>
                    <li class="enlace">&nbsp;<a href="sast.php"><b>> Administraci&oacute;n de la Salud en el Trabajo</b></a></li>
                    <li class="enlace">&nbsp;<a href="saa.php"><b>> Administraci&oacute;n Ambiental</b></a></li>
                    <li class="enlace">&nbsp;<a href="12mpi.php"><b>> 12 Mejores Pr&aacute;cticas Internacionales</b></a></li>
                </ul>
            </div>           
            <div class="utiles">
                <ul>
                    <li style="background-color: darkcyan; font-size: 11pt; color: white; border-top-right-radius: 2em; text-align:center"><label style="padding-left: 1em"><b>Enlaces &uacute;tiles</b></label></li>
                    <li style="padding-left:5px;">&nbsp;<a style="text-decoration: none;" href="http://www.pemex.com"><b>> Pemex.com</b></a></li>
                    <li class="enlace">&nbsp;<a href="http://www.pep.pemex.com"><b>> Pemex Exploraci&oacute;n y Producci&oacute;n</b></a></li>
                    <li class="enlace">&nbsp;<a><b>>Enlace 3</b></a></li>
                    <li class="enlace">&nbsp;<a><b>>Enlace 4</b></a></li>
                </ul>
            </div>
            <div style=" width: 250px; border: darkcyan solid medium; background-color: dodgerblue; text-align: center;float: left; margin-top: 30px; margin-left: 30px; margin-right: 30px; margin-bottom: 20px;">
                <label id="txt" style="font: bold 16pt monospace; color: white; padding: 3px;"></label><br/>
                <label style="font: bold 11pt sans-serif; color: white; padding: 3px;">Hora Centro UTC-6</label>
            </div>
            <div class="busqueda">
                <div style="background-color: darkcyan; font-size: 11pt; color: white; line-height: 2em;">
                    <label style="padding-left: 1em"><b>B&uacute;squeda</b></label>
                </div>
                <div style="padding-left: 1em; width: 500px">  
                    <br/><label>Localice documentos y publicaciones de manera m&aacute;s r&aacute;pida.</label><br/><br/>   
                    <form action="busqueda.php" method="post">
                        <table style="text-align:left">
                            <tr>
                                <td><input type="text" size="45" name="buscar" style="background-color: gainsboro;">&nbsp;&nbsp;</td>
                                <td><button type="submit" style="width: 32px; height: 31px"><img src="imagenes/iconos/search-icon.png" style="width: 25px; height: 25px"></button></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <br/>
            </div>
            <div class="contacto">
                <div style="background-color: black; opacity: 0.7; padding: 7px"><label style="font:bolder italic 22pt cursive; color: white;">Cont&aacute;ctanos</label><br/><label style="font: 13pt sans-serif; color: white"><b>contacto.<span style="color: darkcyan">eps</span>@pemex.com</b></label>
                    <br/><label style="font:13pt sans-serif; color: white"><b>Ext. 801-79514</b></label></div>
            </div>
            <br/><br/><br/><br/><br/><br/>
        </div> 
        <div class="footer">
            <div style="font: 10pt sans-serif; clear: both; background-color: lavender; text-align: center">
                <hr/><br/>
                <a href="#" onclick="openHelp();">Ayuda</a>&nbsp;|&nbsp;
                <a href="#" onclick="openFAQ();">FAQ</a>&nbsp;|&nbsp;
                <a href="#" onclick="openFeedback();">Sugerencias</a><br/><br/>
            </div>&REG;PEMEX - Exploración y Producción - 2016&nbsp;&nbsp;</div> 
    </body>
</html>