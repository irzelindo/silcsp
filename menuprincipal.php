<?php

echo '<script>

					var inactivityTime = function () {
			    var time;
			    window.onload = resetTimer;
			    // DOM Events
			    document.onmousemove = resetTimer;
			    document.onkeypress = resetTimer;

			    function logout() {
			        //alert("You are now logged out.")
			        location.href = "index.php";
			    }

			    function resetTimer() {
			        clearTimeout(time);
			        time = setTimeout(logout, 240000)
			        // 1000 milliseconds = 1 second
			    }
			};

			window.onload = function() {
			  inactivityTime();
			}


</script>';

$v_04   = $_SESSION['V_04'];	// Alertas
$v_05   = $_SESSION['V_05'];	// Tablero Panel
//---------------------------------------------------------//
$v_11   = $_SESSION['V_11'];	// Pacientes
$v_111   = $_SESSION['V_111'];	// Conectar Paciente TB
$v_112   = $_SESSION['V_112'];	// Historia Cl�nica
//---------------------------------------------------------//
$v_113   = $_SESSION['V_113'];	// Turnos
$v_12   = $_SESSION['V_12'];	// Registro de Turnos
$v_121   = $_SESSION['V_121'];	// Reasignar Turnos
$v_122   = $_SESSION['V_122'];	// Anular Turnos
$v_123   = $_SESSION['V_123'];	// Indicaciones
//---------------------------------------------------------//
$v_13   = $_SESSION['V_13'];	// Estudios �rdenes
$v_131   = $_SESSION['V_131'];	// Muestras Check in
$v_132   = $_SESSION['V_132'];	// Impresi�n de Etiquetas
$v_133   = $_SESSION['V_133'];	// Impresi�n de Contrase�as
//---------------------------------------------------------//
$v_14   = $_SESSION['V_14'];	// Notificaci�n Obligatoria
$v_141   = $_SESSION['V_141'];	// Histocompatibilidad Donante Vivo
$v_142   = $_SESSION['V_142'];	// Histocompatibilidad Donante Cadav�rico
$v_143   = $_SESSION['V_143'];	// Histocompatibilidad Donante Renal
$v_144   = $_SESSION['V_144'];	// Leishmaniosis Mucosa
$v_145   = $_SESSION['V_145'];	// Eti/Irag
$v_146   = $_SESSION['V_146'];	// Malaria
$v_147   = $_SESSION['V_147'];	// Chagas
$v_148   = $_SESSION['V_148'];	// Tos Convulsa, Coqueluche, Tos Ferina
$v_149   = $_SESSION['V_149'];	// Hepatitis
$v_1410   = $_SESSION['V_1410'];	// Febriles
$v_1411   = $_SESSION['V_1411'];	// Leishmaniosis Viseral Humana
$v_1412   = $_SESSION['V_1412'];	// Febril Agudo
//---------------------------------------------------------//
$v_151   = $_SESSION['V_151'];	// Ingresos y Cajas
$v_152   = $_SESSION['V_152'];	// Pagos Home Banking
$v_1511   = $_SESSION['V_1511'];	// Recibos
$v_153   = $_SESSION['V_153'];	// Apertura y Cierre de Caja
$v_154   = $_SESSION['V_154'];	// Arqueo
//---------------------------------------------------------//
$v_161   = $_SESSION['V_161'];	// Carga, Validaci�n Revalidaci�n
$v_162   = $_SESSION['V_162'];	// Impresi�n Resultados
$v_163   = $_SESSION['V_163'];	// Carga, Validaci�n Microbiolog�a
$v_164   = $_SESSION['V_164'];	// Email Resultados
$v_165   = $_SESSION['V_165'];	// Antibiograma
$v_166   = $_SESSION['V_166'];	// Microorganismos
$v_167   = $_SESSION['V_167'];	// Repeticiones
$v_168   = $_SESSION['V_168'];	// Hist�rico de Resultados
$v_169   = $_SESSION['V_169'];	// Interfaces con Analizadores
$v_1691   = $_SESSION['V_1691'];	// Preparar Muestras
$v_1692   = $_SESSION['V_1692'];// Confirmar Resultados
//---------------------------------------------------------//
$v_171   = $_SESSION['V_171'];	// Selecci�n para Examinar
$v_1711   = $_SESSION['V_1711'];	// Envio de Examen
$v_181   = $_SESSION['V_181'];	// Previsto Bioqu�mica Cl�nica
$v_182   = $_SESSION['V_182'];	// Previsto Dengue
$v_183   = $_SESSION['V_183'];	// Previsto Hematolog�a
$v_184   = $_SESSION['V_184'];	// Previsto Influenza
$v_185   = $_SESSION['V_185'];	// Previsto Parasitolog�a Intestinal
$v_186   = $_SESSION['V_186'];	// Previsto Rotavirus
$v_187   = $_SESSION['V_187'];	// Previsto S�filis
$v_188   = $_SESSION['V_188'];	// Previsto Malaria
//---------------------------------------------------------//
$v_191   = $_SESSION['V_191'];	// Respuestas Bioqu�mica Cl�nica
$v_192   = $_SESSION['V_192'];	// Respuestas Dengue
$v_193   = $_SESSION['V_193'];	// Respuestas Educaci�n Continua
$v_194   = $_SESSION['V_194'];	// Respuestas Hematolog�a
$v_195   = $_SESSION['V_195'];	// Respuestas Influenza
$v_196   = $_SESSION['V_196'];	// Respuestas Parasitolog�a Intestinal
$v_197   = $_SESSION['V_197'];	// Respuestas Rotavirus
$v_198   = $_SESSION['V_198'];	// Respuestas S�filis
$v_199   = $_SESSION['V_199'];	// Respuestas Malaria
//---------------------------------------------------------//
$v_211   = $_SESSION['V_211'];	// Agrupa Para Env�o
$v_2111   = $_SESSION['V_2111'];	// Mensaje Env�o
$v_212   = $_SESSION['V_212'];	// Recibe Env�o
$v_2121   = $_SESSION['V_2121'];	// Mensaje Recibe
$v_2122   = $_SESSION['V_2122'];	// Muestras Checkin
$v_21221   = $_SESSION['V_21221'];	// Lista de muestra recibidas
$v_21222   = $_SESSION['V_21222'];	// Etiquetas muestras
$v_21223   = $_SESSION['V_21223'];	// Mensaje Recibidos
$v_213   = $_SESSION['V_213'];	// Rechazos
$v_2131   = $_SESSION['V_2131'];	// Mensajes Rechazos
//---------------------------------------------------------//
$v_221   = $_SESSION['V_221'];	// Evaluaci�n Bioqu�mica
$v_222   = $_SESSION['V_222'];	// Evaluaci�n Dengue
$v_223   = $_SESSION['V_223'];	// Evaluaci�n Educaci�n Continua
$v_224   = $_SESSION['V_224'];	// Evaluaci�n Hematolog�a
$v_225   = $_SESSION['V_225'];	// Evaluaci�n Influenza
$v_226   = $_SESSION['V_226'];	// Evaluaci�n Parasitolog�a Intestinal
$v_227   = $_SESSION['V_227'];	// Evaluaci�n Rotavirus
$v_228   = $_SESSION['V_228'];	// Evaluaci�n S�filis
$v_229   = $_SESSION['V_229'];	// Evaluaci�n Malaria

