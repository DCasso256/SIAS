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
        <title>SAA</title>
        <script src="SpryAccordion.js" type="text/javascript"></script>
        <script src="frontPages.js" type="text/javascript"></script>
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <link href="acordeonsaa.css" rel="stylesheet" type="text/css">
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
                <img src="imagenes/cabecera/saa-t1.gif" style="width:1250px; height: 310px;">
                <div style="position: absolute; top: 18em; z-index:0;">
                    <label class="titulo" style="color: #33cc00;">SAA</label>
                </div>
                <div align="center" style="background-color: #33cc00; font: 14pt sans-serif; position:relative">
                    <a style="color: white">"Subsistema de Administraci&oacute;n Ambiental"</a>
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
                            <div class="AccordionPanelTab"><b> - Funcionamiento y Estructura -</b></div>
                            <div class="AccordionPanelContent">&nbsp;&nbsp;&nbsp;&nbsp;
                                Este subsistema consta de 15 Elementos, cuya 
                                aplicación permite la prevención y control de la contaminación, administrando 
                                los aspectos e impactos ambientales de nuestras operaciones y procesos productivos, 
                                asegurando el cumplimiento del marco legal aplicable. Una vez que fueron identificados los 
                                aspectos ambientales del centro de trabajo, se les asigna significancia (Aspectos Ambientales).
                                A todos y cada uno de ellos, se les relacionará con su requisito legal u otro requisito aplicable
                                (Requisitos Legales y otros Requisitos) y se les deberán definir objetivos y metas ambientales, 
                                así como los programas e indicadores para su seguimiento, que conlleven a su minimización o 
                                eliminación (Objetivos, Metas, Programas e Indicadores).<br/> 
                                <img width="440px" height="440px" src="imagenes/spry/funcion-saa.png" style="margin: 15px"><br/><br/>
                                <a target="_blank" href="guias/Descripcion y Requisitos SAA.pdf">Descripci&oacute;n y Requisitos</a>&nbsp;<a target="_blank" href="guias/Tabla de AutoevaluaciÃ³n SAA.pdf">Tabla de Autoevaluaci&oacute;n</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E1: Aspectos Ambientales</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e1-saa.png" class="imgElemento">
                                    Los aspectos ambientales del centro de trabajo se identifican considerándolos
                                    desarrollos, actividades, productos y servicios nuevos, modificados o planificados.
                                    Además se determinan aquellos aspectos que tienen o pueden tener
                                    impactos significativos sobre el medio ambiente y se asegura que se tengan en
                                    cuenta en el establecimiento, implementación y mantenimiento del Subsistema
                                    de Administración Ambiental (SAA).<br/><br/>
                                    <a target="_blank" href="guias/SAA GT E1 Aspectos Ambientales.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E1 Aspectos Ambientales.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                    <a target="_blank" href="guias/SAA PA E1 Aspectos Ambientales.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E2: Requisitos Legales y Otros Requisitos</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e2-saa.png" class="imgElemento">
                                Los requisitos legales ambientales y otros requisitos a los que la Organización
                                se suscribe relacionados con sus aspectos ambientales, se identifican, acceden,
                                explican y comunican a todo el personal y prestadores de servicios. Los
                                requisitos legales ambientales incluyen: leyes, códigos, reglamentos, normas,
                                decretos y acuerdos que se deban cumplir.
                                El concepto “otros requisitos” incluye documentos, recomendaciones o mejores
                                prácticas no obligatorias a las que Petróleos Mexicanos y Organismos
                                Subsidiarios adopta y se asegura de que se tengan en cuenta en el establecimiento,
                                implementación y mantenimiento del SAA.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E2 Requisitos Legales y Otros Requisitos.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E2 Requisitos Legales y Otros Requisitos.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                    <a target="_blank" href="guias/SAA PA E2 Requisitos Legales y otros Requisitos.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E3: Objetivos, Metas, Programas e Indicadores</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e3-saa.png" class="imgElemento">
                                Para que los objetivos y metas de protección ambiental sean eficaces, deben
                                ser cuantitativos y razonables; deben formularse en los diferentes niveles y
                                funciones de Petróleos Mexicanos y Organismos Subsidiarios sobre la base
                                de: la Política SSPA, los aspectos ambientales significativos, compromisos de
                                prevención de la contaminación, cumplimiento de los requisitos legales y
                                otros requisitos, la mejora continua del SAA y deben ser congruentes de un
                                año a otro.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E3 Objetivos, Metas, Programas e Indicadores.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E3 Objetivos, Metas, Programas e Indicadores.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E3 Objetivos, Metas, Programas e Indicadores.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E4: Recursos, Funciones, Responsabilidad y Autoridad</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e4-saa.png" class="imgElemento">
                                El Equipo de Liderazgo asegura la disponibilidad de recursos humanos,
                                financieros y tecnológicos para establecer, implementar, mantener y mejorar
                                el SAA. Las funciones, responsabilidades y autoridad están definidas,
                                documentadas y comunicadas para facilitar una gestión ambiental eficaz.
                                La Máxima Autoridad del centro de trabajo cuenta con uno o varios
                                representantes que se aseguran que el SAA se establece, implementa y
                                mantiene de conformidad a sus requisitos, además informa sobre el
                                desempeño del subsistema para su revisión, incluyendo las recomendaciones
                                para la mejora.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E4 Recursos, Funciones, Responsabilidad y Autoridad.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E4 Recursos, Funciones, Responsabilidad y Autoridad.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E4 Recursos, Funciones, Responsabilidad y Autoridad.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E5: Competencia, Formaci&oacute;n y Toma de Conciencia</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e5-saa.png" class="imgElemento">
                                Todos los trabajadores y prestadores de servicios que realicen actividades que
                                puedan causar impactos ambientales significativos en los centros de trabajo de
                                Petróleos Mexicanos y Organismos Subsidiarios deben ser competentes,
                                tomando como base la formación y experiencia. Para el caso del personal del
                                centro de trabajo, además se identifican y se atienden sus necesidades de
                                formación relacionadas con los aspectos ambientales significativos y el SAA.
                                Respecto a los prestadores de servicios, el centro de trabajo les deberá exigir,
                                por medio de los mecanismos institucionales de contratación vigentes, que
                                sean capaces de demostrar la competencia necesaria o la formación apropiada
                                de su personal para el desarrollo de las actividades que potencialmente puedan
                                causar impactos ambientales significativos.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E5 Competencia, Formacion y Toma de Conciencia.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E5 Competencia, Formacion y Toma de Conciencia.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E5 Competencia, Formacion y Toma de Conciencia.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E6: Comunicaci&oacute;n Interna y Externa</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e6-saa.png" class="imgElemento">
                                Los centros de trabajo o instalaciones de Petróleos Mexicanos y Organismos
                                Subsidiarios se aseguran de establecer, implementar y mantener una comunicación
                                interna entre sus diversos niveles y funciones en relación con sus
                                aspectos ambientales y el SAA.
                                Tomando en consideración los Lineamientos Institucionales al respecto, establecen
                                un proceso para la recepción, documentación y respuesta a las solicitudes
                                de información de las partes interesadas.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E6 Comunicacion Interna y Externa.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E6 Comunicacion Interna y Externa.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E6 Comunicacion Interna y Externa.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E7: Control de Documentos y Registros</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e7-saa.png" class="imgElemento">
                                Los documentos que integran el SAA se controlan conforme a procedimientos
                                que incluyen su emisión, identificación, cambios y manejo de obsoletos,
                                disponibilidad en las áreas de trabajo, así como el control de documentos
                                de origen externo.
                                Los registros generados para demostrar la conformidad con los requisitos del
                                SAA se identifican, se almacenan, se protegen y se tienen disponibles para
                                facilitar su recuperación. Los registros permanecen legibles, identificables
                                y trazables.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E7 Control de Documentos y Registros.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E7 Control de Documentos y Registros.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E7 Control de Documentos y Registros.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E8: Control Operacional Ambiental</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e8-saa.png" class="imgElemento">
                                Las operaciones y actividades que están asociadas a la generación de los aspectos
                                ambientales significativos del centro de trabajo, son identificadas, planificadas
                                y realizadas bajo condiciones específicas, que permitirán mantener
                                un control orientado a prevenir y reducir la contaminación en su origen.
                                Lo anterior tiene como finalidad dar cumplimiento a los compromisos ambientales
                                manifestados en la Política SSPA, a los objetivos y metas ambientales establecidos
                                por el propio centro de trabajo, así como a los requisitos legales y otros
                                requisitos establecidos por Petróleos Mexicanos y Organismos Subsidiarios.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E8 Control Operacional Ambiental.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E8 Control Operacional Ambiental.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E8 Control Operacional Ambiental.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E9: Plan de Respuesta a Emergencias</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e9-saa.png" class="imgElemento">
                                El centro de trabajo identifica las situaciones potenciales de emergencia e incidentes
                                potenciales que pueden tener impactos en el medio ambiente, y en
                                su Plan de Respuesta a Emergencias; establece las acciones para responder
                                ante estas situaciones, la prevención o mitigación de los impactos ambientales
                                adversos asociados; los recursos humanos, materiales y equipos necesarios.
                                Dichos planes son probados para evaluar su efectividad, revisados y corregidos
                                periódicamente.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E9 Plan de Respuesta a Emergencias.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E9 Plan de Respuesta a Emergencias.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E9 Plan de Respuesta a Emergencias.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E10: Seguimiento y Medici&oacute;n de las Operaciones</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e10-saa.png" class="imgElemento">
                                El centro de trabajo debe dar seguimiento y medir de forma regular las características
                                clave de sus operaciones que tienen o pueden tener un impacto significativo
                                en el medio ambiente, considerando la información del desempeño,
                                los controles operacionales ambientales aplicables y la conformidad con los
                                objetivos y metas ambientales.
                                Además, debe asegurarse de que los equipos de seguimiento y medición se
                                utilicen y mantengan calibrados o verificados.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E10 Seguimiento y Medicion de las Operaciones.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E10 Seguimiento y Medicion de las Operaciones.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E10 Seguimiento y Medicion de las Operaciones.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E11: Evaluaci&oacute;n del Cumplimiento Legal</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e11-saa.png" class="imgElemento">
                                Los requisitos legales ambientales y otros requisitos que la Organización
                                adopte se evalúan periódicamente para determinar si se cumple con ellos,
                                manteniendo los registros correspondientes.<br/><br/><br/><br/><br/>
                                <a target="_blank" href="guias/SAA GT E11 Evaluacion del Cumplimiento Legal.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E11 Evaluacion de Cumplimiento Legal.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E11 Evaluacion del Cumplimiento Legal.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E12: No Conformidad, Acci&oacute;n Correctiva y Acci&oacute;n Preventiva</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e12-saa.png" class="imgElemento">
                                El centro de trabajo debe identificar y corregir las no conformidades reales y
                                emprender acciones para mitigar sus impactos ambientales, así como prevenir
                                las no conformidades potenciales. Los incidentes ambientales son considerados
                                como una no conformidad dentro del sistema PEMEX-SSPA.
                                Todas las no conformidades reales y potenciales son analizadas para determinar
                                las causas raíz y tomar acciones, con el fin de prevenir su ocurrencia o
                                recurrencia; además, se revisa la eficacia de dichas acciones.
                                Se debe asegurar de que cualquier cambio necesario se incorpore a la documentación
                                del SAA.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E12 No Conformidad, Accion Correctiva y Accion Preventiva.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E12 No Conformidad, Accion Correctiva y Accion Preventiva.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E12 No Conformidad, Accion Correctiva y Accion Preventiva.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E13: Auditor&iacute;as Ambientales</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e13-saa.png" class="imgElemento">
                                Las auditorías ambientales al SAA y a los procesos deben permitir al Equipo
                                de Liderazgo evaluar la madurez de la implantación de los mismos, identificar
                                las malas y buenas prácticas de trabajo, procedimientos inadecuados, mal
                                entendidos o no aplicados, condiciones de las instalaciones y equipos que no
                                cumplen con los estándares, así como incumplimientos a la normatividad
                                ambiental vigente.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E13 Auditorias Ambientales.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E13 Auditorias Ambientales.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E13 Auditorias Ambientales.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E14: Mejores Pr&aacute;cticas  Ambientales</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e14-saa.png" class="imgElemento">
                                Las mejores prácticas en materia ambiental derivadas de análisis causa raíz,
                                recomendaciones de auditorías, investigación de nuevas tecnologías y de
                                experiencias propias, en los procesos de diseño, construcción, operación,
                                mantenimiento y, en su caso, desmantelamiento; son identificadas, seleccionadas,
                                difundidas e implantadas por el centro de trabajo para apoyar al proceso
                                de mejora continua.
                                Además, se evalúan las mejores prácticas de otras empresas para ser consideradas
                                como parte del proceso de implantación del elemento.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E14 Mejores Practicas Ambientales.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E14 Mejores Practicas Ambientales.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E14 Mejores Practicas Ambientales.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E15: Revisi&oacute;n por la Direcci&oacute;n</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/saa/e15-saa.png" class="imgElemento">
                                La Máxima Autoridad del centro de trabajo revisa el SAA a intervalos planificados,
                                para asegurarse de su funcionamiento, adecuación, eficacia y efectividad.
                                Las revisiones consideran los resultados de las auditorías internas y
                                evaluaciones de cumplimiento de los requisitos legales y otros requisitos; las
                                comunicaciones internas y externas, incluidas las quejas; el desempeño
                                ambiental de la Organización; el grado de cumplimiento de los objetivos y
                                metas; el estado de las acciones correctivas y preventivas; el seguimiento de
                                las acciones resultantes de las revisiones previas llevadas a cabo por la
                                Dirección; los cambios en las circunstancias, incluyendo la evolución de los
                                requisitos legales y otros requisitos relacionados con sus aspectos ambientales
                                y las recomendaciones para la mejora.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E15  Revision de la Direccion.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAA GA E15 Revision por la Direccion.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E15 Revision por  la Direccion.pdf">Protocolo de Auditor&iacute;a</a><br/>
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