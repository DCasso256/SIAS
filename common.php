<?php
    function showMYSQLError(){
        echo "<div style = 'color :red'>Ha ocurrido el siguiente error: " . mysql_error(). "</div>";
        echo "<br/> <br/>";
        echo "&iquest;Qu&eacute; desea hacer&quest; <br/><br/>";
        echo "<a href='#' onclick='location.reload()'>Reintentar</a>&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<a href='index.php'>Cancelar</a>";
    }
    
//Quick function that would convert the $_FILES array to the cleaner (IMHO) array.

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}