//---------------------------------------------------------//
$v_311   = $_SESSION['V_311'];	// Reportes Historia Cl�nica
$v_312   = $_SESSION['V_312'];	// Reportes Lista de Pacientes
$v_313   = $_SESSION['V_313'];	// Reportes Estad�sticas
$v_314   = $_SESSION['V_314'];	// Reportes Cuadros Configurables
//---------------------------------------------------------//
$v_321   = $_SESSION['V_321'];	// Reportes Lista Diaria por Sector
$v_322   = $_SESSION['V_322'];	// Reportes Env�o de Muestras
$v_323   = $_SESSION['V_323'];	// Reportes Grupos de Edades
$v_324   = $_SESSION['V_324'];	// Reportes Plan de Trabajo
$v_325   = $_SESSION['V_325'];	// Peri�dicos Atendidos
$v_326   = $_SESSION['V_326'];	// Reportes Peri�dico Derivaciones
$v_327   = $_SESSION['V_327'];	// Reportes Lista de �rdenes
$v_328   = $_SESSION['V_328'];	// Reportes Turnos
$v_329   = $_SESSION['V_329'];	// Reportes Informe de Tiempos
$v_3210   = $_SESSION['V_3210'];	// Reportes Casos Rechazados
$v_3211   = $_SESSION['V_3211'];	// Reportes Estad�sticas
$v_3212   = $_SESSION['V_3212'];	// Reportes Cuadros Configurables
//---------------------------------------------------------//
$v_331   = $_SESSION['V_331'];	// Reportes Estad�sticas de Resultados
$v_332   = $_SESSION['V_332'];	// Reportes Lista de Resultados
$v_333   = $_SESSION['V_333'];	// Reportes Impresi�n Resultado Individual
$v_334   = $_SESSION['V_334'];	// Reportes Resultados TB
$v_335   = $_SESSION['V_335'];	// Reportes Cuadros Configurables
$v_336   = $_SESSION['V_336'];	// Reportes Resultados Microbiolog�a
//---------------------------------------------------------//
$v_341   = $_SESSION['V_341'];	// Reportes Movimientos Caja
$v_342   = $_SESSION['V_342'];	// Reportes Recibos
$v_343   = $_SESSION['V_343'];	// Reportes Arqueo
$v_344   = $_SESSION['V_344'];	// Reportes Formularios MSP
$v_345   = $_SESSION['V_345'];	// Reportes Estad�sticas Facturaci�n
//---------------------------------------------------------//
$v_351   = $_SESSION['V_351'];	// Reportes Respuestas Individuales
$v_352   = $_SESSION['V_352'];	// Reportes Evaluaciones Peri�dicas
//---------------------------------------------------------//
$v_361   = $_SESSION['V_361'];	// Reportes Usuarios
$v_362   = $_SESSION['V_362'];	// Reportes Bit�cora de Auditor�a
$v_363   = $_SESSION['V_363'];	// Reportes Hist�rico Contrase�as
$v_364   = $_SESSION['V_364'];	// Reportes Hist�rico mensajes
$v_365   = $_SESSION['V_365'];	// Reportes Tablas Configurables
//---------------------------------------------------------//
$v_411   = $_SESSION['V_411'];	// Usuarios
$v_412   = $_SESSION['V_412'];	// Perfiles
$v_413   = $_SESSION['V_413'];	// Roles
$v_414   = $_SESSION['V_414'];	// Opciones
$v_415   = $_SESSION['V_415'];	// Procesos
$v_416   = $_SESSION['V_416'];	// Establecimientos de Salud
$v_417   = $_SESSION['V_417'];	// �reas de Establecimiento
$v_4110   = $_SESSION['V_4110'];  // Sectores Laboratoriales
$v_4111   = $_SESSION['V_4111'];	// Courier
$v_4112   = $_SESSION['V_4112'];	// Tipos de Turnos
$v_4113   = $_SESSION['V_4113'];	// Feriados y Asuetos
$v_4114   = $_SESSION['V_4114'];	// Rango de Edades
$v_4115   = $_SESSION['V_4115'];	// Configuraciones Generales del Sistema
//---------------------------------------------------------//
$v_421   = $_SESSION['V_421'];	// Enfermedades
$v_422   = $_SESSION['V_422'];	// S�ntomas
$v_423   = $_SESSION['V_423'];	// Origen del Paciente
$v_424   = $_SESSION['V_424'];	// M�dicos
$v_425   = $_SESSION['V_425'];	// Diagn�sticos
//---------------------------------------------------------//
$v_431   = $_SESSION['V_431'];	// Estudios
$v_432   = $_SESSION['V_432'];	// Microbiolog�a
$v_433   = $_SESSION['V_433'];	// Determinaciones
$v_434   = $_SESSION['V_434'];	// Rangos (Valores de Referencia)
$v_435   = $_SESSION['V_435'];	// Posibles Resultados
$v_436   = $_SESSION['V_436'];	// M�todos
$v_437   = $_SESSION['V_437'];	// Tipos de Muestras
$v_438   = $_SESSION['V_438'];	// Textos
$v_439   = $_SESSION['V_439'];	// Unidad de Medida
$v_4310   = $_SESSION['V_4310'];	// Motivos de Rechazo
$v_4311   = $_SESSION['V_4311'];	// Estados de Resultados
$v_4312   = $_SESSION['V_4312'];	// Equipos Automatizados
$v_4313   = $_SESSION['V_4313'];	// Determinaciones Asociadas
$v_4314   = $_SESSION['V_4314'];	// Microorganismos
$v_4315   = $_SESSION['V_4315'];	// Antibiogramas
$v_4316   = $_SESSION['V_4316'];	// Antibi�ticos
$v_4317   = $_SESSION['V_4317'];	// Resultados Posibles Configurados
$v_4318   = $_SESSION['V_4318'];	// Plantillas Plan de Trabajo
//---------------------------------------------------------//
$v_441   = $_SESSION['V_441'];	// Empresas Laboratoriales
$v_442   = $_SESSION['V_442'];	// Aranceles
$v_443   = $_SESSION['V_443'];	// Cajas
//---------------------------------------------------------//
$v_451   = $_SESSION['V_451'];	// Educaci�n Continua
//---------------------------------------------------------//
$v_51   = $_SESSION['V_51'];	// Cambio de Contrase�a
$v_52   = $_SESSION['V_52'];	// Cambio C�dula Paciente
$v_53   = $_SESSION['V_53'];	// Vaciar Hist�rico de Bit�cora
$v_54   = $_SESSION['V_54'];	// Actualizar anuncios
//---------------------------------------------------------//

