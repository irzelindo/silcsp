<?php
@Header("consaatent-type: text/html; charset=utf-8");

$nomyape1 = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
include("bitacora.php");

include("numerosALetras.class.php");

$con=Conectarse();

$elusuario=$apellido.", ".$nombre;



if($_POST['codservicio'] != '')
{
    $codservicio = $_POST['codservicio'];
}
else
{
    $codservicio = $_POST['codserviciolr'];
}

$codusu = $_POST['codusu'];
$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
$codorigen = $_POST['codorigen'];
$codservicio2 = $_POST['codservicio2'];
$codsector = $_POST['codsector'];
$codestudio= $_POST['codestudio'];
$codservicio3 = $_POST['codservicio3'];
$coddetermina = $_POST['coddetermina'];
$interno = $_POST['interno'];
$externo = $_POST['externo'];
$urgente = $_POST['urgente'];
$detallado = $_POST['detallado'];
$derivado = $_POST['derivado'];
$noderivado= $_POST['derivado'];
$codestado = $_POST['codestado'];
$horadesde = $_POST['horadesde'];
$horahasta = $_POST['horahasta'];
$listado = $_POST['listado'];
$tiporeporte = $_POST['tiporeporte'];
$ordendesde = $_POST['ordendesde'];
$ordenhasta = $_POST['ordenhasta'];


