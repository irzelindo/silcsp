<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$v_162 = $_SESSION['V_162'];

$nordentra 	 = $_GET['nordentra'];
$codservicio = $_GET['codservicio'];
$codestudio  = $_GET['codestudio'];

$fechaimp = date("d/m/Y", time());
$fechaimpg = date("Y-m-d", time());
$horaimp  = date("H:i");

$query = "select * from establecimientos where codservicio = '$codservicio'";
$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$nomservicio = $row["nomservicio"];

$query1 = "select * from ordtrabajo where nordentra = '$nordentra'";
$result1 = pg_query($link,$query1);

$row1 = pg_fetch_assoc($result1);

$nropaciente = $row1["nropaciente"];
$fecharec 	 = date("d/m/Y", strtotime($row1["fecharec"]));
$horarec     = $row1["horarec"];
$codservder  = $row1["codservder"];

$queryder = "select * from establecimientos where codservicio = '$codservder'";
$resultder = pg_query($link,$queryder);

$rowder = pg_fetch_assoc($resultder);

$nomservicioder = $rowder["nomservicio"];

$query2 = "select * from paciente where nropaciente = '$nropaciente'";
$result2 = pg_query($link,$query2);

$row2 = pg_fetch_assoc($result2);

$pnombre 	= $row2["pnombre"];
$snombre 	= $row2["snombre"];
$papellido 	= $row2["papellido"];
$sapellido 	= $row2["sapellido"];
$cedula 	= $row2["cedula"];
$tdocumento = $row2["tdocumento"];
$telefono 	= $row2["telefono"];
$sexo1   	= $row2["sexo"];
$fechanac   = $row2["fechanac"];

$fecha1 = explode("-",$fechanac); // fecha nacimiento
$fecha2 = explode("-",date("Y-m-d")); // fecha actual

/*$edad = $fecha2[0]-$fecha1[0];

if($fecha2[1]<=$fecha1[1] and $fecha2[2]<=$fecha1[2])
{
	$edad = $edad - 1;
}*/

if($row2["edada"] != 0)
{
	$edad = $row2["edada"];
}
else
{
	$edad = $row2["edadm"];
}

switch ($tdocumento) {
    case '1':
        $nomdocumento = "Cedula";
        break;
    case '2':
        $nomdocumento = "Pasaporte";
        break;
    case '3':
        $nomdocumento = "Carnet Indigena";
        break;
	case '4':
        $nomdocumento = "Otros";
        break;
	case '5':
        $nomdocumento = "No Tiene";
        break;
}


if($row2["sexo"] == 1)
{
	$sexo  = "Masculino";
}
else
{
	$sexo  = "Femenino";
}

$query3 = "select distinct codsector
			from  resultados r
			where r.nordentra   = '$nordentra'
			and   r.fechaval is not null
			and   (r.codresultado !=''
					or   r.resultado !=''
				   )
			order by codsector";
$result3 = pg_query($link,$query3);
$countlc= pg_num_rows($result3);

function acentos($cadena)
{
   $search = explode(",","Ã,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,Ã‘,Ã,ü,Ã‘");
   $replace = explode(",","Í,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,Ñ,Á,&uuml;,Ñ");
   $cadena= str_replace($search, $replace, $cadena);

   return $cadena;
}