$v_6   = $_SESSION['V_6'];	// Panel Control
//---------------------------------------------------------//
$v_455   = $_SESSION['V_455'];	// Monitoreo de Capacidades Laboratoriales


$variable='';

$variable.='<div id="wb_ResponsiveMenu1">
					<label class="toggle" for="ResponsiveMenu1-submenu" id="ResponsiveMenu1-title"><span id="ResponsiveMenu1-icon">
                    <span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></span></label>

                    <!-----------  PRINCIPAL -------------->

					<input type="checkbox" id="ResponsiveMenu1-submenu">
					<ul class="ResponsiveMenu1" id="ResponsiveMenu1">
						<li>
						<label for="ResponsiveMenu1-submenu-0" class="toggle">Principal<b class="arrow-down"></b></label>
						<a href="#">Principal<b class="arrow-down"></b></a>
						<input type="checkbox" id="ResponsiveMenu1-submenu-0"/>
						<ul>
                        ';


                                if($v_11>0)
                                  {
                                    $variable.= '<li><a href="lista_pacientes.php">Pacientes</a></li>';
                                  }
                                if($v_12>0)
                                  {
                                    $variable.= '<li><a href="turnos.php">Turnos</a></li>';
                                  }
                                if($v_13>0)
                                  {
                                    $variable.= '<li><a href="ordenes.php">Ordenes</a></li>';
                                  }
                                if($v_14>0)
                                  {
                                    $variable.= '<li><a href="notificacion.php">Notificaciones&nbsp;Obligatorias</a></li>';
                                  }
                            //-------------------------------------//
                            $variable15='';
                            if($v_153>0 || $v_151>0 || $v_152>0)
                               {
                                $variable15.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-1" class="toggle">Perceptoria<b class="arrow-down"></b></label>
    							<a href="#">Perceptoria<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-1">
    							<ul>';

                                   if($v_153>0){$variable15.='<li><a href="apertura_caja.php">Apertura&nbsp;Caja</a></li>';}
                                   if($v_153>0){$variable15.='<li><a href="cierre_caja.php">Cierre&nbsp;Caja</a></li>';}
                                   if($v_151>0){$variable15.='<li><a href="ingresos_caja.php">Ingresos&nbsp;por&nbsp;Caja</a></li>';}
                                   if($v_152>0){$variable15.='<li><a href="homebanking.php">HomeBanking</a></li>';}
									if($v_154>0){$variable15.='<li><a href="arqueo.php">Arqueo</a></li>';}

                                $variable15.='</ul>
							     </li>';
                               }
                            $variable.= $variable15;
                            //-------------------------------------//
                            $variable16='';
                            if($v_161>0 || $v_169>0)
                               {
                                $variable16.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-2" class="toggle">Resultados<b class="arrow-down"></b></label>
    							<a href="#">Resultados<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-2">
    							<ul>';

                                   if($v_161>0){$variable16.='<li><a href="resultados.php">Carga&nbsp;de&nbsp;Resultados</a></li>';}
																	 if($v_161>0){$variable16.='<li><a href="resultados_lotes.php">Resultados por Agrupacion</a></li>';}
																	 if($v_161>0){$variable16.='<li><a href="resultados_fecha.php">Resultados por Rango Fecha</a></li>';}
                                   if($v_169>0){$variable16.='<li><a href="interfaz.php">Interfaz&nbsp;Analizadores</a></li>';}
                                   if($v_211>0){$variable16.='<li><a href="histocompatibilidad.php">Histocompatibilidad</a></li>';}

                                $variable16.='</ul>
							     </li>';
                               }
                            $variable.= $variable16;
                            //-------------------------------------//
                            if($v_171>0 || $v_181>0 || $v_182>0 || $v_183>0 || $v_184>0 || $v_185>0 || $v_186>0 || $v_187>0 || $v_188>0 || $v_451>0 || $v_191>0 || $v_192>0 || $v_193>0 || $v_194>0 || $v_195>0 || $v_196>0 || $v_197>0 || $v_198>0 || $v_199>0)
                                   {
                                 $variable.= '<li>
							<label for="ResponsiveMenu1-submenu-3" class="toggle">Control&nbsp;de&nbsp;Calidad<b class="arrow-down"></b></label>
							<a href="#">Control&nbsp;de&nbsp;Calidad<b class="arrow-left"></b></a>
							<input type="checkbox" id="ResponsiveMenu1-submenu-3">
							<ul>';

                                //-------------------------------------//
                                $variable17='';
                                if($v_171>0)
                                  {
                                    $variable17.='<li><a href="elegir_examen.php">Evaluacion</a></li>';
                                  }
                                $variable.= $variable17;
                                //-------------------------------------//
                                $variable18='';
                                if($v_181>0)
                                   {
                                    $variable18.='
        							<li>
    								<a href="resultados_respuestas.php">Realizar Evaluacion</a>';

                                    $variable18.='</li>';
                                   }
                                $variable.= $variable18;
                                //-------------------------------------//
                                $variable19='';
                                if($v_191>0)
                                   {
                                    $variable19.='
        							<li>
    								<a href="resultados_previstos.php">Realizar Control</a>';

                         

                                    $variable19.='</li>';
                                   }
                                $variable.= $variable19;
                                //-------------------------------------//
								
								$variable19='';
                                if($v_191>0)
                                   {
                                    $variable19.='
        							<li>
    								<a href="resultados_leishmania.php">Realizar Leishmania</a>';

                         

                                    $variable19.='</li>';
                                   }
                                $variable.= $variable19;
                                //-------------------------------------//
								
								$variable19='';
                                if($v_191>0)
                                   {
                                    $variable19.='
        							<li>
    								<a href="resultados_intestinal.php">Realizar Parasito intestinal</a>';

                         

                                    $variable19.='</li>';
                                   }
                                $variable.= $variable19;
                                //-------------------------------------//
								
								
							$variable.= '</ul>
							</li>';
                              }


						$variable.='</ul>
						</li>

                        <!-----------  PROCESOS COMPLEMENTARIOS -------------->
						<li>
						<label for="ResponsiveMenu1-submenu-6" class="toggle">Procesos&nbsp;Complementarios<b class="arrow-down"></b></label>
						<a href="#">Procesos&nbsp;Complementarios<b class="arrow-down"></b></a>
						<input type="checkbox" id="ResponsiveMenu1-submenu-6">
						<ul>';

                            $variable21='';
                            if($v_211>0 || $v_212>0)
                               {
                                $variable21.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-7" class="toggle">Ordenes<b class="arrow-down"></b></label>
    							<a href="#">Ordenes<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-7">
    							<ul>';

                                   if($v_211>0){$variable21.='<li><a href="envio.php">Preparar&nbsp;Env&iacute;os</a></li>';}
                                   if($v_212>0){$variable21.='<li><a href="recepcion.php">Recibir&nbsp;Env&iacute;os</a></li>';}

                                $variable21.='</ul>
							     </li>

									 <li>
									 <a href="#">Procesamiento<b class="arrow-left"></b></a>
     							<input type="checkbox" id="ResponsiveMenu1-submenu-7">
     							<ul>';

                                    if($v_211>0){$variable21.='<li><a href="lista_trabajo.php">Lista de Trabajo</a></li>';}

                                 $variable21.='</ul>
 							     </li>';
                               }
                            $variable.= $variable21;
                            //-------------------------------------//
                            $variable22='';
                            if($v_221>0)
                               {
                                $variable22.='
    							<li>
    							<a href="respuestas_evaluacion.php">Evaluar</a>';


                                $variable22.='</li>';
                               }
                            $variable.= $variable22;
                            //-------------------------------------//
                            $variable45='';
                            if($v_455>0)
                               {
                                $variable45.='
    							<li>
    							<a href="monitoreos.php">Monitoreo de Capacidades Laboratoriales</a>';


                                $variable45.='</li>';
                               }
                            $variable.= $variable45;
                            //-------------------------------------//
