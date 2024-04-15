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

$q=pg_query($con,"SELECT distinct codestudio FROM evaluaciondeterminacion WHERE nroeval='$nroeval'");

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
$subprograma = $rowp["sub_programa"];

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

@page {size: A4 portrait; }

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

							<table width="700" border="0">
								  <thead style="display: table-header-group">
								    <tr style="border-bottom: solid 1px; border-top: solid 1px;">
										<td colspan="4" style="padding-bottom: 20px;">
											<img src="images/logo-msp-labo.fw.png" style="width: 378px;">
										</td>
									</tr>
									<tr style="font-size: 14px;">
									  <td width="193" style="padding-top: 14px;padding-left: 20px;"><b>Tipo Examen:</b></td>
									  <td width="218" style="padding-top: 14px;">CONTROL DE CALIDAD</td>
									  <td width="211" style="padding-top: 14px;"><b>Sector: </b></td>
									  <td width="246" style="padding-top: 14px;"><?php echo $nomsector; ?></td>

									</tr>
							<tr style="font-size: 14px;">
									  <td style="padding-left: 20px;"><b>Sub-Programa:</b></td>
									  <td><?php echo $subprograma; ?></td>
									  
									</tr>

									<tr style="font-size: 14px;">
									  <td style="padding-left: 20px;"><b>Nro. Evaluacion:</b></td>
									  <td><?php echo $nroeval; ?></td>
									  <td><b>Lote:</b> </td>
									  <td><?php echo $lote; ?></td>
									</tr>
									
									
									<tr style="font-size: 14px;">
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
									  
									<tr style="font-size: 14px;">
									  <td style="padding-left: 20px;"><b>Fecha Inicio:</b></td>
									  <td><?php echo $fechainicio; ?></td>
									  <td><b>Fecha Cierre:</b> </td>
									  <td><?php echo $fecharcierre; ?></td>
									</tr>
		
									

									
									<tr>
									  <td colspan="4">&nbsp;</td>

									</tr>

						<?php
	  
						while($row=pg_fetch_array($q))
						{
							$codestudio  = $row['codestudio'];
							
							$sql1 = "select *
									from estudios
									where codestudio = '$codestudio'";

							$res1 = pg_query($con,$sql1);
							$rowp1 = pg_fetch_assoc($res1);

							$nomestudio = $rowp1["nomestudio"];

							echo '<tr>
									  <td colspan="4">&nbsp;</td>

								  </tr>

									
								<tr>
								  <td height="33" colspan="4" style="font-weight: bold;text-decoration: underline;">Estudio &nbsp;:'.$nomestudio.'</td>
								</tr></thead></table>';


							$q1=pg_query($con,"SELECT * FROM evaluaciondeterminacion WHERE nroeval='$nroeval' and codestudio = '$codestudio'" );
							
							echo '<table id="example" class="table table-striped table-hover" width="100%">
							  <thead>
								<tr>
								  <td scope="col"><b>Determinacion</b> </td>
								  <td scope="col"><b>Resultado </b></td>
								  <td scope="col"><b>Metodo </b></td>
								  <td scope="col"><b>Reactivo </b></td>
								  <td scope="col" ><b>Marca </b></td>
                        		  <td scope="col" ><b>Lote </b></td>
                        		  <td scope="col" ><b>Fecha Vencimiento</b> </td>
								  <td scope="col"><b>Equipo </b></td>
								  <td scope="col"><b>Marca </b></td>
								</tr>
							  </thead>
							  <tbody>';

							$i = 0;
							while($row1=pg_fetch_array($q1) )
							{
								$i = $i + 1;
								
								$coddetermina= $row1['coddetermina'];

								$sql = "select *
										from determinaciones
										where codestudio = '$codestudio'
										and   coddetermina = '$coddetermina'";

								$res = pg_query($con,$sql);
								$rowp = pg_fetch_assoc($res);

								$nomdetermina = $rowp["nomdetermina"];

								echo '<tr><td>'.$nomdetermina.'</td>
										  <td></td>
										  <td></td>
										  <td></td>
										  <td></td>
										  <td></td>
										  <td></td>
										  <td></td>
										  <td></td>
								      </tr>';
								

							}

						}


					  ?>
					</tbody>
			</table>


    </div>


</body>
</html>
