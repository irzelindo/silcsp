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
$datosD	 = explode("/", $_POST["FechaD"]);
$datosH	 = explode("/", $_POST["FechaH"]);
$opcion	 = $_POST["op"];

$finfoD = $datosD[2]."-".$datosD[1]."-".$datosD[0];
$finfoH = $datosH[2]."-".$datosH[1]."-".$datosH[0];
$nomyape = $_SESSION["nomyape"];
$codusu  = $_SESSION['codusu'];

$query = "select * from usuarios u where u.codusu = '$codusu'";
$result = pg_query( $link, $query );
$usuario = pg_fetch_assoc( $result );

$respuesta = new stdClass();
if ( $op == "1" ) {
	$sql = "SELECT
			 ordtrabajo.cod_dgvs as \"ID D.G.V.S.\"
			,ordtrabajo.nro_toma as \"Nro. Toma\"
			,(SELECT nomestudio from estudios where estudios.codestudio = resultados.codestudio) as \"Estudio\"
			,ordtrabajo.nordentra as \"Nro. Laboratorio\"
			,paciente.cedula as \"Cedula\"
			,concat(paciente.pnombre,' ',paciente.snombre,' ',paciente.papellido,' ',paciente.sapellido) as \"Nombre\"
			,paciente.telefono as \"Teléfono\"
			,CASE WHEN paciente.edada <> 0 THEN paciente.edada ELSE paciente.edadm END as \"Edad\"
			,CASE WHEN paciente.sexo = 2   THEN 'F' ELSE 'M' END as \"Sexo\"
			,resultados.hospitalizado
			,resultados.fallecido			
			,(select nomdist from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr)  as \"Distrito\"
			,(select nomreg from regiones where codreg = (select codreg from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr) and subcreg = (select subcreg from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr)) as \"Reg San\"
			,ordtrabajo.nom_servicio as \"Centro Notificante\"
			,resultados.ffiebre as \"Fecha fiebre\"
			,(SELECT Semana FROM semanas_anuales WHERE TO_NUMBER(TO_CHAR(TO_DATE(resultados.ffiebre,'DD/MM/YYYY')::DATE,'YYYYMMDD'),'99999999') BETWEEN TO_NUMBER(TO_CHAR(TO_DATE(FechaDESDE,'DD/MM/YYYY')::DATE,'YYYYMMDD'),'99999999') AND TO_NUMBER(TO_CHAR(TO_DATE(FechaHASTA,'DD/MM/YYYY')::DATE,'YYYYMMDD'),'99999999') limit 1) as \"Semana fiebre\"
			,resultados.ftoma as \"Fecha toma\"
			,to_char(ordtrabajo.fecharec, 'DD/MM/YYYY') as \"Fecha Recepción\"
			,to_char(resultados.fechares, 'DD/MM/YYYY') as \"Fecha Resultado\"
			,(select nomresultado from public.resultadocodificado where codresultado = resultados.codresultado) as \"Resultado\"
			from public.ordtrabajo 
			inner join public.resultados on (resultados.nordentra = ordtrabajo.nordentra)
			inner join public.paciente on (paciente.nropaciente = ordtrabajo.nropaciente)
			where ordtrabajo.codservicio = '{$usuario['codservicio']}'  and 
				  (resultados.fechares >= '$finfoD' AND resultados.fechares <= '$finfoH');";
}else{
	$sql = "SELECT
			 ordtrabajo.cod_dgvs as \"ID D.G.V.S.\"
			,ordtrabajo.nro_toma as \"Nro. Toma\"
			,(SELECT nomestudio from estudios where estudios.codestudio = resultados.codestudio) as \"Estudio\"
			,ordtrabajo.nordentra as \"Nro. Laboratorio\"
			,paciente.cedula as \"Cedula\"
			,concat(paciente.pnombre,' ',paciente.snombre,' ',paciente.papellido,' ',paciente.sapellido) as \"Nombre\"
			,paciente.telefono as \"Teléfono\"
			,CASE WHEN paciente.edada <> 0 THEN paciente.edada ELSE paciente.edadm END as \"Edad\"
			,CASE WHEN paciente.sexo = 2   THEN 'F' ELSE 'M' END as \"Sexo\"
			,resultados.hospitalizado
			,resultados.fallecido
			,(select nomdist from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr)  as \"Distrito\"
			,(select nomreg from regiones where codreg = (select codreg from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr) and subcreg = (select subcreg from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr)) as \"Reg San\"
			,ordtrabajo.nom_servicio as \"Centro Notificante\"
			,ordtrabajo.nom_proceso as \"Laboratorio Procesamiento\"
			,resultados.ffiebre as \"Fecha fiebre\"
			,(SELECT Semana FROM semanas_anuales WHERE TO_NUMBER(TO_CHAR(TO_DATE(resultados.ffiebre,'DD/MM/YYYY')::DATE,'YYYYMMDD'),'99999999') BETWEEN TO_NUMBER(TO_CHAR(TO_DATE(FechaDESDE,'DD/MM/YYYY')::DATE,'YYYYMMDD'),'99999999') AND TO_NUMBER(TO_CHAR(TO_DATE(FechaHASTA,'DD/MM/YYYY')::DATE,'YYYYMMDD'),'99999999') limit 1) as \"Semana fiebre\"
			,resultados.ftoma as \"Fecha toma\"
			,to_char(ordtrabajo.fecharec, 'DD/MM/YYYY') as \"Fecha Recepción\"
			,to_char(resultados.fechares, 'DD/MM/YYYY') as \"Fecha Resultado\"
			,(select nomresultado from public.resultadocodificado where codresultado = resultados.codresultado) as \"Resultado\"
			from public.ordtrabajo 
			inner join public.resultados on (resultados.nordentra = ordtrabajo.nordentra)
			inner join public.paciente on (paciente.nropaciente = ordtrabajo.nropaciente)
			where ordtrabajo.codservicio = '{$usuario['codservicio']}' and 
				  (ordtrabajo.fecharec >= '$finfoD' AND ordtrabajo.fecharec <= '$finfoH');";
}
$result = pg_query( $link, $sql );
$respuesta->arrResultado = pg_fetch_all( $result );
echo json_encode($respuesta);
?>