$variable.='
						</ul>
						</li>
                        <!-----------  REPORTES Y CUADROS -------------->

						<li>
						<label for="ResponsiveMenu1-submenu-9" class="toggle">Reportes&nbsp;y&nbsp;Cuadros<b class="arrow-down"></b></label>
						<a href="#">Reportes&nbsp;y&nbsp;Cuadros<b class="arrow-down"></b></a>
						<input type="checkbox" id="ResponsiveMenu1-submenu-9">
						<ul>';

                            $variable31='';
                            if($v_312>0 || $v_311>0 || $v_314>0 || $v_313>0)
                               {
                                $variable31.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-10" class="toggle">Pacientes<b class="arrow-down"></b></label>
    							<a href="#">Pacientes<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-10">
    							<ul>';

                                   if($v_312>0){$variable31.='<li><a href="lista_pacientes.php">Lista&nbsp;de&nbsp;Pacientes</a></li>';}
                                   if($v_311>0){$variable31.='<li><a href="lista_historia_clinica.php">Historia&nbsp;Cl&iacute;nica</a></li>';}
                                   if($v_314>0){$variable31.='<li><a href="cuadros_configurados_pacientes.php">Cuadros&nbsp;Configurables</a></li>';}
                                   if($v_313>0){$variable31.='<li><a href="estadistica_pacientes.php">Estad&iacute;sticas&nbsp;de&nbsp;Pacientes</a></li>';}

                                $variable31.='</ul>
							     </li>';
                               }
                            $variable.= $variable31;
                            //-------------------------------------//
                            $variable32='';
                            if($v_327>0 || $v_3211>0 || $v_3212>0)
                               {
                                $variable32.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-11" class="toggle">Ordenes<b class="arrow-down"></b></label>
    							<a href="#">Ordenes<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-11">
    							<ul>';

                                   if($v_327>0){$variable32.='<li><a href="listas_ordenes.php">Listas&nbsp;Generales</a></li>';}
                                   if($v_3211>0){$variable32.='<li><a href="ordenes_cuadros.php">Estad&iacute;sticas&nbsp;de&nbsp;Ordenes</a></li>';}
                                   if($v_3212>0){$variable32.='<li><a href="ordenes_configurados.php">Cuadros&nbsp;Configurables</a></li>';}
																	  if($v_3212>0){$variable32.='<li><a href="lista_orden.php">Lista de Trabajo</a></li> ';}

                                $variable32.='</ul>
							     </li>';
                               }
                            $variable.= $variable32;
                            //-------------------------------------//
                            $variable33='';
                            if($v_331>0 || $v_332>0 || $v_335>0)
                               {
                                $variable33.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-12" class="toggle">Resultados<b class="arrow-down"></b></label>
    							<a href="#">Resultados<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-12">
    							<ul>';

                                   if($v_332>0){$variable33.='<li><a href="lista_resultados.php">Listas&nbsp;Generales</a></li> ';}
                                   $variable33.='<li><a href="informeDGVS.php">Informe&nbsp;D.G.V.S.</a></li>';
                                   $variable33.='<li><a href="informarResultadosDGVS.php">Informar&nbsp;Resultados&nbsp;D.G.V.S.</a></li>';
                                   if($v_331>0){$variable33.='<li><a href="cuadros_resultados.php">Estad&iacute;sticas&nbsp;Resultados</a></li>';}
                                   if($v_335>0){$variable33.='<li><a href="resultados_configurados.php">Cuadros&nbsp;Configurables</a></li>';}

                                $variable33.='</ul>
							     </li>';
                               }
                            $variable.= $variable33;
                            //-------------------------------------//
                            $variable34='';
                            if($v_341>0 || $v_342>0 || $v_343>0 || $v_344>0 || $v_345>0)
                               {
                                $variable34.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-13" class="toggle">Perceptor&iacute;a<b class="arrow-down"></b></label>
    							<a href="#">Perceptor&iacute;a<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-13">
    							<ul>';

                                   if($v_341>0){$variable34.='<li><a href="movimientos_caja.php">Movimientos&nbsp;de&nbsp;Caja</a></li>';}
                                   if($v_342>0){$variable34.='<li><a href="recibos_facturacion.php">Recibos</a></li>';}
                                   if($v_343>0){$variable34.='<li><a href="arqueos.php">Arqueos</a></li>';}
                                   if($v_344>0){$variable34.='<li><a href="reporte_financiero.php">Formularios&nbsp;MSP</a></li>';}
                                   if($v_345>0){$variable34.='<li><a href="estadistica_facturacion.php">Estad&iacute;sticas&nbsp;Facturaci&oacute;n</a></li>';}
                                $variable34.='</ul>
						      	</li>';
                               }
                            $variable.= $variable34;
                            //-------------------------------------//
                            $variable35='';
                            if($v_351>0 || $v_352>0)
                               {
                                $variable35.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-14" class="toggle">Control&nbsp;de&nbsp;Calidad<b class="arrow-down"></b></label>
    							<a href="#">Control&nbsp;de&nbsp;Calidad<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-14">
    							<ul>';

                                   /*if($v_351>0){$variable35.='<li><a href="cc_respuestas_individuales.php">Respuestas&nbsp;individuales</a></li>';}
                                   if($v_352>0){$variable35.='<li><a href="cc_evaluacion_periodica.php">Evaluaciones&nbsp;Peri&oacute;dicas</a></li>';}*/
								   if($v_351>0){$variable35.='<li><a href="resumen_evaluacion.php">Resumen Evaluaciones</a></li>';}
								
                                $variable35.='</ul>
							     </li>';
                               }
                            $variable.= $variable35;
                            //-------------------------------------//
                            $variable36='';
                            if($v_361>0 || $v_362>0 || $v_363>0 || $v_364>0 || $v_365>0)
                               {
                                $variable36.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-15" class="toggle">Administraci&oacute;n&nbsp;Sistema<b class="arrow-down"></b></label>
    							<a href="#">Administraci&oacute;n&nbsp;Sistema<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-15">
    							<ul>';

                                   if($v_361>0){$variable36.='<li><a href="reporte_usuarios.php">Usuarios del Sistema</a></li>';}
                                   if($v_362>0){$variable36.='<li><a href="reporte_bitacora.php">Bit&aacute;cora&nbsp;de&nbsp;Auditoria</a></li>';}
                                   if($v_363>0){$variable36.='<li><a href="lista_historico_clave.php">Hist&oacute;rico&nbsp;Contrase&ntilde;as</a></li>';}
                                   if($v_364>0){$variable36.='<li><a href="lista_historico_mensajes.php">Hist&oacute;ricos&nbsp;Mensajes</a></li>';}
                                   if($v_365>0){$variable36.='<li><a href="lista_tablas.php">Tablas&nbsp;Configuradas</a></li>';}
                                $variable36.='</ul>
							     </li>

									 <li>
									 <label for="ResponsiveMenu1-submenu-15" class="toggle">Consultas<b class="arrow-down"></b></label>
     							<a href="#">Consultas<b class="arrow-left"></b></a>
     							<input type="checkbox" id="ResponsiveMenu1-submenu-15">
     							<ul>';

                                    if($v_361>0){$variable36.='<li><a href="lista_movimiento_muestra.php">Movimientos de Muestra</a></li>';}
                                    if($v_362>0){$variable36.='<li><a href="lista_paciente.php">Pacientes</a></li>';}
								
									if($v_6>0){$variable36.='<li><a href="lista_tablero.php" target="_blank">Tablero de Control</a></li>';}
								
									if($v_6>0){$variable36.='<li><a href="tablero_genomica.php" target="_blank">Tablero Genomica</a></li>';}
								
                                 $variable36.='</ul>
 							     </li>';
                               }
                            $variable.= $variable36;
                             //-------------------------------------//

                            $variable45='';
                            if($v_455>0)
                               {
                                $variable45.='
    							<li>
    							<a href="listatablero_monitoreo.php" target="_blank">Monitoreo de Capacidades Laboratoriales</a>';


                                $variable45.='</li>';
                               }
                            $variable.= $variable45;
                            //-------------------------------------//
