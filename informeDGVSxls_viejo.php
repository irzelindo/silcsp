<?php
ini_set("display_errors", false);
ini_set("memory_limit", "-1");
set_time_limit(0);
date_default_timezone_set('America/Asuncion');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();

include( "conexion.php" );
$con = Conectarse();

// $con->exec("set names utf8");

// header("Content-Type: application/xls");
// header("Content-Disposition: attachment; filename=informeDGVS".date("YmdHis").".xls");  
// header("Pragma: no-cache"); 
// header("Expires: 0");
$codusu  = $_SESSION['codusu'];
$query = "select * from usuarios u where u.codusu = '$codusu'";
$result = pg_query( $con, $query );
$usuario = pg_fetch_assoc( $result );

$datosD	 = explode("/", $_POST["FechaD"]);
$datosH	 = explode("/", $_POST["FechaH"]);
$opcion	 = $_POST["op"];

$finfoD = $datosD[2]."-".$datosD[1]."-".$datosD[0];
$finfoH = $datosH[2]."-".$datosH[1]."-".$datosH[0];


if ( $op == "1" ) {
	$sql = "SELECT
			 ordtrabajo.cod_dgvs as \"ID D.G.V.S.\"
			,ordtrabajo.nro_toma as \"Nro. Toma\"
			,ordtrabajo.nordentra as \"Nro. Laboratorio\"
			,paciente.cedula as \"Cedula\"
			,concat(paciente.pnombre,' ',paciente.snombre,' ',paciente.papellido,' ',paciente.sapellido) as \"Nombre\"
			,paciente.telefono as \"Teléfono\"
			,CASE WHEN paciente.edada <> 0 THEN paciente.edada ELSE paciente.edadm END as \"Edad\"
			,CASE WHEN paciente.sexo = 2   THEN 'F' ELSE 'M' END as \"Sexo\"
			,(select nomdist from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr)  as \"Distrito\"
			,(select nomreg from regiones where codreg = (select codreg from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr) and subcreg = (select subcreg from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr)) as \"Reg San\"
			,ordtrabajo.nom_servicio as \"Centro Notificante\"
			,resultados.ffiebre as \"Fecha fiebre\"
			,resultados.ftoma as \"Fecha toma\"
			,to_char(ordtrabajo.fecharec, 'DD/MM/YYYY') as \"Fecha Recepción\"
			,to_char(resultados.fechares, 'DD/MM/YYYY') as \"Fecha Resultado\"
			,(select nomresultado from public.resultadocodificado where codresultado = resultados.codresultado) as \"Resultado\"
			from public.ordtrabajo 
			inner join public.resultados on (resultados.nordentra = ordtrabajo.nordentra)
			inner join public.paciente on (paciente.nropaciente = ordtrabajo.nropaciente)
			where ordtrabajo.codservicio = '{$usuario['codservicio']}' and 
				  (resultados.fechares >= '$finfoD' AND resultados.fechares <= '$finfoH');";
}else{
	$sql = "SELECT
			 ordtrabajo.cod_dgvs as \"ID D.G.V.S.\"
			,ordtrabajo.nro_toma as \"Nro. Toma\"
			,ordtrabajo.nordentra as \"Nro. Laboratorio\"
			,paciente.cedula as \"Cedula\"
			,concat(paciente.pnombre,' ',paciente.snombre,' ',paciente.papellido,' ',paciente.sapellido) as \"Nombre\"
			,paciente.telefono as \"Teléfono\"
			,CASE WHEN paciente.edada <> 0 THEN paciente.edada ELSE paciente.edadm END as \"Edad\"
			,CASE WHEN paciente.sexo = 2   THEN 'F' ELSE 'M' END as \"Sexo\"
			,(select nomdist from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr)  as \"Distrito\"
			,(select nomreg from regiones where codreg = (select codreg from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr) and subcreg = (select subcreg from distritos where coddpto = paciente.coddptor and coddist = paciente.coddistr)) as \"Reg San\"
			,ordtrabajo.nom_servicio as \"Centro Notificante\"
			,resultados.ffiebre as \"Fecha fiebre\"
			,resultados.ftoma as \"Fecha toma\"
			,to_char(ordtrabajo.fecharec, 'DD/MM/YYYY') as \"Fecha Recepción\"
			,to_char(resultados.fechares, 'DD/MM/YYYY') as \"Fecha Resultado\"
			,(select nomresultado from public.resultadocodificado where codresultado = resultados.codresultado) as \"Resultado\"
			from public.ordtrabajo 
			inner join public.resultados on (resultados.nordentra = ordtrabajo.nordentra)
			inner join public.paciente on (paciente.nropaciente = ordtrabajo.nropaciente)
			where ordtrabajo.codservicio = '{$usuario['codservicio']}'  and 
				  (ordtrabajo.fecharec >= '$finfoD' AND ordtrabajo.fecharec <= '$finfoH');";
}
$stmt = pg_query( $con, $sql );
$prueba = pg_fetch_all( $stmt );
$keys = array_keys($prueba[0]);

$th = "<style>td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}</style>";
$th .= utf8_decode("INFORME SARS CoV-2 P/ D.G.V.S.\n");
$th .= "<table style='width:100%;'>
	   <tr>";
for ($i=0; $i < count($keys) ; $i++) { 
	$th .= "<th>".utf8_decode( trim($keys[$i]) )."</th>";
}
$th .= "</tr>";
$td = "";
for ($i=0; $i < count($prueba) ; $i++) { 
	$td .= "<tr>";
	for ($j=0; $j < count($keys) ; $j++) { 
		if ($keys[$j] == "LAT") {
			$td .= "<td>=\"".utf8_decode(trim($prueba[$i][$keys[$j]]))."\"</td>";
		}elseif ($keys[$j] == "LNG") {
			$td .= "<td>=\"".utf8_decode(trim($prueba[$i][$keys[$j]]))."\"</td>";
		}else{
			$td .= "<td>".utf8_decode( str_replace(array("\n", "\r", "\t"), '', trim( $prueba[$i][$keys[$j]] ) ) )."</td>";
		}
	}
	$td .= "</tr>";
}
$for_tabla = $th.$td."</table>";

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=informeDGVS.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
echo $for_tabla;
?>