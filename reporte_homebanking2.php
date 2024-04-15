<?php
@Header("consaatent-type: text/html; charset=utf-8");
 
$nomyape1 = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
include("bitacora.php");

include("numerosALetras.class.php");

$con=Conectarse();

$elusuario=$apellido.", ".$nombre;

$codservicio = $_POST['codservicio'];
if ($codservicio == ""){$codservicio = $_POST['codservicio1'];}
$codempresa = $_POST['codempresa'];
$codcaja = $_POST['codcaja'];
if ($codcaja == ""){$codcaja = $_POST['codcaja1'];}
$codarancel = $_POST['codarancel'];
if ($codarancel == ""){$codarancel = $_POST['codarancel1'];}
$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
$tipo = $_POST['tipo'];
$tiporeporte = $_POST['tiporeporte'];


function acentos($cadena) 
{
   $search = explode(",","Ã,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,Ã‘,Ã,ü");
   $replace = explode(",","Í,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,Ñ,Á,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);
 
   return $cadena;
}
   $mensage=0;  // solo de relleno para no cambiar cosas
   $condicion="";
   $subtit="";
   $ok1="";
   $oK2="";
   $ok2="";

                if($fecha1 != "")
                {
                	$fecha1= "  ".$fecha1;
                	$fecha1= strtotime($fecha1);	
                	$dia1=date("j", $fecha1);
                	$mes1=date("n", $fecha1);
                	$anho1=date("Y",$fecha1);
                }
                else
                {
                	$dia1="";
                	$mes1="";
                	$anho1="";
                }   
   
			   
			   if ($dia1!="" && $mes1!="" && $anho1!="")
			   {
				   if (checkdate($mes1,$dia1,$anho1))
				   {
					  if ($dia1<10)
					  {
						  $dia1="0".$dia1;
					  }
					  
					  if ($mes1<10)
					  {
						  $mes1="0".$mes1;
					  }
					  
					  if ($anho1<100)
					  {
						  $anho1=2000+$anho1;
					  }
					  
					  if ($anho1<1000)
					  {
						  $anho1=1990;
					  }
					  
					  $ff1=$dia1."/".$mes1."/".$anho1;
					  $ff1x=$anho1."-".$mes1."-".$dia1;
					  $ok1="SI";
					  $existef1="SI";
				   } 	
				   else
				   {
					  $ff1="";
					  $ok1="NO";
					  $existef1="NO";
					  
					  echo "<div align='center'>";
					  echo "<font face='Times New Roman' size='4'>Fecha DESDE incorrecta</font>";
					  echo "</div>";    	
					  echo "<br /><br />";
					  print '<p align="center"><a href="javascript:close()">Volver a la página anterior</a></p>';
					} 	
			   }
			   
               if($fecha2 != "")
                {
                	$fecha2= "  ".$fecha2;
                	$fecha2= strtotime($fecha2);	
                	$dia2=date("j", $fecha2);
                	$mes2=date("n", $fecha2);
                	$anho2=date("Y",$fecha2);
                }
                else
                {
                	$dia2="";
                	$mes2="";
                	$anho2="";
                }   
			   if ($dia2!="" && $mes2!="" && $anho2!="") 
			   {
				   if (checkdate($mes2,$dia2,$anho2))
				   {
				       if ($dia2<10)
					   {
							$dia2="0".$dia2;
					   }
				   	   
					   if ($mes2<10)
					   {
					   		$mes2="0".$mes2;
					   }
				   
				   	   if ($anho2<100)
					   {
					   		$anho2=2000+$anho2;
					   }
				   
				   	   if ($anho2<1000)
					   {
					   		$anho2=1990;
					   }
					   
					   $ff2=$dia2."/".$mes2."/".$anho2;
					   $ff2x=$anho2."-".$mes2."-".$dia2;
					   $ok2="SI";
					   $existef2="SI";
				} 	
				  else
				  {
					 $ff2="";
					 $ok2="NO";
					 $existef2="NO";
				  
					 echo "<div align='center'>";
					 echo "<font face='Times New Roman' size='4'>Fecha HASTA incorrecta</font>";
					 echo "</div>";    	
					 echo "<br /><br />";
					 print '<p align="center"><a href="javascript:close()">Volver a la página anterior</a></p>';
				   } 	
			   }
			  
			  if($fecha1 != "")
			  {
				  if ($subtit=="")
				   {
					  $subtit="Desde Fecha: ".$ff1;
				   }
				  else
				   {
					  $subtit=$subtit.", Desde Fecha: ".$ff1;
				   }
				   
			 }

			  if($fecha2 != "")
			  {
				  if ($subtit=="")
				   {
					  $subtit="Hasta Fecha: ".$ff2;
				   }
				  else
				   {
					  $subtit=$subtit.", Hasta Fecha: ".$ff2;
				   }
				   
				   if ($condicion=="")
				   {
					  $condicion= " and hb.fecha between '$ff1x' and '$ff2x'";
				   }
				  else
				   {
					  $condicion =$condicion." and hb.fecha between '$ff1x' and '$ff2x'";
				   }
			  }
			  if ($codservicio != "") 
               { 
                  $ok3="SI";
                  if ($condicion=="")
				   {
					  $condicion=" and ic.codservicio = '$codservicio'";
				   }
				  else
				   {
					  $condicion=$condicion." and ic.codservicio = '$codservicio'";
				   }
               }
               else
               {
                      $ok3 = "NO";
                      echo "<div align='center'>";
					  echo "<font face='Times New Roman' size='4'>Debe Indicar el Establecimiento </font>";
					  echo "</div>";    	
					  echo "<br /><br />";
					  print '<p align="center"><a href="javascript:close()">Volver a la página anterior</a></p>';
               } 
			 
			   if ($tipo == 3) 
               { 
				 
				   if ($subtit=="")
				   {
						$subtit="Listado General";
				   }
				   else
				   {
					  $subtit=$subtit.", Listado General";
				   }
                   
               }
               else
               {
                    if ($tipo == 1) 
                    { 
                           if ($subtit=="")
        				   {
        						$subtit="Listado Detallado por Arancel: $codarancel";
        				   }
        				   else
        				   {
        					  $subtit=$subtit.", Listado Detallado por Arancel: $codarancel";
        				   } 
                           
                           if($codarancel != "TODAS")
                           {
                               if ($condicion=="")
            				   {
            					  $condicion =" and r.codarancel = '$codarancel' ";
            				   }
            				  else
            				   {
            					  $condicion =$condicion." and  r.codarancel = '$codarancel' ";
            				   }
                          }
                   }
                    
               }
			   
               if ($codempresa != "TODAS") 
               { 
                  if ($condicion=="")
				   {
					  $condicion=" and hb.codempresa = '$codempresa'";
				   }
				  else
				   {
					  $condicion=$condicion." and  hb.codempresa = '$codempresa'";
				   }
               }
               
               if ($codcaja != "TODAS") 
               { 
                  if ($condicion=="")
				   {
					  $condicion=" and ic.codcaja = '$codcaja'";
				   }
				  else
				   {
					  $condicion=$condicion." and  ic.codcaja = '$codcaja'";
				   }
               }
               
               

             	 // AQUI COMIENZA EL LISTADO PROPIAMENTE DICHO -----------------------------------------------------------
			if ($ok1 == "SI" and $ok2 == "SI" and $ok3 == "SI")
            {	
                 
                     $sql = "select hb.fecha as fecha,
                               hb.nroexpediente as nroexpediente,
                               hb.codempresa as codempresa,
                               ic.nroingreso as ingreso,
							   ic.nrorecibo as recibo,
                               ic.nroreciboser as reciboser,
                               ic.fecha as fechacarga,
                               ic.codcaja as caja,
                               r.norden as norden,
                               r.codarancel as arancel,
                               hb.monto as monto,
                               r.cantidad as cantidad
						from ingresocaja ic, recibos r, homebanking hb
						where ic.nroingreso = r.nroingreso
						and   ic.nrorecibo  = r.nrorecibo 
                        and   ic.nroingreso = hb.nroingreso ".$condicion.
						"  order by fecha, recibo";  
                                 
                
							  
                 $res=pg_query($con, $sql);
                 $numeroRegistros=pg_num_rows($res); 
                    
                 
                 if ($numeroRegistros<=0)
                 {
                    echo "<div align='center'>";
                    echo "<font face='Times New Roman' size='4'>No se encontraron registros para esos valores </font>";
                    echo "</div>";  
                    echo "<br /><br />";
                    echo $codarancel;
                 	print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
                                        
                 }
                 else
                 {
                   		if ($tiporeporte==1 and $tipo ==3) // reporte PDF Litado General
                   	    {
                                                           
                              $html='<page backtop="60mm" backbottom="10mm" backleft="-5mm" backright="-5mm">
            					<page_header>
            				    <table style="width: 100%; border: none;">
									<tr>
										<td style="width: 50%; border: none;">
											<img src="images/logolcsp.png" width="100" height="100">
											 <br /><strong>MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</strong>                   
											 <br /><strong>SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</strong><br><br>                                
										</td>
									 </tr>
									 <tr>
										<td style="width: 100%; border: none;">
			
											<p align="center" width="100%" >INFORME DE TRANSACCIONES HOMEBANKING</p>
											
											<p style="font-weight:bold;font-size:0.7em;"><b> Considerando:</b> '.$subtit.'</p>
										</td>
									</tr>			
								</table>
            					</page_header>
                                
							    <page_footer>
								<table style="width: 100%; border: none;">
									<tr>
										<td style="text-align: right;">P&aacute;gina: [[page_cu]]/[[page_nb]]</td>
									</tr>
								</table>
							</page_footer>
							
                            <br><table width="629" border="1" align="center">
								  <tr>
									<th width="80" style="background-color: #EDF2F8; text-align:center;">Fecha</th>
                                    <th width="80" style="background-color: #EDF2F8; text-align:center;">Fecha de Carga</th>
                                    <th width="100" style="background-color: #EDF2F8; text-align:center;">Nro. Ticket</th>
                                    <th width="120" style="background-color: #EDF2F8; text-align:center;">Nro. Expediente</th>
									<th width="100" style="background-color: #EDF2F8; text-align:center;">Caja</th>
                                    <th width="250" style="background-color: #EDF2F8; text-align:center;">Proveedor</th>
									<th width="120" style="background-color: #EDF2F8; text-align:center;">Monto</th>
								  </tr>' ;
                                 
                                 $subtotal=0;
                                 $tt=0;
                                                              
								 while ($row = pg_fetch_array($res))              
                                 {
                                      $fecha      = $row['fecha'];
                                      $fechacarga      = $row['fechacarga'];
                                      $nrecibo     = $row['recibo']."-".$row['reciboser'];
                                      $nroexpediente = $row['nroexpediente'];
                                      $caja       = $row ['caja'];
                                      $empresa     = $row['codempresa'];
                                      $monto       = $row['monto']; 
                                      
                                      $sqlempresa = pg_query($con,"select * from empresas ");
                      				  while($rowempresa = pg_fetch_array($sqlempresa)) 
                    				  {
                                        if($rowempresa['codempresa'] == $empresa)
                                        {
                                            $nombre= $rowempresa['razonsocial'];
                                        }
                                                                    
                    				  }
                                      
                                      $sqlcajas = pg_query($con,"select * from cajas ");
                      				  while($rowcajas = pg_fetch_array($sqlcajas)) 
                    				  {
                                        if($rowcajas['codcaja'] == $caja)
                                        {
                                            $nomcaja= $rowcajas['nomcaja'];
                                        }
                                                                    
                    				  }
                                      $html=$html.'<tr>'
                                      .'<td class="tr" width="80" >'.date("d/m/Y", strtotime($fecha)).'</td>'
                                      .'<td class="tr" width="80" >'.date("d/m/Y", strtotime($fechacarga)).'</td>'
                                      .'<td class="tr" align="center" width="100">'.$nrecibo.'</td>'
                                      .'<td class="tr" align="center" width="120">'.$nroexpediente.'</td>'
									  .'<td class="tr" align="center" width="100">'.$caja.'</td>'
									  .'<td class="tr" align="center" width="300">'.$nombre.'</td>'
                                      .'<td class="tr" align="center" width="100">'.number_format($monto,0,',','.').'</td>'
                                      .'</tr>';
                                            
                                      $tt=$tt+$monto;
                                      
                                     
                                }
								
                                $html=$html.'<tr>'
								.'<td class="tr" align="center" colspan="6"><strong>TOTAL</strong></td>'
								.'<td class="tr" align="center" ><strong>'.number_format($tt,0,',','.').'</strong></td>'
								.'</tr>';
								
									 
								$html= $html.'</table>
                                </page>';
							
								ini_set("memory_limit","64M"); 
                                include_once('html2pdf/html2pdf.class.php');
                                $html2pdf = new HTML2PDF('L','Legal','es');
                                $html2pdf->pdf->SetDisplayMode('fullpage');
                                $html2pdf->WriteHTML($html);
                                $html2pdf->Output('homebanking.pdf');	 	      	
								
									// Bitacora
									
            			             include("bitacora.php");
                                     $codopcx = "V_365";
                                     $fechaxx=date("Y-n-j", time());
                                     $hora=date("G:i:s",time());
                                     $accion="Reporte Perceptoria Homebanking";
                                     $terminal = $_SERVER['REMOTE_ADDR'];
                                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal); 
									// Fin grabacion de registro de auditoria*/
					 }  // FIN REPORTE PDF Listado General
                     
                     else
                     {
                         if ($tiporeporte==2 and $tipo ==3) // Rerporte Listado General XLS
                         {     
                                header("Content-type: application/vnd-ms-excel;charset=ISO-8859-1");	
                                header('Content-Disposition: attachment; filename=result.xls');
                                header('Pragma: no-cache');
                                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                                header('Expires: 0');
    
                                print  '<table border=1>
                                       <tr><td style="font-weight:bold;font-size:1em" colspan="7" align="center">MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</td></tr>
                                       <tr><td style="font-weight:bold;font-size:1em" colspan="7" align="center">SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</td></tr>
    	                               <tr><td style="font-weight:bold;font-size:1em" colspan="7" align="center">INFORME DE TRANSACCIONES HOMEBANKING</td></tr>
    	                               <td style="font-weight:bold;font-size:1em" colspan="7" align="center"><b>Considerando:</b>'.acentos($subtit).'</td>
    	                               </tr>';
    	                        
                           
                               print '<br><table border="1" align="center">
    		                     <tr><td width="80" style="background:#353F49; color:white;">Fecha</td>
    		                     <td width="80" style="background:#353F49; color:white;">Fecha de Carga</td>
                                 <td width="100" style="background:#353F49; color:white;">Nro de Ticket</td>
               		             <td width="120" style="background:#353F49; color:white;">Nro de Expediente </td>
                                 <td width="100" style="background:#353F49; color:white;">Caja </td>
                                 <td width="300" style="background:#353F49; color:white;">Proveedor </td>
                                 <td width="100" style="background:#353F49; color:white;">Monto </td>
               		             </tr>'; 
                                 
                                     $subtotal=0;
                                     $tt=0;
                                                                  
    								 while ($row = pg_fetch_array($res))              
                                     {
                                          $fecha      = $row['fecha'];
                                          $fechacarga      = $row['fechacarga'];
                                          $nrecibo     = $row['recibo']."-".$row['reciboser'];
                                          $nroexpediente = $row['nroexpediente'];
                                          $caja       = $row ['caja'];
                                          $empresa     = $row['codempresa'];
                                          $monto       = $row['monto']; 
                                          
                                          $sqlempresa = pg_query($con,"select * from empresas ");
                          				  while($rowempresa = pg_fetch_array($sqlempresa)) 
                        				  {
                                            if($rowempresa['codempresa'] == $empresa)
                                            {
                                                $nombre= $rowempresa['razonsocial'];
                                            }
                                                                        
                        				  }
                                          $sqlcajas = pg_query($con,"select * from cajas ");
                          				  while($rowcajas = pg_fetch_array($sqlcajas)) 
                        				  {
                                            if($rowcajas['codcaja'] == $caja)
                                            {
                                                $nomcaja= $rowcajas['nomcaja'];
                                            }
                                                                        
                        				  }
                                          print '<tr>'
    										.'<td class="tr">'.date("d/m/Y", strtotime($fecha)) .'</td>'
                                            .'<td class="tr">'.date("d/m/Y", strtotime($fechacarga)) .'</td>'
    										.'<td class="tr" align="center">'.$nrecibo .'</td>'
                                            .'<td class="tr" align="center">'.$nroexpediente .'</td>'
    										.'<td class="tr" align="center">'.$caja .'</td>'
    										.'<td class="tr" align="center">'.acentos($nombre).'</td>'
    										.'<td class="tr" align="center">'.number_format($monto,0,',','.').'</td>'
    										.'</tr>';
                                            
                                            $tt=$tt+$monto;
                                           
                                        }
                                        
                                        print '<tr>'
    										.'<td class="tr" align="center" colspan="6"><strong>TOTAL</strong></td>'
    								        .'<td class="tr" align="center" ><strong>'.number_format($tt,0,',','.').'</strong></td>'
    										.'</tr>';
                                            
                                        print '</table>';
                                        
                                        include("bitacora.php");
                                         $codopcx = "V_365";
                                         $fechaxx=date("Y-n-j", time());
                                         $hora=date("G:i:s",time());
                                         $accion="Reporte Perceptoria Homebanking XLS";
                                         $terminal = $_SERVER['REMOTE_ADDR'];
                                         $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal); 
    									// Fin grabacion de registro de auditoria*/
                                        //  FIN Rerporte Listado General XLS
    					 
    				 }
                     else
                     {
                        if ($tiporeporte==1 and $tipo ==1) // Rerporte Listado Detallado PDF
                        {
                            $html='<page backtop="60mm" backbottom="10mm" backleft="-5mm" backright="-5mm">
            					<page_header>
            				    <table style="width: 100%; border: none;">
									<tr>
										<td style="width: 50%; border: none;">
											<img src="images/logolcsp.png" width="100" height="100">
											 <br /><strong>MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</strong>                   
											 <br /><strong>SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</strong><br><br>                                
										</td>
									 </tr>
									 <tr>
										<td style="width: 100%; border: none;">
			
											<p align="center" width="100%" >INFORME DE TRANSACCIONES HOMEBANKING</p>
											
											<p style="font-weight:bold;font-size:0.7em;"><b> Considerando:</b> '.$subtit.'</p>
										</td>
									</tr>			
								</table>
            					</page_header>
                                
							    <page_footer>
								<table style="width: 100%; border: none;">
									<tr>
										<td style="text-align: right;">P&aacute;gina: [[page_cu]]/[[page_nb]]</td>
									</tr>
								</table>
							</page_footer>
							
                            <br><table width="629" border="1" align="center">
								  <tr>
									<th width="80" style="background-color: #EDF2F8; text-align:center;">Fecha</th>
                                    <th width="80" style="background-color: #EDF2F8; text-align:center;">Fecha de Carga</th>
                                    <th width="100" style="background-color: #EDF2F8; text-align:center;">Nro. Ticket</th>
                                    <th width="120" style="background-color: #EDF2F8; text-align:center;">Nro. Expediente</th>
									<th width="100" style="background-color: #EDF2F8; text-align:center;">Caja</th>
                                    <th width="250" style="background-color: #EDF2F8; text-align:center;">Proveedor</th>
                                     <th width="80" style="background-color: #EDF2F8; text-align:center;">C&oacute;digo</th>
                                    <th width="250" style="background-color: #EDF2F8; text-align:center;">Arancel</th>
									<th width="120" style="background-color: #EDF2F8; text-align:center;">Monto</th>
								  </tr>' ;
                                 
                                 $subtotal=0;
                                 $tt=0;
                                                              
								 while ($row = pg_fetch_array($res))              
                                 {
                                      $fecha      = $row['fecha'];
                                      $fechacarga      = $row['fechacarga'];
                                      $nrecibo     = $row['recibo']."-".$row['reciboser'];
                                      $nroexpediente = $row['nroexpediente'];
                                      $caja       = $row ['caja'];
                                      $empresa     = $row['codempresa'];
                                      $codarancel = $row ['arancel'];
                                      $monto       = $row['monto']; 
                                      
                                      $sqlempresa = pg_query($con,"select * from empresas ");
                      				  while($rowempresa = pg_fetch_array($sqlempresa)) 
                    				  {
                                        if($rowempresa['codempresa'] == $empresa)
                                        {
                                            $nombre= $rowempresa['razonsocial'];
                                        }
                                                                    
                    				  }
                                      $sqlcajas = pg_query($con,"select * from cajas ");
                      				  while($rowcajas = pg_fetch_array($sqlcajas)) 
                    				  {
                                        if($rowcajas['codcaja'] == $caja)
                                        {
                                            $nomcaja= $rowcajas['nomcaja'];
                                        }
                                                                    
                    				  }
                                      $sqlarancel = pg_query($con,"select * from aranceles ");
                      				  while($rowarancel = pg_fetch_array($sqlarancel)) 
                    				  {
                                        if($rowarancel['codarancel'] == $codarancel)
                                        {
                                            $nomarancel= $rowarancel['nomarancel'];
                                        }
                                                                    
                    				  }
                                      $html=$html.'<tr>'
                                      .'<td class="tr" width="80" >'.date("d/m/Y", strtotime($fecha)).'</td>'
                                      .'<td class="tr" width="80" >'.date("d/m/Y", strtotime($fechacarga)).'</td>'
                                      .'<td class="tr" align="center" width="100">'.$nrecibo.'</td>'
                                      .'<td class="tr" align="center" width="120">'.$nroexpediente.'</td>'
									  .'<td class="tr" align="center" width="100">'.$caja.'</td>'
									  .'<td class="tr" align="center" width="250">'.$nombre.'</td>'
                                      .'<td class="tr" align="center" width="80">'.$codarancel.'</td>'
                                      .'<td class="tr" align="center" width="250">'.$nomarancel.'</td>'
                                      .'<td class="tr" align="center" width="100">'.number_format($monto,0,',','.').'</td>'
                                      .'</tr>';
                                            
                                      $tt=$tt+$monto;
                                      
                                     
                                }
								
                                $html=$html.'<tr>'
								.'<td class="tr" align="center" colspan="8"><strong>TOTAL</strong></td>'
								.'<td class="tr" align="center" ><strong>'.number_format($tt,0,',','.').'</strong></td>'
								.'</tr>';
								
									 
								$html= $html.'</table>
                                </page>';
							
								ini_set("memory_limit","64M"); 
                                include_once('html2pdf/html2pdf.class.php');
                                $html2pdf = new HTML2PDF('L','Legal','es');
                                $html2pdf->pdf->SetDisplayMode('fullpage');
                                $html2pdf->WriteHTML($html);
                                $html2pdf->Output('homebanking.pdf');	 	      	
								
									// Bitacora
									
            			             include("bitacora.php");
                                     $codopcx = "V_365";
                                     $fechaxx=date("Y-n-j", time());
                                     $hora=date("G:i:s",time());
                                     $accion="Reporte Perceptoria Homebanking ";
                                     $terminal = $_SERVER['REMOTE_ADDR'];
                                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal); 
									// Fin grabacion de registro de auditoria*/
                            
                        }
                        else
                        {
                            if ($tiporeporte==2 and $tipo == 1)
                            {
                                header("Content-type: application/vnd-ms-excel;charset=ISO-8859-1");	
                                header('Content-Disposition: attachment; filename=result.xls');
                                header('Pragma: no-cache');
                                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                                header('Expires: 0');
    
                                print  '<table border=1>
                                       <tr><td style="font-weight:bold;font-size:1em" colspan="9" align="center"> hugooMINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</td></tr>
                                       <tr><td style="font-weight:bold;font-size:1em" colspan="9" align="center">SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</td></tr>
    	                               <tr><td style="font-weight:bold;font-size:1em" colspan="9" align="center">INFORME DE TRANSACCIONES HOMEBANKING</td></tr>
    	                               <td style="font-weight:bold;font-size:1em" colspan="9" align="center"><b>Considerando:</b>'.acentos($subtit).'</td>
    	                               </tr>';
    	                        
                           
                               print '<br><table border="1" align="center">
    		                     <tr><td width="80" style="background:#353F49; color:white;">Fecha</td>
    		                     <td width="80" style="background:#353F49; color:white;">Fecha de Carga</td>
                                 <td width="100" style="background:#353F49; color:white;">Nro de Ticket</td>
               		             <td width="120" style="background:#353F49; color:white;">Nro de Expediente </td>
                                 <td width="100" style="background:#353F49; color:white;">Caja </td>
                                 <td width="300" style="background:#353F49; color:white;">Proveedor </td>
                                  <td width="100" style="background:#353F49; color:white;">C&oacute;digo </td>
                                 <td width="300" style="background:#353F49; color:white;">Arancel </td>
                                 <td width="100" style="background:#353F49; color:white;">Monto </td>
               		             </tr>'; 
                                 
                                     $subtotal=0;
                                     $tt=0;
                                                                  
    								 while ($row = pg_fetch_array($res))              
                                     {
                                          $fecha      = $row['fecha'];
                                          $fechacarga      = $row['fechacarga'];
                                          $nrecibo     = $row['recibo']."-".$row['reciboser'];
                                          $nroexpediente = $row['nroexpediente'];
                                          $caja       = $row ['caja'];
                                          $empresa     = $row['codempresa'];
                                          $codarancel = $row ['arancel'];
                                          $monto       = $row['monto']; 
                                          
                                          $sqlempresa = pg_query($con,"select * from empresas ");
                          				  while($rowempresa = pg_fetch_array($sqlempresa)) 
                        				  {
                                            if($rowempresa['codempresa'] == $empresa)
                                            {
                                                $nombre= $rowempresa['razonsocial'];
                                            }
                                                                        
                        				  }
                                          $sqlcajas = pg_query($con,"select * from cajas ");
                          				  while($rowcajas = pg_fetch_array($sqlcajas)) 
                        				  {
                                            if($rowcajas['codcaja'] == $caja)
                                            {
                                                $nomcaja= $rowcajas['nomcaja'];
                                            }
                                                                        
                        				  }
                                          $sqlarancel = pg_query($con,"select * from aranceles ");
                          				  while($rowarancel = pg_fetch_array($sqlarancel)) 
                        				  {
                                            if($rowarancel['codarancel'] == $codarancel)
                                            {
                                                $nomarancel= $rowarancel['nomarancel'];
                                            }
                                                                        
                        				  }
                                          print '<tr>'
    										.'<td class="tr">'.date("d/m/Y", strtotime($fecha)) .'</td>'
                                            .'<td class="tr">'.date("d/m/Y", strtotime($fechacarga)) .'</td>'
    										.'<td class="tr" align="center">'.$nrecibo .'</td>'
                                            .'<td class="tr" align="center">'.$nroexpediente .'</td>'
    										.'<td class="tr" align="center">'.$caja .'</td>'
    										.'<td class="tr" align="center">'.acentos($nombre).'</td>'
                                            .'<td class="tr" align="center">'.$codarancel .'</td>'
    										.'<td class="tr" align="center">'.acentos($nomarancel).'</td>'
    										.'<td class="tr" align="center">'.number_format($monto,0,',','.').'</td>'
    										.'</tr>';
                                            
                                            $tt=$tt+$subtotal;
                                           
                                        }
                                        
                                        print '<tr>'
    										.'<td class="tr" align="center" colspan="8"><strong>TOTAL</strong></td>'
    								        .'<td class="tr" align="center" ><strong>'.number_format($tt,0,',','.').'</strong></td>'
    										.'</tr>';
                                            
                                        print '</table>';
                                        
                                        include("bitacora.php");
                                         $codopcx = "V_365";
                                         $fechaxx=date("Y-n-j", time());
                                         $hora=date("G:i:s",time());
                                         $accion="Reporte Perceptoria Homebanking XLS";
                                         $terminal = $_SERVER['REMOTE_ADDR'];
                                         $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal); 
    									// Fin grabacion de registro de auditoria*/ 
                            }
                        }
                     }
         }
                 
       }
     
     }
?>