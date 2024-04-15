<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
ini_set("display_errors", false);
ini_set("memory_limit", "-1");
set_time_limit(0);
// ini_set('memory_limit', 1024*1024);
// set_time_limit(0);
// ini_set('memory_limit', '2G'); // or you could use 1G
// ini_set('max_execution_time', '180');
date_default_timezone_set('America/Asuncion');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();

include( "conexion.php" );
$link  	 = Conectarse();
$datos 	 = $_POST["lcsp"];

// $imp   	 = $datos[0]["imp"];
$nomyape = $_SESSION["nomyape"];
$codusu  = $_SESSION['codusu'];

$query = "select * from usuarios u where u.codusu = '$codusu'";
$result = pg_query( $link, $query );
$rowUsu = pg_fetch_assoc( $result );

$mu = "";
$de = "";
// ==================== Muestra =========================================
// 1  - Sangre total 						(7 - SANGRE)
// 40 - orina 								(9 - ORINA)
// 41 - fragmento de órgano 				(12 - FRAGMENTO DE ORGANO)
// 42 - Líquido Cefalorraquídeo (lcr) 		(11 - LÍQUIDO CEFALORAQUÍDEO (LCR))

// 43 - HISOPADO DE EXUDADO DE LA LESIÓN	(20 - HISOPADO DE EXUDADO DE LA LESIÓN)
// 44 - HISOPADO DE LIQUIDO VESICULAR		(19 - HISOPADO DE LÍQUIDO VESICULAR)
// 10 - SUERO VIROLOGIA						(7 - SANGRE)
// 45 - HISOPADO DE COSTRAS DE LA LESIÓN	(21 - HISOPADO DE COSTRAS DE LAS LESIONES)
// 09 -	HISOPADO NASOFARINGEO				(1 - HISOPADO NASOFARÍNGEO)
// 46 - HISOPADO OROFARINGEO				(22 - HISOPADO OROFARÍNGEO)
// ==================== MuestraPara =====================================
// 2 = PCR
// 5 = ELISA
// 6 = INMUNOCROMATOGRAFICO
// 7 = CULTIVO VIRAL

