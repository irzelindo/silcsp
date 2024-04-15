<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$con = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$nroeval  = $_GET['nroeval'];
$usuario  = $_GET['codusu'];

//Agregamos la libreria para genera códigos QR
require "phpqrcode/qrlib.php";

//Declaramos una carpeta temporal para guardar la imagenes generadas
$dir = 'temp/';

//Si no existe la carpeta la creamos
if (!file_exists($dir))
    mkdir($dir);

    //Declaramos la ruta y nombre del archivo a generar
$filename = $dir.$nroeval.$usuario.'.png';

    //Parametros de Condiguración

$tamaño = 10; //Tamaño de Pixel
$level = 'L'; //Precisión Baja
$framSize = 3; //Tamaño en blanco
$contenido = "http://silcsp.mspbs.gov.py/imprimir_leishmania_final_comprobante.php?nroeval=$nroeval&usuario=$usuario"; //Texto

//Enviamos los parametros a la Función para generar código QR
QRcode::png($contenido, $filename, $level, $tamaño, $framSize);

$q4			= pg_query($con,"SELECT * FROM usuarios WHERE codusu = '$usuario'");

$row4 		= pg_fetch_assoc($q4);

$nomusuario = $row4["nomyape"];

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
$obs	 	 = $rowp["obs"];
$enunciado   = $rowp["enunciado"];

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
	window.location = "resultados_previstos.php";
}


function generatePDF()
{
      // Choose the element that our invoice is rendered in.
      const element = document.getElementById('invoice');
      // Choose the element and save the PDF for our user.
      html2pdf().set({
        margin: 1,
        filename: 'documento.pdf',
        image: {
            type: 'jpeg',
            quality: 0.98
        },
        html2canvas: {
            scale: 3, // A mayor escala, mejores gráficos, pero más peso
            letterRendering: true,
        },
        jsPDF: {
            unit: "in",
            format: "a3",
            orientation: 'portrait' // landscape o portrait
        },
        pagebreak: { mode: 'avoid-all', after: '.avoidThisRow' } 
    }).from(element).save();

	  setTimeout(function(){  volver(); }, 3000);

}


  $( window ).on( "load", function() {
        generatePDF();
    });

</script>

</head>
<body>
  <div id="invoice">
	<table align="center">
				<tbody>
					<tr>
						<td>
							<table width="900" border="0" align="center" cellspacing="0" cellpadding="3">
								  <thead style="display: table-header-group">
								    <tr style="border-bottom: solid 1px; border-top: solid 1px;">
										<td colspan="7" style="padding-bottom: 20px;text-align: center;">
											<img src="images/logo-msp-labo.fw.png" style="width: 378px;">
										</td>
									</tr>
									<tr style="font-size: 17px;">
									  <td width="193" style="padding-top: 12px;padding-left: 20px;"><b>Tipo Examen:</b></td>
									  <td colspan="2" style="padding-top: 12px;">CONTROL DE CALIDAD</td>
									  <td width="246" colspan="1"  style="padding-top: 12px;"><b>Sector: </b></td>
									  <td colspan="3"><?php echo $nomsector; ?></td>
									</tr>

									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Nro. Evaluacion:</b></td>
									  <td colspan="2"><?php echo $nroeval; ?></td>
									  <td><b>Lote:</b></td>
										<td colspan="3"><?php echo $lote; ?></td>
									</tr>


									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Mes:</b> </td>
									  <td colspan="2"><?php echo $nommes; ?> </td>
									  <td><b>A&ntilde;o:</b></td>
										<td colspan="3"><?php echo $peranio; ?></td>
									</tr>

									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Puntaje:</b></td>
									  <td colspan="6">100</td>
									</tr>

									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Fecha Inicio:</b></td>
									  <td colspan="2"><?php echo $fechainicio; ?></td>
									  <td><b>Fecha Cierre:</b></td>
										<td colspan="3"><?php echo $fecharcierre; ?></td>
									</tr>

									<tr style="font-size: 17px;">
									  <td style="padding-left: 20px;"><b>Participante:</b></td>
									  <td colspan="6"><?php echo $nomusuario; ?></td>
								    </tr>

									<tr>
									  <td colspan="7">&nbsp;</td>

									</tr>

									</thead>

    						<br>
							<tr>
						  <td colspan="4" style="text-align: center; font-weight: bold">PLANILLA DE RESULTADOS</td>
						</tr>
						<tr>
							<td colspan="4" style="text-align: center; font-weight: bold">Enunciado: <?php echo $enunciado; ?></td>
						</tr>
								
						<tr>
                            <td style="text-align: center; font-weight: bold; border-left: 3px solid; border-bottom: 3px solid; border-top: 3px solid;border-spacing: none;">Codigo-numero</td>
                            <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;border-spacing: none;">Codigo-letra</td>
                            <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;" >Valor asignado</td>
                            <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;border-right: 3px solid;" >Puntaje</td>
                        </tr>

						<?php
							
						$q1=pg_query($con,"SELECT distinct e.nroeval,
													   r.codusu,
													   r.codnumero,
													   r.codletra,
													   r.valor,
													   r.item,
													   r.puntaje
												FROM evalucionparticipante e,  respuestaleishmania r
												WHERE e.nroeval    = r.nroeval
												and   r.codusu = '$usuario'
												and   e.nroeval = '$nroeval'

                        order by e.nroeval" );
						
						
						while($row1=pg_fetch_array($q1) )
						{
								echo '<tr>
										  <td style="text-align: center">'.$row1['codnumero'].'</td>
										  <td style="text-align: center">'.$row1['codletra'].'</td>
										  <td style="text-align: center">'.$row1['valor'].'</td>
										  <td style="text-align: center">'.$row1['puntaje'].'</td>
									 </tr>';

						}
								
						$q2=pg_query($con,"SELECT sum(r.puntaje) as puntaje
												FROM evalucionparticipante e,  respuestaleishmania r
												WHERE e.nroeval    = r.nroeval
												and   r.codusu = '$usuario'
												and   e.nroeval = '$nroeval'" );
								
						$row2 = pg_fetch_assoc($q2);

						$puntaje1 = $row2["puntaje"];
								
						echo '<tr>
						  <td colspan="7" style="font-size: 19px;"><b>Rendimiento:</b> '.round($puntaje1).' % de Concordancia  con Resultados de Referencia.</td>
						</tr>';
								
						echo '<tr>
						  <td colspan="7" style="font-size: 19px;"><b>Observacion:</b> '.$obs.'</td>
						</tr>';
								
						echo '<tr>
						  <td colspan="7" style="font-size: 12px;"><b>Recomendaciones para las buenas prácticas laboratoriales:</b> Es competencia del jefe del Laboratorio, responder de la garantía y control de calidad, que al recibir un resultado inaceptable tome las providencias necerias para eliminar las no conformidades.</td>
						</tr>';
								

						echo '<tr><td colspan="7" style="text-align: right;"><img src="'.$dir.basename($filename).'" style="width: 20%;"/></td></tr>';
					  ?>

							</table>
						</td>
				  </tr>
				</tbody>

			</table>



    </div>


</body>
</html>
