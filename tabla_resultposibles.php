<?php

/**
 @author Victor Diaz Ovando
 * @copyright 2018
 * TABLA: RESULTADOS POSIBLES
 */
    
// AQUI COMIENZA LA IMPRESION
      
$mensage=0;

             	 @Header("Content-type: text/html; charset=utf-8");
             	 // AQUI COMIENZA EL LISTADO PROPIAMENTE DICHO -----------------------------------------------------------
                 $sql = 'select * from resultadoposible order by codestudio ';
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
    
                        echo '<p style="margin-left:0px"><strong>&nbsp;REPORTE DE TABLA DE RESULTADOS POSIBLES</strong></p></td>';
    	                echo '</tr></table>';
    
                        echo '<b>&nbsp;Fecha de emisi&oacute;n del reporte:</b> '.date("d/m/Y").'<br />';
                        echo '<b>&nbsp;Hora de emisi&oacute;n del reporte:</b> '.date("H:i:s").'<br/ >';
    
                        print '<br><table class="cuadro">'
    		                  .'<tr><td class="hr">C&oacute;digo Estudio</td>'
                              .'<td class="hr">C&oacute;digo Determinaci&oacute;n</td>'
    		                  .'<td class="hr">C&oacute;digo Resultado</td>'
    		                  .'</tr>';
    
                        while ($row = pg_fetch_array($res))
    	                      {
                              
     		                  print '<tr>'
                                   .'<td class="tr" width="80px">'.$row['codestudio'] .'</td>'
    		                       .'<td class="tr" width="80px">'.$row['coddetermina'] .'</td>'
    		                       .'<td class="tr" width="80px">'.$row['codresultado'] .'</td>'
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
                         $accion="Reporte Tabla Resultado Posible ";
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
    	                        .'<tr><td style="font-weight:bold;font-size:1em;background-color:#F1F1F1;color:black;" colspan="3">REPORTE DE TABLA DE RESULTADOS POSIBLES</td></tr>';
                          print '</table>';		
    	
                          print  '<table border=1>';	
                          print  '<tr style="background-color:#F1F1F1;color:black;">'	
                                .'<td style="font-size:1em; width:80px;font-weight: bold;">C&oacute;digo Estudio</td>'
                                .'<td style="font-size:1em; width:80px;font-weight: bold;">C&oacute;digo DDeterminaci&oacute;n</td>'
    	                        .'<td style="font-size:1em; width:80px;font-weight: bold;">C&oacute;digo Resultado</td>'
                                .'</tr>';
                        while ($row = pg_fetch_array($res))
    	                      {
                              
     		                  print '<tr>'
                                   .'<td>'.$row['codestudio'].'</td>'
                                   .'<td>'.$row['coddetermina'].'</td>'
    		                       .'<td>'.$row['codresultado'].'</td>'
    		                       .'</tr>';
    	                       }
    	                 print '</table>';
    		
                         // Bitacora
                         include("bitacora.php");
                         $codopcx = "V_365";
                         $fechaxx=date("Y-n-j", time());
                         $hora=date("G:i:s",time());
                         $accion="Reporte Tabla Resultados Posibles XLS ";
                         $terminal = $_SERVER['REMOTE_ADDR'];
                         $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                         // Fin grabacion de registro de auditoria	
                     }	// FIN EXCCEL
						  
    	
                  }
                  // ----------------------------------------------------------------------------------

?>