if ($datos[0]["Muestra"] == '7'){  	   $muestra = '1';
}elseif($datos[0]["Muestra"] == '9'){  $muestra = '40';
}elseif($datos[0]["Muestra"] == '11'){ $muestra = '42';
}elseif($datos[0]["Muestra"] == '12'){ $muestra = '41';
}elseif($datos[0]["Muestra"] == '20'){ $muestra = '43';
}elseif($datos[0]["Muestra"] == '19'){ $muestra = '44';
}elseif($datos[0]["Muestra"] == '21'){ $muestra = '45';
}elseif($datos[0]["Muestra"] == '1'){ $muestra = '09';
}elseif($datos[0]["Muestra"] == '22'){ $muestra = '46';
}
if ( $datos[0]["id_secciones_ficha"] == "2" ) {
	// $cargar = array(['mu'=>'08005','de'=>['800105','800106','800107','800108','800109','800110','800111','800112']],
	// 		   		['mu'=>'08009','de'=>['800113','800114','800115']],
	// 		   		['mu'=>'08010','de'=>['800117','800118','800119']],
	// 		  	   ); 
	if ( $rowUsu['laboratorio'] == '2' ) {
		$cargar = array(['mu'=>'08005','de'=>['800108']],
				   		['mu'=>'08011','de'=>['800105']],
				   		['mu'=>'08012','de'=>['800106','800139']],
				   		['mu'=>'08013','de'=>['800107']],
				   		['mu'=>'08020','de'=>['800135']],
				   		['mu'=>'08021','de'=>['800136','800138']],
				   		['mu'=>'08022','de'=>['800137']],
				   		['mu'=>'08014','de'=>['800109','800120','800121','800122']],
				   		['mu'=>'08009','de'=>['800115']],
				   		['mu'=>'08015','de'=>['800113']],
				   		['mu'=>'08016','de'=>['800114','800140']],
				   		['mu'=>'08010','de'=>['800117']],
				   		['mu'=>'08017','de'=>['800118']],
				   		['mu'=>'08018','de'=>['800119','800141']],
				  	   );
	}else{
		$Enfermedad = explode(",",$datos[0]["Enfermedad"]);
		$cargar = array();
		for ($i=0; $i < count($Enfermedad) ; $i++) { 
			if ( $Enfermedad[$i] == 'DENGUE') {
				if ( $datos[0]["MuestraPara"] == '2' ) {
					array_push($cargar,['mu'=>'08005','de'=>['800108']]);
				}elseif ( $datos[0]["MuestraPara"] == '5' ) {
					array_push($cargar,['mu'=>'08011','de'=>['800105']], ['mu'=>'08012','de'=>['800106','800139']], ['mu'=>'08013','de'=>['800107']]);
				}elseif ( $datos[0]["MuestraPara"] == '6' ) {
					array_push($cargar,['mu'=>'08020','de'=>['800135']], ['mu'=>'08021','de'=>['800136','800138']], ['mu'=>'08022','de'=>['800137']]);
				}elseif ( $datos[0]["MuestraPara"] == '7' ) {
					array_push($cargar,['mu'=>'08014','de'=>['800109','800120','800121','800122']]);
				}
			}elseif ( $Enfermedad[$i] == 'CHIKUNGUNYA') {
				if ( $datos[0]["MuestraPara"] == '2' ) {
					array_push($cargar,['mu'=>'08009','de'=>['800115']]);
				}elseif ( $datos[0]["MuestraPara"] == '5' ) {
					array_push($cargar,['mu'=>'08015','de'=>['800113']], ['mu'=>'08016','de'=>['800114','800140']]);
				}elseif ( $datos[0]["MuestraPara"] == '6' ) {
					// array_push($cargar,['mu'=>'','de'=>['']]);
				}elseif ( $datos[0]["MuestraPara"] == '7' ) {
					// array_push($cargar,['mu'=>'','de'=>['']]);
				}
			}elseif ( $Enfermedad[$i] == 'ZIKA') {
				if ( $datos[0]["MuestraPara"] == '2' ) {
					array_push($cargar,['mu'=>'08010','de'=>['800117']]);
				}elseif ( $datos[0]["MuestraPara"] == '5' ) {
					array_push($cargar,['mu'=>'08017','de'=>['800118']], ['mu'=>'08018','de'=>['800119','800141']]);
				}elseif ( $datos[0]["MuestraPara"] == '6' ) {
					// array_push($cargar,['mu'=>'','de'=>['']]);
				}elseif ( $datos[0]["MuestraPara"] == '7' ) {
					// array_push($cargar,['mu'=>'','de'=>['']]);
				}
			}
		}
	}
}elseif ( $datos[0]["id_secciones_ficha"] == "9" ) {
	$cargar = array(['mu'=>'08019','de'=>['800131']]);
}elseif ( $datos[0]["id_secciones_ficha"] == "-1" ) {
	$cargar = array(['mu'=>'08004','de'=>['800194']]);
}

$query = "select * from resultados 
		  WHERE cod_dgvs2  = '".$datos[0]["cod_dgvs"]."' 
		  AND nro_toma     = '".$datos[0]["NroMuestra"]."'
		  AND orden_dgvs   = '".$datos[0]["orden_dgvs"]."'
		  AND codestudio   = '".$mu."'
		  AND coddetermina = '".$de."'";
$result = pg_query( $link, $query );
$rowOrd = pg_fetch_assoc( $result );

if ( $rowOrd["nordentra"] != "" ) {
	$retornar    = "1";
	echo json_encode( array( 'respuesta' => $rowOrd["nordentra"], 'retorno' => $retornar) );
	exit;
}

$retornar = [];
$query = "select * from paciente WHERE cedula = '".$datos[0]["cedula"]."' OR cod_dgvs2 = '".$datos[0]["cod_dgvs"]."'";

