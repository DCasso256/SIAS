<?php
session_id();
session_start();

 if(strlen(session_id()) > 6){
    ?>
<script type="text/javascript">
    alert ("Inicie sesión para acceder al sistema.");
    location.href="iniciar-sesion.php";
</script>
 <?php        
}
$user = session_id();
$link = mysql_connect("127.0.0.1", "root");
mysql_select_db("pemex-sias", $link);
$query = mysql_query("SELECT * FROM users WHERE id_user='$user'", $link);
$array = mysql_fetch_array($query);
$name = $array['name'];
?>
<!DOCTYPE>
<html>
    <head>
        <title>SASP</title>
        <script src="SpryAccordion.js" type="text/javascript"></script>
        <script src="frontPages.js" type="text/javascript"></script>
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <link href="acordeon.css" rel="stylesheet" type="text/css"/>
        <link href="MenuUsuario.css" rel="stylesheet" type="text/css">
    </head>
    <body>
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
                <img src="imagenes/cabecera/sasp-t2.jpg" style="width:1250px; height:310px">
                <div style="position: absolute; top: 18em; z-index:0;">
                    <label class="titulo" style="color: dodgerblue;">SASP</label>
                </div>
                <div align="center" style="background-color: dodgerblue; font: 14pt sans-serif; position:relative">
                    <a style="color: white">"Subsistema de Administraci&oacute;n de la Seguridad en los Procesos"</a>
                </div>
                <hr/>
            </div>            
            <div class="contenido">
                <div class="anuncios">
                    <div>
                        <label style="padding-left: 1em"><b>Anuncios</b></label>
                    </div>
                    <ul>
                        <li style="padding-left:5px">&nbsp;<label><b>Anuncios</b></label></li>
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
                <div width="510px">
                    <div id="Accordion1" class="Accordion" tabindex="0">
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b> - Funcionamiento y Estructura-</b></div>
                            <div class="AccordionPanelContent">&nbsp;&nbsp;&nbsp;&nbsp;Este subsistema consta de 14 Elementos que, 
                                aplicados sistemáticamente a través de controles administrativos (programas, procedimientos, 
                                evaluaciones, auditorías) a las operaciones que involucran materiales peligrosos, permiten 
                                que los riesgos del proceso sean identificados, entendidos y controlados y las lesiones e 
                                incidentes relacionados con el proceso puedan ser eliminados. Este subsistema interrelaciona los 
                                elementos de Tecnología del Proceso, Análisis de Riesgos y de Planeación y Respuesta a Emergencias,
                                como insumos principales alineados con la etapa de planeación de SSPA del Macroproceso. Con estos
                                insumos se desarrolla el Elemento de Procedimientos de Operación y Prácticas Seguras, el cual 
                                proporciona el material necesario para el Recurso Humano nuestro y de Contratistas, a través del
                                Elemento de Entrenamiento y Desempeño.<br/> 
                                <img width="440px" height="440px" src="imagenes/spry/funcion-sasp.png" style="margin: 15px"><br/><br/>
                                <a target="_blank" href="guias/DescripciÃ³n y Requisitos ASP.pdf">Descripci&oacute;n y Requisitos</a>&nbsp;<a target="_blank" href="guias/Tabla de AutoevaluaciÃ³n ASP.pdf">Tabla de Autoevaluaci&oacute;n</a><br/>
                                </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E1: Tecnolog&iacute;a del Proceso</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e1-sasp.png" class="imgElemento">
                                    El paquete de tecnología del proceso proporciona una descripción del proceso
                                    o de la operación y proporciona también los fundamentos para identificar
                                    y entender los riesgos del proceso, que son los primeros pasos en los esfuerzos
                                    para administrar la Seguridad de los Procesos. El paquete de Tecnología
                                    consta de tres partes: Riesgos de los Materiales, las Bases para el Diseño del
                                    Proceso y las Bases para el Diseño del Equipo.<br/><br/>
                                    <a target="_blank" href="guias/ASP GT E1 Tecnologia del Proceso.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E1 Tecnologia del Proceso.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                    <a target="_blank" href="guias/ASP PA E1 Tecnologia del Proceso.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E2: An&aacute;lisis de Riesgos de Proceso</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e2-sasp.png" class="imgElemento">
                                Se usan para identificar, entender, evaluar, controlar o eliminar los riesgos
                                asociados con las instalaciones del proceso de manera que:
                                <ul><li>− Se utilice un enfoque organizado, metódico y sistemático.</li>
                                    <li>− Se busque y obtenga un consenso entre las diversas disciplinas
                                participantes.</li>
                                    <li>− Se documenten los resultados para su uso posterior en el seguimiento
                                        de las recomendaciones y en el entrenamiento del personal.</li></ul><br/>
                                De manera que se prevengan los incidentes y las lesiones relacionadas con
                                el proceso.
                                Un Análisis de Riesgos de Proceso consta de dos partes: una Revisión de Riesgos
                                de Procesos (RRP) y un Análisis de Consecuencias (Valoración de Riesgos).<br/><br/>
                                <a target="_blank" href="guias/ASP GT E2 Analisis y Evaluacion de Riesgos.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E2 Analisis de Riesgos de Proceso.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E2 Analisis de Riesgo de Proceso.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E3: Procedimientos de Operaci&oacute;n y Pr&aacute;cticas Seguras</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e3-sasp.png" class="imgElemento">
                                Los procedimientos de operación proporcionan un claro entendimiento de los
                                parámetros detallados de operación y los límites para su operación segura.
                                También explican claramente las consecuencias en la seguridad, la salud y el
                                medio ambiente al operar fuera de los límites del proceso, y describen los pasos
                                a tomar para corregir o evitar desviaciones, así como la forma de actuar
                                en casos de emergencia. Las prácticas seguras proporcionan un sistema de
                                procedimientos y/o permisos planeados adecuadamente, que incluyen inspecciones
                                y autorizaciones, antes de hacer trabajos no rutinarios en las áreas
                                de proceso.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E3 Procedimientos de Operacion y Practicas Seguras.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E3 Procedimientos de Operacion y Practicas Seguras.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E3 Procedimientos de Operacion y Practicas Seguras.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E4: Administraci&oacute;n de Cambios de Tecnolog&iacute;a</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e4-sasp.png" class="imgElemento">
                                Los Cambios a la Tecnología del Proceso documentada (ejemplo, riesgos de
                                los materiales, bases para el Diseño del Proceso o bases para el Diseño de los
                                Equipos del Proceso) potencialmente invalidan los Análisis o valoraciones de
                                Riesgos de Proceso anteriores, creando a la vez, riesgos nuevos,- por lo tanto
                                todos los cambios a la Tecnología documentada deben ser correctamente formulados,
                                revisados, autorizados y documentados.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E4 Administracion de Cambios de Tecnologia.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E4 Administracion de Cambios de Tecnologia.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E4 Administracion de Cambios de Tecnologia.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E5: Entrenamiento y Desempe&ntilde;o</b></div>
                            <div class="AccordionPanelContent"> <img src="imagenes/elementos/sasp/e5-sasp.png" class="imgElemento">
                                El personal que actúa correctamente y está bien entrenado no sólo es una característica
                                clave, sino un requisito indispensable para garantizar el manejo
                                seguro de materiales peligrosos y mantener el equipo de proceso operando
                                con seguridad. Se pueden tener implantados todos los demás elementos de la
                                ASP pero sin un personal dedicado a seguir consistentemente las políticas y
                                procedimientos documentados, las oportunidades de operar con seguridad se
                                reducen considerablemente. Los trabajadores deben, además, ser físicamente
                                capaces, estar mentalmente alertas y tener la habilidad de usar un buen juicio
                                para seguir cabalmente las prácticas y procedimientos establecidos.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E5 Entrenamiento y Desempeno.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E5 Entrenamiento y DesempeÃ±o.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E5 Entrenamiento y DesempeÃ±o.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E6: Contratistas</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e6-sasp.png" class="imgElemento">
                                Es esencial que todos los trabajos asignados a los contratistas deban realizarse
                                con seguridad de acuerdo con los procedimientos y/o prácticas de trabajo
                                seguras establecidas en las bases del contrato y ser consistentes con los principios
                                de la Administración de la Seguridad de los Procesos.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E6 Contratistas.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E6 Contratistas.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E6 Contratistas.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E7: Investigaci&oacute;n y An&aacute;lisis de Incidentes</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e7-sasp.png" class="imgElemento">
                                Para que el sistema PEMEX - SSPA sea efectivo, éste debe incluir un mecanismo
                                técnico-administrativo para reportar, investigar y analizar a fondo los
                                incidentes e informar sobre ellos. Por medio de este mecanismo, la
                                Organización aprende y la Gerencia y Línea de Mando pueden determinar las
                                causas raíz de las lesiones e incidentes y emitir recomendaciones para así
                                prevenir que se repitan.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E7 Criterios para la Calificacion de la severidad de los incidentes.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E7 Investigacion y Analisis de Incidentes-Accidentes.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E7 Investigacion y Analisis de Incidentes.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E8: Administraci&oacute;n de Cambios de Personal</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e8-sasp.png" class="imgElemento">
                                En reconocimiento de que la gente es el ingrediente esencial entrelazado a través
                                de todos los elementos de la ASP, es importante mantener un nivel mínimo
                                de (1) experiencia directa y específica en el proceso, y (2) conocimientos y habilidades
                                en la ASP. Al igual que los cambios en la tecnología o en las instalaciones,
                                la pérdida de los niveles de experiencia y conocimientos mínimos, a
                                través de los cambios de personal y de organización, tienen la potencia de invalidar
                                los análisis o valores de riesgo anteriores, los cuales habían sido basadas
                                en la presencia y autoridad de un personal conocedor y experimentado,
                                por lo que los cambios de personal a todos niveles deben cumplir los criterios
                                previamente establecidos para garantizar que se mantengan los niveles mínimos
                                de experiencia y conocimiento a fin de proporcionar una base sólida para
                                todas las decisiones que puedan afectar la Seguridad del Proceso.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E8 Administracion de Cambios de Personal.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E8 Administracion de Cambios de Personal.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E8 Administracion de Cambios de Personal.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E9: Planes de Respuesta a Emergencias</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e9-sasp.png" class="imgElemento">
                                Todas las emergencias potenciales que se pueden presentar en un centro de
                                trabajo requieren una planeación profunda para garantizar una respuesta
                                efectiva por parte del personal del centro de trabajo en conjunto con las organizaciones
                                de respuesta a emergencias de la comunidad; para mitigar el impacto
                                en el personal, el medio ambiente y las instalaciones y el pronto control
                                de la situación de emergencia.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E9 Programacion y Control de Ejercicio-simulacros de PRE.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E9 Planeacion y Respuesta a Emergencias.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E9 Planeacion y Respuesta a Emergencias.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E10: Auditor&iacute;as</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e10-sasp.png" class="imgElemento">
                                La auditoría es un proceso sistemático independiente y documentado, para
                                obtener evidencias y evaluarlas de manera objetiva, con el fin de determinar
                                el cumplimiento de los estándares y requisitos establecidos.
                                La auditoría debe revelar las fortalezas y debilidades de los procesos y sistemas
                                SSPA, y aportar información confiable, que sirva de base para la mejora
                                continua de los mismos.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E10 Administracion de Acciones Correctivas y Preventivas.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E10 Auditorias.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E10 Auditorias.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E11: Aseguramiento de Calidad</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e11-sasp.png" class="imgElemento">
                                El aseguramiento de calidad de equipos y materiales es «el puente» entre las
                                especificaciones de diseño y la instalación inicial. Los esfuerzos de aseguramiento
                                de calidad están enfocados en garantizar que los equipos del proceso
                                estén fabricados conforme a las especificaciones de diseño y ensamblados e
                                instalados correctamente.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E11 Aseguramiento de la Calidad.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E11 Aseguramiento de Calidad.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E11 Aseguramiento de Calidad.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E12: Revisiones de Seguridad de Prearranque</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e12-sasp.png" class="imgElemento">
                                Las Revisiones de Seguridad de Prearranque proporcionan la revisión final a
                                los equipos e instalaciones nuevas, modificadas o rehabilitadas para confirmar
                                que los elementos de la ASP han sido cubiertos correctamente y que la
                                instalación es segura para entrar en operación.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E12 Revision de Seguridad de Prearranque.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E12 Revisiones de Seguridad de Prearranque.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E12 Revision de Seguridad de Prearranque.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E13: Integridad Mec&aacute;nica</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e13-sasp.png" class="imgElemento">
                                El elemento de la Integridad Mecánica cubre la vida útil de los equipos e instalaciones,
                                desde su instalación inicial hasta su desmantelamiento. La
                                Integridad Mecánica se enfoca en garantizar que se mantenga la integridad
                                del sistema para contener las sustancias peligrosas durante toda la vida útil
                                de la instalación. Se ocupa de temas como:<br/><br/><ul>
                                    <li>- Procedimientos de Mantenimiento.</li>
                                    <li>- Entrenamiento y desempeño del personal de mantenimiento.</li>
                                    <li>- Procedimientos de control de Calidad.</li>
                                    <li>- Inspecciones y pruebas a equipos y refacciones, incluyendo el mantenimiento
                                    preventivo / predictivo.</li>
                                    <li>- Ingeniería de confiabilidad.</li></ul><br/>
                                    <a target="_blank" href="guias/ASP GT E13 Integridad Mecanica.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E13 Integridad Mecanica.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                    <a target="_blank" href="guias/ASP PA E13 Integridad Mecanica.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E14: Administraci&oacute;n de Cambios</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sasp/e14-sasp.png" class="imgElemento">
                                Los Cambios en el las instalaciones, mal administrados pueden conducir a, y
                                han conducido a eventos catastróficos. Todos los cambios incluyendo aquellos
                                que se efectúan dentro de la Tecnología del Proceso documentada, pero que
                                no constituyen un «reemplazo en sí»; deben ser correctamente formulados,
                                revisados, autorizados y documentados. Los requisitos de todos los elementos
                                de ASP aplicables deben ser completados antes de implantar el cambio.<br/><br/>
                                <a target="_blank" href="guias/ASP GT E14 Administracion de Cambios.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/ASP GA E14 Administracion de Cambios.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/ASP PA E14 Administracion de Cambios.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                var Accordion1 = new Spry.Widget.Accordion("Accordion1");
            </script>

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