$variable.='
						</ul>
						</li>
                        <!-----------  CONFIGURACIONES -------------->

						<li>
						<label for="ResponsiveMenu1-submenu-16" class="toggle">Configuraciones<b class="arrow-down"></b></label>
						<a href="#">Configuraciones<b class="arrow-down"></b></a>
						<input type="checkbox" id="ResponsiveMenu1-submenu-16"/>
						<ul>';

                             //-------------------------------------//
                            $variable41='';
                            if($v_411>0 || $v_413>0 || $v_415>0 || $v_416>0 || $v_4110>0 || $v_4111>0 || $v_4112>0 || $v_4113>0 || $v_4114>0 || $v_4115>0 || $v_414>0)
                               {
                                $variable41.='
    							<li>
        							<label for="ResponsiveMenu1-submenu-17" class="toggle">Administraci&oacute;n&nbsp;Sistema<b class="arrow-down"></b></label>
        							<a href="#">Administraci&oacute;n&nbsp;Sistema<b class="arrow-left"></b></a>
        							<input type="checkbox" id="ResponsiveMenu1-submenu-17">
        							<ul>';

                                   if($v_411>0){$variable41.='<li><a href="usuarios.php">Usuarios</a></li>';}
                                   if($v_413>0){$variable41.='<li><a href="roles.php">Roles</a></li>';}
                                   if($v_415>0){$variable41.='<li><a href="procesos.php">Procesos</a></li>';}
                                   if($v_416>0){$variable41.='<li><a href="establecimientossa.php">Establecimientos</a></li>';}
                                   if($v_4110>0){$variable41.='<li><a href="sectores.php">Sectores&nbsp;Laboratoriales</a></li>';}
                                   if($v_4111>0){$variable41.='<li><a href="courier.php">Courier</a></li>';}
                                   if($v_4112>0){$variable41.='<li><a href="tipo_turnos.php">Tipos&nbsp;de&nbsp;turnos</a></li>';}
                                   if($v_4113>0){$variable41.='<li><a href="feriados.php">Feriados&nbsp;y&nbsp;asuetos</a></li>';}
                                   if($v_4114>0){$variable41.='<li><a href="rango_edad.php">Rango&nbsp;Edades</a></li>';}
                                   if($v_4115>0){$variable41.='<li><a href="configuracion_gral.php">Configurar&nbsp;sistema</a></li>';}
                                   if($v_414>0){$variable41.='<li><a href="opciones.php">Opciones&nbsp;del&nbsp;sistema</a></li>';}

                                $variable41.='</ul>
							</li>';
                               }
                            $variable.= $variable41;
                            //-------------------------------------//
                            $variable42='';
                            if($v_421>0 || $v_422>0 || $v_423>0 || $v_424>0 || $v_425>0)
                               {
                                $variable42.='
    							<li>
        							<label for="ResponsiveMenu1-submenu-18" class="toggle">Pacientes<b class="arrow-down"></b></label>
        							<a href="#">Pacientes<b class="arrow-left"></b></a>
        							<input type="checkbox" id="ResponsiveMenu1-submenu-18">
        							<ul>';

                                   if($v_421>0){$variable42.='<li><a href="enfermedades.php">Enfermedades</a></li>';}
                                   if($v_422>0){$variable42.='<li><a href="sintomas.php">S&iacute;ntomas</a></li>';}
                                   if($v_423>0){$variable42.='<li><a href="origen_paciente.php">Origen&nbsp;del&nbsp;Paciente</a></li>';}
                                   if($v_424>0){$variable42.='<li><a href="medicos.php">Lugar Extracci&oacute;n</a></li>';}
                                   if($v_425>0){$variable42.='<li><a href="diagnostico.php">Diagn&oacute;sticos</a></li>';}

                                $variable42.='</ul>
							</li>';
                               }
                            $variable.= $variable42;
                            //-------------------------------------//
                            $variable43='';
                            if($v_431>0 || $v_433>0 || $v_436>0 || $v_437>0 || $v_438>0 || $v_439>0 || $v_4310>0 || $v_4311>0 || $v_4312>0 || $v_4314>0 || $v_4315>0 || $v_4316>0 || $v_4317>0 || $v_4318>0)
                               {
                                $variable43.='
    							<li>
        							<label for="ResponsiveMenu1-submenu-19" class="toggle">Estudios&nbsp;Laboratoriales<b class="arrow-down"></b></label>
        							<a href="#">Estudios&nbsp;Laboratoriales<b class="arrow-left"></b></a>
        							<input type="checkbox" id="ResponsiveMenu1-submenu-19"/>
        							<ul>';

                                   if($v_431>0){$variable43.='<li><a href="estudios.php">Estudios</a></li>';}
                                   if($v_431>0){$variable43.='<li><a href="estudiosmicro.php">Estudios Microbiolog&iacute;a</a></li>';}
                                   if($v_433>0){$variable43.='<li><a href="determinaciones.php">Determinaciones</a></li>';}
                                   if($v_436>0){$variable43.='<li><a href="metodos.php">M&eacute;todos</a></li>';}
                                   if($v_437>0){$variable43.='<li><a href="tipo_muestra.php">Tipos&nbsp;de&nbsp;muestras</a></li>';}
                                   if($v_438>0){$variable43.='<li><a href="textos.php">Textos</a></li>';}
                                   if($v_439>0){$variable43.='<li><a href="unidad_medida.php">Unidades&nbsp;de&nbsp;Medida</a></li>';}
                                   if($v_4310>0){$variable43.='<li><a href="motivo_rechazo.php">Motivos&nbsp;de&nbsp;Rechazos</a></li>';}
                                   if($v_4311>0){$variable43.='<li><a href="estado_resultado.php">Estados&nbsp;de&nbsp;Resultados</a></li>';}
                                   if($v_4312>0){$variable43.='<li><a href="equipos.php">Equipos&nbsp;Automatizados</a></li>';}
                                   if($v_4314>0){$variable43.='<li><a href="microorganismos.php">Microorganismos</a></li>';}
                                   if($v_4315>0){$variable43.='<li><a href="antibiogramas.php">Antibiogramas</a></li>';}
                                   if($v_4316>0){$variable43.='<li><a href="antibioticos.php">Antibi&oacute;ticos</a></li>';}
                                   if($v_4317>0){$variable43.='<li><a href="resultado_codificado.php">Resultados&nbsp;Posibles</a></li>';}
                                   if($v_4317>0){$variable43.='<li><a href="resultado_codificadomicro.php">Resultados&nbsp;Microbiolog&iacute;a</a></li>';}
                                   if($v_4318>0){$variable43.='<li><a href="plantillas_plan_trabajo.php">Plantillas&nbsp;Plan&nbsp;Trabajo</a></li>';}

                                $variable43.='</ul>
							     </li>';
                               }
                            $variable.= $variable43;
                            //-------------------------------------//
                            $variable44='';
                            if($v_441>0 || $v_442>0 || $v_443>0)
                               {
                                $variable44.='
    							<li>
        							<label for="ResponsiveMenu1-submenu-20" class="toggle">Perceptor&iacute;a<b class="arrow-down"></b></label>
        							<a href="#">Perceptor&iacute;a<b class="arrow-left"></b></a>
        							<input type="checkbox" id="ResponsiveMenu1-submenu-20">
        							<ul>';

                                   if($v_441>0){$variable44.='<li><a href="empresas.php">Empresas/Laboratorios</a></li>';}
                                   if($v_442>0){$variable44.='<li><a href="aranceles.php">Aranceles</a></li>';}
                                   if($v_443>0){$variable44.='<li><a href="cajas.php">Cajas</a></li>';}
                                   if($v_443>0){$variable44.='<li><a href="bancos.php">Bancos</a></li>';}
                                   if($v_443>0){$variable44.='<li><a href="motivo_anulacion.php">Motivos de Anulaci&oacute;n</a></li>';}

                                $variable44.='</ul>
							</li>';
                               }
                            $variable.= $variable44;
                            //-------------------------------------//
                            $variable45='';
                            if($v_451>0)
                               {
                                $variable45.='
    							<li>
    							<label for="ResponsiveMenu1-submenu-21" class="toggle">Control&nbsp;de&nbsp;Calidad<b class="arrow-down"></b></label>
    							<a href="#">Control&nbsp;de&nbsp;Calidad<b class="arrow-left"></b></a>
    							<input type="checkbox" id="ResponsiveMenu1-submenu-21">
    							<ul>
    								<li><a href="educacion_continua.php">Educaci&oacute;n&nbsp;Continua</a></li>
    							</ul>
    							</li>';
                               }
                            $variable.= $variable45;
