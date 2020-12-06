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
        <title>SAST</title>
        <script src="SpryAccordion.js" type="text/javascript"></script>
        <script src="frontPages.js" type="text/javascript"></script>
        <link href="EstilosSias.css" rel="stylesheet" type="text/css">
        <link href="acordeonsast.css" rel="stylesheet" type="text/css">
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
            <div align="center" style="width: 1250px;">
                <hr/>
                <img src="imagenes/cabecera/sast-sasp.png" style="width:1250px; height: 310px;">
                <div style="position: absolute; top: 18em; z-index:0;">
                    <label class="titulo" style="color: gray;">SAST</label>
                </div>
                <div align="center" style="background-color: gray; font: 14pt sans-serif; position:relative">
                    <a style="color: white">"Subsistema de Administraci&oacute;n de la Salud en el Trabajo"</a>
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
                                Este subsistema consta de 14 Elementos que se desarrollan
                                multidisciplinariamente y que están dirigidos a proteger y promover la salud de los 
                                trabajadores mediante la eliminación de los agentes y factores de riesgo que ponen en 
                                peligro su salud, así como la prevención de enfermedades de trabajo. Por el carácter 
                                multidisciplinario de la Salud en el Trabajo participan tres áreas fundamentales: la Higiene
                                Industrial, Medicina del Trabajo y Recursos Humanos, apoyándose con disciplinas como la 
                                Psicología Laboral y Ergonomía, entre otras; el subproceso se basa en la aplicación de los
                                elementos esenciales que rigen las mejores prácticas de un proceso integral de salud en el trabajo.<br/>
                                <img width="440px" height="440px" src="imagenes/spry/funcion-sast.png" style="margin: 15px"><br/><br/>
                                <a target="_blank" href="guias/DescripciÃ³n y Requisitos SAST.pdf">Descripci&oacute;n y Requisitos</a>&nbsp;<a target="_blank" href="guias/Tabla de AutoevaluaciÃ³n SAST.pdf">Tabla de Autoevaluaci&oacute;n</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E1: Agentes F&iacute;sicos</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e1-sast.png" class="imgElemento">
                                    Son aquellas manifestaciones de la energía tales como calor, frío, ruido, vibraciones,
                                    iluminación, presiones ambientales anormales, radiaciones ionizantes
                                    (rayos X, beta, gamma, etcétera) y campos electromagnéticos no ionizantes
                                    (infrarrojas, ultravioletas), por cuya exposición laboral pueden generarse
                                    daños a la salud en el corto o largo plazos.<br/><br/><br/>
                                    <a target="_blank" href="guias/SAST GT E1 Agentes Fisicos.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E1 Agentes Fisicos.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                    <a target="_blank" href="guias/SAST PA E1 Agentes Fisicos.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E2: Agentes Qu&iacute;micos</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e2-sast.png" class="imgElemento">
                                Son aquellos elementos o compuestos químicos, naturales o sintéticos, en
                                estado de: gases, vapores, neblinas, aerosoles, partículas y polvos, a los cuales
                                se exponen los trabajadores durante su jornada de trabajo y que por sí
                                solos o mezclados, dependiendo de su cantidad o concentración, pueden
                                producir efectos nocivos para la salud cuando se ponen en contacto o ingresan
                                al organismo en dosis que exceden su capacidad para metabolizarlos.<br/><br/>
                                <a target="_blank" href="guias/SAST GT E2 Agentes Quimicos.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E2 Agentes Quimicos.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E2 Agentes Quimicos.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E3: Agentes Biol&oacute;gicos</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e3-sast.png" class="imgElemento">
                                Son aquellos seres vivos, microscópicos (virus, bacterias, hongos, etcétera),
                                flora o fauna nociva, por cuya exposición en el trabajo, dependiendo de sus
                                características de agresividad, toxicidad o capacidad alergénica o patogénica;
                                cantidad o concentración, pueden producir efectos nocivos para la salud
                                cuando se ponen en contacto o ingresan al organismo excediendo la
                                capacidad de sus mecanismos naturales de defensa.<br/><br/>
                                <a target="_blank" href="guias/SAST GT E3 Agentes Biologicos.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E3 Agentes Biologicos.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E3 Agentes Biologicos.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E4: Factores de Riesgo Ergon&oacute;mico</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e4-sast.png" class="imgElemento">
                                Son aquellas condiciones relacionadas con las actividades y condiciones en
                                el sitio de trabajo, que representan un riesgo de lesiones o enfermedades,
                                principalmente en el sistema musculoesquelético, que se manifiestan principalmente
                                como fatiga, dolor, molestias, tensión o incapacidad funcional.<br/><br/><br/><br/>
                                <a target="_blank" href="guias/SAST GT E4 Factores Ergonomicos.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E4 Factores de Riesgo Ergonomicos.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E4 Factores de Riesgo Ergonomicos.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E5: Factores Psicosociales de Riesgo</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e5-sast.png" class="imgElemento">
                                Son aquellas condiciones que se encuentran presentes en el ambiente laboral
                                y que están directamente relacionadas con la organización, el contenido
                                del trabajo y la realización de la tarea (actividad), y que tienen capacidad para
                                afectar tanto al bienestar o a la salud (física, psíquica o social) del trabajador
                                como al desarrollo del trabajo.<br/><br/><br/>
                                <a target="_blank" href="guias/SAST GT E5 Factores Psicosociales.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E5 Factores Psicosociales de Riesgo.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E5 Factores Psicosociales de Riesgo.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E6: Programa de Conservaci&oacute;n Auditiva</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e6-sast.png" class="imgElemento">
                                Programa que tiene como finalidad prevenir lesiones y enfermedades en el sistema
                                auditivo de los trabajadores expuestos a ruido excesivo en su ambiente de
                                trabajo, durante el desarrollo de sus actividades, con acciones específicas
                                como medición, evaluación, dotación de Equipo de Protección Personal
                                Específico, capacitación y entrenamiento, vigilancia a la salud y control del ruido,
                                de conformidad con la Norma Oficial Mexicana NOM-011-STPS-2001.<br/><br/>
                                <a target="_blank" href="guias/SAA GT E6 Comunicacion Interna y Externa.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E6 Programa de Conservacion Auditiva.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAA PA E6 Comunicacion Interna y Externa.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E7: Ventilaci&oacute;n y Calidad del Aire</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e7-sast.png" class="imgElemento">
                                Es aquella condición que cumple con los requerimientos mínimos de confort
                                como calidad del aire aceptable a la mayoría, con una adecuada ventilación
                                y reposición de aire exterior y aire de ventilación filtrado/limpio; en instalaciones
                                en las cuales se encuentra laborando personal.<br/><br/><br/><br/>
                                <a target="_blank" href="guias/SAST GT E7 Ventilacion y Calidad del Aire.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E7 Ventilacion y Calidad del Aire.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E7 Ventilacion y Calidad de Aire.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E8: Servicios para el Personal</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e8-sast.png" class="imgElemento">
                                Son aquellos locales destinados al servicio de los trabajadores en cualquier
                                centro de trabajo de PEMEX y Organismos Subsidiarios como son: sanitarios,
                                vestidores, comedores, casas de cambio, dormitorios (cuando aplique), los
                                cuales deben estar limpios, adecuados y seguros; así como asistencia de
                                agua potable y hielo, proporcionados con la calidad suficiente para consumo
                                humano; evitando con ello el desarrollo de microorganismos como:
                                bacterias, virus, hongos, que pueden provocar efectos adversos en la salud
                                de los trabajadores.<br/><br/>
                                <a target="_blank" href="guias/SAST GT E8 Servicios para el Personal.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E8 Servicios para el Personal.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E8 Servicios para el Personal.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E9: Equipo de Protecci&oacute;n Personal Espec&iacute;fico</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e9-sast.png" class="imgElemento">
                                Cuando por razones de carácter técnico no sea posible aplicar las medidas
                                de prevención y control, se deberá realizar la selección, uso, manejo, mantenimiento,
                                limitaciones y disposición final del Equipo de Protección
                                Personal Específico, que permita proteger a los trabajadores de los agentes
                                del ambiente de trabajo que puedan dañar su salud. <br/><br/><br/>
                                <a target="_blank" href="guias/SAST GT E9 Equipo de Proteccion Personal Especifico.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E9 Equipo de Proteccion Personal Especifico.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E9 Equipo de Proteccion Personal Especifico.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E10: Comunicaci&oacute;n de Riesgos para la Salud</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e10-sast.png" class="imgElemento">
                                Son aquellas actividades que se realizan a través de un programa de capacitación
                                y comunicación, para asegurar que la información relevante de los
                                riesgos a la salud sea proporcionada a todos los trabajadores involucrados
                                de forma individual o en grupo, incluyendo los de reciente ingreso o transferidos,
                                así como personal de compañías contratistas; con la finalidad de alcanzar
                                un nivel de conocimiento, dominio y compromiso entre los trabajadores,
                                que contribuya a una disminución sustancial del número de lesiones
                                y/o enfermedades.<br/><br/>
                                <a target="_blank" href="guias/SAST GT E10 Comunicacion de Riesgos para la Salud.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E10 Comunicacion de Riesgos para la Salud.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E10 Comunicacion de Riesgos para la Salud.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E11: Compatibilidad Puesto-Persona</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e11-sast.png" class="imgElemento">
                                Son aquellas actividades que permiten evaluar la compatibilidad entre los
                                requisitos de desempeño físico, funcional y psicológico del puesto de trabajo
                                y las características del mismo tipo, por parte de la persona propuesta
                                para ocuparlo; a fin de mejorar el desempeño humano, prevenir riesgos, enfermedades
                                y/o lesiones que interrumpan el proceso productivo.<br/><br/>
                                <a target="_blank" href="guias/SAST GT E11 Compatibilidad Puesto-Persona.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E11 Compatibilidad Puesto-Persona.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E11 Compatibilidad Puesto-Persona.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E12: Vigilancia de la Salud en el Trabajo</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e12-sast.png" class="imgElemento">
                                Comprende la recopilación, el análisis, la interpretación y la difusión continuada
                                y sistemática de datos, útiles para evaluar la magnitud, la trascendencia y la
                                vulnerabilidad de las variables relacionadas con el proceso salud-enfermedad,
                                a efecto de actuar en consecuencia, bajo un óptica predominantemente
                                preventiva. La vigilancia de la salud de los trabajadores es indispensable
                                para la planificación, ejecución y evaluación de los programas de seguridad
                                y salud en el trabajo, el control de los trastornos y lesiones relacionadas con
                                el trabajo, así como para la protección y promoción de la salud de los
                                trabajadores. Dicha vigilancia comprende tanto la vigilancia de la salud de
                                los trabajadores como la del medio ambiente de trabajo.<br/><br/>
                                <a target="_blank" href="guias/SAST GT E12 Vigilancia de la Salud.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E12 Vigilancia de la Salud.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E12 Vigilancia a la Salud.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E13: Respuesta M&eacute;dica a Emergencias</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e13-sast.png" class="imgElemento">
                                Son aquellas acciones de preparación, atención y posteriores a las emergencias
                                que se integran al Plan de Respuesta a Emergencias del centro de
                                trabajo y que consideran la participación de los servicios médicos que atienden
                                al centro de trabajo, la integración de Brigadas de Emergencias, su capacitación,
                                la certificación de las competencias de sus integrantes en la
                                atención inicial de los trabajadores con afectaciones agudas a su salud en
                                el lugar de trabajo; la dotación, conservación y utilización de los recursos
                                necesarios para ello, así como los mecanismos de coordinación que deben
                                establecerse con el personal que dirige la aplicación del Plan General de
                                Respuesta a Emergencias.<br/><br/>
                                <a target="_blank" href="guias/SAST GT E13 Respuesta Medica a Emergencias.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E13 Respuesta Medica a Emergencias.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E13 Respuesta Medica a Emergencias.pdf">Protocolo de Auditor&iacute;a</a><br/>
                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><b>E14: Objetivos, Metas, Programas e Indicadores</b></div>
                            <div class="AccordionPanelContent"><img src="imagenes/elementos/sast/e14-sast.png" class="imgElemento">
                                A partir de la autoevaluación del SAST, anualmente, el centro de trabajo
                                debe desarrollar un Programa de Salud en el Trabajo orientado a la
                                prevención de accidentes y enfermedades de trabajo; al mejoramiento de la
                                capacidad de desempeño físico, funcional y psicológico de los trabajadores
                                y al mantenimiento de un medio ambiente de trabajo seguro y saludable,
                                con el establecimiento de objetivos y metas específicos, cuyo avance pueda
                                ser medido por indicadores de desempeño y de resultados, bajo un esquema
                                de mejora contínua.<br/><br/>
                                <a target="_blank" href="guias/SAST GT E14 Objetivos, Metas, Programas e Indicadores.pdf">Gu&iacute;a T&eacute;cnica</a>&nbsp;<a target="_blank" href="guias/SAST GA E14 Objetivos, Metas, Programas e Indicadores.pdf">Gu&iacute;a de Autoevaluaci&oacute;n</a>&nbsp;
                                <a target="_blank" href="guias/SAST PA E14 Objetivos, Metas, Programas e Indicadores.pdf">Protocolo de Auditor&iacute;a</a><br/>
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