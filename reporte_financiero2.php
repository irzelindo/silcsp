<?php
@Header("consaatent-type: text/html; charset=utf-8");
 
$nomyape1 = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
include("bitacora.php");

include("numerosALetras.class.php");

$con=Conectarse();

$elusuario=$apellido.", ".$nombre;

function acentos($cadena) 
{
   $search = explode(",","Ã,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,Ã‘,Ã,ü");
   $replace = explode(",","Í,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,Ñ,Á,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);
 
   return $cadena;
}


$reporte=trim($_POST['reporte']);
$tiporeporte=$_POST['tiporeporte'];
$codservicio=$_POST['codservicio'];
$codigo_usu=$_POST['codigo_usu'];
$codcaja=$_POST['codcaja'];
$reporte=$_POST['reporte'];
$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];
$pagos=$_POST['pagos'];
$codarancel=$_POST['codarancel'];

$f1=trim($fecha1);
$an1=1*substr($f1,0,4);
$me1=1*substr($f1,5,2);
$di1=1*substr($f1,8,2);

$f2=trim($fecha2);
$an2=1*substr($f2,0,4);
$me2=1*substr($f2,5,2);
$di2=1*substr($f2,8,2);



if ($reporte=="" )
    {
    echo "<div align='center'>";
    echo "<font face='Times New Roman' size='4'>Debe Seleccionar una Tabla de la lista presentada</font>";
    echo "</div>";    	
    echo "<br /><br />";
	print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';  
    }