$variable.='
						</ul>
						</li>

                        <!-----------  UTILITARIOS -------------->
						<li>
						<label for="ResponsiveMenu1-submenu-22" class="toggle">Utillitarios<b class="arrow-down"></b></label>
						<a href="#">Utillitarios<b class="arrow-down"></b></a>
						<input type="checkbox" id="ResponsiveMenu1-submenu-22">
						<ul>';
                           $variable5='';
                           if($v_51>0){$variable5.='<li><a href="cambiar_clave.php">Cambio&nbsp;Contrase&ntilde;a</a></li>';}
                           if($v_52>0){$variable5.='<li><a href="cambiar_cedula.php">Cambio&nbsp;C&eacute;dula</a></li>';}
                           if($v_53>0){$variable5.='<li><a href="vaciar_bitacora.php">Vaciar&nbsp;Bit&aacute;cora</a></li>';}
                           if($v_54>0){$variable5.='<li><a href="anuncios.php">Actualizar&nbsp;Anuncios</a></li>';}
                           if($v_05>0){$variable5.='<li><a href="tableroturnos.php" target="_blank">Tablero de Turnos</a></li>';}
                           $variable5.='<li><a href="menu.php">Ir&nbsp;al&nbsp;inicio</a></li>';
                           $variable.= $variable5;
$variable.='
						</ul>
						</li>

                        <!-----------  SALIR -------------->';
                        $salir='<li><a href="prelogin.php?codusu='.$_SESSION['codusu'].'"><span style="color: red;"><strong>Salir</strong></span></a></li>';
                        $variable.= $salir;

$variable.='				</ul>
				</div>';

echo $variable;

?>


