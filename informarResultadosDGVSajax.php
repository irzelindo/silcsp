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
$link  	 	= Conectarse();
$datosD	 	= explode("/", $_POST["FechaD"]);
$datosH	 	= explode("/", $_POST["FechaH"]);
$muestra    = $_POST["Muestra"];
$opcion	 	= $_POST["op"];
$enfermedad = $_POST["Enfermedad"];
$cargar2    = "";

$ordenDesde = "";
if ( $muestra == 1 ) {
	$ordenDesde = " AND (ordtrabajo.orden_dgvs = '' OR ordtrabajo.orden_dgvs is null) ";
}else{
	$ordenDesde = " AND (ordtrabajo.orden_dgvs <> '' OR ordtrabajo.orden_dgvs is not null) ";
}

if ( $enfermedad == "2" ) {
	// $cargar = "'08005','08009','08010'";
	$cargar = "'08005','08011','08012','08013','08020','08021','08022','08014','08009','08015','08016','08010','08017','08018'";
}elseif ( $enfermedad == "9" ) {
	$cargar = "'08019'";
}elseif ( $enfermedad == "-1" ) {
	$cargar  = "'08004'";
	$cargar2 = " AND resultados.coddetermina = '800194'";
}


$finfoD = $datosD[2]."-".$datosD[1]."-".$datosD[0];
$finfoH = $datosH[2]."-".$datosH[1]."-".$datosH[0];
$nomyape = $_SESSION["nomyape"];
$codusu  = $_SESSION['codusu'];

$query = "select * from usuarios u where u.codusu = '$codusu'";
$result = pg_query( $link, $query );
$usuario = pg_fetch_assoc( $result );

$respuesta = new stdClass();
if ( $opcion == 1 ) {
	$fecha = "AND (resultados.fechares >= '$finfoD' AND resultados.fechares <= '$finfoH')";
}else{
	$fecha = "AND (ordtrabajo.fecharec >= '$finfoD' AND ordtrabajo.fecharec <= '$finfoH')";
}
$sql = "SELECT
		  tdocumento
		, cedula
		, pnombre || ' ' || snombre as nombres
		, papellido || ' ' || sapellido as apellidos
		, sexo
		, fechanac
		, to_char(fechanac, 'DD/MM/YYYY') as fechanac_esp
		, ecivil
		, nacionalidad
		, telefono
		, email
		, dccionr
		, paisr
		, coddptor
		, coddistr
		, resultados.codservicio
		, resultados.nroestudio
		, resultados.idmuestra
		, ordtrabajo.nordentra
		, fecharec
		, to_char(fecharec, 'DD/MM/YYYY') as fecharec_esp
		, horarec
		, ordtrabajo.cod_dgvs
		, ordtrabajo.nro_toma
		, ordtrabajo.orden_dgvs
		, trim(nom_proceso) AS nom_proceso
		, ordtrabajo.nroficha
		, ordtrabajo.idlab
		, ordtrabajo.id_secciones_ficha
		, resultados.codestudio
		, estudios.nomestudio as codestudio_desc
		, resultados.coddetermina
		, determinaciones.nomdetermina as coddetermina_desc
		, resultados.resultado
		, resultados.codresultado
		, resultadocodificado.nomresultado as codresultado_desc
		, resultados.fechares
		, resultados.envio_dgvs
		, resultados.proceso_dgvs
		, (SELECT string_agg(resultados.proceso_dgvs, ',' ORDER BY resultados.proceso_dgvs) FROM resultados WHERE resultados.nordentra = ordtrabajo.nordentra) AS cccff
		, to_char(resultados.fechares, 'DD/MM/YYYY') as fechares_esp
		, (SELECT codtmuestra FROM estrealizar WHERE estrealizar.nordentra = ordtrabajo.nordentra LIMIT 1) AS codtmuestra
		, (SELECT nomtmuestra FROM tipomuestra WHERE codtmuestra = (SELECT codtmuestra from estrealizar WHERE estrealizar.nordentra = ordtrabajo.nordentra LIMIT 1)) as codtmuestra_desc
		from ordtrabajo
		-- inner join estrealizar ON (estrealizar.nordentra = ordtrabajo.nordentra)
		inner join resultados          ON (resultados.nordentra  = ordtrabajo.nordentra)
		inner join paciente            ON (paciente.nropaciente  = ordtrabajo.nropaciente)
		inner join estudios            ON (estudios.codestudio   = resultados.codestudio)
		inner join determinaciones     ON (determinaciones.codestudio = resultados.codestudio AND determinaciones.coddetermina = resultados.coddetermina)
		left  join resultadocodificado ON (resultadocodificado.codresultado = resultados.codresultado)
		where resultados.codestudio in ($cargar) $cargar2 $ordenDesde
		  -- AND (resultados.fechares >= '$finfoD' AND resultados.fechares <= '$finfoH')
		  $fecha
		order by cedula, codestudio, coddetermina";
// echo $sql;
$result = pg_query( $link, $sql );
$respuesta->arrResultado = pg_fetch_all( $result );
echo json_encode($respuesta);
?>