else
   {
               $condicion="";
               $subtit="";
			   
			   if ($di1!="" && $me1!="" && $an1!="")
			   {
				   if (checkdate($me1,$di1,$an1))
				   {
					  if ($di1<10)
					  {
						  $di1="0".$di1;
					  }
					  
					  if ($me1<10)
					  {
						  $me1="0".$me1;
					  }
					  
					  if ($an1<100)
					  {
						  $an1=2000+$an1;
					  }
					  
					  if ($an1<1000)
					  {
						  $an1=1990;
					  }
					  
					  $ff1=$di1."/".$me1."/".$an1;
					  $ff1x=$an1."-".$me1."-".$di1;
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
			   
			   if ($di2!="" && $me2!="" && $an2!="") 
			   {
				   if (checkdate($me2,$di2,$an2))
				   {
				       if ($di2<10)
					   {
							$di2="0".$di2;
					   }
				   	   
					   if ($me2<10)
					   {
					   		$me2="0".$me2;
					   }
				   
				   	   if ($an2<100)
					   {
					   		$an2=2000+$an2;
					   }
				   
				   	   if ($an2<1000)
					   {
					   		$an2=1990;
					   }
					   
					   $ff2=$di2."/".$me2."/".$an2;
					   $ff2x=$an2."-".$me2."-".$di2;
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
			  
			  if($ff1 != "")
			  {
				  if ($subtit=="")
				   {
					  $subtit="Desde Fecha: ".$ff1;
				   }
				  else
				   {
					  $subtit=$subtit.", Desde Fecha: ".$ff1;
				   }
				   
				   if ($condicion=="")
				   {
					  $condicion =" and ic.fecha >='$ff1x'";
				   }
				  else
				   {
					  $condicion=$condicion." and ic.fecha >='$ff1x'";
				   }
			  }

			  if($ff2 != "")
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
					  $condicion =" and ic.fecha <='$ff2x'";
				   }
				  else
				   {
					  $condicion= $condicion." and ic.fecha <='$ff2x'";
				   }
			  }
			  
			   if ($pagos == 1) 
               { 
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Efectivo";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Efectivo";
				   }
                   if ($condicion=="")
				   {
					  $condicion =" and ic.formapago ='$pagos'";
				   }
				  else
				   {
					  $condicion= $condicion." and ic.formapago ='$pagos'";
				   }
                   
               }
               if ($pagos == 2) 
               { 
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Cheque";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Cheque";
				   }
                   if ($condicion=="")
				   {
					  $condicion =" and ic.formapago ='$pagos'";
				   }
				  else
				   {
					  $condicion= $condicion." and ic.formapago ='$pagos'";
				   }
                   
               }
			   
				if ($pagos == 3) 
               { 
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Tarjeta de Credito";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Tarjeta de Credito";
				   }
                   if ($condicion=="")
				   {
					  $condicion =" and ic.formapago ='$pagos'";
				   }
				  else
				   {
					  $condicion= $condicion." and ic.formapago ='$pagos'";
				   }
                   
               }  					   
			   if ($pagos == 4) 
               { 
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Tarjeta de Debito";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Tarjeta de Debito";
				   }
                   if ($condicion=="")
				   {
					  $condicion =" and ic.formapago ='$pagos'";
				   }
				  else
				   {
					  $condicion= $condicion." and ic.formapago ='$pagos'";
				   }
                   
               }  
               if ($pagos == 5) 
               { 
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: HomeBanking";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: HomeBanking";
				   }
                   if ($condicion=="")
				   {
					  $condicion =" and ic.formapago ='$pagos'";
				   }
				  else
				   {
					  $condicion= $condicion." and ic.formapago ='$pagos'";
				   }
                   
               }
               if ($pagos == 6) 
               { 
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Otros casos";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Otros casos";
				   }
                   if ($condicion=="")
				   {
					  $condicion =" and ic.formapago ='$pagos'";
				   }
				  else
				   {
					  $condicion= $condicion." and ic.formapago ='$pagos'";
				   }
                   
               } 
               if ($pagos == "TODAS") 
               { 
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: TODAS";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: TODAS";
				   }
                   
               }				
			   if ($codcaja != "TODAS") 
               { 
				   $condicion= $condicion." and  ic.codcaja = '$codcaja' ";
				   
						$sqlespec	= "select * from usuarios where codusu = trim('$codigo_usu')";
						$tabespec 	=  pg_query($con, $sqlespec);
						$rowespec	=  pg_fetch_array($tabespec);
						$nomyape	=  $rowespec['nomyape'];
					
				  
				   if ($subtit=="")
				   {
						$subtit="Perceptor: ".$nomyape;
				   }
				   else
				   {
					  $subtit=$subtit.", Perceptor: ".$nomyape;
				   }
               }
               else
               {
                     if ($subtit=="")
				   {
						$subtit="Perceptor: TODAS";
				   }
				   else
				   {
					  $subtit=$subtit.", Perceptor: TODAS";
				   }
               }
			   
			   if ($codarancel != "TODAS") 
               { 
				   $condicion .= " and  r.codarancel = '$codarancel'";
				   
					$sqlespec	= "select * from aranceles where codarancel = '$codarancel'";
					$tabespec 	=  pg_query($con, $sqlespec);
					$rowespec	=  pg_fetch_array($tabespec);
					$nomarancel	=  $rowespec['nomarancel'];
				  
				   if ($subtit=="")
				   {
						$subtit="Arancel: ".$nomarancel;
				   }
				   else
				   {
					  $subtit=$subtit.", Arancel: ".$nomarancel;
				   }
               }
			   

             	 // AQUI COMIENZA EL LISTADO PROPIAMENTE DICHO -----------------------------------------------------------
				 
				 $sql 	= "select  ic.fecha as fecha,
                                   ic.nrorecibo as recibo,
                                   ic.nroreciboser as serie,
                                   ic.formapago as formapago,
                                   ic.estado as estado,
                                   ic.codcaja as codcaja,
                                   ic.codusu as codusu,
								   r.monto*r.cantidad as monto,
                                   r.codarancel as codarancel
						  from ingresocaja ic, recibos r
						  where ic.nroingreso  = r.nroingreso
						  and   ic.nrorecibo = r.nrorecibo
						  and   ic.nroreciboser  = r.nroreciboser ".$condicion.
						  "order by fecha, recibo";
							  
				$res	  =  pg_query($con, $sql);
				$numrecibo= pg_num_rows($res); 
                
           if ($numrecibo<=0)
           {
                    echo "<div align='center'>";
                    echo "<font face='Times New Roman' size='4'>No se encontraron registros para esos valores</font>";
                    echo "</div>";    	
                    echo "<br /><br />";
	                print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
           }
           else
           {
               if ($reporte=="repfin1" )
                {
                    $html='<page backtop="60mm" backbottom="10mm" backleft="-5mm" backright="-5mm">
							  <page_header>
								<table style="width: 100%; border: none;">
									<tr>
										<td style="width: 50%; border: none;">
											<img src="images/images1.jpg" width="100" height="100">
											 <br /><strong>MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</strong>                   
											 <br /><strong>SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</strong><br><br>                                
										</td>
									 </tr>
									 <tr>
										<td style="width: 100%; border: none;">
			
											<p align="center" width="100%" >INFORME FINANCIERO – RENDICI&Oacute;N DE RECIBOS DE INGRESOS POR COBRO DE ARANCELES</p>
											
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
							
							   <br><table width="817" border="1" align="center">
								  <tr>
								    <th width="103" rowspan="2" style="background-color: #EDF2F8; text-align:center;">Fecha de Recaudaci&oacute;n</th>
								    <th colspan="2" style="background-color: #EDF2F8; text-align:center;">N&Uacute;MERO DE RECIBOS UTILIZADOS POR D&Iacute;A</th>
								    <th width="127" rowspan="2" style="background-color: #EDF2F8; text-align:center;">GS. IMPORTE DIARIO.</th>
								    <th width="122" rowspan="2" style="background-color: #EDF2F8; text-align:center;">N&Uacute;MERO DE RECIBOS ANULADOS</th>
                                  </tr>
								  <tr>
									<th width="91" style="background-color: #EDF2F8; text-align:center;">DESDE</th>
									<th width="96" style="background-color: #EDF2F8; text-align:center;">HASTA</th>
							     </tr>';  
						   
								 $subtotal = 0;
                                 $total = 0;
                                 $fechax = "";
                                 $desde = "";
                                 $anulados = "";
                                 $homebanking = "";
					    
						  while ($row = pg_fetch_array($res))
						  {			
							  $fecha  = $row['fecha'];
                               
							  if ($fecha == $fechax || $fechax == "")
                              {
                                $fechax= $fecha;
                                if ($desde == "")
                                {
                                    $desde = $row ['recibo']."-".$row['serie'];
                                }
                                $hasta = $row ['recibo']."-".$row['serie'];
                                
                                if ($estado != 2)
                                {
                                   $monto  = $row['monto'];
                                   $subtotal  = $subtotal + $monto; 
                                }
                                else
                                {
                                    $anulados = $anulados.$row ['recibo']."-".$row['serie']." ,";
                                }
                                $formapago  = $row['formapago'];
                               
                                if ($formapago == 6)
                                {
                                    $homebanking = $homebanking.$row ['recibo']."-".$row['serie'].", ";
                                }
                                
                              } 
                              else
                              {
                                  if($anulados == "")
    							  {
    								  $anulados = "-------";
    							  }
    	
    							   $html=$html.'<tr>'
    									.'<td class="tr" align="center">'.date("d/m/Y", strtotime($fechax)).'</td>'
    									.'<td class="tr" align="center">'.$desde.'</td>'
    									.'<td class="tr" align="center">'.$hasta.'</td>'
    									.'<td class="tr" align="center">'.number_format($subtotal,0,';','.').'</td>'
    									.'<td class="tr" align="center">'.$anulados.'</td>'
    									.'</tr>';
                                      $total = $total + $subtotal;  
                                      
                                      $anulados = "";
                                      $subtotal = "";
                                      $fechax= $fecha;
        							  $desde = $row ['recibo']."-".$row['serie'];
                                      $hasta = $row ['recibo']."-".$row['serie'];
                                      if ($estado != 2)
                                        {
                                           $monto  = $row['monto'];
                                           $subtotal  = $subtotal + $monto; 
                                        }
                                      else
                                        {
                                            $anulados = $anulados.$row ['recibo']."-".$row['serie']." ,";
                                        }
                                      $formapago  = $row['formapago'];  
                                      if ($formapago == 6)
                                        {
                                            $homebanking = $homebanking.$row ['recibo']."-".$row['serie'].", ";
                                        }    
                                
                              } // fin de if
        
         
						  } // fin de while
                          
                          $total = $total + $subtotal;
                          if($anulados == "")
    							  {
    								  $anulados = "-------";
    							  }
                          $html=$html.'<tr>'
    									.'<td class="tr" align="center">'.date("d/m/Y", strtotime($fechax)).'</td>'
    									.'<td class="tr" align="center">'.$desde.'</td>'
    									.'<td class="tr" align="center">'.$hasta.'</td>'
    									.'<td class="tr" align="center">'.number_format($subtotal,0,';','.').'</td>'
    									.'<td class="tr" align="center">'.$anulados.'</td>'
    									.'</tr>';
						  
						  $html= $html.'<tr>'
								.'<td colspan="3" style="text-align: center; font-weight:bold; border:0px none;" class="tr">Total</td>'
								.'<td style="text-align: center; font-weight:bold;" class="tr">'.number_format($total,0,';','.').'</td>'
								.'<td colspan="1" style="text-align: center; border:0px none;">&nbsp;</td>'
							.'</tr>
							<tr>
								<td colspan="7" style=" text-align:left; font-weight:bold; border:0px none; font-size:12px">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="7" style=" text-align:left; font-weight:bold; border:0px none; font-size:12px">'.'SON GUARANIES: '.numtoletras($total).'</td>
							</tr>
                            <tr>
								<td colspan="7" style=" text-align:left; font-weight:bold; border:0px none; font-size:12px">'.'PAGOS POR HOMEBANKING: '.$homebanking.'</td>
							</tr>';
									
						$html= $html.'</table>
                                </page>';
							
								ini_set("memory_limit","64M"); 
                                include_once('html2pdf/html2pdf.class.php');
                                $html2pdf = new HTML2PDF('L','Legal','es');
                                $html2pdf->pdf->SetDisplayMode('fullpage');
                                $html2pdf->WriteHTML($html);
                                $html2pdf->Output('form1.pdf');	 	      	
								
									// Bitacora
									
									$codusu = $_SESSION["codusu"];
									$codopc = "V_";
									$fecha=date("Y-n-j", time());
									$hora=date("G:i:s",time());
									$accion="Reporte Autenticaciones - PDF: INFORME FINANCIERO – RENDICION DE RECIBOS DE INGRESOS POR COBRO DE ARANCELES";
									$terminal = $_SERVER['REMOTE_ADDR'];
									$result=pg_query($con, "INSERT INTO bitacora(codusu, codopc, fecha, hora, accion, terminal) VALUES ('$codusu', '$codopc', '$fecha', '$hora', '$accion', '$terminal')"); 
									// Fin grabacion de registro de auditoria		
                }
           }
   }  
?>