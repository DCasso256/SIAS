<?php
$v = filter_input(INPUT_GET, "v");
$d = filter_input(INPUT_GET, "d");
$img = "";

if ($d == "nav"){
    $img = "<img src='imagenes/diagramas/navegacion.png' style='width: 900px; height: 500px'>";
}

if($d == "menu"){
    $img = "<img src='imagenes/diagramas/menu-plataformas.png' style='width: 1000px; height: 900px'>";
}

if($d == "file"){
    $img = "<img src='imagenes/diagramas/subir-archivo.png' style='width: 900px; height: 600px'>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ayuda</title>
        <link rel="stylesheet" href="EstilosSias.css" type="text/css">
        <script>
            function goBack(){
                history.go(-1);
            }
        </script>
    </head>
    <body align="center" style="background-color: #ebf5f6">
        <div style="text-align: center; background-color:silver; color:#0066cc; font: bold 16pt sans-serif; line-height: 2em;">
            <label>Ayuda</label>
        </div><br/><br/>
        <div style="text-align: center">
            <?php
            switch ($v){
                case "contact":
            ?>
            <button style="float:right; margin-right: 20px;" onclick="goBack();"><img src='imagenes/iconos/back-icon.png' style='width: 17px; height: 17px'></button>
                <label style="font: bold 20pt sans-serif; color: darkcyan">Contacto</label><br/><br/><br/>
                <label>Nombre:</label><input type="text" size="40" name="nombre"><br/><br/>
                <label>Correo:</label><input type="text" size="40" name="correo"><br/><br/>
                <label>Asunto:</label><input type="text" size="40" name="asunto"><br/><br/>
                <label>Mensaje:</label><textarea cols="35" rows="15" name="mensaje"></textarea><br/><br/>
                <input type="submit" value="Enviar"><br/>            
            <?php
                    break;
                case "usrmanual":
            ?>
            <div>
                <button style="float:right; margin-right: 20px;" onclick="goBack();"><img src='imagenes/iconos/back-icon.png' style='width: 17px; height: 17px'></button>
                <label style="font: bold 20pt sans-serif; color: darkcyan">Manual de usuario</label><br/><br/><br/>
                <div style="background-color: whitesmoke; height: 420px">
                <iframe src="guias/ASP 13 Manual de Integridad Mecanica y Aseguramiento de la Calidad IMAC.pdf" srcdoc="guias/ASP 13 Manual de Integridad Mecanica y Aseguramiento de la Calidad IMAC.pdf" sandbox="" style="width:50%; height:60%; min-height: 400px; z-index:-1">
                </iframe></div>
            </div>
            <?php
                    break;
                case "diagrams":           
            ?>
            <div>
                <button style="float:right; margin-right: 20px;" onclick="goBack();"><img src='imagenes/iconos/back-icon.png' style='width: 17px; height: 17px'></button>
                <label style="font: bold 20pt sans-serif; color: darkcyan">Diagramas de Actividad</label><br/><br/><div style="text-align: justify">
                <p>Bienvenido, puede utilizar la siguiente documentación para resolver las dudas que tenga con referencia 
                al uso del sistema. Seleccione a continuación para visualizar el diagrama correspondiente, maximice
                la ventana para apreciar mejor la imagen.</p><br/>
                <ul><li><a href="ayuda.php?v=diagrams&d=nav">Navegación general</a></li><br/><li><a href="ayuda.php?v=diagrams&d=file">Subir archivo</a></li><br/>
                    <li><a href="ayuda.php?v=diagrams&d=menu">Menu Platafomas</a></li></ul></div>                
            </div>
            <?php
                    echo "$img";
                    break;
                default:            
            ?>
            <button style="margin: 2em; border-radius: 1em; text-align: center" onclick="location.href='ayuda.php?v=contact'">
                <label style="font: bold 14pt sans-serif">Contacto</label><br/><br/>
                <img src="imagenes/iconos/contact-icon.png" style="width:100px; height:100px"></button>
            <button style="margin: 2em; border-radius: 1em; text-align: center" onclick="location.href='ayuda.php?v=diagrams'">
                <label style="font: bold 14pt sans-serif">Diagramas de actividad</label><br/><br/>
                <img src="imagenes/act-diagr.png" style="width:100px; height:100px"></button>
            <button style="margin: 2em; border-radius: 1em; text-align: center" onclick="location.href='ayuda.php?v=usrmanual'">
                <label style="font: bold 14pt sans-serif">Manual del usuario</label><br/><br/>
                <img src="imagenes/portada-manuales/apartado-general.jpg" style="width:100px; height:100px;"></button>
            </div>
            <?php   break;
            }
            ?>
        
        <br/>
        <br/><br/>
        <div class="footer2"><label>&REG;PEMEX - Exploraci&oacute;n y Producci&oacute;n - 2015&nbsp;&nbsp;</label></div>
    </body>
</html>