if ( $_SESSION[ 'usuario' ] != "SI" ) {
	header( "Location: index.php" );
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="shortcut icon" href="favicon.ico"/>
<!------------ CSS ----------->
<link href="css/bootstrap2.min.css" rel="stylesheet"/>



<script type="text/javascript" src="js/JsBarcode.all.min.js"></script>

<!----------- PARA ALERTAS  ---------->
<script src="js/sweetalert2.all.min.js" type="text/javascript"></script>
<style>

@page {size: A4 portrait;}

tr.salto {page-break-after:always !important;}

footer {
  background-color: black;
  position: fixed;
  bottom: 0;
  width: 100%;
  height: 40px;
  color: white;
  text-align: center;
  border-top: solid 1px;
}
</style>
</head>
<body>
	<?php
	if($countlc != 0)
	{
		echo '<table>
				<tbody>
					<tr>
						<td>
							<table width="886" border="0" align="center">
								  <thead style="display: table-header-group">
								    <tr style="border-bottom: solid 1px; border-top: solid 1px;">
										<td colspan="4" style="padding-bottom: 13px; padding-top: 13px;">
											<img src="images/logo-msp-labo.fw.png" style="width: 886px; align="center" height: 85px">
										</td>
									</tr>
									<tr style="font-size: 12px;">
									  <td style="padding-top: 12px;padding-left: 20px;"><b>Orden:</b></td>
									  <td style="padding-top: 12px;">'.$nordentra.'</td>
									  <td style="padding-top: 12px;"><b>Servicio: </b></td>
									  <td style="padding-top: 12px;">'.$nomservicio.'</td>
									</tr>

									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Tipo de documento:</b></td>
									  <td>'.$nomdocumento.' '.$cedula.'</td>
									  <td><b>Derivante:</b> </td>
									  <td>'.$nomservicioder.'</td>
									</tr>

									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Apellidos y Nombres:</b></td>
									  <td colspan="3">'.$papellido.' '.$sapellido.' '.$pnombre.' '.$snombre.'</td>
									</tr>

									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Sexo:</b> </td>
									  <td>'.$sexo.'</td>
									  <td><b>Edad:</b> </td>
									  <td>'.$edad.'</td>
									</tr>

									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Tel&eacute;fono:</b></td>
									  <td>'.$telefono.'</td>
									  <td><b>Fecha Ing.:</b> </td>
									  <td>'.$fecharec.' '.$horarec.'</td>
									</tr>

									<tr style="font-size: 10px;border-bottom: solid 1px;">
									  <td style="padding-bottom: 13px;padding-left: 20px;">Imprimio:</td>
									  <td style="padding-bottom: 13px;">'.$codusu.' </td>
									  <td style="padding-bottom: 13px;">Fecha Impresion:</td>
									  <td style="padding-bottom: 13px;">'.$fechaimp.' '.$horaimp.'</td>
									</tr>

									<tr>
									  <td colspan="4">&nbsp;</td>

									</tr>
									<tr>
									  <th width="300" scope="col">ESTUDIO</th>
									  <th width="184" scope="col">RESULTADO</th>
									  <th width="130" scope="col">UNIDAD MEDIDA</th>
									  <th width="285" scope="col">REFERENCIA</th>
									</tr>
									</thead>
			<br>';

			$j = 0;

			while ($row3 = pg_fetch_array($result3))
			{
						$codsector    = $row3['codsector'];

						$querysector = "select * from sectores where codsector = '$codsector' order by posicion";
						$resultsector = pg_query( $link, $querysector );

						$rowsector = pg_fetch_assoc( $resultsector );

						$nomsector = $rowsector[ "nomsector" ];

						$query4 = "select distinct nroestudio, codestudio, codmetodo
										from  resultados r
										where r.nordentra   = '$nordentra'
										and   r.codsector  = '$codsector'
										and   exists(select * from determinaciones where codestudio = r.codestudio)
										and   r.fechaval is not null
										and   (r.codresultado !=''
														or   r.resultado !=''
													  )
										order by nroestudio";
						$result4 = pg_query($link,$query4);
				
						$queryvalidador = "select distinct codsector, codusu1
											from  resultados r
											where r.nordentra   = '$nordentra'
											and   r.codsector  = '$codsector'
											and   r.fechaval is not null
											and   (r.codresultado !=''
													or   r.resultado !=''
												   )
											order by codsector, codusu1";
						$resultvalidador  = pg_query($link,$queryvalidador);
						$countlvalidador = pg_num_rows($resultvalidador);

						$j = $j + 1;

						if($j === 1)
						{
							echo '
								<tr>
										<td height="33" colspan="4" style="font-weight: bold;text-align: center;text-decoration: underline;">'.$nomsector.'</td>
								 </tr>';
						}
						else
						{

							echo '
								<tr>
										<td height="33" colspan="4" style="font-weight: bold;text-align: center;text-decoration: underline;padding-top: 7%;">'.$nomsector.'</td>
								 </tr>';
						}


						$lineas = $lineas + 1;
						while ($row4 = pg_fetch_array($result4))
						{
							$nroestudio   = $row4['nroestudio'];
							$codestudio   = $row4['codestudio'];
							$codmetodo    = $row4['codmetodo'];

							$lineas = $lineas + 1;

							$query5 = "select * from estudios where codestudio = '$codestudio' order by posicion";
							$result5 = pg_query( $link, $query5 );

							$row5 = pg_fetch_assoc( $result5 );

							$nomestudio = $row5[ "nomestudio" ];

							$query6 = "select * from metodos where codmetodo = '$codmetodo'";
							$result6 = pg_query( $link, $query6 );

							$row6 = pg_fetch_assoc( $result6 );

							$nommetodo = $row6[ "nommetodo" ];



							echo '<tr>
								  <td height="40" colspan="4" align="left" valign="bottom" style="font-weight: bold;text-decoration: underline;">'.$nomestudio.':</td>
								 </tr>';

							echo '<tr>
								  <td colspan="4" style="font-style: italic;font-weight: bold;font-size: 10px">METODO: '.$nommetodo.'</td>
								</tr>';

							$query7 = "select d.coddetermina,
											   CASE WHEN d.aliasdetermina IS NULL THEN d.nomdetermina ELSE d.aliasdetermina END as nomdetermina,
											   r.codresultado,
											   r.resultado,
											   d.codumedida,
											   d.tipo,
											   d.codestudio,
											   d.posicion,
											   CASE WHEN p.edada IS NULL THEN p.edadm ELSE p.edada END as edad,
											   r.obs
										from determinaciones d, resultados r, ordtrabajo o, paciente p
										where d.codestudio    = r.codestudio
										and   d.coddetermina  = r.coddetermina
										and   r.nordentra     = o.nordentra
										and   o.nropaciente   = p.nropaciente
										and   (r.codresultado !=''
												or   r.resultado !=''
											  )
										and   d.codestudio    = '$codestudio'
										and   r.nordentra     = '$nordentra'
										order by d.codestudio, d.posicion";
							$result7 = pg_query($link,$query7);

							while ($row7 = pg_fetch_array($result7))
							{
								$coddetermina   = $row7['coddetermina'];
								$nomdetermina   = $row7['nomdetermina'];
								$codresultado   = $row7['codresultado'];
								$resultado    	= $row7['resultado'];
								$codumedida    	= $row7['codumedida'];
								$tiporesul      = $row7['tipo'];
								$codestudio1	= $row7['codestudio'];
								//$edad			= $row7['edad'];
								$obs			= $row7['obs'];

								$lineas = $lineas + 1;

								$query8  = "select * from unidadmedida where codumedida = '$codumedida'";
								$result8 = pg_query( $link, $query8 );

								$row8 = pg_fetch_assoc( $result8 );

								$nomumedida = $row8[ "nomumedida" ];

								$query9 = "select * from determinacionrango where codestudio = '$codestudio1' and coddetermina = '$coddetermina' order by codestudio, tipo";
								$result9 = pg_query( $link, $query9 );

								$numeroRegistros = pg_num_rows($result9);
								
								$referencia = "";

								if($numeroRegistros != 0)
								{
											while ($row9 = pg_fetch_array($result9))
											{
														$tipoedad 	   = $row9[ "tipoedad" ];
														$sexo 	  	   = $row9[ "sexo" ];
														$edadmin  	   = $row9[ "edadmin" ];
														$edadmax  	   = $row9[ "edadmax" ];
														$inirango 	   = $row9[ "inirango" ];
														$finrango 	   = $row9[ "finrango" ];
														$codresultado1 = $row9[ "codresultado1" ];
														$codresultado2 = $row9[ "codresultado2" ];
														$codresultado3 = $row9[ "codresultado3" ];

														if($tiporesul == 'N')
														{
															if(($edad >= $edadmin and $edad <= $edadmax) and $tipoedad == 1)
															{
																$referencia = $inirango." - ".$finrango." ".$nomumedida;
															}
															else
															{
																if(($edad >= $edadmin and $edad <= $edadmax) and $tipoedad == 2)
																{
																	$referencia = $inirango." - ".$finrango." ".$nomumedida;
																}
																else
																{
																	$referencia = "";
																}
															}
														}
														else
														{
															if($tiporesul == 'A')
															{
																if($codresultado1 != '')
																{
																	switch ($codresultado1) {
																		case 1:
																			$referencia = "Resultado Aceptable: NEGATIVO";
																			break;
																		case 2:
																			$referencia = "Resultado Aceptable: NO CONCLUYENTE";
																			break;
																		case 3:
																			$referencia = "Resultado Aceptable: POSITIVO";
																			break;
																		default:
																			$referencia = "";
																			break;
																	}
																}

																if($codresultado2 != '')
																{
																	switch ($codresultado2) {
																		case 1:
																			$referencia = "Resultado Critico: NEGATIVO";
																			break;
																		case 2:
																			$referencia = "Resultado Critico: NO CONCLUYENTE";
																			break;
																		case 3:
																			$referencia = "Resultado Critico: POSITIVO";
																			break;
																		default:
																			$referencia = "";
																			break;
																	}
																}

																if($codresultado3 != '')
																{
																	switch ($codresultado3) {
																		case 1:
																			$referencia = "Resultado P&aacute;nico: NEGATIVO";
																			break;
																		case 2:
																			$referencia = "Resultado P&aacute;nico: NO CONCLUYENTE";
																			break;
																		case 3:
																			$referencia = "Resultado P&aacute;nico: POSITIVO";
																			break;
																		default:
																			$referencia = "";
																			break;
																	}
																}
															}
															else
															{
																if($tiporesul == 'G')
																{
																	
																	if($referencia == '')
																	{
																		$referencia = $row9[ "generico" ];
																	}
																	else
																	{
																		$referencia = $referencia.'<br>'.$row9[ "generico" ];
																	}

																}
																else
																{
																	$referencia = "";
																}
															}
														}
											}
								}
								else
								{
									$referencia = "";
								}

								$query10 = "select rc.codresultado,
												   rc.nomresultado
											from resultadoposible rp, resultadocodificado rc
											where rp.codresultado = rc.codresultado
											and rp.codestudio = '$codestudio1'
											and rp.coddetermina = '$coddetermina'
											and rc.codresultado = '$codresultado'";

								$result10 = pg_query( $link, $query10 );

								$row10 = pg_fetch_assoc( $result10 );

								if($resultado == '' || $resultado == '&nbsp;')
								{
									 $resultado = $row10[ "nomresultado" ];
								}

								if($obs != '')
								{
									echo '<tr>
									  <td style="vertical-align: top; padding: 8px;">'.$nomdetermina.'<br><p style="font-size: 10px">Obs:'.$obs.'</p></td>
									  <td style="vertical-align: top; padding: 8px;">'.$resultado.'</td>
									  <td style="vertical-align: top; padding: 8px;">'.$nomumedida.'</td>
									  <td style="vertical-align: top; padding: 8px;">'.$referencia .'</td>
									</tr>';
								}
								else
								{
									echo '<tr>
									  <td style="vertical-align: top; padding: 8px;">'.$nomdetermina.'</td>
									  <td style="vertical-align: top; padding: 8px;">'.$resultado.'</td>
									  <td style="vertical-align: top; padding: 8px;">'.$nomumedida.'</td>
									  <td style="vertical-align: top; padding: 8px;">'.$referencia .'</td>
									</tr>';
								}

								pg_query( $link, "UPDATE resultados
											SET codusu2 = '$codusu', fechaent = '$fechaimpg', horaentre = '$horaimp', codestado = '007'
											WHERE nordentra = '$nordentra' and codestudio = '$codestudio' and coddetermina = '$coddetermina'" );

								if ($lineas == 22)
								{
									echo "<tr class='salto'></tr>";
								   $lineas = 0;
								}

							}

						}
						echo '<tr>
						<td height="50" colspan="4" style="font-weight: bold;text-align: center;padding-left: 450px; font-size: 10px;padding-top: 7%;">';

						while ($rowvalidador = pg_fetch_array($resultvalidador))
						{
									$validador    = $rowvalidador['codusu1'];

									$queryvalidador1 = "select * from usuarios where codusu = '$validador'";
									$resultvalidador1 = pg_query( $link, $queryvalidador1);

									$rowvalidador1 = pg_fetch_assoc( $resultvalidador1 );

									$nomyape    = $rowvalidador1[ "nomyape" ];
									$nroregprof = $rowvalidador1[ "nroregprof" ];

									$archivo='firmas/'.$validador.'usuariofirma.jpg';

									echo '<div style="float: left;margin-right: 6%;"><img src="'.$archivo.'" width="80px" height="50px"/><br>
													Validado por: Dra.'.$nomyape.' <br>Reg. Prof. Nro.: '.$nroregprof.'</div>';
						}

						echo '</td></tr>';

					}

					echo '</table>
						</td>
					</tr>
				</tbody>

			</table>

			<footer>
			  <small>** No valido para procedimiento legal** <br>
			 Avda. Venezuela c/ Tte. Escurra - Tel.: 292-653</small>
			</footer>';
		}
		else
		{
			echo '<script type="text/javascript">
						let timerInterval
						swal({
						  title: "No se puede imprimir, Falta validar los resultados!",
						  html: "",
						  type: "warning",
						  timer: 2800,
						  onOpen: () => {
							swal.showLoading()
							timerInterval = setInterval(() => {
							  swal.getContent().querySelector("strong")
								.textContent = swal.getTimerLeft()
							}, 100)
						  },
						  onClose: () => {
							clearInterval(timerInterval);
							window.close();
						  }
						}).then((result) => {
						  if (
							// Read more about handling dismissals
							result.dismiss === swal.DismissReason.timer
						  ) {
							console.log("I was closed by the timer")
						  }
						})
					</script>';
		}
	  ?>


</body>
</html>
