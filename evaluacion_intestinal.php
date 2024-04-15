<?php
session_start();

include( "conexion.php" );
$con = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$nroeval  = $_GET['nroeval'];
$usuario  = $_GET['usuario'];


$q=pg_query($con,"SELECT * FROM pregunta WHERE nroeval='$nroeval'");

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
	window.location = "resultados_intestinal.php?mensage=2";
}
	
function volver()
{
	//window.close();
	window.location = "resultados_intestinal.php";
}
	
function guardarOpcion(nroeval, idpregunta, item, usuario, id, tipo)
{
	var metodo   	 = jQuery( "#metodo" ).val();
	var reactivo	 = jQuery( "#reactivo" ).val();
	var marca        = jQuery( "#marca" ).val();
	var loteev       = jQuery( "#loteev" ).val();
	var fechaven     = jQuery( "#fechaven" ).val();
	var equipo       = jQuery( "#equipo" ).val();
	var obsev        = jQuery( "#obsev" ).val();
	var respuestar   = jQuery( "#respuestar"+id ).val();
	var rmuestra     = jQuery( "#rmuestra").val();
	
	
	jQuery( "#respuestar"+id ).focusout();

	$.ajax({
                 type: "POST",
                 url: "modifica_evalintestinal.php",
                 data:{
                     nroeval:nroeval, idpregunta:idpregunta, item:item, usuario:usuario, tipo:tipo, metodo:metodo, reactivo:reactivo, marca:marca, loteev:loteev, fechaven:fechaven, equipo:equipo, obsev:obsev, respuestar:respuestar, rmuestra:rmuestra
                 },
                 dataType:'json',
          
                 success: function (data) {

                        if(data.message != 0)
                        {
							
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
                 url: "modifica_enviarresultado.php",
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
                 url: "elimina_enviarresultado.php",
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
	
function validarcar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[<>!=*&%$#'"{}?]/; // 4
    te = String.fromCharCode(tecla); // 5
    return !patron.test(te); // 6
}
	
</script>

<style>

.container {
      width: 970 px;
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
							<table width="800" border="0" align="center">
								  <thead style="display: table-header-group">
								    <tr style="border-bottom: solid 1px; border-top: solid 1px;">
										<td colspan="4" style="padding-bottom: 20px;">
											<img src="images/logo-msp-labo.fw.png" style="width: 500px;">
										</td>
									</tr>
									<tr style="font-size: 12px;">
									  <td width="193" style="padding-top: 12px;padding-left: 20px;"><b>Tipo Examen:</b></td>
									  <td width="218" style="padding-top: 12px;">PARASITO INTESTINAL</td>
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

								$pregunta	 = $row['descripcio'];
								$idpregunta	 = $row['idpregunta'];
								$tipo		 = $row['tipo'];
								$nroeval	 = $row['nroeval'];

								echo '<tr>
									  <td height="33" colspan="4" style="font-weight: bold;  text-decoration: underline;">Pregunta &nbsp;'.$i.'&nbsp;::'.$pregunta.'</td>
									</tr>';

								$q1=pg_query($con,"SELECT * FROM respuesta WHERE idpregunta='$idpregunta'" );

								while($row1=pg_fetch_array($q1) )
								{
									$item		= $row1['item'];
									$descripcio	= $row1['descripcio'];
									
									$j = $j + 1;
									
									if($tipo == 2)
									{
										echo '<tr><td colspan="4"><input type="radio" name="descripcio'.$j.'" value="'.$item.'" onClick="guardarOpcion('.$nroeval.','.$idpregunta.','.$item.', '.$usuario.', '.$j.', 2)">'.$descripcio.'</td></tr>';
									}
									else
									{
										echo '<tr>
												<td colspan="4">
													<input type="text" name="respuestar'.$j.'" id="respuestar'.$j.'" style="width:100%" onChange="guardarOpcion('.$nroeval.','.$idpregunta.','.$item.', '.$usuario.','.$j.', 1)" maxlength="200" tabindex="'.$j.'">
												</td>
											  </tr>';
									}
									

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
