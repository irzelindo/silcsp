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
					  $condicion.=" and ic.fecha between '$ff1x' and '$ff2x'";
				   }
				  else
				   {
					  $condicion.=$condicion." and ic.fecha between '$ff1x' and '$ff2x'";
				   }
			  }
			  if ($codservicio != "") 
               { 
                  $ok3="SI";
                  if ($condicion=="")
				   {
					  $condicion.=" and ic.codservicio = '$codservicio'";
				   }
				  else
				   {
					  $condicion.=$condicion." and ic.codservicio = '$codservicio'";
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
			 
			   if ($tipo == 1) 
               { 
				 
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Caja";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Caja";
				   }
                   if ($condicion=="")
				   {
					  $condicion.=" and ic.formapago between 1 and 5";
				   }
				  else
				   {
					  $condicion.=$condicion." and ic.formapago between 1 and 5";
				   }
               }
               else
               {
                    if ($tipo == 2) 
                    {
                           if ($subtit=="")
        				   {
        						$subtit="Forma de Pago: Home Banking";
        				   }
        				   else
        				   {
        					  $subtit=$subtit.", Forma de Pago: Home Banking";
        				   } 
                           if ($condicion=="")
        				   {
        					  $condicion.=" and ic.formapago = 6";
        				   }
        				  else
        				   {
        					  $condicion.=$condicion." and ic.formapago = 6";
        				   }  
                    }
                    else
                    {
                           if ($subtit=="")
        				   {
        						$subtit="Forma de Pago: Ambos";
        				   }
        				   else
        				   {
        					  $subtit=$subtit.", Forma de Pago: Ambos ";
        				   }
                    }
               }
			   
               if ($codempresa != "TODAS") 
               { 
                  if ($condicion=="")
				   {
					  $condicion.=" and ic.nropaciente = '$codempresa'";
				   }
				  else
				   {
					  $condicion.=$condicion." and  ic.nropaciente = '$codempresa'";
				   }
               }
               
               if ($codcaja != "TODAS") 
               { 
                  if ($condicion=="")
				   {
					  $condicion.=" and ic.codcaja = '$codcaja'";
				   }
				  else
				   {
					  $condicion.=$condicion." and  ic.codcaja = '$codcaja'";
				   }
               }
               
               if ($codarancel != "TODAS") 
               { 
                  if ($condicion=="")
				   {
					  $condicion.=" and r.codarancel = '$codarancel'";
				   }
				  else
				   {
					  $condicion.=$condicion." and r.codarancel = '$codarancel'";
				   }
               }

             	 // AQUI COMIENZA EL LISTADO PROPIAMENTE DICHO -----------------------------------------------------------
			if ($ok1 == "SI" and $ok2 == "SI" and $ok3 == "SI")
            {	
                  $sql = "select ic.nroingreso as ingreso,
							   ic.nrorecibo as recibo,
                               ic.nroreciboser as reciboser,
                               ic.fecha as fecha,
							   ic.estado as estado,
                               ic.codcaja as caja,
							   ic.formapago as formapago,
                               ic.nomyape as nombre,
                               ic.nropaciente as nropaciente,
                               r.norden as norden,
                               r.codarancel as arancel,
							   r.monto as monto,
                               r.cantidad as cantidad
						from ingresocaja ic, recibos r
						where ic.nroingreso = r.nroingreso
						and   ic.nrorecibo  = r.nrorecibo ".$condicion.
						"  order by fecha, recibo";  
                
							  
                 $res=pg_query($con, $sql);
                 $numeroRegistros=pg_num_rows($res); 
                    
                 
                 if ($numeroRegistros<=0)
                 {
                    echo "<div align='center'>";
                    echo "<font face='Times New Roman' size='4'>No se encontraron registros para esos valores </font>";
                    echo "</div>";  
                    echo "<br /><br />";
                 	print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
                                        
                 }
                 else
                 {
                   		if ($tiporeporte==1) // reporte PDF Empresa Unica
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
			
											<p align="center" width="100%" >INFORME DE RECIBOS POR ARANCEL DE CAJA</p>
											
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
									<th width="70" style="background-color: #EDF2F8; text-align:center;">Fecha</th>
                                    <th width="100" style="background-color: #EDF2F8; text-align:center;">Nro. Recibo</th>
                                    <th width="70" style="background-color: #EDF2F8; text-align:center;">Caja</th>
                                    <th width="180" style="background-color: #EDF2F8; text-align:center;">Empresa</th>
									<th width="70" style="background-color: #EDF2F8; text-align:center;">C&oacute;digo</th>
                                    <th width="200" style="background-color: #EDF2F8; text-align:center;">Arancel</th>
									<th width="100" style="background-color: #EDF2F8; text-align:center;">Monto</th>
									<th width="50" style="background-color: #EDF2F8; text-align:center;">Cantidad</th>
				                    <th width="100" style="background-color: #EDF2F8; text-align:center;">Forma de Pago</th>
                                    <th width="100" style="background-color: #EDF2F8; text-align:center;">Estado</th>
                                    <th width="100" style="background-color: #EDF2F8; text-align:center;">Sub Total</th>
								  </tr>' ;
                                 
                                 $subtotal=0;
                                 $tt=0;
                                                              
								 while ($row = pg_fetch_array($res))              
                                 {
                                      $caja       = $row ['caja'];
                                      $fecha      = $row['fecha'];
                                      $nrecibo     = $row['recibo']."-".$row['reciboser'];
                                      $empresa     = $row['nombre'];
                                      $codigo      = $row['arancel'];
									  $monto       = $row['monto']; 
                                      $cantidad    = $row['cantidad']; 
                                      $fpago       = $row['formapago'];
									  $estado      = $row['estado']; 
									  $nropaciente = $row['nropaciente'];
									 
									  if($empresa == '')
									  {
										  	$querye = "select * from empresas where codempresa = '$nropaciente' ";
											$resulte = pg_query($con,$querye);

											$rowe = pg_fetch_assoc($resulte);

											$empresa = $rowe["razonsocial"];
									  }


                                      
                                      if($fpago == 6)
                                      {
                                           $formapago= "Home Banking";
                                           $subtotal = $monto*$cantidad;
									  }
								      else
							          {
 										   $formapago = "Caja";
                                           $subtotal = $monto*$cantidad;
  									   }   
                                      
                                      if ($estado == 1)
                                      {
                                        $estado2="Vigente";
                                      }
                                      else
                                      {
                                        if ($estado == 3)
                                        {
                                          $estado2="Impreso";  
                                        }
                                        else
                                        {
                                          $estado2="Anulado";
                                          $subtotal = 0;   
                                        }
                                        
                                      }
                                      
                                      $sqlarancel = pg_query($con,"select * from aranceles ");
                      				  while($rowarancel = pg_fetch_array($sqlarancel)) 
                    				  {
                                        if($rowarancel['codarancel'] == $codigo)
                                        {
                                            $nomarancel= $rowarancel['nomarancel'];
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
                                      .'<td class="tr" width="70" >'.date("d/m/Y", strtotime($fecha)).'</td>'
                                      .'<td class="tr" align="center" width="100">'.$nrecibo.'</td>'
                                      .'<td class="tr" align="center" width="100">'.$nomcaja.'</td>'
									  .'<td class="tr" align="left" width="180">'.$empresa.'</td>'
									  .'<td class="tr" align="center" width="70">'.$codigo.'</td>'
                                      .'<td class="tr" align="left" width="200">'.$nomarancel.'</td>'
                                      .'<td class="tr" align="center" width="100">'.number_format($monto,0,',','.').'</td>'
									  .'<td class="tr" align="center" width="50">'.$cantidad.'</td>'
                                      .'<td class="tr" align="center" width="100">'.$formapago.'</td>'
                                      .'<td class="tr" align="center" width="100">'.$estado2.'</td>'
                                      .'<td class="tr" align="center" width="100">'.number_format($subtotal,0,',','.').'</td>'
                                      .'</tr>';
                                            
                                      $tt=$tt+$subtotal;
                                      
                                     
                                }
								
                                $html=$html.'<tr>'
								.'<td class="tr" align="center" colspan="10"><strong>TOTAL</strong></td>'
								.'<td class="tr" align="right" ><strong>'.number_format($tt,0,',','.').'</strong></td>'
								.'</tr>';
								
									 
								$html= $html.'</table>
                                </page>';
							
								ini_set("memory_limit","64M"); 
                                include_once('html2pdf/html2pdf.class.php');
                                $html2pdf = new HTML2PDF('L','Legal','es');
                                $html2pdf->pdf->SetDisplayMode('fullpage');
                                $html2pdf->WriteHTML($html);
                                $html2pdf->Output('recibos.pdf');	 	      	
								
									// Bitacora
									
            			             include("bitacora.php");
                                     $codopcx = "V_365";
                                     $fechaxx=date("Y-n-j", time());
                                     $hora=date("G:i:s",time());
                                     $accion="Reporte Perceptoria Recibo de Caja";
                                     $terminal = $_SERVER['REMOTE_ADDR'];
                                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal); 
									// Fin grabacion de registro de auditoria*/
					 }  // FIN REPORTE PDF Empresa Unica
                     
                     else
                     {
                        header("Content-type: application/vnd-ms-excel;charset=ISO-8859-1");	
                            header('Content-Disposition: attachment; filename=result.xls');
                            header('Pragma: no-cache');
                            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                            header('Expires: 0');

                            print  '<table border=1>
                                   <tr><td style="font-weight:bold;font-size:1em" colspan="11" align="center">MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</td></tr>
                                   <tr><td style="font-weight:bold;font-size:1em" colspan="11" align="center">SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</td></tr>
	                               <tr><td style="font-weight:bold;font-size:1em" colspan="11" align="center">INFORME DE RECIBOS POR ARANCEL DE CAJA</td></tr>
	                               <td style="font-weight:bold;font-size:1em" colspan="11" align="center"><b>Considerando:</b>'.acentos($subtit).'</td>
	                               </tr>';
	                        
                       
                           print '<br><table border="1" align="center">
		                     <tr><td width="70" style="background:#353F49; color:white;">Fecha</td>
		                     <td width="100" style="background:#353F49; color:white;">Nro. de Recibo</td>
                             <td width="70" style="background:#353F49; color:white;">Caja</td>
           		             <td width="180" style="background:#353F49; color:white;">Empresa </td>
                             <td width="70" style="background:#353F49; color:white;">C&oacute;digo </td>
                             <td width="200" style="background:#353F49; color:white;">Arancel </td>
                             <td width="100" style="background:#353F49; color:white;">Monto </td>
                             <td width="50" style="background:#353F49; color:white;">Cantidad</td>
                             <td width="100" style="background:#353F49; color:white;">Forma de Pago</td>
                             <td width="100" style="background:#353F49; color:white;">Estado</td>
                             <td width="100" style="background:#353F49; color:white;">Sub Total</td>
                             
           		             </tr>'; 
                             
                                 $subtotal=0;
                                 $tt=0;
                                                              
								 while ($row = pg_fetch_array($res))              
                                 {
                                      $caja       = $row ['caja'];
                                      $fecha      = $row['fecha'];
                                      $nrecibo     = $row['recibo']."-".$row['reciboser'];
                                      $empresa     = $row['nombre'];
                                      $codigo        = $row['arancel'];
									  $monto       = $row['monto']; 
                                      $cantidad       = $row['cantidad']; 
                                      $fpago       = $row['formapago'];
									  $estado      = $row['estado']; 
									  $nropaciente = $row['nropaciente'];
									 
									  if($empresa == '')
									  {
										  	$querye = "select * from empresas where codempresa = '$nropaciente' ";
											$resulte = pg_query($con,$querye);

											$rowe = pg_fetch_assoc($resulte);

											$empresa = $rowe["razonsocial"];
									  }
                                      
                                      if($fpago == 6)
                                      {
                                           $formapago= "Home Banking";
                                           $subtotal = $monto*$cantidad;
									  }
								      else
							          {
 										   $formapago = "Caja";
                                           $subtotal = $monto*$cantidad;
  									   }   
                                      
                                      if ($estado == 1)
                                      {
                                        $estado2="Vigente";
                                      }
                                      else
                                      {
                                        if ($estado == 3)
                                        {
                                          $estado2="Impreso";  
                                        }
                                        else
                                        {
                                          $estado2="Anulado";
                                          $subtotal = 0;   
                                        }
                                        
                                      }
                                      
                                      $sqlarancel = pg_query($con,"select * from aranceles ");
                      				  while($rowarancel = pg_fetch_array($sqlarancel)) 
                    				  {
                                        if($rowarancel['codarancel'] == $codigo)
                                        {
                                            $nomarancel= $rowarancel['nomarancel'];
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
										.'<td class="tr" align="center">'.$nrecibo .'</td>'
                                        .'<td class="tr" align="center">'.$nomcaja .'</td>'
										.'<td class="tr" align="center">'.$empresa .'</td>'
										.'<td class="tr" align="center">'.$codigo .'</td>'
										.'<td class="tr" align="center">'.acentos($nomarancel) .'</td>'
										.'<td class="tr" align="center">'.number_format($monto,0,',','.').'</td>'
										.'<td class="tr" align="center">'.$cantidad .'</td>'
										.'<td class="tr" align="center">'.$formapago .'</td>'
										.'<td class="tr" align="center">'.$estado2 .'</td>'
                                        .'<td class="tr" align="center">'.number_format($subtotal,0,',','.').'</td>'
										.'</tr>';
                                        
                                        $tt=$tt+$subtotal;
                                       
                                    }
                                    
                                    print '<tr>'
										.'<td class="tr" align="center" colspan="10"><strong>TOTAL</strong></td>'
								        .'<td class="tr" align="right" ><strong>'.number_format($tt,0,',','.').'</strong></td>'
										.'</tr>';
                                        
                                    print '</table>';
                                    
                                    include("bitacora.php");
                                     $codopcx = "V_365";
                                     $fechaxx=date("Y-n-j", time());
                                     $hora=date("G:i:s",time());
                                     $accion="Reporte Perceptoria Recibo de Caja XLS";
                                     $terminal = $_SERVER['REMOTE_ADDR'];
                                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal); 
									// Fin grabacion de registro de auditoria*/
					 
				 }
       }
     
     }
?>