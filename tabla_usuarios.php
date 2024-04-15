<?php

/**
 @author Victor Diaz Ovando
 * @copyright 2018
 * TABLA: USUARIOS
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
                 $sql = 'select * from usuarios order by codusu ';
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
    
                        echo '<p style="margin-left:0px"><strong>&nbsp;REPORTE DE TABLA DE USUARIOS</strong></p></td>';
    	                echo '</tr></table>';
    
                        echo '<b>&nbsp;Fecha de emisi&oacute;n del reporte:</b> '.date("d/m/Y").'<br />';
                        echo '<b>&nbsp;Hora de emisi&oacute;n del reporte:</b> '.date("H:i:s").'<br/ >';
    
                        print '<br><table class="cuadro">'
    		                  .'<tr><td class="hr">Usuario</td>'
    		                  .'<td class="hr">Nombre y Apellido</td>'
    		                  .'<td class="hr">Cedula</td>'
                              .'<td class="hr">E-mail</td>'
                              .'<td class="hr">Telefono</td>'
                              .'<td class="hr">Celular</td>'
                              .'<td class="hr">Direcci&oacute;n</td>'
                              .'<td class="hr">Fecha Registro</td>'
                              .'<td class="hr">Estado</td>'
                              .'<td class="hr">Clave Actual</td>'
    		                  .'<td class="hr">Fecha &Uacute;ltima Act. </td></tr>';
    
                        while ($row = pg_fetch_array($res))
    	                      {
                              $fr = $row["fechareg"];
                              $fechax="  ".$fr;
                              $f1 = strtotime($fechax);
                              $dia1=date("j",$f1);
                              $mes1=date("n",$f1);
                              $anho1=date("Y",$f1);
                              if ($dia1<10)
                                 {
       	                         $dia1="0".$dia1;
                                 }
                              if ($mes1<10)
                                 {
       	                         $mes1="0".$mes1;
                                 }
                              $freg=$dia1."/".$mes1."/".$anho1;
                              
                              $fa = $row["fechauact"];
                              $fechax2="  ".$fa;
                              $f2 = strtotime($fechax2);
                              $dia2=date("j",$f2);
                              $mes2=date("n",$f2);
                              $anho2=date("Y",$f2);
                              if ($dia2<10)
                                 {
       	                         $dia="0".$dia2;
                                 }
                              if ($mes2<10)
                                 {
       	                         $mes2="0".$mes2;
                                 }
                              $fua=$dia2."/".$mes2."/".$anho2;
                              
                              $estado='';
                              if($row['estado']==1){$estado=' Activo';}else{if($row['estado']==2){$estado=' Inactivo';}} 
        
        
     		                  print '<tr>'
                                   .'<td class="tr" width="80px">'.$row['codusu'] .'</td>'
    		                       .'<td class="tr" width="300px">'.$row['nomyape'] .'</td>'
    		                       .'<td class="tr" width="80px">'.$row['cedula'] .'</td>'
    		                       .'<td class="tr" width="300px">'.$row['email'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['telefono'] .'</td>'
                                   .'<td class="tr" width="80px">'.$row['celular'] .'</td>'
                                   .'<td class="tr" width="300px">'.$row['dccion'] .'</td>'
                                   .'<td class="tr" width="80px">'.$freg .'</td>'
                                   .'<td class="tr" width="80px">'.$estado .'</td>'
                                   .'<td class="tr" width="80px">'.$row['clave'] .'</td>'
                                   .'<td class="tr" width="80px">'.$fua .'</td>'
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
                         $accion="Reporte Tabla Usuarios ";
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
    	                        .'<tr><td style="font-weight:bold;font-size:1em;background-color:#F1F1F1;color:black;" colspan="11">REPORTE DE USUARIOS DEL SISTEMA</td></tr>';
                          print '</table>';		
    	
                          print  '<table border=1>';	
                          print  '<tr style="background-color:#F1F1F1;color:black;">'	
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Usuario</td>'
    	                        .'<td style="font-size:1em; width:300px;font-weight: bold;">Nombre y Apellido</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Cedula</td>'
                                .'<td style="font-size:1em; width:300px;font-weight: bold;">E-mail</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Telefono</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Celular</td>'
                                .'<td style="font-size:1em; width:300px;font-weight: bold;">Direcci&oacute;n</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Fecha de Registro</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Estado</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Clave Actual</td>'
                                .'<td style="font-size:1em; width:70px;font-weight: bold;">Fecha &Uacute;ltima Act.</td>'
                                .'</tr>';
                        while ($row = pg_fetch_array($res))
    	                      {
                              
                             $fr = $row["fechareg"];
                              $fechax="  ".$fr;
                              $f1 = strtotime($fechax);
                              $dia1=date("j",$f1);
                              $mes1=date("n",$f1);
                              $anho1=date("Y",$f1);
                              if ($dia1<10)
                                 {
       	                         $dia1="0".$dia1;
                                 }
                              if ($mes1<10)
                                 {
       	                         $mes1="0".$mes1;
                                 }
                              $freg=$dia1."/".$mes1."/".$anho1;
                              
                              $fa = $row["fechauact"];
                              $fechax2="  ".$fa;
                              $f2 = strtotime($fechax2);
                              $dia2=date("j",$f2);
                              $mes2=date("n",$f2);
                              $anho2=date("Y",$f2);
                              if ($dia2<10)
                                 {
       	                         $dia="0".$dia2;
                                 }
                              if ($mes2<10)
                                 {
       	                         $mes2="0".$mes2;
                                 }
                              $fua=$dia2."/".$mes2."/".$anho2;
                              
                              $estado='';
                              if($row['estado']==1){$estado=' Activo';}else{if($row['estado']==2){$estado=' Inactivo';}} 
        
     		                  print '<tr>'
                                   .'<td>'.$row['codusu'].'</td>'
    		                       .'<td>'.$row['nomyape'].'</td>'
                                   .'<td>'.$row['cedula'].'</td>'
                                   .'<td>'.$row['email'].'</td>'
                                   .'<td>'.$row['telefono'].'</td>'
                                   .'<td>'.$row['celular'].'</td>'
    		                       .'<td>'.acentos($row['dccion']).'</td>'
                                   .'<td>'.$freg.'</td>'
                                   .'<td>'.$estado.'</td>'
                                   .'<td>'.$row['clave'].'</td>'
                                   .'<td>'.$fua.'</td>'
    		                       .'</tr>';
    	                       }
    	                 print '</table>';
    		
                         // Bitacora
                         include("bitacora.php");
                         $codopcx = "V_365";
                         $fechaxx=date("Y-n-j", time());
                         $hora=date("G:i:s",time());
                         $accion="Reporte Tabla Usuarios XLS ";
                         $terminal = $_SERVER['REMOTE_ADDR'];
                         $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                         // Fin grabacion de registro de auditoria	
                     }	// FIN EXCCEL
						  
    	
                  }
                  // ----------------------------------------------------------------------------------

?>
