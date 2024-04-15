<?php
include("conexion.php"); 
$con=Conectarse();
	
$fecha 		 = $_POST['fechaturno'];
$codservicio = $_POST['codservicio'];
$codarea 	 = $_POST['codarea'];
$codturno 	 = $_POST['codturno'];
	
$dia  = substr($fecha,0,2);
$mes  = substr($fecha,3,2);
$anio = substr($fecha,6,4);

$diac=date("j", time());
$mesc=date("n", time());
$anioc=date("Y", time());

if (strlen($diac)<2)
{
	$diac="0".$diac;
}

if (strlen($mesc)<2)
{
	$mesc="0".$mesc;
}

$fecha_actual=mktime(0,0,0,$mesc,$diac,$anioc);
  
$fecha_entrada = mktime(0,0,0,$mes,$dia,$anio);

$semana = date('N',  mktime(0,0,0,$mes,$dia,$anio));  

$sqlferiado = "select * 
		from feriados 
		where dia  = '$dia' 
		and   mes  = '$mes' 
		and   anio = '$anio'
		union all
		select * 
		from feriados 
		where dia  = '$dia' 
		and   mes  = '$mes'";

$resferiado  = pg_query($con,$sqlferiado);
$cantferiado = pg_num_rows($resferiado);

$rowferiado  = pg_fetch_assoc($resferiado);

$turno 	 = $rowferiado["motivo"];


if($fecha_entrada < $fecha_actual)
{
	$turno = 'No';
}
else
{
	if($cantferiado != 0)
	{
		$turno = $rowferiado["motivo"];
	}
	else
	{
		$turno = 'Si';
	}
}

$respuesta = new stdClass();

$respuesta->turno = $turno;

echo json_encode($respuesta);
?>