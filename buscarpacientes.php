<?php
include("conexion.php"); 
$con=Conectarse();

include("conexionsaa.php");
$consaa=Conectarsesaa();

include("conexionpol.php");
$conpol=Conectarsepol();
	


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

$sql1 = "select * from paciente where cedula = '$cedula'";
	
$res1=pg_query($consaa,$sql1);
$countsaa=pg_num_rows($res1);

$sql2 = "select * from personas where cedula_identidad = '$cedula'";
	
$res2=pg_query($conpol,$sql2);
$countpol=pg_num_rows($res2);

//Webservice Identificaciones - MITICS
if ($countpol == 0){
   include ("getIdentificacionesSENATICS.php"); //Taw-Fito-Ani
    $nro=$cedula; 
    webservice_policia($nro,$conpol);  
    //Copia de busqueda anterior                   
    $res3=pg_query($conpol, $sql2);
	$countpol2=pg_num_rows($res3);
}
//Culmina el acceso al webservice - MITICS


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
	}
}
else
{
	if($countsaa != 0)
	{
		while ($row1 = pg_fetch_array($res1))
		{

			$respuesta->pnombre   	 = $row1[pnombre];
			$respuesta->snombre   	 = $row1[snombre];
			$respuesta->papellido 	 = $row1[papellido];
			$respuesta->sapellido 	 = $row1[sapellido];
			$respuesta->tdocumento 	 = $row1[tdocumento];
			$respuesta->sexo 	  	 = $row1[sexo];
			$respuesta->fechanac  	 = $row1[fechanac];
			$respuesta->ecivil 		 = $row1[ecivil];
			$respuesta->dccionr 	 = $row1[dccionr];
			$respuesta->coddptor 	 = $row1[coddpto];
			$respuesta->coddistr 	 = $row1[coddist];
			$respuesta->paisr 	 	 = "";
			$respuesta->telefono 	 = "";
			$respuesta->email 		 = "";
			
			$query2  = "select * from paises where codnac = trim('$row1[codnacc]')";
		    $result2 = pg_query($consaa, $query2);
		    $rowp    = pg_fetch_array($result2);

			$respuesta->nacionalidad = $rowp[nomnac];

		}
	}
	else
	{
		if($countpol != 0)
		{
			while ($rowpol = pg_fetch_array($res2))
			{
				$xnombre=trim($rowpol["nombres"]);
				$xapellido=trim($rowpol["apellidos"]);
				$longitud1=strlen($xnombre); 
				$longitud2=strlen($xapellido);

				$pnombre   = "";
				$papellido = "";
				$snombre   = "";
				$sapellido = "";

				$ini=0;
				for ($k=0;$k <= $longitud1;$k++)
				{
					if (substr($xnombre,$k,1)==" ")
					{
					   $ini=1;
					}

					if ($ini==0)   
					{
					   $pnombre=$pnombre.substr($xnombre,$k,1);
					}
				   if ($ini==1)   
				   {
					   $snombre=$snombre.substr($xnombre,$k,1);
				   }
				}

				$ini2=0;
				for ($k=0;$k <= $longitud2;$k++)
				{
				   if (substr($xapellido,$k,1)==" ")
				   {
					  $ini2=1;
				   }
				   if ($ini2==0)   
				   {
					  $papellido=$papellido.substr($xapellido,$k,1);
				   }
				   if ($ini2==1)   
				   {
					  $sapellido=$sapellido.substr($xapellido,$k,1);
				   }
				}

				if($rowpol["codigo_genero"] == '1')
				{
					$sexo 	=  2;
				}
				else
				{
					$sexo 	=  1;
				}
				

				$pnombre   = str_replace("'", "", $pnombre);
				$snombre   = str_replace("'", "", $snombre);
				$papellido = str_replace("'", "", $papellido);
				$sapellido = str_replace("'", "", $sapellido);
				
				$respuesta->pnombre   	 = $pnombre;
				$respuesta->snombre   	 = $snombre;
				$respuesta->papellido 	 = $papellido;
				$respuesta->sapellido 	 = $sapellido;
				$respuesta->tdocumento 	 = '1';
				$respuesta->sexo 	  	 = $sexo;
				$respuesta->fechanac  	 = $rowpol[fecha_nacimiento];
				$respuesta->ecivil 		 = "";
				$respuesta->nacionalidad = "";
				$respuesta->telefono 	 = "";
				$respuesta->email 		 = "";
				$respuesta->dccionr 	 = $rowpol[domicilio];
				$respuesta->coddptor 	 = "";
				$respuesta->coddistr 	 = "";
				$respuesta->paisr 	 	 = "";
			}
		}
		else
		{
			if($countpol2 != 0)
			{
				while ($rowpol = pg_fetch_array($res3))
				{
					$xnombre=trim($rowpol["nombres"]);
					$xapellido=trim($rowpol["apellidos"]);
					$longitud1=strlen($xnombre); 
					$longitud2=strlen($xapellido);

					$pnombre   = "";
					$papellido = "";
					$snombre   = "";
					$sapellido = "";

					$ini=0;
					for ($k=0;$k <= $longitud1;$k++)
					{
						if (substr($xnombre,$k,1)==" ")
						{
						   $ini=1;
						}

						if ($ini==0)   
						{
						   $pnombre=$pnombre.substr($xnombre,$k,1);
						}
					   if ($ini==1)   
					   {
						   $snombre=$snombre.substr($xnombre,$k,1);
					   }
					}

					$ini2=0;
					for ($k=0;$k <= $longitud2;$k++)
					{
					   if (substr($xapellido,$k,1)==" ")
					   {
						  $ini2=1;
					   }
					   if ($ini2==0)   
					   {
						  $papellido=$papellido.substr($xapellido,$k,1);
					   }
					   if ($ini2==1)   
					   {
						  $sapellido=$sapellido.substr($xapellido,$k,1);
					   }
					}

					if($rowpol["codigo_genero"] == '1')
					{
						$sexo 	=  2;
					}
					else
					{
						$sexo 	=  1;
					}
				

					$pnombre   = str_replace("'", "", $pnombre);
					$snombre   = str_replace("'", "", $snombre);
					$papellido = str_replace("'", "", $papellido);
					$sapellido = str_replace("'", "", $sapellido);
					
					$respuesta->pnombre   	 = $pnombre;
					$respuesta->snombre   	 = $snombre;
					$respuesta->papellido 	 = $papellido;
					$respuesta->sapellido 	 = $sapellido;
					$respuesta->tdocumento 	 = '1';
					$respuesta->sexo 	  	 = $sexo;
					$respuesta->fechanac  	 = $rowpol[fecha_nacimiento];
					$respuesta->ecivil 		 = "";
					$respuesta->nacionalidad = "";
					$respuesta->telefono 	 = "";
					$respuesta->email 		 = "";
					$respuesta->dccionr 	 = $rowpol[domicilio];
					$respuesta->coddptor 	 = "";
					$respuesta->coddistr 	 = "";
					$respuesta->paisr 	 	 = "";
				}
			}
			else 
			{
				$respuesta->pnombre   	 = "";
				$respuesta->snombre   	 = "";
				$respuesta->papellido 	 = "";
				$respuesta->sapellido 	 = "";
				$respuesta->tdocumento 	 = "1";
				$respuesta->sexo 	  	 = "";
				$respuesta->fechanac  	 = "";
				$respuesta->ecivil 		 = "";
				$respuesta->nacionalidad = "PARAGUAYA";
				$respuesta->telefono 	 = "";
				$respuesta->email 		 = "";
				$respuesta->dccionr 	 = "";
				$respuesta->coddptor 	 = "";
				$respuesta->coddistr 	 = "";
				$respuesta->paisr 	 	 = "";
			}
		}
	}
}


echo json_encode($respuesta);
?>