// echo $query;
$result = pg_query( $link, $query );
$row = pg_fetch_assoc( $result );

$query = "select max(nropaciente) as maximo from paciente";
$resultnp = pg_query( $link, $query );
$rownp = pg_fetch_assoc( $resultnp );

$fe = date("Y-m-d");

if ( $datos[0]["fechanac"] == "0-0-0" ) { $fechanac = "9999-12-31"; }else{ $fechanac = $datos[0]["fechanac"]; }
$ee = 0;

if ( $row["cedula"] != "" ) {

	$pnombre 	= str_replace("'", '', $datos[0]["pnombre"]);
	$snombre 	= str_replace("'", '', $datos[0]["snombre"]);
	$papellido 	= str_replace("'", '', $datos[0]["papellido"]);
	$sapellido 	= str_replace("'", '', $datos[0]["sapellido"]);
	$dccionr 	= str_replace("'", '', $datos[0]["dccionr"]);

	$query = "UPDATE paciente SET
				tdocumento 			= '".$datos[0]["tdocumento"]."',
				cedula  			= '".$datos[0]["cedula"]."',
				pnombre  			= '".$pnombre."',
				snombre  			= '".$snombre."',
				papellido  			= '".$papellido."',
				sapellido  			= '".$sapellido."',
				sexo  				= '".$datos[0]["sexo"]."',
				fechanac  			= '".$fechanac."',
				edada  				= '".$datos[0]["edada"]."',
				edadm  				= '".$datos[0]["edadm"]."',
				ecivil  			= '".$datos[0]["ecivil"]."',
				nacionalidad  		= '".$datos[0]["nacionalidad"]."',
				telefono  			= '".$datos[0]["telefono"]."',
				email  				= '".$datos[0]["email"]."',
				codexterno  		= '".$datos[0]["codexterno"]."',
				estado  			= '".$datos[0]["estado"]."',
				dccionr  			= '".$dccionr."',
				paisr  				= '".$datos[0]["paisr"]."',
				coddptor  			= '".$datos[0]["coddptor"]."',
				coddistr  			= '".$datos[0]["coddistr"]."',
				nomyapefam  		= '".$datos[0]["nomyapefam"]."',
				telefonof  			= '".$datos[0]["telefonof"]."',
				celularf  			= '".$datos[0]["celularf"]."',
				obs  				= '".$datos[0]["obs"]."',
				codusup  			= '".$datos[0]["U"]."',
				tb  				= '".$datos[0]["tb"]."',
				cod_dgvs2			= '".$datos[0]["cod_dgvs"]."',
				fechauact			= '".$fe."'
				WHERE nropaciente 	= '".$row["nropaciente"]."' RETURNING nropaciente;";
	$ee = 1;
}else{

	$pnombre 	= str_replace("'", '', $datos[0]["pnombre"]);
	$snombre 	= str_replace("'", '', $datos[0]["snombre"]);
	$papellido 	= str_replace("'", '', $datos[0]["papellido"]);
	$sapellido 	= str_replace("'", '', $datos[0]["sapellido"]);
	$dccionr 	= str_replace("'", '', $datos[0]["dccionr"]);

	$query = "INSERT INTO paciente (fechareg,
									tdocumento,
									cedula,
									pnombre,
									snombre,
									papellido,
									sapellido,
									sexo,
									fechanac,
									edada,
									edadm,
									ecivil,
									nacionalidad,
									telefono,
									email,
									codexterno,
									estado,
									dccionr,
									paisr,
									coddptor,
									coddistr,
									nomyapefam,
									telefonof,
									celularf,
									obs,
									codusup,
									tb,
									fechauact,
									cod_dgvs2) VALUES(
									'".$fe."',
				 					'".$datos[0]["tdocumento"]."',
				  					'".$datos[0]["cedula"]."',
				  					'".$pnombre."',
				  					'".$snombre."',
				  					'".$papellido."',
				  					'".$sapellido."',
				  					'".$datos[0]["sexo"]."',
				  					'".$fechanac."',
									'".$datos[0]["edada"]."',
									'".$datos[0]["edadm"]."',
									'".$datos[0]["ecivil"]."',
									'".$datos[0]["nacionalidad"]."',
									'".$datos[0]["telefono"]."',
									'".$datos[0]["email"]."',
									'".$datos[0]["codexterno"]."',
									'".$datos[0]["estado"]."',
									'".$dccionr."',
									'".$datos[0]["paisr"]."',
									'".$datos[0]["coddptor"]."',
									'".$datos[0]["coddistr"]."',
									'".$datos[0]["nomyapefam"]."',
									'".$datos[0]["telefonof"]."',
									'".$datos[0]["celularf"]."',
									'".$datos[0]["obs"]."',
									'".$codusu."',
									'".$datos[0]["tb"]."',
									'".$fe."',
									'".$datos[0]["cod_dgvs"]."')
									RETURNING nropaciente;";
}
// echo $query;
$result = pg_query( $link, $query );
$new_id = pg_fetch_assoc($result);
$codigo = $new_id["nropaciente"];

