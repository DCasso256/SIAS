<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Codes</title>
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function modal(){
                document.getElementById('modal').style.display='none';
            }
            function clock(){
                var hoy = new Date();
                var h = hoy.getHours();
                var m = hoy.getMinutes();
                var s = hoy.getSeconds();
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
                var t = setTimeout(startTime, 500);
            }
            function checar(i){
                if (i < 10){i = "0" + i}; //añade un cero frente a los números menores a 10
                return i;
            }
            </script>
    </head>
    <body onload="clock()">
        <div class="modal" id="modal">
            <div>
            <label onclick="document.getElementById('modal').style.display='none';">X</label>
            <video controls="" id="video" src="imagenes/VID-20141226-WA0004.mp4" poster="imagenes/pemex.png" preload="none"></video>
            </div>
        </div>
        <div align="center" style="background-color: white;font: 25pt sans-serif;color: black;width:100%;min-width: 640px;cursor: pointer;" onclick="location.href = 'inicio.php'">
            <img src="imagenes/pemex.png" style="padding-right: 50px" align="middle" width="120px" height="90px">
            <label style="color: #555555;">SISTEMA INFORM&Aacute;TICO DE ADMINISTRACI&Oacute;N DEL SSPA</label>
            <img src="imagenes/sspa.png"  style="padding-left: 50px" align="middle" width="110px" height="90px">
        </div>
        <?php
        include_once 'funciones/common.php';
        include_once 'funciones/arrays.php';
        $link = mysql_connect("127.0.0.1", "root");
        mysql_select_db("pemex-sias", $link);
        $id = 0;
        
        $result = mysql_query("SELECT * FROM users", $link);
        
        while ($array = mysql_fetch_array($result)){
            $plat[$id] = $array[2];
            $id ++;
        }
        $pos = 0;
        echo $plat[$pos];
        
        if ($id <= $pos){
            $pos =0;
        }
        ?>    
        <video controls="" src="" width="350px" height="250px" poster="imagenes/pemex.png" preload="none"></video>
        <br/>
       
        <br/>
        <div id="divfield">
            <button onclick="addElement();">añadir input</button><br/><br/><br/>
            <script type="text/javascript">
            function addElement(){
                nuevo = document.createElement('input');
                seccion = document.getElementById('field');
                seccion.appendChild('nuevo');
            }
            </script>
            <fieldset id="field"><br/><br/>
                <input type="text" size="20" id="aba"><br/>
                <input type="password" id="abb"><br/>
                <input type="file" id="abc"><br/>
            </fieldset>
        </div>
        
        <div id="padre">
            <script type="text/javascript">
            function anyadir(){
                nuevo = document.createElementById('p').appendChild(createTextNode('Nuevo parrafo'));
                seccion = document.getElementById('padre').getElementsByTagName('p').[1];
                document.getElementById('padre').insertBefore(nuevo, seccion);
            }
            </script>
            <button onclick="anyadir();">añadir input</button>
            <p>Primer parrafo</p>
            <p>Segundo parrafo</p>
        </div>
        <br/>
        <div id="clock" style="font: bold 14pt monospace; color: darkcyan; background-color: gray;"></div>
        
        <?php
        
        $hora = getdate()['hours'];
        $minutos = getdate()['minutes'];
        $segundos = getdate()['seconds'];
        $año = getdate()['year'];
        $mes = getdate()['month'];
        $dia = getdate()['mday'];
        
        $rndstr1 = rand(1, 26);
        $rndstr2 = rand(1, 26);
        $prim = $caps[$rndstr1];
        $sec = "$lowcase[$rndstr2]_";
        $random = rand(12345, 98765);
        
        $contraseña = "$prim$sec$random";
        
        if(!strstr($user, "@")){
            echo "Uusario no registrado <br/>";
        }
        else if(strstr($user, "@")){
            echo "usuario válido";
        }
              
        echo  $contraseña ,"<br/><br/>",$prim , "<br/><br/>";
        
        echo $hora,":", $minutos,":",$segundos,"-----",$año,$mes,$dia;      
        
        ?>
        <br/><button type="button" onclick="document.getElementById('modal').style.display='block'">Ver video</button>
        
    </body>
</html>
