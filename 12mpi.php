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
<!DOCTYPE html>
<html>
    <head>
        <title>12 MPI</title>
        <script src="SpryAccordion.js" type="text/javascript"></script>
        <script src="frontPages.js" type="text/javascript"></script>
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <link href="SpryAccordion.css" rel="stylesheet" type="text/css">
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
            <div align="center" style="min-width: 1250px; width: 90%;">
                <hr/>
                <img src="imagenes/cabecera/12mpi-t3.jpg" style="width:1250px; height: 310px;">
                <div style="position: absolute; top: 18em; z-index:0;">
                    <label class="titulo" style="color: #ff1a0e;">12MPI</label>
                </div>
                <div align="center" style="background-color: #ff1a0e; font: 14pt sans-serif; position:relative">
                    <label style="color: white">"12 Mejores Pr&aacute;cticas Internacionales"</label>
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
                        <div class="AccordionPanelTab"><b> - La importancia de las 12MPI -</b></div>
                        <div class="AccordionPanelContent">Es la base del sistema PEMEX-SSPA y est&aacute; constituido por 12 Elementos que sirven para
                            administrar los aspectos generales de seguridad, salud y protección ambiental en Petr&oacute;leos
                            Mexicanos y del cual emana la Pol&iacute;tica de SSPA que aplica para toda la Organizaci&oacute;n.
                            <br/><br/><a target="_blank" href="guias/DescripciÃ³n y Requisitos 12MPI.pdf">Descripci&oacute;n y Requisitos</a>&nbsp;<a target="_blank" href="guias/Tabla de AutoevaluaciÃ³n 12MPI.pdf">Tabla de Autoevaluaci&oacute;n</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E1: Compromiso visible y demostrado</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e1.jpg" class="imgElemento">
                            Compromiso es el componente b&aacute;sico de un sistema exitoso de SSPA. Para que un sistema 
                            sea plenamente eficaz,ese compromiso debe de existir en todos los niveles de la Organización, desde la
                            Dirección General hasta la Base Trabajadora.<br/><br/><br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E1 Compromiso Visible y Demostrado.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E1 Compromiso Visible y Demostrado.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E1 Compromiso Visible y Demostrado.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E2: Pol&iacute;tica de SSPA</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e2.jpg" class="imgElemento">
                            Los conceptos sobre Seguridad, Salud y Protección Ambiental 
                            (SSPA) incluidos en la Política de SSPA y sus principios, son la expresión de la posición de la 
                            Empresa al respecto. A nivel estratégico de la Organización se formula una Política de SSPA apropiada
                            para la industria petrolera, acorde con la naturaleza, magnitud, peligros, riesgos e impactos de las
                            actividades y productos, incluyendo el compromiso de mejorar el desempeño en SSPA, la prevención de
                            los riesgos y de cumplir los requisitos legales.<br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E2 Politica de SSPA.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E2 Politica de SSPA.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E2 Politica de SSPA.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E3: Responsabilidad de la l&iacute;nea de mando</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e3.jpg" class="imgElemento">
                            Para lograr que el sistema PEMEX-SSPA se implante y opere de manera efectiva
                            y oportuna, es necesario un esfuerzo global, en el que todos los miembros
                            de la Línea de Mando y el personal que les reporta, acepten el compromiso
                            de su desempeño personal en SSPA, el cual debe propiciar:
                            <ul><li>1.- El cumplir con sus funciones y responsabilidades en todos los
                                    estratos jerárquicos.</li>
                                <li>2.- El satisfacer los requisitos establecidos en el sistema.</li>
                                <li>3.- El facilitar la interacción entre la Línea de Mando y personal que
                                    le reporta.</li>
                                <li>4.- Una comunicación efectiva.</li>
                                <li>5.- El permitir la contribución de todos los trabajadores para lograr los
                                    objetivos y metas. Sobre la base de que los aspectos de SSPA son intrínsecos a
                                    sus actividades.</li>
                            </ul><br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E3 Responsabilidad de la Linea de Mando.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E3 Responsabilidad de la Linea de Mando.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E3 Responsabilidad de la Linea de Mando.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E4: Organizaci&oacute;n Estructurada</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e4.png" class="imgElemento"> 
                            En materia de SSPA, la Organización Estructurada es una forma de organizar
                            los recursos humanos de la Empresa en Equipos y Subequipos en cada nivel
                            de la Organización, para facilitar y apoyar a la Línea de Mando durante la implantación,
                            ejecución, mejora y sustentabilidad del sistema PEMEX-SSPA con
                            efectividad y oportunidad. Normalmente los Subequipos de trabajo son asignados
                            a tareas específicas o a partes o elementos del sistema.
                            La Organización Estructurada de SSPA debe seguir la Organización de línea
                            en sus funciones naturales, vigilando y promoviendo la máxima involucración
                            y participación posible del personal, la cual, en materia de SSPA apoya desarrollando
                            documentos, capacitando, efectuando mediciones globales y emitiendo
                            recomendaciones integrales.<br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E4 Organizacion Estructurada.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E4 Organizacion Estructurada.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E4 Organizacion Estructurada.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E5: Metas y objetivos agresivos</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e5.png" class="imgElemento">
                            Los objetivos y metas en SSPA en una Empresa de clase mundial establecen la dirección global del
                            esfuerzo, y contribuyen a que la administración del negocio sea exitosa; requiere que los procesos de
                            planeación, ejecución de planes y programas y evaluación de resultados sean sistémicos y con base en 
                            indicadores, que una vez alcanzados, la Organización se fije cada vez metas y objetivos más agresivos, 
                            que motiven a todo el personal a mejorar su desempe&ntilde;o en SSPA para contribuir a que la Empresa sea m&aacute;s 
                            competitiva.<br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E5 Metas y Objetivos Agresivos.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E5 Metas y Objetivos Agresivos.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E5 Metas y Objetivos Agresivos.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E6: Altos estándares de desempeño</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e6.png" class="imgElemento">
                            Los Estándares de Desempeño en SSPA son documentos donde de acuerdo
                            con el conocimiento y experiencia en la materia del personal experto de la
                            Organización, se describen y establecen las mejores formas probadas de llevar
                            a cabo las actividades inherentes a las operaciones de la Empresa, entre
                            algunos de ellos se pueden mencionar los siguientes: lineamientos, guías técnicas,
                            normas de referencia, procedimientos, instructivos, reglas, criterios,
                            etcétera; en los cuales se especifica cómo debe realizarse cada actividad.<br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E6 Disciplina Operativa.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E6 Disciplina Operativa.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E6 Disciplina Operativa.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E7: Papel de la función de SSPA</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e7.png" class="imgElemento">
                            Los profesionales de la Función de SSPA, deben ser los depositarios del conocimiento
                            y experiencia en la materia, enfocando sus funciones más hacia
                            asesorar, facilitar, guiar, y participar con toda la Línea de Organización y la
                            Organización Estructurada para que estos últimos cumplan con sus responsabilidades
                            durante el proceso de implantación, mejora y sustentabilidad de
                            la SSPA en la Empresa, así mismo ellos deben auditar y vigilar el comportamiento
                            de los indicadores del sistema PEMEX-SSPA para la toma de decisiones
                            para la mejora continua.<br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E7 Papel de la Funcion de SSPA.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E7 Papel de la Funcion de SSPA.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E7 Papel de la Funcion de SSPA.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E8: Auditorías efectivas</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e8.png" class="imgElemento">
                            La Auditoría Efectiva (AE) es una metodología que mediante el análisis de
                            cómo y en qué circunstancias se desarrollan las actividades laborales, permite
                            la identificación de actos, prácticas y condiciones inseguras en el sitio de
                            trabajo, comparando el desempeño contra estándares establecidos. Se fundamenta
                            en que los accidentes y/o incidentes pueden ser prevenidos al alertar
                            a los trabajadores sobre las posibles consecuencias de los actos, prácticas
                            o condiciones inseguras, interactuando con ellos hasta lograr el compromiso
                            que modifiquen su conducta y observen rigurosamente las disposiciones contenidas
                            en el marco regulatorio aplicable al desempeño de sus actividades.<br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E8 Auditorias Efectivas.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E8 Auditorias Efectivas.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E8 Auditorias Efectivas.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E9: Investigación y an&aacute;lsis de incidentes</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e9.png" class="imgElemento">
                            Para que el sistema PEMEX-SSPA sea efectivo, &eacute;ste debe incluir un mecanismo
                            t&eacute;cnico-administrativo para reportar, investigar y analizar a fondo los incidentes
                            e informar sobre ellos. Por medio de este mecanismo, la Organización
                            aprende y la Gerencia y Línea de Mando pueden determinar las causas raíz
                            de las lesiones e incidentes y emitir recomendaciones para así prevenir que
                            se repitan. <br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E9 Investigacion y Analisis de Incidentes.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E9 Investigacion y Analisis de Incidentes.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E9 Investigacion y Analisis de Incidentes.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E10: Capacitaci&oacute;n y entrenamiento</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e10.png" class="imgElemento">
                            Mediante una Capacitación y Entrenamiento sistemático en SSPA a todo el
                            personal, acorde con las necesidades y requerimientos del puesto-persona,
                            incluyendo proveedores y Contratistas, la Línea de Organización en sus tres
                            niveles (Estratégico, Táctico y Operativo), promueve la mejora de los conocimientos
                            y habilidades, a la vez que fomenta y refuerza una actitud positiva
                            para mejorar el desempeño, confiabilidad y sustentabilidad de SSPA.<br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E10 Capacitacion y Entrenamiento.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E10 Capacitacion y Entrenamiento.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E10 Capacitacion y Entrenamiento.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E11: Comunicaciones efectivas</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e11.png" class="imgElemento">
                            La Máxima Autoridad de cada nivel de la Organización (Estratégico, Táctico y
                            Operativo) desempeña un papel importante en el desarrollo del mensaje; toda
                            la Organización de línea comunica el mensaje, para asegurar que se comprenda,
                            debiéndose cerrar el ciclo de comunicación mediante la retroalimentación
                            de la audiencia.<br/><br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E11 Comunicaciones Efectivas1.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E11 Comunicaciones Efectivas.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E11 Comunicaciones Efectivas.pdf">Protocolo de Auditor&iacute;a</a><br/>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>E12: Motivaci&oacute;n progresiva</b></div>
                        <div class="AccordionPanelContent"><img src="imagenes/elementos/12mpi/e12.png" class="imgElemento">
                            El mejor método de motivación consiste en lograr que todos los trabajadores
                            estén convencidos de que la SSPA es en beneficio propio para que esto los
                            estimule a participar en las labores de SSPA.
                            En una organización motivada:
                            Toda la Línea de Organización en sus tres niveles (Estratégico, Táctico y
                            Operativo) participa a fondo en las actividades de SSPA.
                            Todo el personal refleja la motivación de la Máxima Autoridad de la
                            Línea de Organización en cada nivel y se compromete a tener un buen
                            desempeño en SSPA<br/><br/>
                            <a target="_blank" href="guias/12 MPI GT E12 Motivacion Progresiva.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/12MPI GA E12 Motivacion Progresiva.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                            <a target="_blank" href="guias/12MPI PA E12 Motivacion Progresiva.pdf">Protocolo de Auditor&iacute;a</a><br/>
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
                    <div style="background-color: darkcyan; font-size: 11pt; color: white; line-height: 2em; text-align: center">
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