<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();

include( "conexion.php" );
$con = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$nroeval  = $_GET['nroeval'];
$usuario  = $_GET['usuario'];

$v_181   = $_SESSION['V_181'];

$q=pg_query($con,"SELECT * FROM evaluaciondet WHERE nroeval='$nroeval'");

$q1=pg_query($con,"SELECT * FROM evaluacion WHERE nroeval='$nroeval'");

$rowp = pg_fetch_assoc($q1);

$peranio 	 = $rowp["peranio"];
$permes  	 = $rowp["permes"];
$lote 	 	 = $rowp["lote"];
$fechainicio = date("d/m/Y", strtotime($rowp["fechainicio"]));
$fecharcierre= date("d/m/Y", strtotime($rowp["fecharcierre"]));
$codsector 	 = $rowp["codsector"];
$tipo	 	 = $rowp["tipo"];
$puntaje	 = $rowp["tipo"];
$subprograma = $rowp["subprograma"];

$querysector = "select * from sectores where codsector = '$codsector'";
$resultsector = pg_query( $con, $querysector );

$rowsector = pg_fetch_assoc( $resultsector );

$nomsector = $rowsector[ "nomsector" ];

switch ($permes) 
{
    case '1':
        $nommes = 'ENERO';
        break;
    case '2':
        $nommes = 'FEBRERO';
        break;
    case '3':
        $nommes = 'MARZO';
        break;
    case '4':
        $nommes = 'ABRIL';
        break;
    case '5':
        $nommes = 'MAYO';
        break;
    case '6':
        $nommes = 'JUNIO';
        break;
    case '7':
        $nommes = 'JULIO';
        break;
    case '8':
        $nommes = 'AGOSTO';
        break;
    case '9':
        $nommes = 'SETIEMBRE';
        break;
    case '10':
        $nommes = 'OCTUBRE';
        break;
    case '11':
        $nommes = 'NOVIEMBRE';
        break;
    case '12':
        $nommes = 'DICIEMBRE';
        break;
}


function acentos($cadena)
{
   $search = explode(",","Ã,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,Ã‘,Ã,ü");
   $replace = explode(",","Í,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,Ñ,Á,&uuml;");
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

<!----------- JAVASCRIPT ---------->

<script src="js/jquery.min.js"></script>

<!-- jQuery -->
<script src="js/jquery.js"></script>
	
<script src="js/html2pdf.bundle.min.js"></script>

<script>

function volver()
{
	//window.close();
	window.location = "elegir_examen.php";
}
	
	
function generatePDF() 
{
      // Choose the element that our invoice is rendered in.
      const element = document.getElementById('invoice');
      // Choose the element and save the PDF for our user.
      html2pdf().from(element).save();
	
	  setTimeout(function(){  volver(); }, 3000);
     
}
	
	
    $( window ).on( "load", function() {
        generatePDF();
    });
	
</script>
<style>

@page {size: legal; portrait; }

tr.salto {page-break-after:always}
	
footer {
  background-color: black;
  position: fixed;
  bottom: 0;
  width: 100%;
  height: 40px;
  color: white;
  text-align: center;
  border-top: solid 1px;
}
</style>
</head>
<body>
  <div id="invoice">
	<table>
				<tbody>
					<tr>
						<td>
							<table width="700" border="0" align="center">
								  <thead style="display: table-header-group">
								    <tr style="border-bottom: solid 1px; border-top: solid 1px;">
										<td colspan="4" style="padding-bottom: 20px;">
											<img src="images/logo-msp-labo.fw.png" style="width: 378px;">
										</td>
									</tr>
									<tr style="font-size: 12px;">
									  <td width="193" style="padding-top: 12px;padding-left: 20px;"><b>Tipo Examen:</b></td>
									  <td width="218" style="padding-top: 12px;">EVALUACION CONTINUA</td>
									  <td width="211" style="padding-top: 12px;"><b>Sector: </b></td>
									  <td width="246" style="padding-top: 12px;"><?php echo $nomsector; ?></td>
									</tr>
									
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Nro. Evaluacion:</b></td>
									  <td><?php echo $nroeval; ?></td>
									  <td><b>Lote:</b> </td>
									  <td><?php echo $lote; ?></td>
									</tr>
									
									
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Mes:</b> </td>
									  <td><?php echo $nommes; ?></td>
									  <td><b>A&ntilde;o:</b> </td>
									  <td><?php echo $peranio; ?></td>
									</tr>
									
									<!--<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Puntaje:</b></td>
									  <td>echo $puntaje</td>
									  <td></td>
									  <td></td>
									</tr> -->
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Fecha Inicio:</b></td>
									  <td><?php echo $fechainicio; ?></td>
									  <td><b>Fecha Cierre:</b> </td>
									  <td><?php echo $fecharcierre; ?></td>
									</tr>
									  <tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Sub-programa:</b></td>
									  <td><?php echo $subprograma; ?></td>
									  
									</tr>
									  
									<tr>
									  <td colspan="4">&nbsp;</td>

									</tr>

									</thead>

    						<br>
						<?php
	  
						while($row=pg_fetch_array($q))
						{
							$i = $i + 1;

							$pregunta=$row['pregunta'];
							$item	 =$row['item'];

							echo '<tr>
								  <td height="33" colspan="4" style="font-weight: bold;text-decoration: underline;">'.$i.':'.$pregunta.'</td>
								</tr>';

							$q1=pg_query($con,"SELECT * FROM evaluaciondet WHERE nroeval='$nroeval' and item = '$item'" );

							while($row1=pg_fetch_array($q1) )
							{
								$opc1=$row1['opc1'];
								$opc2=$row1['opc2'];
								$opc3=$row1['opc3'];
								$opc4=$row1['opc4'];
								$opc5=$row1['opc5'];
								$opc6=$row1['opc6'];

								echo '<tr><td colspan="4">1). '.$opc1.'</td></tr>';
								echo '<tr><td colspan="4">2). '.$opc2.'</td></tr>';
								echo '<tr><td colspan="4">3). '.$opc3.'</td></tr>';
								echo '<tr><td colspan="4">4). '.$opc4.'</td></tr>';
								echo '<tr><td colspan="4">5). '.$opc5.'</td></tr>';
								echo '<tr><td colspan="4">6). '.$opc6.'</td></tr>';

							}

						}


					  ?>
							
							</table>
						</td>
				  </tr>
				</tbody>

			</table>
	  
	  

    </div>


</body>
</html>
