<?php

/**
 @author Victor Diaz Ovando
 * @copyright 2018
 * TABLA: COURIER
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
                 $sql = 'select * from courier order by codcourier ';
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
    
                        echo '<p style="margin-left:0px"><strong>&nbsp;REPORTE DE TABLA DE COURIER</strong></p></td>';
    	                echo '</tr></table>';
    
                        echo '<b>&nbsp;Fecha de emisi&oacute;n del reporte:</b> '.date("d/m/Y").'<br />';
                        echo '<b>&nbsp;Hora de emisi&oacute;n del reporte:</b> '.date("H:i:s").'<br/ >';
    
                        print '<br><table class="cuadro">'
    		                  .'<tr><td class="hr">C&oacute;digo</td>'
    		                  .'<td class="hr">Denominaci&oacute;n</td>'
    		                  .'<td class="hr">Director</td>'
                              .'<td class="hr">Direcci&oacute;n</td>'
                              .'<td class="hr">Telefono</td>'
                              .'<td class="hr">E-mail</td>'
                              .'<td class="hr">Estado</td>'
                              .'</tr>';
    
                        while ($row = pg_fetch_array($res))
    	                      {
                              
                              $estado='';
                              if($row['estado']==1){$estado=' Activo';}else{if($row['estado']==2){$estado=' Inactivo';}} 
        
        
     		                  print '<tr>'
                                   .'<td class="tr" width="80px">'.$row['codcourier'] .'</td>'
    		                       .'<td class="tr" width="200px">'.$row['nomcourier'] .'</td>'
    		                       .'<td class="tr" width="300px">'.$row['director'] .'</td>'
    		                       .'<td class="tr" width="300px">'.$row['dccion'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['telefono'] .'</td>'
                                   .'<td class="tr" width="300px">'.$row['email'] .'</td>'
                                   .'<td class="tr" width="80px">'.$estado .'</td>'
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
                         $accion="Reporte Tabla Courier ";
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
    	                        .'<tr><td style="font-weight:bold;font-size:1em;background-color:#F1F1F1;color:black;" colspan="7">REPORTE DE USUARIOS DEL SISTEMA</td></tr>';
                          print '</table>';		
    	
                          print  '<table border=1>';	
                          print  '<tr style="background-color:#F1F1F1;color:black;">'	
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">C&oacute;digo</td>'
    	                        .'<td style="font-size:1em; width:300px;font-weight: bold;">Denominaci&oacute;n</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Director</td>'
                                .'<td style="font-size:1em; width:300px;font-weight: bold;">Direcci&oacute;n</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Telefono</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">E-mail</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Estado</td>'
                                .'</tr>';
                        while ($row = pg_fetch_array($res))
    	                      {
                              
                              $estado='';
                              if($row['estado']==1){$estado=' Activo';}else{if($row['estado']==2){$estado=' Inactivo';}} 
        
     		                  print '<tr>'
                                   .'<td>'.$row['codcourier'].'</td>'
    		                       .'<td>'.$row['nomcourier'].'</td>'
                                   .'<td>'.acentos($row['director']).'</td>'
                                   .'<td>'.acentos($row['dccion']).'</td>'
                                   .'<td>'.$row['telefono'].'</td>'
                                   .'<td>'.$row['email'].'</td>'
                                   .'<td>'.$estado.'</td>'
    		                       .'</tr>';
    	                       }
    	                 print '</table>';
    		
                         // Bitacora
                         include("bitacora.php");
                         $codopcx = "V_365";
                         $fechaxx=date("Y-n-j", time());
                         $hora=date("G:i:s",time());
                         $accion="Reporte Tabla Courier XLS ";
                         $terminal = $_SERVER['REMOTE_ADDR'];
                         $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                         // Fin grabacion de registro de auditoria	
                     }	// FIN EXCCEL
						  
    	
                  }
                  // ----------------------------------------------------------------------------------

?>