function acentos($cadena)
{
   $search = explode(",","Í,�,�,�,�,�,�,�,�,�,�,�,�,á,é,í,ó,ú,ñ,�á,�é,�í,�ó,�ú,�ñ,Ó,� ,É,� ,Ú,“,�� ,¿,Ñ,Á,�");
   $replace = explode(",","�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,\",\",�,�,�,&uuml;");
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
					  $condicion= " and ot.fecharec between '$ff1x' and '$ff2x'";
				   }
				  else
				   {
					  $condicion =$condicion." and ot.fecharec between '$ff1x' and '$ff2x'";
				   }
			  }
			  if ($codservicio != "")
               {
                  $ok3="SI";
                  if ($codservicio != "TODAS")
                  {
                      if ($condicion=="")
    				   {
    					  $condicion=" and ot.codservicio = '$codservicio'";
    				   }
    				  else
    				   {
    					  $condicion=$condicion." and ot.codservicio = '$codservicio'";
    				   }
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
               if ($codorigen == "TODAS")
               {
                    if ($subtit=="")
				   {
						$subtit= "Origen: TODAS";
				   }
				   else
				   {
					  $subtit=$subtit.", Origen: TODAS";
				   }
               }
			   else
               {
                    $sqlorig = pg_query($con,"select * from origenpaciente ");
				    while($roworig = pg_fetch_array($sqlorig))
  				    {
                        if($roworig['codorigen'] == $codorigen)
                        {
                            $nomorigen= $roworig['nomorigen'];
                        }
       		        }

                         if ($subtit=="")
        				   {
        						$subtit="Origen: ".$nomorigen;
        				   }
        				   else
        				   {
        					  $subtit=$subtit.", Origen: ".$nomorigen;
        				   }
                           if ($condicion=="")
        				   {
            					  $condicion =" and ot.codorigen = '$codorigen' ";
        				   }
         				   else
        				   {
            					  $condicion =$condicion." and ot.codorigen = '$codorigen' ";
        				   }

               }

               if ($codservicio2 != "TODAS")
               {
                  if ($condicion=="")
				   {
					  $condicion=" and ot.codservder = '$codservicio2'";
				   }
				  else
				   {
					  $condicion=$condicion." and  ot.codservder = '$codservicio2'";
				   }
               }
               if ($codservicio3 != "TODAS")
               {
                  if ($condicion=="")
				   {
					  $condicion=" and ot.codservrem = '$codservicio3'";
				   }
				  else
				   {
					  $condicion=$condicion." and  ot.codservrem = '$codservicio3'";
				   }
               }

               if ($codsector != "TODAS")
               {
                  if ($condicion=="")
				   {
					  $condicion=" and r.codsector = '$codsector'";
				   }
				  else
				   {
					  $condicion=$condicion." and  r.codsector = '$codsector'";
				   }
               }
               if ($codestudio != "")
               {
                  if ($condicion=="")
				   {
					  $condicion=" and r.codestudio = '$codestudio'";
				   }
				  else
				   {
					  $condicion=$condicion." and  r.codestudio = '$codestudio'";
				   }
               }
               /*
               if ($coddetermina != "" )
               {
                  if ($condicion=="")
				   {
					  $condicion=" and r.coddetermina = '$coddetermina'";
				   }
				  else
				   {
					  $condicion=$condicion." and  r.coddetermina = '$coddetermina'";
				   }
               }
               if ($urgente == "1" )
               {
                  if ($condicion=="")
				   {
					  $condicion=" and ot.urgente = 1";
				   }
				  else
				   {
					  $condicion=$condicion." and  e.urgente = 1";
				   }
               }*/
               if ($codestado != "TODAS" )
               {
                  if ($condicion=="")
				   {
					  $condicion=" and r.codestado = '$codestado'";
				   }
				  else
				   {
					  $condicion=$condicion." and  r.codestado = '$codestado'";
				   }
               }

        if($horadesde != "" and $horahasta != "")
			  {
				  if ($subtit=="")
				   {
					  $subtit="Desde Hora: ".$horadesde." Hasta Hora: ".$horahasta ;
				   }
				  else
				   {
					  $subtit=$subtit.", Desde Hora: ".$horadesde." Hasta Hora: ".$horahasta;
				   }

				   if ($condicion=="")
				   {
					  $condicion= " and ot.horarec between '$horadesde' and '$horahasta'";
				   }
				  else
				   {
					  $condicion =$condicion." and ot.horarec between '$horadesde' and '$horahasta'";
				   }
			  }

        if($ordendesde != "" and $ordenhasta != "")
			  {
				  if ($subtit=="")
				   {
					  $subtit="Desde Orden: ".$ordendesde." Hasta Orden: ".$ordenhasta ;
				   }
				  else
				   {
					  $subtit=$subtit.", Desde Orden: ".$ordendesde." Hasta Orden: ".$ordenhasta;
				   }

				   if ($condicion=="")
				   {
					  $condicion= " and ot.nordentra between '$ordendesde' and '$ordenhasta'";
				   }
				  else
				   {
					  $condicion =$condicion." and ot.nordentra between '$ordendesde' and '$ordenhasta'";
				   }
			  }

               if ($codusu != "TODAS" )
               {
                  if ($condicion=="")
				   {
					  $condicion=" and ot.codusu = '$codusu'";
				   }
				  else
				   {
					  $condicion=$condicion." and  ot.codusu = '$codusu'";
				   }
               }

             	 // AQUI COMIENZA EL LISTADO PROPIAMENTE DICHO -----------------------------------------------------------

             if ($ok1 == "SI" and $ok2 == "SI" and $ok3 == "SI")
            {

                     $sql = "select ot.nordentra as orden,
                               ot.codservicio as codservicio,
                               ot.codusu as codusu,
                               ot.nropaciente as nropaciente,
							   ot.fecharec as fecharec,
                               ot.horarec as horarec,
                               ot.codorigen as codorigen,
                               ot.codservrem as codservicio2,
                               ot.codservder as codservicio3,
                               ot.cod_dgvs as cod_dgvs,
                               ot.nom_servicio as nomservicio,
                               r.codsector as codsector,
                               r.codestudio as codestudio,
                               r.coddetermina as coddetermina,
                               r.codestado as codestado
						from ordtrabajo ot, resultados r
						where ot.nordentra = r.nordentra
						and   ot.codservicio = r.codservicio ".$condicion.
						"  order by fecharec, orden";



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
                    if ($tiporeporte==1 and $listado == 1) // reporte PDF Litado diario por sector
                    {

                          $html='<page backtop="47mm" backbottom="10mm" backleft="-3mm" backright="-3mm">
                            <page_header>
                            <table style="width: 100%; border: none;">
                                <tr>
                                    <td style="width: 50%; border: none;">
                                        <img src="images/logolcsp.png" width="80" height="80">
                                         <strong>MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</strong>
                                         <br /><strong>SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</strong>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="width: 100%; border: none;">

                                        <p align="center" width="100%" >LISTADO DIARIO POR SECTOR</p>

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

                        <br><table width="800" border="1" align="center" >
                              <tr>
                                <th width="80" style="background-color: #EDF2F8; text-align:center; font-size:9px;">Fecha</th>
                                <th width="50" style="background-color: #EDF2F8; text-align:center;font-size:9px;">Nro. de Orden</th>
                                <th width="50" style="background-color: #EDF2F8; text-align:center;font-size:9px;">ID DGVS</th>
                                <th width="180" style="background-color: #EDF2F8; text-align:center;font-size:9px;">Nombre y Apellido</th>
                                <th width="50" style="background-color: #EDF2F8; text-align:center;font-size:9px;">Edad</th>
                                <th width="50" style="background-color: #EDF2F8; text-align:center;font-size:9px;">Nro. Doc.</th>
                                <th width="100" style="background-color: #EDF2F8; text-align:center;font-size:9px;">Nro. de Tel&eacute;fono</th>
                                <th width="200" style="background-color: #EDF2F8; text-align:center;font-size:9px;">Servicio Remitente</th>
                                <th width="200" style="background-color: #EDF2F8; text-align:center;font-size:9px;">Estudio</th>
                                <th width="80" style="background-color: #EDF2F8; text-align:center;font-size:9px;">Estado</th>
                                <th width="120" style="background-color: #EDF2F8; text-align:center;font-size:9px;">Usuario</th>
                              </tr>' ;

                              $ordenx="";
                              $total=0;

                             while ($row = pg_fetch_array($res))
                             {
                                  $nordentra = $row ['orden'];
                                  $codservicio = $row['codservicio'];
                                  $codusu = $row['codusu'];
                                  $nropaciente   = $row['nropaciente'];
                                  $fecha      = $row['fecharec'];
                                  $hora     = $row['horarec'];
                                  $codorigen = $row['codorigen'];
                                  $codservicio2 = $row['codservicio2'];
                                  $codservicio3 = $row['codservicio3'];
                                  $codsector     = $row ['codsector'];
                                  $codestudio    = $row['codestudio'];
                                  $codestado     = $row['codestado'];
                                  $cod_dgvs     = $row ['cod_dgvs'];
                                  $nomservicio2 = $row['nomservicio'];

                                if ($ordenx != $nordentra )
                                {
                                  $ordenx = $nordentra;

                                  $sqlpac = pg_query($con,"select * from paciente ");
                                  while($rowpac = pg_fetch_array($sqlpac))
                                  {
                                    if($rowpac['nropaciente'] == $nropaciente)
                                    {
                                        $nomyape= $rowpac['pnombre'].' '.$rowpac['snombre'].' '.$rowpac['papellido'].' '.$rowpac['sapellido'];
                                        $cedula =$rowpac['cedula'];
                                        $edada =$rowpac['edada'];
                                        $telefono=$rowpac['telefono'];
                                    }

                                  }


                                    $tabla_sector= pg_query($con, "select * from sectores");
                                    while($rowsec = pg_fetch_array($tabla_sector))
                                    {
                                        if($rowsec['codsector'] == $codsector)
                                        {
                                            $nomsector= $rowsec['nomsector'];
                                        }

                                    }
                                    $tabla_est= pg_query($con, "select * from estudios");
                                    while($rowest = pg_fetch_array($tabla_est))
                                    {
                                        if($rowest['codestudio'] == $codestudio)
                                        {
                                            $nomestudio= $rowest['nomestudio'];
                                        }

                                    }
                                    $tabla_estado= pg_query($con, "select * from estadoresultado");
                                    while($rowestado = pg_fetch_array($tabla_estado))
                                    {
                                        if($rowestado['codestado'] == $codestado)
                                        {
                                            $nomestado= $rowestado['nomestado'];
                                        }

                                    }

                                    $tabla_usu= pg_query($con, "select * from usuarios");
                                    while($rowusu = pg_fetch_array($tabla_usu))
                                    {
                                        if($rowusu['codusu'] == $codusu)
                                        {
                                            $nomusuario= $rowusu['nomyape'];
                                        }
                                    }

                                  $html=$html.'<tr>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="80" >'.date("d/m/Y", strtotime($fecha)).'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="50">'.$nordentra.'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="50">'.$cod_dgvs.'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="180">'.$nomyape.'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="50">'.$edada.'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="50">'.$cedula.'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="100">'.$telefono.'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="200" >'.$nomservicio2.'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="200">'.$nomestudio.'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="80">'.$nomestado.'</td>'
                                  .'<td class="tr" align="center" style="font-size:8px;" width="120">'.$nomusuario.'</td>'
                                  .'</tr>';

                                  $total=$total+1;
                               }
                            }
                            $html=$html.'<tr>'
                            .'<td class="tr" align="center" colspan="10"><strong>TOTAL DE ORDENES</strong></td>'
                            .'<td class="tr" align="center" ><strong>'.number_format($total,0,',','.').'</strong></td>'
                            .'</tr>';

                            $html= $html.'</table>
                            </page>';

                            ini_set("memory_limit","64M");
                            include_once('html2pdf/html2pdf.class.php');
                            $html2pdf = new HTML2PDF('L','Legal','es');
                            $html2pdf->pdf->SetDisplayMode('fullpage');
                            $html2pdf->WriteHTML($html);
                            $html2pdf->Output('listadodiario.pdf');

                                // Bitacora

                                 include("bitacora.php");
                                 $codopcx = "V_321";
                                 $fechaxx=date("Y-n-j", time());
                                 $hora=date("G:i:s",time());
                                 $accion="Reporte Lista Ordenes";
                                 $terminal = $_SERVER['REMOTE_ADDR'];
                                 $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                                // Fin grabacion de registro de auditoria*/
                 }  // FIN REPORTE PDF Listado General

                     else
                     {
                        if ($tiporeporte == 2 and $listado ==1) // reporte EXCEL Litado diario por sector
                        {

                                header("Content-type: application/vnd-ms-excel;charset=ISO-8859-1");
                                header('Content-Disposition: attachment; filename=result.xls');
                                header('Pragma: no-cache');
                                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                                header('Expires: 0');

                                print  '<table border=1>
                                       <tr><td style="font-weight:bold;font-size:1em" colspan="11" align="center">MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</td></tr>
                                       <tr><td style="font-weight:bold;font-size:1em" colspan="11" align="center">SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</td></tr>
    	                               <tr><td style="font-weight:bold;font-size:1em" colspan="11" align="center">LISTADO DIARIO POR SECTOR</td></tr>
    	                               <td style="font-weight:bold;font-size:1em" colspan="11" align="center"><b>Considerando:</b>'.acentos($subtit).'</td>
    	                               </tr>';


                               print '<br><table border="1" align="center">
    		                     <tr><td width="80" style="background:#353F49; color:white;">Fecha</td>
    		                     <td width="50" style="background:#353F49; color:white;">Nro. de Orden</td>
                                 <td width="50" style="background:#353F49; color:white;">ID DGVS</td>
                                 <td width="200" style="background:#353F49; color:white;">Nombre y Apellido</td>
               		             <td width="50" style="background:#353F49; color:white;">Edad</td>
                                 <td width="80" style="background:#353F49; color:white;">Nro. Doc.</td>
                                 <td width="100" style="background:#353F49; color:white;">Nro. de Telefono</td>
                                 <td width="200" style="background:#353F49; color:white;">Servicio Remitente</td>
                                 <td width="100" style="background:#353F49; color:white;">Estudio</td>
                                 <td width="80" style="background:#353F49; color:white;">Estado</td>
                                 <td width="120" style="background:#353F49; color:white;">Usuario</td>
               		             </tr>';

                                 $ordenx="";
                                 $total=0;

    								 while ($row = pg_fetch_array($res))
                                     {
                                          $nordentra = $row ['orden'];
                                          $codservicio = $row['codservicio'];
                                          $codusu = $row['codusu'];
                                          $nropaciente   = $row['nropaciente'];
                                          $fecha      = $row['fecharec'];
                                          $hora     = $row['horarec'];
                                          $codorigen = $row['codorigen'];
                                          $codservicio2 = $row['codservicio2'];
                                          $codservicio3 = $row['codservicio3'];
                                          $codsector     = $row ['codsector'];
                                          $codestudio    = $row['codestudio'];
                                          $codestado     = $row['codestado'];
                                          $cod_dgvs     = $row ['cod_dgvs'];
                                          $nomservicio2 = $row ['nomservicio'];

                                          if ($ordenx != $nordentra)
                                          {
                                              $ordenx = $nordentra;

                                              $sqlpac = pg_query($con,"select * from paciente ");
                              				  while($rowpac = pg_fetch_array($sqlpac))
                            				  {
                                                if($rowpac['nropaciente'] == $nropaciente)
                                                {
                                                    $nomyape= $rowpac['pnombre'].' '.$rowpac['snombre'].' '.$rowpac['papellido'].' '.$rowpac['sapellido'];
                                                    $cedula =$rowpac['cedula'];
                                                    $edada =$rowpac['edada'];
                                                    $telefono=$rowpac['telefono'];
                                                }

                            				  }

                                                $tabla_sector= pg_query($con, "select * from sectores");
                            					while($rowsec = pg_fetch_array($tabla_sector))
                            					{
                            					    if($rowsec['codsector'] == $codsector)
                                                    {
                                                        $nomsector= $rowsec['nomsector'];
                                                    }

                            					}
                                                $tabla_est= pg_query($con, "select * from estudios");
                            					while($rowest = pg_fetch_array($tabla_est))
                            					{
                            					    if($rowest['codestudio'] == $codestudio)
                                                    {
                                                        $nomestudio= $rowest['nomestudio'];
                                                    }

                            					}
                                                $tabla_estado= pg_query($con, "select * from estadoresultado");
                            					while($rowestado = pg_fetch_array($tabla_estado))
                            					{
                            					    if($rowestado['codestado'] == $codestado)
                                                    {
                                                        $nomestado= $rowestado['nomestado'];
                                                    }

                            					}

                                                $tabla_usu= pg_query($con, "select * from usuarios");
                            					while($rowusu = pg_fetch_array($tabla_usu))
                            					{
                            					    if($rowusu['codusu'] == $codusu)
                                                    {
                                                        $nomusuario= $rowusu['nomyape'];
                                                    }

                            					}
                                              print '<tr>'
        										.'<td class="tr">'.date("d/m/Y", strtotime($fecha)).'</td>'
        										.'<td class="tr" align="center">'.$nordentra.'</td>'
                                                .'<td class="tr" align="center">'.$cod_dgvs.'</td>'
                                                .'<td class="tr" align="center">'.acentos($nomyape).'</td>'
                                                .'<td class="tr" align="center">'.$edada.'</td>'
        										.'<td class="tr" align="center">'.$cedula.'</td>'
                                                .'<td class="tr" align="center">'.$telefono.'</td>'
                                                .'<td class="tr" align="center">'.acentos($nomservicio2).'</td>'
        										.'<td class="tr" align="center">'.acentos($nomestudio).'</td>'
                                                .'<td class="tr" align="center">'.acentos($nomestado).'</td>'
                                                .'<td class="tr" align="center">'.acentos($nomusuario).'</td>'
        										.'</tr>';

                                                $total=$total+1;
                                           }
                                        }
                                       print '<tr>'
    										.'<td class="tr" align="center" colspan="10"><strong>TOTAL DE ORDENES</strong></td>'
    								        .'<td class="tr" align="center" ><strong>'.number_format($total,0,',','.').'</strong></td>'
    										.'</tr>';

                                        print '</table>';




    				 }
						 else
						 {
							if ($tiporeporte==1 and $listado == 2) // reporte PDF Litado de Muestras
							{

								  $html='<page backtop="47mm" backbottom="10mm" backleft="-3mm" backright="-3mm">
									<page_header>
									<table style="width: 100%; border: none;">
										<tr>
											<td style="width: 50%; border: none;">
												<img src="images/logolcsp.png" width="80" height="80">
												 <strong>    MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</strong>
												 <br /><strong>SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</strong>
											</td>
										 </tr>
										 <tr>
											<td style="width: 100%; border: none;">
												<p align="center" width="100%" >LISTADO DE MUESTRAS</p>
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

								<br><table width="800" border="1" align="center" >
									  <tr>
										<th width="50" style="background-color: #EDF2F8; text-align:center;font-size:9px;">N° ORDEN</th>
										<th width="80" style="background-color: #EDF2F8; text-align:center; font-size:9px;">FECHA</th>
										<th width="190" style="background-color: #EDF2F8; text-align:center;font-size:9px;">NOMBRE Y APELLIDO</th>
										<th width="50" style="background-color: #EDF2F8; text-align:center;font-size:9px;">EDAD</th>
										<th width="150" style="background-color: #EDF2F8; text-align:center;font-size:9px;">SERVICIO REMITENTE</th>
										<th width="200" style="background-color: #EDF2F8; text-align:center;font-size:9px;">ESTUDIO</th>
										<th width="80" style="background-color: #EDF2F8; text-align:center;font-size:9px;">ID DGVS</th>
										<th width="150" style="background-color: #EDF2F8; text-align:center;font-size:9px;">ESTABLECIMIENTO</th>
										<th width="150" style="background-color: #EDF2F8; text-align:center;font-size:9px;">ENTIDAD DERIVANTE</th>
									  </tr>' ;

									  $ordenx="";
									  $total=0;

									 while ($row = pg_fetch_array($res))
									 {
										  $nordentra = $row ['orden'];
										  $codservicio = $row['codservicio'];
										  $codusu = $row['codusu'];
										  $nropaciente   = $row['nropaciente'];
										  $fecha      = $row['fecharec'];
										  $hora     = $row['horarec'];
										  $codorigen = $row['codorigen'];
										  $codservicio2 = $row['codservicio2'];
										  $codservicio3 = $row['codservicio3'];
										  $cod_dgvs = $row ['cod_dgvs'];
										  $codsector     = $row ['codsector'];
										  $codestudio    = $row['codestudio'];
										  $codestado     = $row['codestado'];

										if ($ordenx != $nordentra)
										{
										  $ordenx = $nordentra;

										  $sqlpac = pg_query($con,"select * from paciente ");
										  while($rowpac = pg_fetch_array($sqlpac))
										  {
											if($rowpac['nropaciente'] == $nropaciente)
											{
												$nomyape= $rowpac['pnombre'].' '.$rowpac['snombre'].' '.$rowpac['papellido'].' '.$rowpac['sapellido'];
												$cedula =$rowpac['cedula'];
												$edada =$rowpac['edada'];
											}

										  }

										  $sqlserv = pg_query($con,"select * from establecimientos ");
										  while($rowserv = pg_fetch_array($sqlserv))
										  {
											if($rowserv['codservicio'] == $codservicio2)
											{
												$nomservicio2= $rowserv['nomservicio'];
											}
											if($rowserv['codservicio'] == $codservicio3)
											{
												$nomservicio3= $rowserv['nomservicio'];
											}
											if($rowserv['codservicio'] == $codservicio)
											{
												$nomservicio= $rowserv['nomservicio'];
											}


										 }

											$tabla_sector= pg_query($con, "select * from sectores");
											while($rowsec = pg_fetch_array($tabla_sector))
											{
												if($rowsec['codsector'] == $codsector)
												{
													$nomsector= $rowsec['nomsector'];
												}

											}
											$tabla_est= pg_query($con, "select * from estudios");
											while($rowest = pg_fetch_array($tabla_est))
											{
												if($rowest['codestudio'] == $codestudio)
												{
													$nomestudio= $rowest['nomestudio'];
												}

											}
											$tabla_estado= pg_query($con, "select * from estadoresultado");
											while($rowestado = pg_fetch_array($tabla_estado))
											{
												if($rowestado['codestado'] == $codestado)
												{
													$nomestado= $rowestado['nomestado'];
												}

											}

											$tabla_usu= pg_query($con, "select * from usuarios");
											while($rowusu = pg_fetch_array($tabla_usu))
											{
												if($rowusu['codusu'] == $codusu)
												{
													$nomusuario= $rowusu['nomyape'];
												}
											}

										  $html=$html.'<tr>'
										  .'<td class="tr" align="center" style="font-size:8px;" width="50">'.$nordentra.'</td>'
										  .'<td class="tr" align="center" style="font-size:8px;" width="80" >'.date("d/m/Y", strtotime($fecha)).'</td>'
										  .'<td class="tr" align="center" style="font-size:8px;" width="190">'.$nomyape.'</td>'
										  .'<td class="tr" align="center" style="font-size:8px;" width="50">'.$edada.'</td>'
										  .'<td class="tr" align="center" style="font-size:8px;" width="180">'.$nomservicio2.'</td>'
										  .'<td class="tr" align="center" style="font-size:8px;" width="200" >'.$nomestudio.'</td>'
										  .'<td class="tr" align="center" style="font-size:8px;" width="80">'.$cod_dgvs.'</td>'
										  .'<td class="tr" align="center" style="font-size:8px;" width="180">'.$nomservicio.'</td>'
										  .'<td class="tr" align="center" style="font-size:8px;" width="180">'.$nomservicio3.'</td>'

										  .'</tr>';

										  $total=$total+1;
									   }
									}
									$html=$html.'<tr>'
									.'<td class="tr" align="center" colspan="8"><strong>TOTAL DE MUESTRAS</strong></td>'
									.'<td class="tr" align="center" ><strong>'.number_format($total,0,',','.').'</strong></td>'
									.'</tr>';

									$html= $html.'</table>
									</page>';

									ini_set("memory_limit","64M");
									include_once('html2pdf/html2pdf.class.php');
									$html2pdf = new HTML2PDF('L','Legal','es');
									$html2pdf->pdf->SetDisplayMode('fullpage');
									$html2pdf->WriteHTML($html);
									$html2pdf->Output('listadomuestras.pdf');

										// Bitacora

										 include("bitacora.php");
										 $codopcx = "V_321";
										 $fechaxx=date("Y-n-j", time());
										 $hora=date("G:i:s",time());
										 $accion="Reporte Lista Ordenes";
										 $terminal = $_SERVER['REMOTE_ADDR'];
										 $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
										// Fin grabacion de registro de auditoria*/
							}
							else
							{
								//excel listado de muestras

							}
						 }
            		 }
					 
					if ($tiporeporte==1 and $listado == 5) // reporte PDF Litado diario por sector
                    {
						  $query1 = "select ot.codservicio,
										    e.nomservicio,
										    count(distinct ot.nordentra)
									from ordtrabajo ot, establecimientos e, resultados r
									where ot.codservicio = e.codservicio 
									and   ot.nordentra = r.nordentra ".$condicion."
									group by ot.codservicio,
											 e.nomservicio";
						  $result1 = pg_query($con,$query1);
						
						  $query3 = "select count(distinct ot.nordentra) total
									from ordtrabajo ot, establecimientos e, resultados r
									where ot.codservicio = e.codservicio 
									and   ot.nordentra = r.nordentra ".$condicion;
						  $result3 = pg_query($con,$query3);
						  $row3 = pg_fetch_assoc($result3);
						
						  $totalgeneral = $row3["total"];

                          echo '<html>
                              <head>
                              <meta charset="utf-8">
                              <title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
                              <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                              <link rel="shortcut icon" href="favicon.ico"/>

                              <!----------- PARA ALERTAS  ---------->
                              <script src="js/sweetalert2.all.min.js" type="text/javascript"></script>

                              <!----------- PARA MODAL  ---------->
                              <link rel="stylesheet" href="css/bootstrap2.min.css">
                              <link rel="stylesheet" href="css/bootstrap-theme.min.css">

                              <style>

                              .container {
                                    width: 970px;
                                    margin: 0 auto 0 auto;
                                  }

                                  .table-striped tbody tr:nth-of-type(odd) {
                                    background-color: rgb(217, 235, 235);
                                  }

                                  .table-hover tbody tr:hover {
                                    background-color: rgba(122, 114, 81, 0.7);
                                    color: rgb(112, 24, 78);
                                  }

                                  .thead-green {
                                    background-color: rgb(0, 99, 71);
                                    color: white;
                                  }

                              </style>
                              </head>
                              <body>

                                <div class="container">
  								<table style="border: none;">
                                <tr>
                                    <td style="width: 50%; border: none;">
                                        <img src="images/logolcsp.png" width="80" height="80">
                                         <strong>MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</strong>
                                         <br /><strong>SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</strong>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="border: none;">

                                        <p align="center"" >CANTIDAD ORDENES POR USUARIOS</p>

                                        <p style="font-weight:bold;font-size:0.7em;"><b> Considerando:</b> '.$subtit.'</p>
                                    </td>
                                </tr>
                            </table>';
						
						while ($row = pg_fetch_array($result1))
      					{
						
							echo '<div style="font-size: 14px; text-align:left; margin-top: 6px;"><b>Establecimiento:'.$row["nomservicio"].'</div>';

							echo'<table class="table table-striped table-hover" >
								<thead class="thead-green">
								  <tr>
									<th style="text-align: center;">Usuario</th>
									<th style="text-align: center;">Cantidad</th>
								  </tr>
								</thead>
								<tbody>';
							
								$query2 = "select ot.codservicio,
												   ot.codusu,
												   count(distinct ot.nordentra) as cantidad
											from ordtrabajo ot, resultados r
											where ot.codservicio = '".$row["codservicio"]."'
											and   ot.nordentra = r.nordentra 
											".$condicion."
											group by ot.codservicio,
													 ot.codusu
											order by 3 desc";
								$result2 = pg_query($con,$query2);
							
								while ($row2 = pg_fetch_array($result2))
								{

									echo '<tr>'
										.'<td style="font-size: 12px;text-align: center;">'.$row2["codusu"].'</td>'
										.'<td style="font-size: 12px;text-align: center;">'.number_format($row2["cantidad"], 0, ',', '.').'</td>'
										.'</tr>';
								}

								echo '</tbody>
								  </table>';
							}
							
							echo '<div style="font-size: 14px; text-align:left; margin-top: 6px;"><b>Total General: '.number_format($totalgeneral, 0, ',', '.').'</div>';
						
							echo '</div>
								</body>
								</html>';

   
                 }  // FIN REPORTE PDF Listado General
                 else
                 {
                        if ($tiporeporte == 2 and $listado ==5) // reporte EXCEL Litado diario por sector
                        {
								$query1 = "select ot.codservicio,
										    e.nomservicio,
										    count(distinct ot.nordentra)
									from ordtrabajo ot, establecimientos e, resultados r
									where ot.codservicio = e.codservicio 
									and   ot.nordentra = r.nordentra ".$condicion."
									group by ot.codservicio,
											 e.nomservicio";
						  		$result1 = pg_query($con,$query1);
							
							    $query3 = "select count(distinct ot.nordentra) total
									from ordtrabajo ot, establecimientos e, resultados r
									where ot.codservicio = e.codservicio 
									and   ot.nordentra = r.nordentra ".$condicion;
							    $result3 = pg_query($con,$query3);
							    $row3 = pg_fetch_assoc($result3);

							    $totalgeneral = $row3["total"];
							
                                header("Content-type: application/vnd-ms-excel;charset=ISO-8859-1");
                                header('Content-Disposition: attachment; filename=result.xls');
                                header('Pragma: no-cache');
                                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                                header('Expires: 0');

                                print  '<table border=1>
                                       <tr><td style="font-weight:bold;font-size:1em" colspan="3" align="center">MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</td></tr>
                                       <tr><td style="font-weight:bold;font-size:1em" colspan="3" align="center">SISTEMA DE INFORMACI&Oacute;N DEL LABORATORIO DE SALUD P&Uacute;BLICA</td></tr>
    	                               <tr><td style="font-weight:bold;font-size:1em" colspan="3" align="center">CANTIDAD ORDENES POR USUARIOS</td></tr>
    	                               <td style="font-weight:bold;font-size:1em" colspan="2" align="center"><b>Considerando:</b>'.acentos($subtit).'</td>
    	                               </tr>
									   </table>';
							
							   while ($row = pg_fetch_array($result1))
      						   {

								   print '<div style="font-size: 14px; text-align:left; margin-top: 6px;"><b>Establecimiento:'.$row["nomservicio"].'</div>

									<table class="table table-striped table-hover" >
									<thead class="thead-green">
									  <tr>
										<th style="text-align: center;">Usuario</th>
										<th style="text-align: center;">Cantidad</th>
									  </tr>
									</thead>
									<tbody>';

									 $query2 = "select ot.codservicio,
												   ot.codusu,
												   count(distinct ot.nordentra) as cantidad
											from ordtrabajo ot, resultados r
											where ot.codservicio = '".$row["codservicio"]."'
											and   ot.nordentra = r.nordentra 
											".$condicion."
											group by ot.codservicio,
													 ot.codusu
											order by 3 desc";
									$result2 = pg_query($con,$query2);

									while ($row2 = pg_fetch_array($result2))
									{

										print  '<tr>'
											.'<td style="font-size: 12px;text-align: center;">'.$row2["codusu"].'</td>'
											.'<td style="font-size: 12px;text-align: center;">'.number_format($row2["cantidad"], 0, ',', '.').'</td>'
											.'</tr>';
									}

									print '</tbody>
									  </table>';
							   }
							
							   print '<div style="font-size: 14px; text-align:left; margin-top: 6px;"><b>Total General: '.number_format($totalgeneral, 0, ',', '.').'</div>';

    				 }

       			}
			}
    }
?>