// if ( $ee == 1 ) {
// 	$result1 = pg_query( $link, "SELECT nropaciente FROM paciente WHERE cod_dgvs = '".$datos[0]["cod_dgvs"]."';" );
// 	$new_id1 = pg_fetch_assoc($result1);
// 	$codigo = $new_id1["nropaciente"];
// }

// ===================================================================================================
// $tm 	= $datos[0]["ArrLaboratorioTOT"];
// $re 	= $datos[0]["ArrResultadoTOT"];
// $el 	= $datos[0]["ArrEliminarLAB"];

$es 	= $datos[0]["Establecimiento"];
$esDes 	= $datos[0]["EstablecimientoDes"];
$ho 	= $datos[0]["Hospitalizado"];

for ($i=0; $i < count($el) ; $i++) {
	if ($el[$i]['db'] == "LAB") {
		$sqlDelLab ="DELETE FROM public.ordtrabajo WHERE cod_dgvs2 		= '{$datos[0]['cod_dgvs']}' and nro_toma = '{$el[$i]['nroToma']}';
					 DELETE FROM public.resultados WHERE cod_dgvs2 		= '{$datos[0]['cod_dgvs']}' and nro_toma = '{$el[$i]['nroToma']}';
					 DELETE FROM public.resultados_dgvs WHERE cod_dgvs2 = '{$datos[0]['cod_dgvs']}' and nro_toma = '{$el[$i]['nroToma']}';";
		$result    = pg_query( $link, $sqlDelLab );
	}
}

$codorigen = $es;

if ( $es == "-2" ) {
	if ( $datos[0]["EstablecimientoDes"] == "RNL-CAMINERA" || $datos[0]["EstablecimientoDes"] == "RNL-CUADRILLA" || $datos[0]["EstablecimientoDes"] == "RNL") {
		$codorigen = "001";
	}elseif( $datos[0]["EstablecimientoDes"] == "MEYER LAB" ) {
		$codorigen = "001";
	}elseif( $datos[0]["EstablecimientoDes"] == "CENTRO DE ESPECIALIDADES " ) {
		$codorigen = "001";
	}elseif( $datos[0]["EstablecimientoDes"] == "BIOLOGIA MOLECULAR" ) {
		$codorigen = "001";
	}elseif( $datos[0]["EstablecimientoDes"] == "ANALIZA" ) {
		$codorigen = "001";
	}elseif( $datos[0]["EstablecimientoDes"] == "CYRLAB" ) {
		$codorigen = "001";
	}
}

// else{
// 	$codorigen = "001";
// }

