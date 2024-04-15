<?php
include("conexion.php");
$con=Conectarse();

if(isset($_POST["codservicioe"]))
{
	$codservicioe = $_POST['codservicioe'];
}
else
{
	$codservicioe = "";
}

if(isset($_POST["codservicior"]))
{
	$codservicior = $_POST['codservicior'];
}
else
{
	$codservicior = "";
}

if(isset($_POST["codcourier"]))
{
	$codcourier = $_POST['codcourier'];
}
else
{
	$codcourier = "";
}

if(isset($_POST["grupo"]))
{
	$grupo = $_POST['grupo'];
}
else
{
	$grupo = "";
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

$sqlcou = "select 	*
			from ordtrabajo t, datoagrupado d
			where d.nordentra    = t.nordentra
			and   d.codservicio = t.codservicio
			and   coalesce(d.estado, 1) = 1
			and   d.codservicioe = '$codservicioe'";

$rescou = pg_query($con,$sqlcou);
$concou = pg_num_rows($rescou);

if($codservicioe != '')
{
	if($concou == 0)
	{
		$w=$w." and ((e.codservact = '$codservicioe' and d.estado is not null)
			  or (e.codservicio = '$codservicioe' and d.estado is null)
			  )";
	}
	else
	{
		$w=$w." and (CASE WHEN e.codservact is null THEN e.codservicio
					 ELSE e.codservact
				END = '$codservicioe'
				)";
	}
}

if($codservicior != '')
{
	$w=$w." and e.codservicior = '$codservicior'";
}

if($codcourier != '' && $concou !=0)
{
	$w=$w." and exists(select * from datoagrupado d where d.nordentra = t.nordentra and   d.codservicio = t.codservicio and d.codcourier ='$codcourier')";
}

if($grupo != '')
{
	$w=$w." and d.grupo like '$grupo%'";
}

if($desde != '')
{
	$w=$w." and t.fecharec >= '$desde'";
}

if($hasta != '')
{
	$w=$w." and t.fecharec <= '$hasta'";
}

$sqlagru = "select distinct p.nropaciente,
				p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
				p.dccionr,
				p.telefono,
				t.nordentra,
				t.codservicio,
				t.codorigen,
				e.nromuestra,
				e.codtmuestra,
				d.estado,
				e.codservicior
			from paciente p, ordtrabajo t, estrealizar e
			FULL OUTER JOIN datoagrupado d ON d.nordentra = e.nordentra and d.codservicio = e.codservicio and d.nromuestra = e.nromuestra
			where p.nropaciente = t.nropaciente
			and   e.nordentra   = t.nordentra
			and   e.codservicio = t.codservicio
			and   coalesce(d.estado, 1) = 1
			and   e.nromuestra   is not null ".$w;

$resagru = pg_query($con,$sqlagru);
$conagru = pg_num_rows($resagru);

$rowagru = pg_fetch_assoc($resagru);

$estado  = $rowagru["estado"];

$respuesta = new stdClass();

$respuesta->cantmuestra = $conagru;


echo json_encode($respuesta);
?>
