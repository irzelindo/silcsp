<?php
include("conexion.php");
$con=Conectarse();

if($_POST['cedula'] == '')
{
	$cedula = -1;
}
else
{
	$cedula = $_POST['cedula'];
}

$sql = "select * from paciente where cedula = '$cedula'";

$res=pg_query($con,$sql);
$countlc=pg_num_rows($res);

$respuesta = new stdClass();

if($countlc != 0)
{
	while ($row = pg_fetch_array($res))
	{

		$respuesta->pnombre   	 = $row[pnombre];
		$respuesta->snombre   	 = $row[snombre];
		$respuesta->papellido 	 = $row[papellido];
		$respuesta->sapellido 	 = $row[sapellido];
		$respuesta->tdocumento 	 = $row[tdocumento];
		$respuesta->sexo 	  	 = $row[sexo];
		$respuesta->fechanac  	 = $row[fechanac];
		$respuesta->ecivil 		 = $row[ecivil];
		$respuesta->nacionalidad = $row[nacionalidad];
		$respuesta->telefono 	 = $row[telefono];
		$respuesta->email 		 = $row[email];
		$respuesta->dccionr 	 = $row[dccionr];
		$respuesta->coddptor 	 = $row[coddptor];
		$respuesta->coddistr 	 = $row[coddistr];
		$respuesta->paisr 	 	 = $row[paisr];
		$respuesta->nropaciente = $row[nropaciente];
		$respuesta->cod_dgvs = $row[cod_dgvs];
	}
}
else
{
	$respuesta->res = 0;
}


echo json_encode($respuesta);
?>