if ( $ho == "SI" ) { $ho = "001"; }else{ $ho = "002"; }
// $mu = "";
// $de = "";
// if ( $datos[0]["ttoma"] == "1" ) {
// 	$mu = "08001"; $de = "800001";
// }elseif ( $datos[0]["ttoma"] == "2" ) {
// 	$mu = "08003"; $de = "800005";
// }elseif ( $datos[0]["ttoma"] == "98" ) { /* SECUENCIACION */
// 	$mu = "08004"; $de = "800189";
// }elseif ( $datos[0]["ttoma"] == "05" ) { /* MALARIA */
// 	if ( $datos[0]["MuestraPara"] == "11" ) { /* Microscopia */
// 		$mu = "05001"; $de = "800007";
// 	}else if ( $datos[0]["MuestraPara"] == "2" ) { /* PCR */
// 		// $mu = ""; $de = "";
// 	}else if ( $datos[0]["MuestraPara"] == "4" ) { /* TEST RAPIDO */
// 		// $mu = ""; $de = "";
// 	}
// }else{
// 	$mu = "08001"; $de = "800001";
// }

$hora 		 = date("H:i");

$codigoOrden = "";
$CargarOrden = 0;
// for ($i=0; $i < count($tm) ; $i++) {
// 	if ( $tm[$i]['id'] == "0" ) {
$sqlAddOrden = "INSERT INTO public.ordtrabajo(codservicio,
											  codusu,
											  nropaciente,
											  fecharec,
											  horarec,
											  fechasal,
											  horasal,
											  urgente,
											  nroturno,
											  codorigen,
											  codservrem,
											  codservder,
											  codmedico,
											  recitacion,
											  retira,
											  obs,
											  cod_dgvs2,
											  nro_toma,
											  nom_servicio,
											  orden_dgvs,
											  nom_proceso,
											  nroficha,
											  id_secciones_ficha)
				VALUES (
											  '{$rowUsu["codservicio"]}',
											  '".$codusu."',
											  '".$codigo."',
											  '".$fe."',
											  '".$hora."',
											  null,
											  null,
											  '2',
											  (SELECT COALESCE(((MAX(nroturno::int)+1)::varchar), '1',((MAX(nroturno::int)+1)::varchar) ) FROM public.ordtrabajo),
											  '".$ho."',
											  '".$codorigen."',
											  '".$codorigen."',
											  '',
											  '2',
											  '2',
											  '',
											  {$datos[0]['cod_dgvs']},
											  {$datos[0]['NroMuestra']},
											  '{$datos[0]['EstablecimientoDes']}',
											  '{$datos[0]['orden_dgvs']}',
											  '{$datos[0]['LaboratorioProc']}',
											  '{$datos[0]['IdFicha']}',
											  '{$datos[0]['id_secciones_ficha']}' ) RETURNING nordentra;";
// echo $sqlAddOrden."\n";
$result      = pg_query( $link, $sqlAddOrden );
$new_id      = pg_fetch_assoc($result);
$codigoOrden = $new_id["nordentra"];

$sqlnro = "select nextval('seq_estrealizar')";
$resnro     = pg_query( $link, $sqlnro );
$rownro 	= pg_fetch_assoc($resnro);
$nroestudio = $rownro["nextval"];

