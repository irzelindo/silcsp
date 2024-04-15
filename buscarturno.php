<?php
include("conexion.php"); 
$con=Conectarse();
	
$fecha 		 = $_POST['fecha'];
$codservicio = $_POST['codservicio'];
$codarea 	 = $_POST['codarea'];
$codturno 	 = $_POST['codturno'];

$dia  = substr($fecha,0,2);
$mes  = substr($fecha,3,2);
$anio = substr($fecha,6,4);

$semana = date('N',  mktime(0,0,0,$mes,$dia,$anio));  


$sql = "select '1' semana,
       CASE WHEN cantlun != 0 THEN cantlun
	   ELSE 0
       END as cantdias
from tiposturnos 
where codservicio = '$codservicio' and codarea = '$codarea' and codturno = '$codturno'
union all
select '2' semana,
       CASE WHEN cantlun != 0 THEN cantlun
	   ELSE 0
       END as cantdias
from tiposturnos 
where codservicio = '$codservicio' and codarea = '$codarea' and codturno = '$codturno'
union all
select '3' semana,
       CASE WHEN cantmie != 0 THEN cantmie
	   ELSE 0
       END as cantdias
from tiposturnos 
where codservicio = '$codservicio' and codarea = '$codarea' and codturno = '$codturno'
union all
select '4' semana,
       CASE WHEN cantjue != 0 THEN cantjue
	   ELSE 0
       END as cantdias
from tiposturnos 
where codservicio = '$codservicio' and codarea = '$codarea' and codturno = '$codturno'
union all
select '5' semana,
       CASE WHEN cantvie != 0 THEN cantvie
	   ELSE 0
       END as cantdias
from tiposturnos 
where codservicio = '$codservicio' and codarea = '$codarea' and codturno = '$codturno'
union all
select '6' semana,
       CASE WHEN cantsab != 0 THEN cantsab
	   ELSE 0
       END as cantdias
from tiposturnos 
where codservicio = '$codservicio' and codarea = '$codarea' and codturno = '$codturno'
union all
select '7' semana,
       CASE WHEN cantdom != 0 THEN cantdom
	   ELSE 0
       END as cantdias
from tiposturnos 
where codservicio = '$codservicio' and codarea = '$codarea' and codturno = '$codturno'";
	
$res=pg_query($con,$sql);


$sqlturnos = "select * from turnos where codturno = '$codturno' and codservicio = '$codservicio' and codarea = '$codarea' and fechatur = '$fecha'";

$resturno  = pg_query( $con, $sqlturnos );
$counturno = pg_num_rows( $resturno );

$respuesta = new stdClass();


while ($row = pg_fetch_array($res))
{
	if($row[semana] == $semana)
	{
		$respuesta->cantdias = $counturno.'/'.$row[cantdias];
	}
	
}

echo json_encode($respuesta);
?>