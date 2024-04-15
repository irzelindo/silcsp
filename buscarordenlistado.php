<?php
include("conexion.php");
$con=Conectarse();

if(isset($_POST["codsector"]))
{
	$codsector = $_POST['codsector'];
}
else
{
	$codsector = "";
}

if(isset($_POST["codestudio"]))
{
	$codestudio = $_POST['codestudio'];
}
else
{
	$codestudio = "";
}

if(isset($_POST["qr"]))
{
	$qr = $_POST['qr'];
}
else
{
	$qr = "";
}

if(isset($_POST["desde"]) && $_POST["desde"] != 'null')
{
	$desde	 = $_POST['desde'];
}
else
{
	$desde	 = "";
}

if(isset($_POST["hasta"]) && $_POST["hasta"] != 'null')
{
	$hasta	 = $_POST['hasta'];
}
else
{
	$hasta	 = "";
}

	if($codsector != '')
	{
		$w=$w." and  es.codsector = '$codsector'";

	}

	if($codestudio != '')
	{
		$w=$w." and  es.codestudio = '$codestudio'";

	}

if($desde != '')
	{
		$w=$w." and t.fecharec >= '$desde'";
	}

if($hasta != '')
	{
		$w=$w." and t.fecharec <= '$hasta'";
	}

	if($qr != '')
	{
		$codservicio = substr($qr, 0, 3);
		$nordentra     = substr($qr, 3);

		$w=$w." and  t.nordentra = '$nordentra' and t.codservicio = '$codservicio'";

	}

$sql1 = "select distinct p.nropaciente,
			p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
			p.dccionr,
			p.telefono,
			t.nordentra,
			t.codservicio,
			t.codorigen,
			e.nromuestra,
			e.codtmuestra,
			e.codservact,
			e.nroestudio,
			es.nomestudio,
      es.codestudio
		from paciente p, ordtrabajo t, estudios es, estrealizar e
		FULL OUTER JOIN ordenagrupado d ON d.nordentra = e.nordentra
		where p.nropaciente = t.nropaciente
		and   e.nordentra   = t.nordentra
		and   e.codestudio  = es.codestudio
		and   e.estadoestu  != '008' ".$w."order by t.nordentra";

$res1=pg_query($con,$sql1);
$cant = pg_num_rows($res1);

	// Se agregan los datos de la respuesta del servidor
$respuesta = new stdClass();

$i=0;
while ($row = pg_fetch_array($res1))
{
		$respuesta->rows[$i]['id'] = $row['nordentra'];

		$codorigen   = $row['codorigen'];
		$codtmuestra = $row['codtmuestra'];
		$codservicio = $row['codservicio'];
		$nropaciente = $row['nropaciente'];
		$codservact  = $row['codservact'];
		$nordentra   = $row['nordentra'];
		$nomyape     = $row['nomyape'];
		$dccionr     = $row['dccionr'];
		$telefono    = $row['telefono'];
		$nomestudio  = $row['nomestudio'];

		$cadena1="select * from origenpaciente where codorigen='$codorigen'";
		$lista1 = pg_query($con, $cadena1);
		$registro1 = pg_fetch_array($lista1);
		$nomorigen=$registro1['nomorigen'];

		$cadena2="select * from tipomuestra where codtmuestra='$codtmuestra'";
		$lista2 = pg_query($con, $cadena2);
		$registro2 = pg_fetch_array($lista2);
		$nomtmuestra=$registro2['nomtmuestra'];

		$muestra = str_pad($row['nromuestra'], 8, '0', STR_PAD_LEFT);

		$nromuestra = $codservicio.$muestra;

		$nromuestra1 = $row['nromuestra'];

		$cadena3="select * from establecimientos where codservicio='$codservact'";
		$lista3 = pg_query($con, $cadena3);
		$registro3 = pg_fetch_array($lista3);
		$nomservicio=$registro3['nomservicio'];

		$i++;

	//$respuesta->cantmuestra = array($nomservicio,$row['nordentra'],$nomorigen,$row['nomyape'],$row['dccionr'],$row['telefono'],$nomtmuestra,$nromuestra, $nomestado, $nropaciente, $codservicio, $nromuestra1);
}
$respuesta->borrar = '<div id="wb_FontAwesomeIcon4"><a href="#" id= "del" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div>';
$respuesta->nomservicio = $nomservicio;
$respuesta->nordentra = $nordentra;
$respuesta->nomorigen = $nomorigen;
$respuesta->nomyape = $nomyape;
$respuesta->dccionr = $dccionr;
$respuesta->telefono = $telefono;
$respuesta->nomtmuestra = $nomtmuestra;
$respuesta->nromuestra = $nromuestra;
$respuesta->nomestudio = $nomestudio;
$respuesta->nropaciente = $nropaciente;
$respuesta->codservicio = $codservicio;
$respuesta->nromuestra1 = $nromuestra1;
$respuesta->codestudio = $codestudio;
$respuesta->cantidad = $cant;

echo json_encode($respuesta);
?>