$orden_dgvs = "";
if ( isset($datos[0]["orden_dgvs"]) ) {
	$orden_dgvs = $datos[0]["orden_dgvs"];
}else {
	$orden_dgvs = "";
}
$sqlAddEstrealizar = '';
for ($i=0; $i < count($cargar) ; $i++) { 
	$sqlAddEstrealizar.="INSERT INTO public.estrealizar(
						 nroestudio,
						 codservicio,
						 codarea,
						 codusu,
						 nropaciente,
						 fecha,
						 hora,
						 codestudio,
						 codservicior,
						 codserviciod,
						 coddiagnostico,
						 estadoestu,
						 fechatmues,
						 horatmues,
						 codtmuestra,
						 nromuestra,
						 nroturno,
						 nordentra,
						 codservact,
						 validar,
						 codorigen,
						 codmedico,
						 cod_dgvs2,
						 nro_toma,
						 orden_dgvs,
						 nroficha,
						 id_secciones_ficha,
						 hospitalizado,
						 fallecido
						 ) VALUES (
						 '$nroestudio', 
						 '{$rowUsu["codservicio"]}', 
						 null,
						 '$codusu',
						 '$codigo', 
						 '$fe', 
						 '$hora', 
						 '{$cargar[$i]['mu']}', 
						 '{$rowUsu["codservicio"]}', 
						 null, 
						 null, 
						 '1', 
						 '$fe', 
						 '$hora', 
						 '$muestra', 
						 '1', 
						 (SELECT COALESCE(((MAX(nroturno::int)+1)::varchar), 
						 '1',
						 ((MAX(nroturno::int)+1)::varchar) ) FROM public.estrealizar), 
						 '$codigoOrden',
					  	 '{$rowUsu["codservicio"]}',
					  	 null,
					  	 '{$rowUsu["codservicio"]}',
					  	 null,
					  	 '".$datos[0]["cod_dgvs"]."',
					  	 '".$datos[0]["NroMuestra"]."',
					  	 '".$orden_dgvs."',
					  	 '{$datos[0]['IdFicha']}',
						 '{$datos[0]['id_secciones_ficha']}',
						 '".$datos[0]['Hospitalizado']."',
						 '".$datos[0]['Fallecido']."');";
	for ($k=0; $k < count($cargar[$i]['de']) ; $k++) { 
		$sqlAddEstrealizar.="INSERT INTO public.resultados(nordentra, codservicio, nroestudio, idmuestra, nroorden, fechares, codmetodo, codumedida, codsector, codestudio, coddetermina, resultado, codresultado, codequipo, codestado, codusu1, fechaval, horaval, codusu2, fechareval, horareval, anulado, fechaanul, horaanul, codusu3, codusu4, fechaent, horaentre, obs, vecesimp, codusu5, fechaenvio, horaenvio, cod_dgvs2, nro_toma,ffiebre,ftoma,orden_dgvs,nroficha,id_secciones_ficha,hospitalizado,
						 fallecido)
		VALUES ('".$codigoOrden."', '{$rowUsu["codservicio"]}', '$nroestudio', 'XXX".$k."', '1', null, '', '', '08', '{$cargar[$i]['mu']}', '{$cargar[$i]['de'][$k]}', null, null, null, '001', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '".$datos[0]["cod_dgvs"]."', '".$datos[0]["NroMuestra"]."', '".$datos[0]["ffiebre"]."', '".$datos[0]["ftoma"]."', '".$orden_dgvs."','{$datos[0]['IdFicha']}',
							 '{$datos[0]['id_secciones_ficha']}','".$datos[0]['Hospitalizado']."',
						 '".$datos[0]['Fallecido']."');";
	}
	// echo $sqlAddEstrealizar.'\n';
	$result      = pg_query( $link, $sqlAddEstrealizar );
	$sqlAddEstrealizar = '';

	$sqlnro 	= "select nextval('seq_estrealizar')";
	$resnro     = pg_query( $link, $sqlnro );
	$rownro 	= pg_fetch_assoc($resnro);
	$nroestudio = $rownro["nextval"];	
}
// echo $sqlAddEstrealizar;

// $result      = pg_query( $link, $sqlAddEstrealizar );
// for ($i=0; $i < count($cargar) ; $i++) { 
	
// }
// $result      = pg_query( $link, $sqlAddResultado );
// echo $sqlAddResultado."\n";


// echo $sqlAddEstrealizar."\n";

// array_push($retornar, array('cdgvs'=>$datos[0]["cod_dgvs"],'mdgvs'=>$datos[0]["NroMuestra"]) );
		// $CargarOrden = 1;
		// $nro_toma = $tm[$i]["NroMuestra"];
// 	}else{

// 	}
// }
$retornar    = "0";
echo json_encode( array('respuesta' => $codigoOrden, 'retorno' => $retornar) );
?>
