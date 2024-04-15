<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$v_162 = $_SESSION['V_162'];

$nordentra 	 = $_GET['nordentra'];
$codservicio = $_GET['codservicio'];
$codestudio  = $_GET['codestudio'];

$fechaimp = date("d/m/Y", time());
$horaimp  = date("H:i");

$query = "select * from establecimientos where codservicio = '$codservicio'";
$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$nomservicio = $row["nomservicio"];

$query1 = "select * from ordtrabajo where nordentra = '$nordentra'";
$result1 = pg_query($link,$query1);

$row1 = pg_fetch_assoc($result1);

$nropaciente = $row1["nropaciente"];
$fecharec 	 = date("d/m/Y", strtotime($row1["fecharec"]));

$horarec     = $row1["horarec"];

$query2 = "select * from paciente where nropaciente = '$nropaciente'";
$result2 = pg_query($link,$query2);

$row2 = pg_fetch_assoc($result2);


$pnombre 	= $row2["pnombre"];
$snombre 	= $row2["snombre"];
$papellido 	= $row2["papellido"];
$sapellido 	= $row2["sapellido"];
$cedula 	= $row2["cedula"];
$tdocumento = $row2["tdocumento"];
$telefono 	= $row2["telefono"];
$fechanac 	 = date("d/m/Y", strtotime($row2["fechanac"]));

switch ($tdocumento) {
    case '1':
        $nomdocumento = "Cedula";
        break;
    case '2':
        $nomdocumento = "PASSPORT";
        break;
    case '3':
        $nomdocumento = "Carnet Indigena";
        break;
	case '4':
        $nomdocumento = "Otros";
        break;
	case '5':
        $nomdocumento = "No Tiene";
        break;
}


if($row2["sexo"] == 1)
{
	$sexo  = "Male";
}
else
{
	$sexo  = "Female";
}

$query3 = "select distinct nroestudio, codestudio, codmetodo
			from  resultados r
			where r.nordentra   = '$nordentra'
			--and   r.fechareval is not null
			order by nroestudio";
$result3 = pg_query($link,$query3);
$countlc= pg_num_rows($result3);


if($row2["edada"] != 0)
{
	$edad = $row2["edada"];
}
else
{
	$edad = $row2["edadm"];
}

function acentos($cadena)
{
   $search = explode(",","Ã,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,Ã‘,Ã,ü,Ã‘");
   $replace = explode(",","Í,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,Ñ,Á,&uuml;,Ñ");
   $cadena= str_replace($search, $replace, $cadena);

   return $cadena;
}


if ( $_SESSION[ 'usuario' ] != "SI" ) {
	header( "Location: index.php" );
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="shortcut icon" href="favicon.ico"/>
<script type="text/javascript" src="js/JsBarcode.all.min.js"></script>

<!----------- PARA ALERTAS  ---------->
<script src="js/sweetalert2.all.min.js" type="text/javascript"></script>
<style>
#contenedor {
	width: 950px;
	height: 1400px;
	margin: auto;

}

