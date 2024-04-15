<?php

/**
 @author Victor Diaz Ovando
 * @copyright 2018
 * TABLA: DEPARTAMENTOS Y DISTRITOS
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
                 $sql = 'select * from distritos order by coddist ';
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
    
                        echo '<p style="margin-left:0px"><strong>&nbsp;REPORTE DE TABLA DE DEPARTAMENTOS Y DISTRITOS</strong></p></td>';
    	                echo '</tr></table>';
    
                        echo '<b>&nbsp;Fecha de emisi&oacute;n del reporte:</b> '.date("d/m/Y").'<br />';
                        echo '<b>&nbsp;Hora de emisi&oacute;n del reporte:</b> '.date("H:i:s").'<br/ >';
    
                        print '<br><table class="cuadro">'
    		                  .'<tr><td class="hr">C&oacute;digo Depto.</td>'
    		                  .'<td class="hr">Departamento</td>'
                              .'<td class="hr">C&oacute;digo Distrito</td>'
		                      .'<td class="hr">Distrito</td>'
    		                  .'</tr>';
    
                        while ($row = pg_fetch_array($res))
    	                {      
                              $coddpto = $row['coddpto'];
                              
                              
                              $tab2 = pg_query($con, "select * from departamentos where  coddpto='$coddpto'");
                              $row2 = pg_fetch_array($tab2);
                              $nomdpto = $row2['nomdpto'];
        
        
     		                  print '<tr>'
                                   .'<td class="tr" width="80px">'.$coddpto .'</td>'
    		                       .'<td class="tr" width="300px">'.$nomdpto .'</td>'
    		                       .'<td class="tr" width="80px">'.$row['coddist'] .'</td>'
    		                       .'<td class="tr" width="300px">'.$row['nomdist'] .'</td>'
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
                         $accion="Reporte Tabla Depto y Distrito ";
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
    	                        .'<tr><td style="font-weight:bold;font-size:1em;background-color:#F1F1F1;color:black;" colspan="4">REPORTE DE TABLA DE DEPARTAMENTOS Y DISTRITOS</td></tr>';
                          print '</table>';		
    	
                          print  '<table border=1>';	
                          print  '<tr style="background-color:#F1F1F1;color:black;">'	
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">C&oacute;digo Depto.</td>'
    	                        .'<td style="font-size:1em; width:300px;font-weight: bold;">Departamento</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">C&oacute;digo Distrito</td>'
                                .'<td style="font-size:1em; width:200px;font-weight: bold;">Distrito</td>'
                                .'</tr>';
                        while ($row = pg_fetch_array($res))
    	                      {
                              
                            $coddpto = $row['coddpto'];
                              
                              
                              $tab2 = pg_query($con, "select * from departamentos where  coddpto='$coddpto'");
                              $row2 = pg_fetch_array($tab2);
                              $nomdpto = $row2['nomdpto'];
        
     		                  print '<tr>'
                                   .'<td>'.$coddpto.'</td>'
    		                       .'<td>'.$nomdpto.'</td>'
                                   .'<td>'.$row['coddist'].'</td>'
                                   .'<td>'.$row['nomdist'].'</td>'
    		                       .'</tr>';
    	                       }
    	                 print '</table>';
    		
                         // Bitacora
                         include("bitacora.php");
                         $codopcx = "V_365";
                         $fechaxx=date("Y-n-j", time());
                         $hora=date("G:i:s",time());
                         $accion="Reporte Tabla Depto y Distrito XLS ";
                         $terminal = $_SERVER['REMOTE_ADDR'];
                         $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                         // Fin grabacion de registro de auditoria	
                     }	// FIN EXCCEL
						  
    	
                  }
                  // ----------------------------------------------------------------------------------

?>
