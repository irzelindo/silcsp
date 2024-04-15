<?php

/**
 @author Victor Diaz Ovando
 * @copyright 2018
 * TABLA: TIPO TURNOS
 */
 function elvalor($dato)
 {
 if($dato!='0' && $dato!='0,00' && $dato!='')
   {
   $eldato=$dato;	
   }
 else
   {
   $eldato='---';	
   }  	
 return $eldato;  
 }
    
// AQUI COMIENZA LA IMPRESION

      
$mensage=0;

             	 @Header("Content-type: text/html; charset=utf-8");
             	 // AQUI COMIENZA EL LISTADO PROPIAMENTE DICHO -----------------------------------------------------------
                 $sql = 'select * from tipoturnos order by codturno ';
                 $res=pg_query($con, $sql);
                 $numeroRegistros=pg_num_rows($res);

                 if ($numeroRegistros<=0)
                    {
                    echo "<div align='center'>";
                    echo "<font face='Times New Roman' size='4'>No se encontraron registros en esta tabla</font>";
                    echo "</div>";    	
                    echo "<br /><br />";
	                print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
                    }
                 else
                    {
                   	if ($tiporeporte==1) // reporte HTML
             	    {
               	        echo '<table border="0px"><tr><td><img src="images/logolcsp.png" width="100px" height="100px"/></td>';	      
                        echo '<td><strong>&nbsp;Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica </strong>';
                        echo '<br />';
    
                        echo '<p style="margin-left:0px"><strong>&nbsp;REPORTE DE TABLA DE TIPO DE TURNOS</strong></p></td>';
    	                echo '</tr></table>';
    
                        echo '<b>&nbsp;Fecha de emisi&oacute;n del reporte:</b> '.date("d/m/Y").'<br />';
                        echo '<b>&nbsp;Hora de emisi&oacute;n del reporte:</b> '.date("H:i:s").'<br/ >';
    
                        print '<br><table class="cuadro">'
    		                  .'<tr><td class="hr">C&oacute;digo Establecimiento</td>'
    		                  .'<td class="hr">Establecimiento</td>'
    		                  .'<td class="hr">C&oacute;digo &Acute;rea</td>'
                              .'<td class="hr">&Acute;rea</td>'
                              .'<td class="hr">C&oacute;digo Tipo Turno</td>'
                              .'<td class="hr">Lunes</td>'
                              .'<td class="hr">Horario Lunes</td>'
                              .'<td class="hr">Martes</td>'
                              .'<td class="hr">Horario Martes</td>'
                              .'<td class="hr">Mi&eacute;rcoles</td>'
                              .'<td class="hr">Horario Mi&eacute;rcoles</td>'
                              .'<td class="hr">Jueves</td>'
                              .'<td class="hr">Horario Jueves</td>'
                              .'<td class="hr">Viernes</td>'
                              .'<td class="hr">Horario Viernes</td>'
                              .'<td class="hr">S&acute;bado</td>'
                              .'<td class="hr">Horario &acute;bado</td>'
                              .'<td class="hr">Domingo</td>'
    		                  .'<td class="hr">Horario Domingo</td></tr>';
    
                        while ($row = pg_fetch_array($res))
    	                      {
                              $codservicio = $row['codservicio'];
                              $tabest = pg_query($con, "select * from establecimientos where  codservicio='$codservicio'");
                              $rowest = pg_fetch_array($tabest);
                              $nomservicio = $rowest['nomservicio'];
                              
                              $codarea = $row['codarea'];
                              $taba = pg_query($con, "select * from areasest where  codarea='$codarea'");
                              $rowa = pg_fetch_array($taba);
                              $nomarea = $rowa['nomarea'];
        
     		                  print '<tr>'
                                   .'<td class="tr" width="80px">'.$codservicio.'</td>'
    		                       .'<td class="tr" width="300px">'.$nomservicio .'</td>'
    		                       .'<td class="tr" width="80px">'.$codarea .'</td>'
    		                       .'<td class="tr" width="300px">'.$nomarea .'</td>'
                                   .'<td class="tr" width="80px">'.$row['codturno'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['cantlun'] .'</td>'
                                   .'<td class="tr" width="120px">'.$row['horarlun'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['cantmar'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['horarmar'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['cantmier'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['horarmier'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['cantjue'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['horarjue'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['cantvie'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['horarvie'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['cantsab'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['horarsab'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['cantdom'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['horardom'] .'</td>'
    		                       .'</tr>';
    	                       }
    	                 print '</table><br />';
                         print '<p align="left">[ <a href="javascript:close()">VOLVER A LA PAGINA ANTERIOR</a> ]</p>';  
                         
                         print '</body>';
    	
                         // Bitacora
                         include("bitacora.php");
                         $codopcx = "V_365";
                         $fechaxx=date("Y-n-j", time());
                         $hora=date("G:i:s",time());
                         $accion="Reporte Tabla Tipo Turnos ";
                         $terminal = $_SERVER['REMOTE_ADDR'];
                         $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                         // Fin grabacion de registro de auditoria
                     }
					 else // EXCEL O PDF
                     {
                          header("Content-type: application/vnd.ms-excel");
                          header("Content-Disposition: attachment; filename=result.xls");
                          header("Pragma: no-cache");
                          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                          header("Expires: 0");
    
    
                          print  '<table border=1>'
    	                        .'<tr><td style="font-weight:bold;font-size:1em;background-color:#F1F1F1;color:black;" colspan="19">REPORTE TABLA DE TIPO DE TURNOS</td></tr>';
                          print '</table>';		
    	
                          print  '<table border=1>';	
                          print  '<tr style="background-color:#F1F1F1;color:black;">'	
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">C&oacute;digo Establecimiento</td>'
    	                        .'<td style="font-size:1em; width:300px;font-weight: bold;">Establecimiento</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">C&oacute;digo &Acute;rea</td>'
                                .'<td style="font-size:1em; width:300px;font-weight: bold;">&Acute;rea</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">C&oacute;digo Tipo Turno</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Lunes</td>'
                                .'<td style="font-size:1em; width:150px;font-weight: bold;">Horario Lunes</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Martes</td>'
                                .'<td style="font-size:1em; width:150px;font-weight: bold;">Horario Martes</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Mi&eacute;rcoles</td>'
                                .'<td style="font-size:1em; width:150px;font-weight: bold;">Horario Mi&eacute;rcoles</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Jueves</td>'
                                .'<td style="font-size:1em; width:150px;font-weight: bold;">Horario Jueves</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Viernes</td>'
                                .'<td style="font-size:1em; width:150px;font-weight: bold;">Horario Viernes</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">S&acute;bado</td>'
                                .'<td style="font-size:1em; width:150px;font-weight: bold;">Horario S&acute;bado</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Domingo</td>'
                                .'<td style="font-size:1em; width:150px;font-weight: bold;">Horario Domingo</td>'
                                .'</tr>';
                        while ($row = pg_fetch_array($res))
    	                      {
                              $codservicio = $row['codservicio'];
                              $tabest = pg_query($con, "select * from establecimientos where  codservicio='$codservicio'");
                              $rowest = pg_fetch_array($tabest);
                              $nomservicio = $rowest['nomservicio'];
                              
                              $codarea = $row['codarea'];
                              $taba = pg_query($con, "select * from areasest where  codarea='$codarea'");
                              $rowa = pg_fetch_array($taba);
                              $nomarea = $rowa['nomarea'];
        
     		                  print '<tr>'
                                   .'<td>'.$codservicio.'</td>'
    		                       .'<td>'.acentos($nomservicio).'</td>'
                                   .'<td>'.$codarea.'</td>'
                                   .'<td>'.acentos($nomarea).'</td>'
                                   .'<td>'.$row['codturno'].'</td>'
                                   .'<td>'.$row['cantlun'].'</td>'
    		                       .'<td>'.$row['horarlun'].'</td>'
                                   .'<td>'.$row['cantmar'].'</td>'
                                   .'<td>'.$row['horarmar'].'</td>'
                                   .'<td>'.$row['cantmier'].'</td>'
                                   .'<td>'.$row['horarmier'].'</td>'
                                   .'<td>'.$row['cantjue'].'</td>'
                                   .'<td>'.$row['horarjue'].'</td>'
                                   .'<td>'.$row['cantvie'].'</td>'
                                   .'<td>'.$row['horarvie'].'</td>'
                                   .'<td>'.$row['cantsab'].'</td>'
                                   .'<td>'.$row['horarsab'].'</td>'
                                   .'<td>'.$row['cantdom'].'</td>'
                                   .'<td>'.$row['horardom'].'</td>'
    		                       .'</tr>';
    	                       }
    	                 print '</table>';
    		
                         // Bitacora
                         include("bitacora.php");
                         $codopcx = "V_365";
                         $fechaxx=date("Y-n-j", time());
                         $hora=date("G:i:s",time());
                         $accion="Reporte Tabla Tipo Turno XLS ";
                         $terminal = $_SERVER['REMOTE_ADDR'];
                         $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                         // Fin grabacion de registro de auditoria	
                     }	// FIN EXCCEL
						  
    	
                  }
                  // ----------------------------------------------------------------------------------

?>
