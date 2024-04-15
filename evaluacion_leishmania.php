<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$con = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$nroeval  	 = $_GET['nroeval'];
$usuario     = $_GET['usuario'];

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
$cantfila	 = $rowp["cantfila"];
$enunciado	 = $rowp["enunciado"];

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
	window.location = "resultados_leishmania.php?mensage=2";
}
	
function volver()
{
	//window.close();
	window.location = "resultados_leishmania.php";
}
	
function GenerarAgrupamiento()
{
	var i=0;

    $('#example tr').each(function() {
		
		i = i + 1;
		
		if(i > 0)
		{
			var nroeval        = $("#nroeval").val(),
				usuario        = $("#usuario").val(),
				codnumero      = $("select#codnumero"+i).val(),
				codletra   	   = $("select#codletra"+i).val(), 
				valor   	   = $("#valor"+i).val();
		
				jQuery.ajax({
						  url:'modifica_evalleishmania.php',
						  type:'POST',
						  dataType:'json',
						  data:{nroeval:nroeval, codnumero:codnumero, codletra:codletra, valor:valor, usuario:usuario, item:i}
					  }).done(function(respuesta){

							
						  if(respuesta.grupo != 0)
						  {

							
							 //cerrarVentana();

						  }

				});
			
		}
		
             
    });	
	
	setTimeout(function () {

		cerrarVentana();

    }, 1000);

}
	
</script>

<style>

.container {
      width: 970px;
      margin: 20 auto 0 auto;
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
<body  >
	  
		<table width="800"  border="0" >
            <thead style="display: table-header-group">
              <tr style="border-bottom: solid 1px; border-top: solid 1px;">
                  <td colspan="4" style="padding-bottom: 20px;">
                     <p style="text-align:center;"> <img     src="images/logo-msp-labo.fw.png" style="width: 420px "></p>
                  </td>
              </tr>
              <tr style="font-size: 12px">
                <td width="193" style="padding-top: 12px;padding-left: 20px;"><b>Tipo Examen:</b></td>
                <td width="218" style="padding-top: 12px;">EVALUACION LEISHMANIA</td>
                <td width="211" style="padding-top: 12px;"><b>Sector: </b></td>
                <td width="246" style="padding-top: 12px;"><?php echo $nomsector; ?></td>
              </tr>

          <tr style="font-size: 12px">
                <td style="padding-left: 20px;"><b>Nro. Evaluacion:</b></td>
                <td><?php echo $nroeval; ?> <input type="hidden" id="nroeval" value="<?php echo $nroeval; ?>"> <input type="hidden" id="usuario" value="<?php echo $usuario; ?>"> </td>
                <td><b>Lote:</b> </td>
                <td><?php echo $lote; ?></td>
              </tr>


              <tr style="font-size: 12px">
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

             <tr style="font-size: 12px">
                <td style="padding-left: 20px;"><b>Fecha Inicio:</b></td>
                <td><?php echo $fechainicio; ?></td>
                <td><b>Fecha Cierre:</b> </td>
                <td><?php echo $fecharcierre; ?></td>
              </tr>

            <tr style="font-size: 12px; ">
                <td colspan="4">&nbsp;</td>

              </tr>

              </thead>
			</table>

              <?php

              echo '<div style="width: 55%; margin-left: 20px; font-weight: bold">'.$enunciado.'</div>
			  		<tr><table id="example" class="table table-striped table-hover" style="width: 50%;">
                    <thead>
                      <tr>
                        <td scope="col" style="text-align: center;">Código-número</td>
                        <td scope="col" style="text-align: center;">Código-letra</td>
                        <td scope="col" style="text-align: center;">Valor asignado</td>
                      </tr>
                    </thead>
                    <tbody>';
	
			  for ($i = 1; $i <= $cantfila; $i++) 
			  {
					echo "<tr>";
				  
				  		 echo "<td>". '<select name="codnumero'.$i.'" size="1" id="codnumero'.$i.'" style="width: 90%;">
							  			
										<option value = ""></option>
										<option value = "1">1</option>
										<option value = "2">2</option>
										<option value = "3">3</option>
										<option value = "4">4</option>
										<option value = "5">5</option>
										<option value = "6">6</option>
										<option value = "7">7</option>
										<option value = "8">8</option>
										<option value = "9">9</option>
										<option value = "10">10</option>

									 </select>' . "</td>";
				  
				  
				  		 echo "<td>". '<select name="codletra'.$i.'" size="1" id="codletra'.$i.'" style="width: 90%;">
							  			
										<option value = ""></option>
										<option value = "A">a</option>
										<option value = "B">b</option>
										<option value = "C">c</option>
										<option value = "D">d</option>
										<option value = "E">e</option>
										<option value = "F">f</option>
										<option value = "G">g</option>
										<option value = "H">h</option>
										<option value = "I">i</option>
										<option value = "J">j</option>
										

									 </select>' . "</td>";
				  
				  		  echo "<td>" . '<input type="text" value="" name="valor'.$i.'" id="valor'.$i.'" required style="width: 90%;">' . "</td>";

                     echo "</tr>";
			  }

              echo '</tbody></table>';
              echo'<br /><button  class="btn btn-primary" onClick= "volver()"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true" ></span>&nbsp;Volver</button>';

              echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  class="btn btn-primary" onClick= "GenerarAgrupamiento()"><span class="glyphicon glyphicon-lock" aria-hidden="true" ></span>&nbsp;Enviar</button>';

            ?>
							
</body>
</html>
