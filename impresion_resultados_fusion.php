<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$v_162 = $_SESSION['V_162'];

$metodosDisponibles = array(
	"PCR-SSO"=>"PCR-SSO (polymerase chain reaction-sequence specific oligonucleotide probe)"
   ,"PCR-SSP"=>"PCR-SSP (polymerase chain reaction-sequence specific primers)"
   ,"PCR-SBT"=>"PCR-SBT (Sanger based typing)"
);

$nordentra 	 = $_GET['nordentra'];
$metodo 	 = $_GET['metodo'];

if (array_key_exists($metodo,$metodosDisponibles)){
	$metodo = $metodosDisponibles[$metodo];
}

$observacion = $_GET['observacion'];

$observacionesDetalles = array(
	"CPH"=> array(
			  "Códigos NMDP, representa una serie de letras que determinan conjuntos específicos de variantes para un determinado grupo alélico, formando así, grupos de posibilidades mínimas para un resultado, siendo considerado de esta manera, un resultado de tipificacion de media resolución."
			 ,"La leyenda de código NMDP, presenta la lista de posibilidades para ese grupo alélico abajo de cada resultado. Ademas podría ser consultada en https://hml.nmdp.org/MacUI/"
			 )
);

$observacion_adicional = $_GET['observacion_adicional'];

$tipo        = $_GET['tipo'];

$fechaimp = date("d/m/Y", time());
$fechaimpg = date("Y-m-d", time());
$horaimp  = date("H:i");

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


if($row2["sexo"] == 1 || $row2["sexo"] == "")
{
	$sexo  = "Masculino";
}
else
{
	$sexo  = "Femenino";
}

$query = "SELECT rf.*, replace(rf.trayidname,rf.catalogid,'') as nombre_paciente FROM resultados_fusion rf WHERE rf.nroorden = $1 ORDER BY locus_1";
$stm = pg_prepare($link,"stm",$query);
$result = pg_execute($link,"stm", array($nordentra));
$resultados = pg_num_rows($result);

$result_array = array();
while ($row = pg_fetch_assoc($result)) {
  $cedula = $row['patientid'];
  $nombre_paciente = $row['nombre_paciente'];
  $realizado_por = $row['usuario'];
  $confirmado_por = $row['usuario'];
  
  $result_array[] =	array(
		"locus"=>$row['locus_1']
		,"locusType"=>$row['nmdp_1'] .":". $row['nmdp_id_1']. " ".$row['nmdp_2'] .":". $row['nmdp_id_2']
		,"locusid1"=>$row['nmdp_id_1']
		,"locusDef1"=>$row['nmdpdef_1']
		,"locusid2"=>$row['nmdp_id_2']
		,"locusDef2"=>$row['nmdpdef_2']
	);
}


