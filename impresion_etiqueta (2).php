<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$v_12 = $_SESSION[ 'V_12' ];
$v_121 = $_SESSION[ 'V_121' ];

$nordentra = $_GET[ 'nordentra' ];
$codservicio = $_GET[ 'codservicio' ];

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

        @media print {
          body {
              display: table;
              table-layout: fixed;
              padding-top: 0cm;
              padding-bottom: 2.5cm;
              height: auto;
          }
        }
    </style>

</head>

<!---- onload="imprimir();" onfocus="window.close()"------->
<body>
    <div>

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
				   max(e.cantetiq) as cantetiq
			from estudios e, tipomuestra t, sectores s, estrealizar er
			where e.codestudio  = er.codestudio
			and   e.codtmuestra = t.codtmuestra
			and   e.codsector   = s.codsector
			and   er.nordentra  = '$nordentra'
			and   er.codservicio= '$codservicio'
group by er.codservicio,
				   s.codsector,
				   t.codtmuestra,
				   t.nomtmuestra,
				   er.nropaciente,
				   er.nordentra,
				   er.fechatmues,
				   er.horatmues,
				   er.nromuestra";
        $result = pg_query( $link, $query );
		$countlc= pg_num_rows($result);

        $i = 0;
    if($countlc != 0)
		{
			while ( $row = pg_fetch_array( $result ) )
			{
				$i = $i + 1;

				$codservicio = $row[ "codservicio" ];
				$codsector   = $row[ "codsector" ];
				$nomestudio  = $row[ "nomestudio" ];
				$nropaciente = $row[ "nropaciente" ];
				$nordentra   = $row[ "nordentra" ];
				$nromuestra  = $row[ "nromuestra" ];
				$cantetiq    = $row[ "cantetiq" ];

				$query1 = "select * from establecimientos where codservicio = '$codservicio'";
				$result1 = pg_query( $link, $query1 );

				$row1 = pg_fetch_assoc( $result1 );

				$nomservicio = $row1[ "nomservicio" ];

				$query2 = "select * from ordtrabajo where nordentra = '$nordentra' and codservicio = '$codservicio'";
				$result2 = pg_query( $link, $query2 );

				$row2 = pg_fetch_assoc( $result2 );

				$fecharec    = date( "d/m/Y", strtotime( $row2[ "fecharec" ] ) );
				$codorigen   = $row2[ "codorigen" ];
				$horarec     = $row2[ "horarec" ];
        $coddgvs     = $row2[ "cod_dgvs" ];

				$query3 = "select * from paciente where nropaciente = '$nropaciente'";
				$result3 = pg_query( $link, $query3 );

				$row3 = pg_fetch_assoc( $result3 );

				$pnombre   = $row3[ "pnombre" ];
				$snombre   = $row3[ "snombre" ];
				$papellido = $row3[ "papellido" ];
				$sapellido = $row3[ "sapellido" ];
				$cedula    = $row3[ "cedula" ];

				$query4 = "select * from origenpaciente where codorigen = '$codorigen'";
				$result4 = pg_query( $link, $query4 );

				$row4 = pg_fetch_assoc( $result4 );

				$nomorigen = $row4[ "nomorigen" ];

				$query5 = "select * from sectores where codsector = '$codsector'";
				$result5 = pg_query( $link, $query5 );

				$row5 = pg_fetch_assoc( $result5 );

				$nomsector = $row5[ "nomsector" ];

				$muestra = str_pad($nromuestra, 8, '0', STR_PAD_LEFT);

				for ($j = 1; $j <= $cantetiq; $j++)
				{

					echo '<div style="width:280px; margin-top: 8px; padding-top: 3px; padding-bottom:7px; height: 10px;">';

					echo '<div style="font-size: 19px; font-family: Arial;"> Orden &nbsp;&nbsp;'.$nordentra.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$fecharec.' '.$horarec.'</div>';

					echo '<div style="height: 65px;margin-left: 20px;"><svg id="barcode'.$i.'"></svg></div>';

          echo '<div style="font-size: 17px; font-family: Arial;">'.$pnombre.' '.$snombre.' '.$papellido.'</div>';

          echo '<div style="font-size: 17px; font-family: Arial;">CI &nbsp;&nbsp;'.$cedula.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; EDAD &nbsp;&nbsp;'.$edada.'</div>';

					echo '<div style="font-size: 15px; font-family: Arial;">'.$nomservicio.'</div>';

					echo '<div style="font-size: 12px; font-family: Arial;">'.$nomorigen.'</div>';

          echo '<div style="font-size: 16px; font-family: Arial;"> Id.DGVS &nbsp'.$coddgvs.'</div>';

          if($j != $cantetiq)
					{
						   echo '</div><br><br><br><br><br><br><br><br>';
					}

					echo '<script type="text/javascript">
							JsBarcode( "#barcode'.$i.'", "'.$codservicio.$nordentra.'", {
								format: "CODE128A",
								lineColor: "#000000",
								width: 3,
								height: 48,
								displayValue: false
							} );
						</script>';
				}
			}
		}
		else
		{
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
		}

        ?>
    </div>
</body>
</html>
