<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$con = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$nroeval  = $_GET['nroeval'];
$usuario  = $_GET['usuario'];

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
$contenido = "http://silcsp.mspbs.gov.py/imprimir_evaluacion_final_comprobante.php?nroeval=$nroeval&usuario=$usuario"; //Texto

//Enviamos los parametros a la Función para generar código QR 
QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

$q4			= pg_query($con,"SELECT * FROM usuarios WHERE codusu = '$usuario'");

$row4 		= pg_fetch_assoc($q4);

$nomusuario = $row4["nomyape"];

$v_181 = $_SESSION['V_181'];

$q=pg_query($con,"select e.item,
					   CASE WHEN e.respuesta = '1' THEN 'a'
						 WHEN e.respuesta = '2' THEN 'b'
						 WHEN e.respuesta = '3' THEN 'c'
						 WHEN e.respuesta = '4' THEN 'd'
						 WHEN e.respuesta = '5' THEN 'e'
						 WHEN e.respuesta = '6' THEN 'f'
						 END
						 AS correctas,
						 CASE WHEN r.respuesta = '1' THEN 'a'
						 WHEN r.respuesta = '2' THEN 'b'
						 WHEN r.respuesta = '3' THEN 'c'
						 WHEN r.respuesta = '4' THEN 'd'
						 WHEN r.respuesta = '5' THEN 'e'
						  WHEN r.respuesta = '6' THEN 'f'
						 END
						 AS respuestas,
						 CASE WHEN cast(r.respuesta as varchar(1)) = e.respuesta THEN 'B'
						 ELSE 'I'
						 END
						 AS calificacion,
						 e.puntaje
				from evaluaciondet e, respuestaparticipante r
				where e.nroeval = r.nroeval
				and   e.item    = r.item
				and   r.nroeval = '$nroeval'
				and   r.codusu  = '$usuario'
				order by 1");

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
	window.location = "resultados_respuestas.php";
}
	
	
function generatePDF() 
{
      // Choose the element that our invoice is rendered in.
      const element = document.getElementById('invoice');
      // Choose the element and save the PDF for our user.
      html2pdf().from(element).save();
	
	  setTimeout(function(){  volver(); }, 2000);
     
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
	<table align="center">
				<tbody>
					<tr>
						<td>
							<table width="700" border="0" align="center" cellspacing="0" cellpadding="3">
								  <thead style="display: table-header-group">
								    <tr style="border-bottom: solid 1px; border-top: solid 1px;">
										<td colspan="5" style="padding-bottom: 20px;text-align: center">
											<img src="images/logo-msp-labo.fw.png" style="width: 378px;">
										</td>
									</tr>
									<tr style="font-size: 12px;">
									  <td width="113" style="padding-top: 12px;padding-left: 20px;"><b>Tipo Examen:</b></td>
									  <td colspan="2" style="padding-top: 12px;">EVALUACION CONTINUA</td>
									  <td style="padding-top: 12px;"><b>Sector: </b></td>
										<td><?php echo $nomsector; ?></td>
									  
									</tr>
									
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Nro. Evaluacion:</b></td>
									  <td colspan="2"><?php echo $nroeval; ?> </td>
									  <td ><b>Lote:</b></td>
										<td><?php echo $lote; ?></td>
								    </tr>
									
									
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Mes:</b> </td>
									  <td colspan="2"><?php echo $nommes; ?> </td>
									  <td><b>A&ntilde;o:</b></td>
										<td><?php echo $peranio; ?></td>
								    </tr>
								    
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Puntaje:</b></td>
									  <td colspan="2">100</td>
									  <td><b>Sub-Programa:</b></td>
								      <td><?php echo $subprograma; ?></td>
								    </tr>
									<!--<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Puntaje:</b></td>
									  <td colspan="2">100</td>
									  <td><b>Sub-Programa:</b></td>
								      <td><?php echo $subprograma; ?></td>
								    </tr> -->
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Fecha Inicio:</b></td>
									  <td colspan="2"><?php echo $fechainicio; ?></td>
									  <td><b>Fecha Cierre:</b></td>
										<td><?php echo $fecharcierre; ?></td>
								    </tr>
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Participante:</b></td>
									  <td colspan="4"><?php echo $nomusuario; ?></td>
								    </tr>
									  
									<tr>
									  <td colspan="5">&nbsp;</td>

									</tr>

									</thead>

    						<br>
							<tr>
						  <td colspan="5" style="text-align: center; font-weight: bold">PLANILLA DE RESULTADOS</td>
						</tr>
						<tr>
                            <td style="text-align: center; font-weight: bold; border-left: 3px solid; border-bottom: 3px solid; border-top: 3px solid;border-spacing: none;">Cuestionario</td>
                            <td width="139" style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;border-spacing: none;">M&eacute;todo</td>
                            <td width="164" style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;border-spacing: none;">Labotorio de Referencia</td>
                            <td width="140" style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;" >Determinaci&oacute;n del Laboratorio</td>
                            <td width="114" style="text-align: center; font-weight: bold;border-bottom: 3px solid; border-top: 3px solid; border-right: 3px solid;">Concepto</td>

                          </tr>
						<?php
	  					
						$puntaje = 0;
								
						while($row=pg_fetch_array($q))
						{
							if($row['calificacion'] == 'B')
							{
								$puntaje = $puntaje + $row['puntaje'];
							}
							
							echo '<tr>
									  <td style="text-align: center">'.$row['item'].'</td>
									  <td style="text-align: center">SM</td>
									  <td style="text-align: center">'.$row['correctas'].'</td>
									  <td style="text-align: center">'.$row['respuestas'].'</td>
									  <td style="text-align: center">'.$row['calificacion'].'</td>
									  </tr>';

						}
						
						echo '<tr><td colspan="5"><b>RENDIMIENTO:</b> '.round($puntaje).' % de Concordancia  con Resultados de Referencia.</td></tr>';
						echo '<tr><td colspan="5"></td></tr>';
						echo '<tr><td colspan="5">Mayor o igual a 80% = Satisfactorio, Menor a 80% = Insuficiente.</td></tr>';
						echo '<tr><td colspan="5">SM=Seleci&oacute;n M&uacute;ltiple, NM=No Marco, NE=No Evaluado; Concepto: B=Bueno; I=Insufiente.</td></tr>';
								
						echo '<tr>
						  <td colspan="5" style="font-size: 15px;"><b>Recomendaciones para las buenas prácticas laboratoriales:</b> Es competencia del jefe del Laboratorio, que al recibir un resultado inaceptable tome las providencias necerias para eliminar las no conformidades. Ante cualquier aclaración comunicarse a la Unidad de Gestion de Calidad (gcalidad.lcsp@mspbs.gov.py)</td>
						</tr>';
								
						echo '<tr><td colspan="5" style="text-align: right;"><img src="'.$dir.basename($filename).'" style="width: 20%;" /></td></tr>';

					  ?>
							
							</table>
						</td>
				  </tr>
					
				  
				</tbody>

			</table>
	  
	  

    </div>


</body>
</html>
