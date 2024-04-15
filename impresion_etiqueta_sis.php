<?php
ini_set("display_errors", true);
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();
ini_set("memory_limit", "-1");
set_time_limit(0);
date_default_timezone_set('America/Asuncion');
header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

include( "conexion.php" );
$link = Conectarse();

$nordentra   = $_GET[ 'nordentra' ];
$codservicio = $_GET[ 'codservicio' ];

function acentos($cadena)
{
   $search = explode(",","Í,�,�,�,�,�,�,�,�,�,�,�,�,á,é,í,ó,ú,ñ,�á,�é,�í,�ó,�ú,�ñ,Ó,� ,É,� ,Ú,“,�� ,¿,Ñ,Á,�");
   $replace = explode(",","�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,\",\",�,�,�,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);

   return $cadena;
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

	<script type="text/javascript">
            function imprimir() {
                if (window.print) {
                    window.print();
                } else {
                    alert("La función de impresion no esta soportada por su navegador.");
                }
            }
    </script>

    <style>
        #contenedor {
            width:400px;
            height: 100px;
            margin: auto;
        }
    </style>

</head>

<!---- onload="imprimir();" onfocus="window.close()"------->
<body>

        <?php

        $query = "select  distinct er.codservicio,
				   s.codsector,
				   t.codtmuestra,
				   t.nomtmuestra,
				   er.nropaciente,
				   er.nordentra,
				   er.fechatmues,
				   er.horatmues,
				   er.nromuestra,
           		   e.nomestudio,
				   max(e.cantetiq) as cantetiq
			from estudios e, tipomuestra t, sectores s, estrealizar er
			where e.codestudio   = er.codestudio
			and   er.codtmuestra = t.codtmuestra
			and   e.codsector    = s.codsector
			and   er.nordentra   = '$nordentra'
			and   er.codservicio = '$codservicio'
			group by er.codservicio,
				   s.codsector,
				   t.codtmuestra,
				   t.nomtmuestra,
				   er.nropaciente,
				   er.nordentra,
				   er.fechatmues,
				   er.horatmues,
				   er.nromuestra,
           		   e.nomestudio";
        $result = pg_query( $link, $query );
		$countlc= pg_num_rows($result);

        $i = 0;
		if($countlc != -1){
			// while ( $row = pg_fetch_array( $result ) ) {
				$i = $i + 1;

				// $codservicio = $row[ "codservicio" ];
				// $codsector   = $row[ "codsector" ];
				// $nomestudio  = $row[ "nomestudio" ];
				// $nropaciente = $row[ "nropaciente" ];
				// $nordentra   = $row[ "nordentra" ];
				// $nromuestra  = $row[ "nromuestra" ];
				// $cantetiq    = $row[ "cantetiq" ];
				$cantetiq    = 2;


				// Busca el Establecimiento
				// $query1 = "select * from establecimientos where codservicio = '$codservicio'";
				// $result1 = pg_query( $link, $query1 );

				// $row1 = pg_fetch_assoc( $result1 );

				// $nomservicio = $row1[ "nomservicio" ];
				// ===================================================================================================
				// Busca la orden de trabajo
				// $query2 = "select * from ordtrabajo where nordentra = '$nordentra' and codservicio = '$codservicio'";
				$query2 = "select * from ordtrabajo where cod_dgvs = '$nordentra' and nro_toma = '$codservicio'";
				$result2 = pg_query( $link, $query2 );

				$row2 = pg_fetch_assoc( $result2 );

				$fecharec    = date( "d/m/Y", strtotime( $row2[ "fecharec" ] ) );
				$ordtrabajo  = $row2[ "nordentra" ];
				$codorigen   = $row2[ "codorigen" ];
				$codservicioimp = $row2[ "codservicio" ];
				$horarec     = $row2[ "horarec" ];
        		$coddgvs     = $row2[ "cod_dgvs" ].'/'.$row2[ "nro_toma" ];
        		$nomservicio = $row2[ "nom_servicio" ];
        		// ===================================================================================================
        		// Busca nombre del Paciente
				$query3 = "select * from paciente where nropaciente = '{$row2[ 'nropaciente' ]}'";
				$result3 = pg_query( $link, $query3 );

				$row3 = pg_fetch_assoc( $result3 );

				$pnombre   = $row3[ "pnombre" ];
				$snombre   = $row3[ "snombre" ];
				$papellido = $row3[ "papellido" ];
				$sapellido = $row3[ "sapellido" ];
				$cedula    = $row3[ "cedula"];
        		$edada     = $row3[ "edada"];
        		// ===================================================================================================
				$query4 = "select * from origenpaciente where codorigen = '{$row2[ 'codorigen' ]}'";
				$result4 = pg_query( $link, $query4 );

				$row4 = pg_fetch_assoc( $result4 );

				$nomorigen = $row4[ "nomorigen" ];
				// ===================================================================================================
				$query5 = "select * from sectores where codsector = (SELECT codsector FROM resultados WHERE cod_dgvs = '$nordentra' and nro_toma = '$codservicio') ";
				$result5 = pg_query( $link, $query5 );
				$row5 = pg_fetch_assoc( $result5 );
				$nomsector = $row5[ "nomsector" ];
				// $muestra = str_pad($nromuestra, 8, '0', STR_PAD_LEFT);
				// ===================================================================================================
				// Busca el Esutdio
				$query6 = "select * from estudios where codestudio = (SELECT codestudio FROM resultados WHERE cod_dgvs = '$nordentra' and nro_toma = '$codservicio')";
				// echo $query6;
				$result6 = pg_query( $link, $query6 );
				$row6 = pg_fetch_assoc( $result6 );
				$nomestudio = $row6[ "nomestudio" ];
				// ===================================================================================================
				// Busca el NroLaboratorio
				$query7 = "SELECT nroestudio FROM resultados WHERE cod_dgvs = '$nordentra' and nro_toma = '$codservicio'";
				// echo $query7;
				$result7 = pg_query( $link, $query7 );
				$row7 = pg_fetch_assoc( $result7 );
				$nroLCSP = $row7[ "nroestudio" ];
				// ===================================================================================================
				$etiqueta = "";
				for ($j = 1; $j <= 1; $j++){

					echo '<div style="width:370px; margin-top: 8px; padding-top: 3px; padding-bottom:7px; height: 10px;">';
					echo '<div style="font-size: 28px; font-family: Times; float: left;"> Orden: '.$ordtrabajo.' </div><div style="font-size: 17px; font-family: Arial; float: left; padding-left: 60px;">'.$fecharec.' '.$horarec.'</div>';
					echo '<div style="height: 65px;margin-bottom: 40px;"><svg id="barcode'.$j.'"></svg></div>';
          			echo '<div style="font-size: 19px; font-family: Arial;">'.acentos(utf8_decode($pnombre.' '.$snombre.' '.$papellido)).'</div>';
         			echo '<div style="font-size: 20px; font-family: Arial;">CI &nbsp;&nbsp;'.$cedula.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; EDAD &nbsp;&nbsp;'.$edada.'</div>';
					echo '<div style="font-size: 15px; font-family: Arial;">'.$nomservicio.'</div>';
				/*	echo '<div style="font-size: 12px; font-family: Arial;">'.$nomorigen.'</div>';*/
          			echo '<div style="font-size: 20px; font-family: Arial;"> Id.DGVS &nbsp'.$coddgvs.'</div>';
					if($j != $cantetiq){
						echo '</div><br><br><br><br><br><br><br><br><br><br>';
					}
					echo '<script type="text/javascript">
							JsBarcode( "#barcode'.$j.'", "'.$codservicioimp.$ordtrabajo.'", {
								format: "CODE128A",
								lineColor: "#000000",
								width: 2,
								height: 48,
								displayValue: false
							} );
						</script>';
				}
				// echo $etiqueta;
			// }
		}
		else{
			echo '<script type="text/javascript">
						let timerInterval
						swal({
						  title: "No se puede imprimir, Falta validar las muestras!",
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
			// echo '<script type="text/javascript">
			// 		JsBarcode( "#barcode'.$i.'", "'.$codservicio.$nordentra.'", {
			// 			format: "CODE128A",
			// 			lineColor: "#000000",
			// 			width: 2,
			// 			height: 48,
			// 			displayValue: false
			// 		} );
			// 	</script>';
		}

        ?>
</body>
</html>
