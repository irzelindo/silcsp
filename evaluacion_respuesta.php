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

$q4			= pg_query($con,"SELECT * FROM usuarios WHERE codusu = '$usuario'");

$row4 		= pg_fetch_assoc($q4);

$nomusuario = $row4["nomyape"];

$v_181   = $_SESSION['V_181'];

$q=pg_query($con,"SELECT distinct codestudio FROM evaluaciondeterminacion WHERE nroeval='$nroeval'");

$numeroRegistros=pg_num_rows($q);

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
$obs		 = $rowp["obs"];

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

function volver()
{
	//window.close();
	window.location = "respuestas_evaluacion.php";
}
	
function GenerarAgrupamiento()
{
	var h=0;
	
	$('#example').find("td.codestudio").each(function(index){
		h = h + 1;
 		
		var codestudio     = $(this).html(),
			coddetermina   = $("#coddetermina"+h).val(),
			nroeval        = $("#nroeval"+h).val(),
			usuario        = $("#usuario"+h).val(),
			puntaje   	   = $("#puntaje"+h).val(),
			obs		   	   = $("#obs").val()
		
		jQuery.ajax({
						  url:'modifica_respuesta_eval.php',
						  type:'POST',
						  dataType:'json',
						  data:{nroeval:nroeval, codestudio:codestudio, coddetermina:coddetermina, puntaje:puntaje, usuario:usuario, obs:obs}
					  }).done(function(respuesta){

						  if(respuesta.grupo != 0)
						  {

							  
							 // cerrarVentana();

						  }

		});

 	});
	
	setTimeout(function () {

		volver();

    }, 1000);

}

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
	
		  <tr>
			<td><table width="700" border="0" align="center" cellspacing="0" cellpadding="3">
					  <thead style="display: table-header-group">
						  
						<tr style="border-bottom: solid 1px; border-top: solid 1px;">
							<td colspan="4" style="padding-bottom: 20px;"><img src="images/logo-msp-labo.fw.png" style="width: 378px;">
							</td>
						</tr>

						<tr style="font-size: 12px;">
						  <td width="193" style="padding-top: 12px;padding-left: 20px;"><b>Tipo Examen:</b></td>
						  <td width="218" style="padding-top: 12px;">CONTROL DE CALIDAD</td>
						  <td width="211" style="padding-top: 12px;"><b>Sector: </b></td>
						  <td width="246" colspan="1"  style="padding-top: 12px;"><?php echo $nomsector; ?></td>
						</tr>
						<tr style="font-size: 12px;">
						  <td style="padding-left: 20px;"><b>Nro. Evaluacion:</b></td>
						  <td><?php echo $nroeval; ?></td>
						  <td><b>Lote:</b></td>
						  <td colspan="1"><?php echo $lote; ?></td>
						</tr>
						<tr style="font-size: 12px;">
						  <td style="padding-left: 20px;"><b>Mes:</b></td>
						  <td><?php echo $nommes; ?></td>
						  <td><b>A&ntilde;o:</b></td>
						  <td colspan="1"><?php echo $peranio; ?></td>
						</tr>
						<tr style="font-size: 12px;">
						  <td style="padding-left: 20px;"><b>Puntaje:</b></td>
						  <td colspan="3">100</td>
						</tr>
						<tr style="font-size: 12px;">
						  <td style="padding-left: 20px;"><b>Fecha Inicio:</b></td>
						  <td><?php echo $fechainicio; ?></td>
						  <td><b>Fecha Cierre:</b></td>
						  <td colspan="1"><?php echo $fecharcierre; ?></td>
						</tr>
						<tr style="font-size: 12px;">
						  <td style="padding-left: 20px;"><b>Participante:</b></td>
						  <td colspan="3"><?php echo $nomusuario; ?></td>
						</tr>
						<tr>
						  <td colspan="4">&nbsp;</td>
						</tr>
					  </thead>
				</table>
				</td>
			  </tr>

			  <br>
			  <tr>
				<td colspan="4" style="text-align: center; font-weight: bold">PLANILLA DE RESULTADOS</td>
			  </tr>

						<?php
						
						$i = 0;
								
						while($row=pg_fetch_array($q))
						{
							$codestudio  = $row['codestudio'];

							$sql1 = "select *
									from estudios
									where codestudio = '$codestudio'";

							$res1 = pg_query($con,$sql1);
							$rowp1 = pg_fetch_assoc($res1);

							$nomestudio = $rowp1["nomestudio"];
							
							
							
							$q1=pg_query($con,"SELECT distinct e.nroeval,
													   e.codestudio,
													   e.coddetermina,
													   e.correcta,
													   r.respuesta,
													   r.codusu,
													   d.posicion,
													   r.puntaje,
													   r.metodo, 
													   r.reactivo, 
													   r.marcalo,
													   r.lote,
													   r.fechaven
												FROM evaluaciondeterminacion e,  respuestaparti r, determinaciones d
												WHERE e.nroeval    = r.nroeval
												and   e.codestudio = r.codestudio
												and   e.coddetermina = r.coddetermina
                        						and   d.codestudio    = r.codestudio
												and   d.coddetermina  = r.coddetermina
												and   r.codusu = '$usuario'
												and   e.nroeval = '$nroeval'
												and   e.codestudio = '$codestudio'
                        order by d.posicion" );
							
							
							
							if($i == 0)
							{
								echo '<tr><td><table id="example" class="table table-striped table-hover" width="100%">';
							}

							while($row1=pg_fetch_array($q1) )
							{
								$i = $i + 1;
								
								$codestudio  = $row1['codestudio'];
								$coddetermina= $row1['coddetermina'];

								$sql = "select *
										from determinaciones
										where codestudio = '$codestudio'
										and   coddetermina = '$coddetermina'";

								$res = pg_query($con,$sql);
								$rowp = pg_fetch_assoc($res);

								$nomdetermina = $rowp["nomdetermina"];

								if($i == 1)
								{
									echo '<thead><tr>
											  <td style="text-align: center; font-weight: bold; border-left: 3px solid; border-bottom: 3px solid; border-top: 3px solid;border-spacing: none;">Determinaci&oacute;n</td>
											  <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;border-spacing: none;">Respuesta Correcta</td>
											  <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;" >Respuesta Marcada</td>
											  <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;">Metodo </td>
											  <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;">Reactivo </td>
											  <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;">Marca </td>
											  <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;">Lote </td>
											  <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid; ">Fecha Vencimiento </td>
											  <td style="text-align: center; font-weight: bold; border-bottom: 3px solid; border-top: 3px solid;border-right: 3px solid;" >Puntaje</td>
										</tr>
										</thead>';
								}
								
								echo '<tr>
									<td colspan="9" style="font-weight: bold">Estudio: '.$nomestudio.'</td>
								  </tr>';
								
								echo '<tr>
										  <td style="text-align: center" >'.$nomdetermina.'</td>
										  <td style="text-align: center">'.$row1['correcta'].'</td>
										  <td style="text-align: center">'.$row1['respuesta'].'</td>
										  <td style="text-align: center">'.$row1['metodo'].'</td>
										  <td style="text-align: center">'.$row1['reactivo'].'</td>
										  <td style="text-align: center">'.$row1['marcalo'].'</td>
										  <td style="text-align: center">'.$row1['lote'].'</td>
										  <td style="text-align: center">'.$row1['fechaven'].'</td>
										  <td style="display:none;" class="codestudio">' . $codestudio. '</td>
										  <td style="display:none;"><input type="text" style="text-align: center;" value="'.$coddetermina.'" name="coddetermina'.$i.'" id="coddetermina'.$i.'" required></td>
										  <td style="display:none;"><input type="text" style="text-align: center;" value="'.$nroeval.'" name="nroeval'.$i.'" id="nroeval'.$i.'" required></td>
										  <td style="display:none;"><input type="text" style="text-align: center;" value="'.$usuario.'" name="usuario'.$i.'" id="usuario'.$i.'" required></td>
										  <td style="text-align: center"><input type="text" style="text-align: center;" value="'.$row1['puntaje'].'" name="puntaje'.$i.'" id="puntaje'.$i.'" required></td>
									 </tr>';

							}

						}


					  ?>

			</table>
          </td>
       </tr>
		<tr>
            <td>&nbsp;</td>
        </tr>
         <tr>
              <td>Observaci&oacute;n:<input type="text" value="<?php echo $obs; ?>" name="obs" id="obs" maxlength="200" style="width: 700px;"></td>
         </tr>
          <tr>
                 <td><br />
                       <button  class="btn btn-primary" onClick= "volver()"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true" ></span>&nbsp;Volver</button>
                       <button  class="btn btn-primary" onClick= "GenerarAgrupamiento()"><span class="glyphicon glyphicon-lock" aria-hidden="true" ></span>&nbsp;Enviar</button></td>
          </tr>
       
      </table>
   </div>
</body>
</html>