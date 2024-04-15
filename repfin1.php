<?php
@Header("consaatent-type: text/html; charset=utf-8");
  
	$ok1="SI";
	$ok2="SI";
    $ok3="SI";
	
    if ($ok1=="SI" && $ok2=="SI" && $ok3=="SI")
    {
               $mensage=0;  // solo de relleno para no cambiar cosas

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
					  $condicion =" and r.fecha >='$ff1x'";
				   }
				  else
				   {
					  $condicion=$condicion." and r.fecha >='$ff1x'";
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
					  $condicion.=" and r.fecha <='$ff2x'";
				   }
				  else
				   {
					  $condicion.=" and r.fecha <='$ff2x'";
				   }
			  }
			   
			   if ($exone!="" && $cobrados=="")
               { 
				   $condicion .= " and r.nroexoner != '' and r.nrecibo = ''";
				  
				   if ($subtit=="")
				   {
						$subtit="Tipos: Exonerados";
				   }
				   else
				   {
					  $subtit=$subtit.", Tipos: Exonerados";
				   }
               }
			   $otro='nada';
			   if ($efectivo == 1) 
               { 
				   //$condicion .= " and  r.fpago = '$efectivo'";
				   $otro=" and (r.fpago = '$efectivo'";
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Efectivo";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Efectivo";
				   }
               }
			   
			    if ($cheque == 2) 
               { 
				   //$condicion .= " and  r.fpago = '$cheque'";
				   if($otro=='nada')
				     {
				     $otro=" and (r.fpago = '$cheque'";
					 }
				  else
				   	 {
				   	 $otro=$otro." or r.fpago = '$cheque'";	
				   	 }
				  
				  
				   if ($subtit=="")  
				   {
						$subtit="Forma de Pago: Cheque";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Cheque";
				   }
               }
			   
			   if ($tarjeta == 3) 
               { 
				   //$condicion .= " and  r.fpago = '$tarjeta'";
				  if($otro=='nada')
				     {
				     $otro=" and (r.fpago = '$tarjeta'";
					 }
				  else
				   	 {
				   	 $otro=$otro." or r.fpago = '$tarjeta'";	
				   	 }
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Tarjeta de Cr&eacute;dito";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Tarjeta de Cr&eacute;dito";
				   }
               }
			   
			   if ($tarjetad == 4) 
               { 
				  // $condicion .= " and  r.fpago = '$tarjetad'";
				  if($otro=='nada')
				     {
				     $otro=" and (r.fpago = '$tarjetad'";
					 }
				  else
				   	 {
				   	 $otro=$otro." or r.fpago = '$tarjetad'";	
				   	 }
				  
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Tarjeta de D&eacute;bito";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Tarjeta de D&eacute;bito";
				   }
               }
			   
			   if ($otros == 5) 
               { 
				   //$condicion .= " and  r.fpago = '$otros'";
				  if($otro=='nada')
				     {
				     $otro=" and (r.fpago = '$otros'";
					 }
				  else
				   	 {
				   	 $otro=$otro." or r.fpago = '$otros'";	
				   	 }
				  
				   if ($subtit=="")
				   {
						$subtit="Forma de Pago: Otros Casos";
				   }
				   else
				   {
					  $subtit=$subtit.", Forma de Pago: Otros Casos";
				   }
               }
			   
				  if($otro!='nada')
				     {
				   	 $otro=$otro.")";	
				   	 }
				  else
				     {
				     $otro="";	
				     }
				$condicion=$condicion.$otro;  
				  					   
			   
			   if ($codperce != "") 
               { 
				   $condicion .= " and  r.codperce = trim('$codperce')";
				   
				   if($codperce != "")
					{
						$sqlespec	= "select * from perceptores where codperce = trim('$codperce')";
						$tabespec 	=  pg_query($con, $sqlespec);
						$rowespec	=  pg_fetch_array($tabespec);
						$nomyape	=  $rowespec['nomyape'];
					}
					else
					{
						$nomyape = "";
					}
				  
				   if ($subtit=="") 
				   {
						$subtit="Preceptor: ".$nomyape;
				   }
				   else
				   {
					  $subtit=$subtit.", Preceptor: ".$nomyape;
				   }
               }
			   
			   if ($codarancel != "") 
               { 
				   $condicion .= " and  rd.codarancel = trim('$codarancel')";
				   
				   if($codarancel != "")
					{
						$sqlespec	= "select * from aranceles where codarancel = trim('$codarancel')";
						$tabespec 	=  pg_query($con, $sqlespec);
						$rowespec	=  pg_fetch_array($tabespec);
						$nomarancel	=  $rowespec['nomarancel'];
					}
					else
					{
						$nomarancel = "";
					}
				  
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
				$sql = "select r.nrecibo as nrecibo,
							   r.nserie as nserie,
							   r.recibide,
							   r.fecha as fecha,
							   r.hora,
							   r.fpago,
							   sum(rd.cantidad*rd.monto) as total
						from recibos r, recibodet rd
						where r.nrecibo = rd.nrecibo
						and   r.nserie  = rd.nserie 
						and   r.estado  = 1 ".$condicion.
						" group by r.nrecibo,
							   r.nserie,
							   r.recibide,
							   r.fecha,
							   r.hora,
							   r.fpago order by fecha, nserie, nrecibo";
							  
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
                   		if ($tiporeporte==1) // reporte PDF
                   	{
                 
                       $html='<page backtop="60mm" backbottom="10mm" backleft="-5mm" backright="-5mm">
							  <page_header>
								<table style="width: 100%; border: none;">
									<tr>
										<td style="width: 50%; border: none;">
											<img src="images/nuevologomsp.png"><img src="images/logolcsp.png" width="100" height="100">
											 <br /><strong>MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</strong>                   
											 <br /><strong>SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</strong><br><br>                                
										</td>
									 </tr>
									 <tr>
										<td style="width: 100%; border: none;">
			
											<p align="center" width="100%" >INFORME DE RENDICI&Oacute;N PERI&Oacute;DICA POR FORMA DE PAGO</p>
											
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
							</page_footer>';
							
							 $html.= '<br><table width="629" border="1" align="center">
								  <tr>
									<th width="103" style="background-color: #EDF2F8; text-align:center;">Nro. Recibo</th>
									<th width="184" style="background-color: #EDF2F8; text-align:center;">Usuario</th>
									<th width="58" style="background-color: #EDF2F8; text-align:center;">Fecha</th>
									<th width="55" style="background-color: #EDF2F8; text-align:center;">Hora</th>
									<th width="100" style="background-color: #EDF2F8; text-align:center;">Tipo de Pago</th>
									<th width="89" style="background-color: #EDF2F8; text-align:center;">Total</th>
								  </tr>'; 
						   
						   
								 $i=0;
								$tt=0;
								 while ($row = pg_fetch_array($res))
								  {			
									  $recibide  = $row['recibide']; 
									  $hora      = $row['hora'];
									  $fpago     = $row['fpago'];
									  $nrecibo   = $row['nrecibo'];
									  $nserie    = $row['nserie'];
									  $fecha     = $row['fecha'];
									  $total     = $row['total'];
									   $tt=$tt+$total;
									   if($fpago == 1)
									   {
										   $nomfpago = "Efectivo";
									   }
									   else
									   {
										   if($fpago == 2)
										   {
											   $nomfpago = "Cheque";
										   }
										   else
										   {
											   if($fpago == 3)
											   {
												   $nomfpago = "Tarjeta Cr&eacute;dito";
											   }
											   else
											   {
												   if($fpago == 4)
												   {
													   $nomfpago = "Tarjeta D&eacute;bito";
												   }
												   else
												   {
													   if($fpago == 5)
													   {
														   $nomfpago = "Otros casos";
													   } 
													   else
													   {
															$nomfpago = "---";   
													   }
												   }
											   }
										   }
									   }
			
									   $html.= '<tr>'
											.'<td class="tr" align="center">'.$nserie."-".$nrecibo.'</td>'
											.'<td class="tr">'.$recibide.'</td>'
											.'<td class="tr">'.date("d/m/Y", strtotime($fecha)).'</td>'
											.'<td class="tr" align="center">'.$hora.'</td>'
											.'<td class="tr" align="center">'.$nomfpago.'</td>'
											.'<td class="tr" align="right">'.number_format($total,0,',','.').'</td>'
											.'</tr>';
			
								  }
								
									   $html.= '<tr>'
											.'<td class="tr" align="center" colspan="5"><strong>TOTAL</strong></td>'
											.'<td class="tr" align="right"><strong>'.number_format($tt,0,',','.').'</strong></td>'
											.'</tr>';
								
									 
								$html.= '</table></page>';
							
								ini_set("memory_limit","64M"); 
								include_once('html2pdf/html2pdf.class.php');
								$html2pdf = new HTML2PDF('L','A3','es');
								$html2pdf->pdf->SetDisplayMode('fullpage');
								$html2pdf->WriteHTML($html);
								$html2pdf->Output('resultado.pdf');		 	      	
								
									// Bitacora
									
            			             include("bitacora.php");
                                     $codopcx = "V_365";
                                     $fechaxx=date("Y-n-j", time());
                                     $hora=date("G:i:s",time());
                                     $accion="Reporte Perceptoria Formulario 1 PDF";
                                     $terminal = $_SERVER['REMOTE_ADDR'];
                                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal); 
									// Fin grabacion de registro de auditoria
					 }  // FIN REPORTE PDF
					 
                     else 
					 {
						 if ($tiporeporte==2) // reporte EXCEL
						 {
							header("Content-type: application/vnd-ms-excel;charset=ISO-8859-1");	
							header('Content-Disposition: attachment; filename=result.xls');
							header('Pragma: no-cache');
							header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
							header('Expires: 0');

							print  '<table border=1>'
								  .'<tr><td style="font-weight:bold;font-size:1em" colspan="6" align="center">INFORME DE RENDICI&Oacute;N PERI&Oacute;DICA POR FORMA DE PAGO</td></tr>'
								  .'<tr>'
								  .'<td style="font-weight:bold;font-size:1em" colspan="6" align="center"><b>Considerando:</b> '.acentos($subtit).'<br /></td>'
								  .'</tr>';
						  
						  print '<br><table width="629" border="1" align="center">
								  <tr>
									<th width="103" style="background-color: #EDF2F8; text-align:center;">Nro. Recibo</th>
									<th width="184" style="background-color: #EDF2F8; text-align:center;">Usuario</th>
									<th width="58" style="background-color: #EDF2F8; text-align:center;">Fecha</th>
									<th width="55" style="background-color: #EDF2F8; text-align:center;">Hora</th>
									<th width="100" style="background-color: #EDF2F8; text-align:center;">Tipo de Pago</th>
									<th width="89" style="background-color: #EDF2F8; text-align:center;">Total</th>
								  </tr>'; 
								
						  $i=0;
						  $tt=0;
						  while ($row = pg_fetch_array($res))
						  {			
							  $recibide  = $row['recibide']; 
							  $hora      = $row['hora'];
							  $fpago     = $row['fpago'];
							  $nrecibo   = $row['nrecibo'];
							  $nserie    = $row['nserie'];
							  $fecha     = $row['fecha'];
							  $total     = $row['total'];
							   $tt=$tt+$total;
							   if($fpago == 1)
							   {
								   $nomfpago = "Efectivo";
							   }
							   else
							   {
								   if($fpago == 2)
								   {
									   $nomfpago = "Cheque";
								   }
								   else
								   {
									   if($fpago == 3)
									   {
										   $nomfpago = "Tarjeta Cr&eacute;dito";
									   }
									   else
									   {
										   if($fpago == 4)
										   {
											   $nomfpago = "Tarjeta D&eacute;bito";
										   }
										   else
										   {
											   if($fpago == 5)
											   {
												   $nomfpago = "Otros casos";
											   } 
											   else
											   {
													$nomfpago = "---";   
											   }
										   }
									   }
								   }
							   }
	
							   print '<tr>'
									.'<td class="tr" align="center">'.$nserie."-".$nrecibo.'</td>'
									.'<td class="tr" >'.$recibide.'</td>'
									.'<td class="tr">'.date("d/m/Y", strtotime($fecha)).'</td>'
									.'<td class="tr" align="center">'.$hora.'</td>'
									.'<td class="tr" align="center">'.$nomfpago.'</td>'
									.'<td class="tr" align="right">'.number_format($total,0,',','.').'</td>'
									.'</tr>';
	
						  }
						   print '<tr>'
								.'<td class="tr" align="center" colspan="5"><strong>TOTAL</strong></td>'
								.'<td class="tr" align="right"><strong>'.number_format($tt,0,',','.').'</strong></td>'
								.'</tr>';
						  
						   print '</table>';
						  
						  // Bitacora
						  
                                include("bitacora.php");
                                $codopcx = "V_365";
                                $fechaxx=date("Y-n-j", time());
                                $hora=date("G:i:s",time());
                                $accion="Reporte Perceptoria Formulario 1 XLS";
                                $terminal = $_SERVER['REMOTE_ADDR'];
                                $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);  
					  
							// Fin grabacion de registro de auditoria	
					   }	// FIN EXCEL

						  
					  }
				 }
			}
?>