<?php
session_start();

include( "conexion.php" );
$con = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$nroeval  = $_GET['nroeval'];
$usuario  = $_GET['usuario'];


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
$puntaje	 = $rowp["puntaje"];
$rmuestra	 = $rowp["rmuestra"];

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

$countlc = pg_num_rows($q);



if($countlc != 0)
{
  $reportdatos = '<div style="font-size: 16px; text-align:left"><b>Codigo:</b> '.$nroeval.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Lote:</b> '.$lote.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Periodo:</b> '.$nommes.'/'.$peranio.'</div>';
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

<!------------ CSS ----------->

 <link rel="stylesheet" type="text/css" href="style.css"/>

 <link href="css/animate.min.css" rel="stylesheet"/>

<!----------- JAVASCRIPT ---------->

<script src="js/jquery.min.js"></script>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!----------- PARA ALERTAS  ---------->
<script src="js/sweetalert2.all.min.js" type="text/javascript"></script>

<link href="font-awesome.min.css" rel="stylesheet"/>

<!----------- PARA MODAL  ---------->
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

<script>
function cerrarVentana()
{
	//window.close();
	window.location = "resultados_respuestas.php?mensage=2";
}
	
function volver()
{
	//window.close();
	window.location = "resultados_respuestas.php";
}
	
function guardarOpcion(nroeval, item, usuario, opc)
{
	var metodo   	 = jQuery( "#metodo" ).val();
	var reactivo	 = jQuery( "#reactivo" ).val();
	var marca        = jQuery( "#marca" ).val();
	var loteev       = jQuery( "#loteev" ).val();
	var fechaven     = jQuery( "#fechaven" ).val();
	var equipo       = jQuery( "#equipo" ).val();
	var obsev        = jQuery( "#obsev" ).val();
	var rmuestra     = jQuery( "#rmuestra" ).val();
	
	
	$.ajax({
                 type: "POST",
                 url: "modifica_evaluacion.php",
                 data:{
                     nroeval:nroeval, item:item, usuario:usuario, opc:opc, metodo:metodo, reactivo:reactivo, marca:marca, loteev:loteev, fechaven:fechaven, equipo:equipo, obsev:obsev, rmuestra:rmuestra
                 },
                 dataType:'json',
          
                 success: function (data) {

                        if(data.message != 0)
                        {
							/**/
                        }

                 },
                 error: function () {
                         alert('error fatal');

                 }
        });
}
	
function enviarOpcion(nroeval, usuario)
{
	
	$.ajax({
                 type: "POST",
                 url: "modifica_enviaropcion.php",
                 data:{
                     nroeval:nroeval, usuario:usuario
                 },
                 dataType:'json',
          
                 success: function (data) {

                        if(data.message != 0)
                        {
							cerrarVentana();
                        }

                 },
                 error: function () {
                         alert('error fatal');

                 }
        });
}
	
function eliminaOpcion(nroeval, usuario)
{
	
	$.ajax({
                 type: "POST",
                 url: "elimina_enviaropcion.php",
                 data:{
                     nroeval:nroeval, usuario:usuario
                 },
                 dataType:'json',
          
                 success: function (data) {

                        if(data.message != 0)
                        {
							volver();
                        }

                 },
                 error: function () {
                         alert('error fatal');

                 }
        });
}
	
</script>

<style>

.container {
      width: 970px;
      margin: 0 auto 0 auto;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgb(217, 235, 235);
    }

    .table-hover tbody tr:hover {
      background-color: rgba(122, 114, 81, 0.7);
      color: rgb(112, 24, 78);
    }

    .thead-green {
      background-color: rgb(0, 99, 71);
      color: white;
    }

</style>
</head>
<body>
  <div class="container">
	  
	  <table>
				<tbody>
					<tr>
						<td>
							<table width="700" border="0" align="center">
								  <thead style="display: table-header-group">
								    <tr style="border-bottom: solid 1px; border-top: solid 1px;">
										<td colspan="4" style="padding-bottom: 20px;">
											  <p style="text-align:center;"> <img     src="images/logo-msp-labo.fw.png" style="width: 420px "></p>
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
									  
									<?php if($rmuestra == 2){ ?>
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Método:</b></td>
									  <td colspan="3"><input type="text" value="" name="metodo" id="metodo" required></td>
								    </tr>
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Reactivo:</b></td>
									  <td colspan="3"><input type="text" value="" name="reactivo" id="reactivo" required></td>
								    </tr>
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Marca:</b></td>
									  <td colspan="3"><input type="text" value="" name="marca" id="marca" required></td>
								    </tr>
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Lote:</b></td>
									  <td colspan="3"><input type="text" value="" name="loteev" id="loteev" required></td>
								    </tr>
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Fecha Vencimiento:</b></td>
									  <td colspan="3"><input type="date" value="" name="fechaven" id="fechaven" required></td>
								    </tr>
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Equipo:</b></td>
									  <td colspan="3"><input type="text" value="" name="equipo" id="equipo" required></td>
								    </tr>
									  
									<tr style="font-size: 12px;">
									  <td style="padding-left: 20px;"><b>Observación:</b></td>
									  <td colspan="3"><input type="text" value="" name="obsev" id="obsev" required>
									  <input type="hidden" value="<?php echo  $rmuestra; ?>" name="rmuestra" id="rmuestra">	
									  </td>
								    </tr>
									  
									 <?php } ?>
									  
									<tr>
									  <td colspan="4">&nbsp;</td>

									</tr>

									</thead>

    						<br>
							<?php

							$usuario = "'".$usuario."'";


							while($row=pg_fetch_array($q))
							{
								$i = $i + 1;

								$pregunta=$row['pregunta'];
								$item	 =$row['item'];

								echo '<tr>
									  <td height="33" colspan="4" style="font-weight: bold;text-decoration: underline;">Pregunta &nbsp;'.$i.'&nbsp;::'.$pregunta.'</td>
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
									
									$j = $j + 1;

									echo '<tr><td colspan="4"><input type="radio" name="opc'.$j.'" value="1" onClick="guardarOpcion('.$nroeval.','.$item.', '.$usuario.', 1)">'.$opc1.'</td></tr>';
									echo '<tr><td colspan="4"><input type="radio" name="opc'.$j.'" value="2" onClick="guardarOpcion('.$nroeval.','.$item.', '.$usuario.', 2)">'.$opc2.'</td></tr>';
									echo '<tr><td colspan="4"><input type="radio" name="opc'.$j.'" value="3" onClick="guardarOpcion('.$nroeval.','.$item.', '.$usuario.', 3)">'.$opc3.'</td></tr>';
									echo '<tr><td colspan="4"><input type="radio" name="opc'.$j.'" value="4" onClick="guardarOpcion('.$nroeval.','.$item.', '.$usuario.', 4)">'.$opc4.'</td></tr>';
									echo '<tr><td colspan="4"><input type="radio" name="opc'.$j.'" value="5" onClick="guardarOpcion('.$nroeval.','.$item.', '.$usuario.', 5)">'.$opc5.'</td></tr>';
									
									echo '<tr><td colspan="4"><input type="radio" name="opc'.$j.'" value="6" onClick="guardarOpcion('.$nroeval.','.$item.', '.$usuario.', 6)">'.$opc6.'</td></tr>';
									
								}

							}
								
							echo'<br /><button  class="btn btn-primary" onClick= "eliminaOpcion('.$nroeval.', '.$usuario.')"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true" ></span>&nbsp;Volver</button>';

							echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  class="btn btn-primary" onClick= "enviarOpcion('.$nroeval.', '.$usuario.')"><span class="glyphicon glyphicon-lock" aria-hidden="true" ></span>&nbsp;Enviar</button><br /><br />';


						  ?>
							
							</table>
						</td>
				  </tr>
				</tbody>

			</table>
	  

    </div>


</body>
</html>
