<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$con = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$nroeval  = $_GET['nroeval'];
$usuario  = $_GET['codusu'];


$q4			= pg_query($con,"SELECT * FROM usuarios WHERE codusu = '$usuario'");

$row4 		= pg_fetch_assoc($q4);

$nomusuario = $row4["nomyape"];

$v_181   = $_SESSION['V_181'];

$q=pg_query($con,"SELECT distinct codestudio FROM evaluaciondeterminacion WHERE nroeval='$nroeval'");

$q1=pg_query($con,"SELECT * FROM evaluacion WHERE nroeval='$nroeval'");

$rowp = pg_fetch_assoc($q1);

$peranio 	 = $rowp["peranio"];
$permes  	 = $rowp["permes"];
$lote 	 	 = $rowp["lote"];
$fechainicio = date("d/m/Y", strtotime($rowp["fechainicio"]));
$fecharcierre= date("d/m/Y", strtotime($rowp["fecharcierre"]));
$codsector 	 = $rowp["codsector"];
$tipo	 	 = $rowp["tipo"];
$puntaje	 = $rowp["tipo"];
$obs	 	 = $rowp["obs"];

$querysector = "select * from sectores where codsector = '$codsector'";
$resultsector = pg_query( $con, $querysector );

$rowsector = pg_fetch_assoc( $resultsector );

$nomsector = $rowsector[ "nomsector" ];

switch ($permes)
{
    case '1':
        $nommes = 'ENERO';
        break;
    case '2':
        $nommes = 'FEBRERO';
        break;
    case '3':
        $nommes = 'MARZO';
        break;
    case '4':
        $nommes = 'ABRIL';
        break;
    case '5':
        $nommes = 'MAYO';
        break;
    case '6':
        $nommes = 'JUNIO';
        break;
    case '7':
        $nommes = 'JULIO';
        break;
    case '8':
        $nommes = 'AGOSTO';
        break;
    case '9':
        $nommes = 'SETIEMBRE';
        break;
    case '10':
        $nommes = 'OCTUBRE';
        break;
    case '11':
        $nommes = 'NOVIEMBRE';
        break;
    case '12':
        $nommes = 'DICIEMBRE';
        break;
}


function acentos($cadena)
{
   $search = explode(",","Ã,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,Ã‘,Ã,ü");
   $replace = explode(",","Í,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,Ñ,Á,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);

   return $cadena;
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="shortcut icon" href="favicon.ico"/>

</head>
<body>
  <div id="invoice">
	<table align="center">
				<tbody>
					<tr>
						<td>
							<table width="900" border="0" align="center" cellspacing="0" cellpadding="3">
								  <thead style="display: table-header-group">
								    <tr style="border-bottom: solid 1px; border-top: solid 1px;">
										<td colspan="7" style="padding-bottom: 20px;text-align: center;">
											<img src="images/logo-msp-labo.fw.png" style="width: 378px;">
										</td>
									</tr>
									<tr style="font-size: 17px;">
									  <td width="193" style="padding-top: 12px;padding-left: 20px;"><b>Tipo Examen:</b></td>
									  <td colspan="2" style="padding-top: 12px;">CONTROL DE CALIDAD</td>
									  <td width="246" colspan="1"  style="padding-top: 12px;"><b>Sector: </b></td>
									  <td colspan="3"><?php echo $nomsector; ?></td>
									</tr>

									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Nro. Evaluacion:</b></td>
									  <td colspan="2"><?php echo $nroeval; ?></td>
									  <td><b>Lote:</b></td>
										<td colspan="3"><?php echo $lote; ?></td>
									</tr>


									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Mes:</b> </td>
									  <td colspan="2"><?php echo $nommes; ?> </td>
									  <td><b>A&ntilde;o:</b></td>
										<td colspan="3"><?php echo $peranio; ?></td>
									</tr>

									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Puntaje:</b></td>
									  <td colspan="6">100</td>
									</tr>

									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Fecha Inicio:</b></td>
									  <td colspan="2"><?php echo $fechainicio; ?></td>
									  <td><b>Fecha Cierre:</b></td>
										<td colspan="3"><?php echo $fecharcierre; ?></td>
									</tr>

									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Participante:</b></td>
									  <td colspan="6"><?php echo $nomusuario; ?></td>
								    </tr>

									<tr>
									  <td colspan="7">&nbsp;</td>

									</tr>

									</thead>

    						<br>
							<tr>
						  <td colspan="5" style="text-align: center; font-weight: bold">PLANILLA DE RESULTADOS</td>
						</tr>
	
						<tr>
							<td style="text-align: center; font-weight: bold; border-left: 3px solid; border-bottom: 3px solid; border-top: 3px solid;border-spacing: none;">Item</td>
							<td width="179" style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;border-right: 3px solid;" colspan="4">Respuesta</td>

						</tr>

						<?php
							
						$q1=pg_query($con,"select p.descripcio,
												   re.correctar,
												   r.respuestar,
												   r.puntaje,
												   r.idpregunta,
												   p.reporte
											from respuestafinal r, respuesta re, pregunta p
											where r.idpregunta = p.idpregunta
											and   r.idpregunta = re.idpregunta
											and   r.nroeval    = p.nroeval
											and   r.codusu  = '$usuario'
											and   r.nroeval = '$nroeval'   
											order by r.nroeval" );
						
						
						while($row1=pg_fetch_array($q1) )
						{
								$idpregunta = $row1['idpregunta'];
							
								echo '<tr>
										  <td>'.$row1['reporte'].'</td>
										  <td style="text-align: center" colspan="4">'.$row1['respuestar'].'</td>
									 </tr>';

						}
								
						$q2=pg_query($con,"select sum(r.puntaje) as puntaje
											from respuestafinal r, respuesta re, pregunta p
											where r.idpregunta = p.idpregunta
											and   r.idpregunta = re.idpregunta
											and   r.nroeval    = p.nroeval
											and   r.codusu  = '$usuario'
											and   r.nroeval = '$nroeval'" );
								
						$row2 = pg_fetch_assoc($q2);

						$puntaje1 = $row2["puntaje"];
								
						echo '<tr>
						  <td colspan="7" style="font-size: 19px;"><b>Rendimiento:</b> '.round($puntaje1).' % de Concordancia  con Resultados de Referencia.</td>
						</tr>';
								
						echo '<tr>
						  <td colspan="7" style="font-size: 19px;"><b>Observacion:</b> '.$obs.'</td>
						</tr>';
								
						echo '<tr>
						  <td colspan="7" style="font-size: 12px;"><b>Recomendaciones para las buenas prácticas laboratoriales:</b> Es competencia del jefe del Laboratorio, responder de la garantía y control de calidad, que al recibir un resultado inaceptable tome las providencias necerias para eliminar las no conformidades.</td>
						</tr>';
								
					  ?>

							</table>
						</td>
				  </tr>
				</tbody>

			</table>



    </div>


</body>
</html>