pg_free_result($result);

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
	if ( $resultados > 0 ) {
	?>	
		
		<table>
			<tbody>
				<tr>
					<td>
						<table width="886" border="0" align="center" style="table-layout: fixed;">
							<thead style="display: table-header-group">
								<tr style="border-bottom: solid 1px; border-top: solid 1px;" align="center">
									<td colspan="4" style="padding-bottom: 13px; padding-top: 13px;">
										<img src="images/logo-msp-labo.fw.png" style="width: 600px; align='center'; height: 85px">
									</td>
								</tr>
								<tr style="font-size: 12px;">
								  <td style="padding-top: 12px;padding-left: 20px;"><b>Orden:</b></td>
								  <td style="padding-top: 12px;"><?php echo $nordentra; ?></td>
								  <td style="padding-top: 12px;"><b>Servicio: </b></td>
								  <td style="padding-top: 12px;"><?php echo $nomservicio; ?></td>
								</tr>

								<tr style="font-size: 12px;">
								  <td style="padding-left: 20px;"><b>Tipo de documento:</b></td>
								  <td><?php echo $cedula; ?></td>
								  <td><b>Derivante:</b> </td>
								  <td><?php echo $nomservicioder; ?></td>
								</tr>

								<tr style="font-size: 12px;">
								  <td style="padding-left: 20px;"><b>Apellidos y Nombres:</b></td>
								  <td colspan="3"><?php echo $nombre_paciente; /*echo $papellido.' '.$sapellido.' '.$pnombre.' '.$snombre;*/ ?></td>
								</tr>

								<tr style="font-size: 12px;">
								  <td style="padding-left: 20px;"><b>Sexo:</b> </td>
								  <td><?php echo $sexo; ?></td>
								  <td><b>Edad:</b> </td>
								  <td><?php echo $edad; ?></td>
								</tr>

								<tr style="font-size: 12px;">
								  <td style="padding-left: 20px;"><b>Tel&eacute;fono:</b></td>
								  <td><?php echo $telefono; ?></td>
								  <td><b>Fecha Ing.:</b> </td>
								  <td><?php echo $fecharec." ".$horarec; ?></td>
								</tr>

								<tr style="font-size: 10px;border-bottom: solid 1px;">
								  <td style="padding-bottom: 13px;padding-left: 20px;">Imprimio:</td>
								  <td style="padding-bottom: 13px;"><?php echo $codusu; ?> </td>
								  <td style="padding-bottom: 13px;">Fecha Impresion:</td>
								  <td style="padding-bottom: 13px;"><?php echo $fechaimp." ".$horaimp; ?></td>
								</tr>

								<tr>
								  <td colspan="4">&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								  <td colspan="2" align="center"><strong><?php echo ($tipo == "TIPI"?"Tipificaci&oacute;n de HLA":"Anticuerpos"); ?></strong></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
								  <td colspan="4"><strong>Nombre del estudio: Tipificacion de HLA</strong></td>
								</tr>
								<tr>
								  <td colspan="4"><strong>Metodo:</strong> <?php echo $metodo; ?></strong></td>
								</tr>
								<tr>
								  <td colspan="4"><strong>M&eacute;todo de Extracci&oacute;n de ADN:</strong> Extracción y purificación de ADN con columnas de sílice. </td>
								</tr>
								<tr> 
								  <td colspan="4"><strong>Material:</strong> Sangre</td>
								</tr>
								<tr style="font-size: 12px;border-bottom: solid 1px;">
								  <td colspan="4">&nbsp;</td>
								</tr>
								
								<tr>
									<th>Locus:</th>
									<th>Tipificaci&oacute;n:</th>
									<th colspan="2">Equivalente Serol&oacute;gico</th>
								</tr>
								
								<?php
								foreach($result_array as $value) {
									echo '<tr> <th>'.$value["locus"].'</th> <th>'.$value["locusType"].'</th> <th colspan="2">&nbsp;</th> </tr>';
								}
								?>
								<tr style="font-size: 12px;border-bottom: solid 1px;">
								  <td colspan="4">&nbsp;</td>
								</tr>
								
								<tr> <td colspan="4">&nbsp;</td> </tr>
								<tr> 
								  <td colspan="4"><strong>Interprborraretaci&oacute;n de C&oacute;digo NMDP:</strong></td>
								</tr>
								
								<?php
								foreach($result_array as $value) {
									if ($value["locusDef1"] != "") {
										echo '<tr> <td colspan="4" style="word-wrap: break-word"><strong>'.$value["locusid1"].'=</strong>'.$value["locusDef1"].'</td></tr>';
									}
									echo '<tr> <td colspan="4">&nbsp;</td> </tr>';
									if ($value["locusDef2"] != "") {
										echo '<tr> <td colspan="4" style="word-wrap: break-word"><strong>'.$value["locusid2"].'=</strong>'.$value["locusDef2"].'</td></tr>';
									}
								}
								?>
								
								
								<tr style="font-size: 12px;border-bottom: solid 1px;">
								  <td colspan="4">&nbsp;</td>
								</tr> 
								
								
								<tr> <td colspan="4">&nbsp;</td> </tr>
								<tr>
									<td colspan="4"><strong>Realizado por:</strong> <?php echo $realizado_por; ?> </td>
								</tr>
								<tr>
									<td colspan="4"><strong>Confirmado por:</strong> <?php echo $confirmado_por; ?></td>
								</tr>
								<tr style="font-size: 12px;border-bottom: solid 1px;">
								  <td colspan="4">&nbsp;</td>
								</tr>
								
								
								<tr> <td colspan="4">&nbsp;</td> </tr>
								<tr>
									<td colspan="4"><strong>Observacion:</strong></td>
								</tr>
								
								<?php 
								if ( array_key_exists($observacion, $observacionesDetalles) ) {
									foreach($observacionesDetalles[$observacion] as $obs) {
										echo '<tr> <td colspan="4">-'.$obs.'</td> </tr>';
									}
								}
								echo '<tr> <td colspan="4">'.$observacion_adicional.'</td> </tr>';
								?>
								<tr> <td colspan="4">&nbsp;</td> </tr>
								<tr> <td colspan="4">&nbsp;</td> </tr>
								<tr> <td colspan="4">&nbsp;</td> </tr>
								<tr> <td colspan="4">&nbsp;</td> </tr>
								<tr> <td colspan="4">&nbsp;</td> </tr>
								
								<tr> <td>&nbsp;</td> <td colspan="2" style="font-size: 12px; border-bottom: dashed 1px;">&nbsp;</td> <td>&nbsp;</td> </tr>
								<tr> <td>&nbsp;</td> <td colspan="2" align="center">Validado electronicamente por: Dra. Sonia Figueredo</td> <td>&nbsp;</td> </tr>
								<tr> <td>&nbsp;</td> <td colspan="2" align="center">Reg. Nro. 123456 </td> <td>&nbsp;</td> </tr>
								
								<tr> <td colspan="4">&nbsp;</td> </tr>
								<tr> <td colspan="4">&nbsp;</td> </tr>
								
								
							</thead>
							<br>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		
	<?php	
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