</style>
</head>
<body>
	<?php
	if($countlc != 0)
	{
		echo '<div id="contenedor">

		  <div style="font-size: 24px; padding-bottom: 5px; margin-top: 20px; text-align:left; height: 150px; border: 1px #000000 solid;">
			<div style="float: left; margin-left: 150px; margin-top: 30px;margin-right:20px;">
				<img src="images/logo-msp-labo.fw.png" width="673">
			</div>
		  </div>
		  <div style="border-bottom: 1px #000000 solid; border-left: 1px #000000 solid; border-right: 1px #000000 solid; padding-bottom: 10px; padding-left: 10px;">
			<div style="font-size: 20px; margin-top: 5px; text-align:left"
			><b>Order No.:</b> '.$nordentra.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <b>Service: </b> '.$nomservicio.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </div>
		  <div style="font-size: 18px; text-align:left;margin-top: 5px;"
		  ><b>Document Type:</b> '.$nomdocumento.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <b>Document Number:</b> '.$cedula.'
		  </div>
		  <div style="font-size: 18px; margin-top: 5px; text-align:left"><b>Name:</b> '.$papellido.' '.$sapellido.' '.$pnombre.' '.$snombre.'</div>
		
			 <div style="font-size: 18px; margin-top: 5px; text-align:left;"><b>Gender:</b> '.$sexo.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b>Age:</b> '.$edad.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Date of Birth (dd/mm/yyyy):</b> '.$fechanac.' </div>

		  <div style="font-size: 18px; margin-top: 5px; text-align:left;"><b>Telephone Number:</b> '.$telefono.'
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <b>Date (dd/mm/yyyy):</b> '.$fecharec.'   
		  </div>
	
		  </div>

		<div style="height: 280px;">
		  <div>
			  <div style="font-size: 18px; text-align: left; margin-bottom: 10px; margin-top: 10px; font-weight: bold; float: left; width: 450px;">ANALYSIS</div>

			  <div style="font-size: 18px; text-align: left; margin-bottom: 10px; margin-top: 10px; font-weight: bold; float: left; width: 200px">RESULT</div>

			 

			  <div style="font-size: 18px; text-align: left; margin-bottom: 10px; margin-top: 10px; font-weight: bold; float: left; width: 280px">REFERENCE VALUE</div>
		   </div>

		   <div>';

			while ($row3 = pg_fetch_array($result3))
			{
					$codestudio   = $row3['codestudio'];
					$codmetodo    = $row3['codmetodo'];

					$query4 = "select * from estudios where codestudio = '$codestudio'";
					$result4 = pg_query( $link, $query4 );

					$row4 = pg_fetch_assoc( $result4 );

					$nomestudio = $row4[ "nomestudio" ];

					$query5 = "select * from metodos where codmetodo = '$codmetodo'";
					$result5 = pg_query( $link, $query5 );

					$row5 = pg_fetch_assoc( $result5 );

					$nommetodo = $row5[ "nommetodo" ];

					$query10 = "select *
								from  resultados r
								where r.nordentra   = '$nordentra'
								and   r.codservicio = '$codservicio'
								and   r.codestudio  = '$codestudio'
								--and   r.fechareval is not null
								order by nroestudio, nroorden";
					$result10 = pg_query($link,$query10);

					echo '<div>
					<div style="font-size: 16px; text-align: left; margin-bottom: 1px; margin-top: 10px; font-weight: bold; float: left; width: 450px; text-decoration: underline">'.$nomestudio.':</div>

			
				</div>';

					echo '<div>
					

					  <div style="font-size: 16px; text-align: left; float: left; width: 150px; height: 16px; text-align: center; margin-bottom: px;"></div>

					  <div style="font-size: 18px; text-align: left; float: left; width: 150px; height: 16px; text-align: center; margin-bottom: 40px;"></div>

					 
				  </div>';

				while ($row10 = pg_fetch_array($result10))
				{
					$coddetermina = $row10['coddetermina'];
					$resultado    = $row10['resultado'];
					$codumedida   = $row10['codumedida'];
					$nroorden     = $row10['nroorden'];
          $codresultado = $row10['codresultado'];

					$query6 = "select * from determinaciones where codestudio = '$codestudio' and coddetermina = '$coddetermina'";
					$result6 = pg_query( $link, $query6 );

					$row6 = pg_fetch_assoc( $result6 );

					$nomdetermina = $row6[ "nomdetermina" ];

					$query7 = "select * from unidadmedida where codumedida = '$codumedida'";
					$result7 = pg_query( $link, $query7 );

					$row7 = pg_fetch_assoc( $result7 );

					$nomumedida = $row7[ "nomumedida" ];

					$query8 = "select * from determinacionrango where codestudio = '$codestudio' and coddetermina = '$coddetermina'";
					$result8 = pg_query( $link, $query8 );

					$row8 = pg_fetch_assoc( $result8 );

					$tipo 	  = $row8[ "tipo" ];
					$sexo 	  = $row8[ "sexo" ];
					$edadmin  = $row8[ "edadmin" ];
					$edadmax  = $row8[ "edadmax" ];
					$inirango = $row8[ "inirango" ];
					$finrango = $row8[ "finrango" ];

					$query9 = "select rc.codresultado,
        												 rc.nomresultado
        										from resultadoposible rp, resultadocodificado rc
        										where rp.codresultado = rc.codresultado
        										and rp.codestudio = '$codestudio'
        										and rp.coddetermina = '$coddetermina'
                            and rc.codresultado = '$codresultado'";

					$result9 = pg_query( $link, $query9 );

					$row9 = pg_fetch_assoc( $result9 );

					$nomresultado = $row9[ "nomresultado" ];

          if($resultado == '' || $resultado == '&nbsp;')
          {
              $resultado = $row9[ "nomresultado" ];
          }

						//textosestudios
						//textos

					pg_query( $link, "UPDATE public.resultados
									SET codusu2 = '$codusu', fechaent = '$fechaimp', horaentre = '$horaimp', codestado = '007'
									WHERE nordentra = '$nordentra' and codservicio = '$codservicio' and nroorden = '$nroorden' and codestudio = '$codestudio' and coddetermina = '$coddetermina'" );
		echo '<div>			

 <div style="font-size: 16px; text-align: left; margin-bottom: 1px; font-weight: bold; margin-top: 2px; ; float: left; width: 1200px">MATERIAL: NASOPHARYNGEAL SWAB.</div> 	 
 </div>';

					echo '<div> 
					 <div style="font-size: 18px; text-align: left; margin-bottom: 1px; margin-top: 30px; float: left; width: 400px; height: 20px;">'.$nomdetermina.':</div>

					

					  <div style="font-size: 18px; text-align:left;font-weight: bold; margin-bottom: 1px; margin-top: 30px; float: left; width: 165px; height: 20px;">'.$resultado.'</div>

					  <div style="font-size: 18px; text-align: center; margin-bottom: 1px; margin-top: 30px; float: left; width: 100px; height: 20px;">'.$nomumedida.'</div>

<div style="font-size: 18px; text-align: left; margin-bottom: 1px; margin-top: 30px; ; float: left; width: 150px">The presence of SARS-CoV-2 RNA is not detected in the analyzed sample.(NEGATIVE)</div>

<br><br>
<br><br><br><br>
   <br><br><br><br><br><br><br><br><br>
 <div style="font-size: 20px; text-align: left; margin-bottom: 10px; margin-top: 10px; ; float: left; width: 1200px">METHOD: RT-qPCR                                               
 -  RT-qPCR Protocol developed by the  Charite Hospital (Berlin, Germany).<br>
         Recommended for  PAHO/WHO.</div>
<br><br><br><br>
 <div style="font-size: 20px; text-align: left; margin-bottom: 10px; margin-top: 10px; ; float: left; width: 1200px">OBSERVATION: "The sample was taken on Wednesday, March 30, 2022, at 08:00 a.m."</div>


<br><br><br><br>
   <br><br><br><br><br><br><br><br><br>
 <div style="font-size: 16px; text-align: center; margin-bottom: 10px; margin-top: 10px; ; float: rigth;font-weight: bold; width: 1200px">Validated by: Dr. María José Ortega Soler </div>
 <div style="font-size: 16px; text-align: center; margin-bottom: 10px; margin-top: 10px; ; float: rigth;font-weight: bold; width: 1200px">Professional Registry No. 1.136 </div>

				   </div>';
 

		

				}

			}

			echo '</div>
<br><br><br><br>
          <br><br><br><br><br><br><br><br><br><br><br><br>
          <br><br><br><br><br><br><br><br><br><br><br><br>
          <br><br><br>
				  <div style="font-size: 15px; text-align: center; border: #000000 solid 2px;">
					<b>** Not valid for legal procedure**<br>
						Avda. Venezuela c/ Tte. Escurra<br>
						Telephone number: +59521292653</b>
				  </div>
				</div>';
		}
		else
		{
			echo '<script type="text/javascript">
						let timerInterval
						swal({
						  title: "No se puede imprimir, Falta validar los resultados!",
						  html: "",
						  type: "warning",
						  timer: 2800,
						  onOpen: () => {
							swal.showLoading()
							timerInterval = setInterval(() => {
							  swal.getContent().querySelector("strong")
								.textContent = swal.getTimerLeft()
							}, 100)
						  },
						  onClose: () => {
							clearInterval(timerInterval);
							window.close();
						  }
						}).then((result) => {
						  if (
							// Read more about handling dismissals
							result.dismiss === swal.DismissReason.timer
						  ) {
							console.log("I was closed by the timer")
						  }
						})
					</script>';
		}
	  ?>


</body>
</html>
