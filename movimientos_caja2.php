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
$estado = $_POST['estado'];
$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
$tipo = $_POST['tipo'];
$tiporeporte = $_POST['tiporeporte'];


function acentos($cadena) 
{
   $search = explode(",","Í,?,?,?,?,?,?,?,?,?,?,?,?,á,é,í,ó,ú,ñ,?á,?é,?í,?ó,?ú,?ñ,Ó,? ,É,? ,Ú,“,? ,¿,Ñ,Á,?");
   $replace = explode(",","?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,\",\",?,?,?,&uuml;");
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
					  print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
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
					 print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
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
				  
				   if ($condicion=="")
				   {
					  $condicion =" ic.fecha >='$ff1x'";
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
					  $condicion = " ic.fecha <='$ff2x'";
				   }
				  else
				   {
					  $condicion.=" and ic.fecha <='$ff2x'";
				   }
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
					  $condicion = " and ic.formapago between 1 and 5";
				   }
				  else
				   {
					  $condicion.=" and ic.formapago between 1 and 5";
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
        					  $condicion = " and ic.formapago = 6";
        				   }
        				  else
        				   {
        					  $condicion.=" and ic.formapago = 6";
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
					  $condicion =" and ic.nropaciente = '$codempresa'";
				   }
				  else
				   {
					  $condicion.= " and  ic.nropaciente = '$codempresa'";
				   }
               }
               
               if ($codservicio != "") 
               { 
                  $ok3="SI";
                  if ($condicion=="")
				   {
					  $condicion =" and ic.codservicio = '$codservicio'";
				   }
				  else
				   {
					  $condicion.= " and ic.codservicio = '$codservicio'";
				   }
               }
               else
               {
                      $ok3 = "NO";
                      echo "<div align='center'>";
					  echo "<font face='Times New Roman' size='4'>Debe Indicar el Establecimiento </font>";
					  echo "</div>";    	
					  echo "<br /><br />";
					  print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
               }
               
               if ($codcaja != "TODAS") 
               { 
                  if ($condicion=="")
				   {
					  $condicion =" and ic.codcaja = '$codcaja'";
				   }
				  else
				   {
					  $condicion.= " and ic.codcaja = '$codcaja'";
				   }
               }
               
               if ($estado == 1) 
               { 
				 
				   if ($condicion=="")
				   {
					  $condicion =" and ic.estado = 1";
				   }
				  else
				   {
					  $condicion.= " and ic.estado = 1";
				   }
               }
               else
               {
                    if ($estado == 2) 
                    {
                           if ($condicion=="")
        				   {
        					  $condicion =" and ic.estado = 2";
        				   }
        				  else
        				   {
        					  $condicion.= " and ic.estado = 2";
        				   }  
                    }
                    
               }

             	 // AQUI COMIENZA EL LISTADO PROPIAMENTE DICHO -----------------------------------------------------------
            if ($ok1 == "SI" and $ok2 == "SI" and $ok3 == "SI")
            {
                  $sql = "select ic.fecha as fecha,
							   ic.codcaja as caja,
							   ic.nrorecibo||'-'||ic.nroreciboser as recibo,
                               ic.nomyape as nombre,
							   ic.estado as estado,
                               coalesce(sum(CASE WHEN ic.formapago !=6 THEN r.monto*r.cantidad END),0) porcaja,
							   coalesce(sum(CASE WHEN ic.formapago =6 THEN r.monto*r.cantidad END),0) porhome,
							   coalesce(sum(CASE WHEN ic.estado != 2 THEN r.monto*r.cantidad END),0) total
						from ingresocaja ic
						FULL JOIN recibos r
						ON    ic.nroingreso   = r.nroingreso
						AND   ic.nrorecibo    = r.nrorecibo
						AND   ic.nroreciboser = r.nroreciboser
						where ".$condicion."
						group by ic.fecha,
								ic.codcaja,
							   ic.nrorecibo||'-'||ic.nroreciboser,
                               ic.nomyape,
							   ic.estado
						order by fecha, recibo";  
                
							  
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
                   		if ($tiporeporte==1 && $codempresa != "TODAS") // reporte PDF Empresa Unica
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
			
											<p align="center" width="100%" >INFORME DE MOVIMIENTOS DE CAJA</p>
											
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
                                    <th width="100" style="background-color: #EDF2F8; text-align:center;">Caja</th>
                                    <th width="120" style="background-color: #EDF2F8; text-align:center;">Nro. Recibo</th>
									<th width="200" style="background-color: #EDF2F8; text-align:center;">Empresa</th>
                                    <th width="70" style="background-color: #EDF2F8; text-align:center;">Estado</th>
									<th width="100" style="background-color: #EDF2F8; text-align:center;">Por Caja</th>
									<th width="100" style="background-color: #EDF2F8; text-align:center;">Por Home Banking</th>
				                    <th width="100" style="background-color: #EDF2F8; text-align:center;">Total</th>
								  </tr>' ;
   						
         				        $i=0;
                                
                                while ($row = pg_fetch_array($res))
							     {	
								      
                                      $fecha      = $row['fecha'];
                                      $empresa    = $row['nombre'];
                                      $caja       = $row['caja'];
									  $nrecibo    = $row['recibo'];
							          $porhome    = $row['porhome'];
                                      $porcaja    = $row['porcaja'];
									  $total      = $row['total'];
									  $estado     = $row['estado'];
									
									
									  if ($estado == 1)
                                      {
                                        $estadox = "Vigente";
                                      }
                                      else
                                      {
                                          if ($estado == 2)
										  {
											$estadox = "Anulado";
											$monto = 0;
										  }
										  else
										  {
											$estadox = "Impreso";
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
                                      .'<td class="tr">'.date("d/m/Y", strtotime($fecha)).'</td>'
                                      .'<td class="tr" align="center">'.$nomcaja.'</td>'
									  .'<td class="tr" align="center">'.$nrecibo.'</td>'
									  .'<td class="tr" align="center">'.$empresa.'</td>'
                                      .'<td class="tr" align="center">'.$estadox.'</td>'
									  .'<td class="tr" align="center">'.number_format($porcaja,0,',','.').'</td>'
									  .'<td class="tr" align="center">'.number_format($porhome,0,',','.').'</td>'
									  .'<td class="tr" align="right">'.number_format($total,0,',','.').'</td>'
                                      .'</tr>';
									  
									  if ($estado != 2)
								      {
									  	$tt=$tt+$total;
                                      	$ttcaja=$ttcaja+$porcaja;
                                      	$tthb=$tthb+$porhome;
									  }
                                  }
							
								$html=$html.'<tr>'
								.'<td class="tr" align="center" colspan="5"><strong>TOTAL</strong></td>'
                                .'<td class="tr" align="center" ><strong>'.number_format($ttcaja,0,',','.').'</strong></td>'
                                .'<td class="tr" align="center" ><strong>'.number_format($tthb,0,',','.').'</strong></td>'
								.'<td class="tr" align="right" ><strong>'.number_format($tt,0,',','.').'</strong></td>'
								.'</tr></table></page>';
							
								ini_set("memory_limit","64M"); 
                                include_once('html2pdf/html2pdf.class.php');
                                $html2pdf = new HTML2PDF('L','Legal','es');
                                $html2pdf->pdf->SetDisplayMode('fullpage');
                                $html2pdf->WriteHTML($html);
                                $html2pdf->Output('movimientos.pdf');	 	      	
								
									// Bitacora
									
            			             include("bitacora.php");
                                     $codopcx = "V_365";
                                     $fechaxx=date("Y-n-j", time());
                                     $hora=date("G:i:s",time());
                                     $accion="Reporte Perceptoria Movimiento de Caja";
                                     $terminal = $_SERVER['REMOTE_ADDR'];
                                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal); 
									// Fin grabacion de registro de auditoria*/
					 }  // FIN REPORTE PDF Empresa Unica
                     else
                     {
                        // Reporte Todas las Empresas
                        
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
			
											<p align="center" width="100%" >INFORME DE MOVIMIENTOS DE CAJA</p>
											
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
                                    <th width="100" style="background-color: #EDF2F8; text-align:center;">Caja</th>
                                    <th width="120" style="background-color: #EDF2F8; text-align:center;">Nro. Recibo</th>
									<th width="200" style="background-color: #EDF2F8; text-align:center;">Empresa</th>
                                    <th width="70" style="background-color: #EDF2F8; text-align:center;">Estado</th>
									<th width="100" style="background-color: #EDF2F8; text-align:center;">Por Caja</th>
									<th width="100" style="background-color: #EDF2F8; text-align:center;">Por Home Banking</th>
								    <th width="100" style="background-color: #EDF2F8; text-align:center;">Total</th>
								  </tr>' ;
   						
         				        $i=0;
                                
                                while ($row = pg_fetch_array($res))
							     {	
								      
                                      $fecha      = $row['fecha'];
                                      $empresa    = $row['nombre'];
                                      $caja       = $row['caja'];
									  $nrecibo    = $row['recibo'];
							          $porhome    = $row['porhome'];
                                      $porcaja    = $row['porcaja'];
									  $total      = $row['total'];
									  $estado     = $row['estado'];
									
									
									  if ($estado == 1)
                                      {
                                        $estadox = "Vigente";
                                      }
                                      else
                                      {
                                          if ($estado == 2)
										  {
											$estadox = "Anulado";
											$monto = 0;
										  }
										  else
										  {
											$estadox = "Impreso";
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
                                      .'<td class="tr">'.date("d/m/Y", strtotime($fecha)).'</td>'
                                      .'<td class="tr" align="center">'.$nomcaja.'</td>'
									  .'<td class="tr" align="center">'.$nrecibo.'</td>'
									  .'<td class="tr" align="center">'.$empresa.'</td>'
                                      .'<td class="tr" align="center">'.$estadox.'</td>'
									  .'<td class="tr" align="center">'.number_format($porcaja,0,',','.').'</td>'
									  .'<td class="tr" align="center">'.number_format($porhome,0,',','.').'</td>'
									  .'<td class="tr" align="right">'.number_format($total,0,',','.').'</td>'
                                      .'</tr>';
                                      $i=$i+1;
									
									  if ($estado != 2)
								      {
									  	$tt=$tt+$total;
                                      	$ttcaja=$ttcaja+$porcaja;
                                      	$tthb=$tthb+$porhome;
									  }
                                  }
							
								$html=$html.'<tr>'
								.'<td class="tr" align="center" colspan="5"><strong>TOTAL</strong></td>'
                                .'<td class="tr" align="center" ><strong>'.number_format($ttcaja,0,',','.').'</strong></td>'
                                .'<td class="tr" align="center" ><strong>'.number_format($tthb,0,',','.').'</strong></td>'
								.'<td class="tr" align="right" ><strong>'.number_format($tt,0,',','.').'</strong></td>'
								.'</tr></table></page>';
							
								ini_set("memory_limit","64M"); 
                                include_once('html2pdf/html2pdf.class.php');
                                $html2pdf = new HTML2PDF('L','Legal','es');
                                $html2pdf->pdf->SetDisplayMode('fullpage');
                                $html2pdf->WriteHTML($html);
                                $html2pdf->Output('movimientos.pdf');	 	      	
								
									// Bitacora
									
            			             include("bitacora.php");
                                     $codopcx = "V_365";
                                     $fechaxx=date("Y-n-j", time());
                                     $hora=date("G:i:s",time());
                                     $accion="Reporte Perceptoria Movimiento de Caja";
                                     $terminal = $_SERVER['REMOTE_ADDR'];
                                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal); 
									// Fin grabacion de registro de auditoria*/
                     }  // Fin reporte Todas las Empresas
                     
					 
				 }
                 
            }
			
?>