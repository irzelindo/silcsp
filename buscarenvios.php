<?php
include("conexion.php"); 
$con=Conectarse();
	
if(isset($_POST["codservicior"])) 
{
	$codservicior = $_POST['codservicior'];
}
else 
{	
	$codservicior = "";
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
			and   d.codservicioe = t.codservicio
			and   d.codservicioe = '$codservicior'";

$rescou = pg_query($con,$sqlcou);
$concou = pg_num_rows($rescou);

if($codservicior != '')
{
	$w=$w." and e.codservicior = '$codservicior'";  
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
				e.codservact,
				e.codservicior
			from paciente p, ordtrabajo t, estrealizar e, datoagrupado d 
			where p.nropaciente  = t.nropaciente
			and   d.nordentra 	 = e.nordentra 
			and   d.codservicio  = e.codservicio 
			and   d.nromuestra   = e.nromuestra
			and   e.nordentra    = t.nordentra
			and   e.codservicio  = t.codservicio
			and   e.nromuestra   is not null ".$w;

$resagru = pg_query($con,$sqlagru);
$conagru = pg_num_rows($resagru);

$respuesta = new stdClass();

$respuesta->cantmuestra = $conagru;

echo json_encode($respuesta);
?>