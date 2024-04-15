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


$q=pg_query($con,"SELECT distinct ev.nroeval, 
						 ev.codestudio, 
						 ev.coddetermina, 
						 rp.respuesta,
						 rp.metodo, 
						 rp.reactivo, 
						 rp.marcalo,
						 rp.lote,
						 rp.fechaven,
						 rp.equipo, 
						 rp.marcaeq
					FROM evaluaciondeterminacion ev
					FULL OUTER JOIN respuestaparti rp 
					ON ev.nroeval = rp.nroeval
					and   ev.codestudio = rp.codestudio
					and   ev.coddetermina = rp.coddetermina
					where ev.nroeval='$nroeval' 
					and   rp.codusu='$usuario'");

$countlc = pg_num_rows($q);

if($countlc == 0)
{
	$q=pg_query($con,"SELECT distinct ev.nroeval, 
							 ev.codestudio, 
							 ev.coddetermina,
							 '' respuesta,
							 '' metodo, 
						     '' reactivo, 
						     '' equipo, 
						     '' marcaeq
					FROM evaluaciondeterminacion ev
					where ev.nroeval='$nroeval'");
}


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
	window.location = "resultados_previstos.php?mensage=2";
}
	
function volver()
{
	//window.close();
	window.location = "resultados_previstos.php";
}
	
function GenerarAgrupamiento()
{
	var i=0;

    $('#example tr').each(function() {
		
		i = i + 1;
		
		if(i > 1)
		{
			var codestudio     = $(this).find("td").eq(10).html(),
				coddetermina   = $(this).find("td").eq(11).html(),
				nroeval        = $(this).find("td").eq(12).html(),
				usuario        = $(this).find("td").eq(13).html(),
				respue   	   = $("#respuesta"+i).val(),
				metodo   	   = $("#metodo"+i).val(),
				reactivo   	   = $("#reactivo"+i).val(),
				marcalo   	   = $("#marcalo"+i).val(),
				lote     	   = $("#lote"+i).val(),
				fechaven   	   = $("#fechaven"+i).val(),
				equipo   	   = $("#equipo"+i).val(),
				marcaeq   	   = $("#marcaeq"+i).val();
			
			if(respue != '')
			{
				
				jQuery.ajax({
						  url:'modifica_eval.php',
						  type:'POST',
						  dataType:'json',
						  data:{nroeval:nroeval, codestudio:codestudio, coddetermina:coddetermina, respuesta:respue, metodo:metodo, reactivo:reactivo, marcalo:marcalo, lote:lote, fechaven:fechaven, equipo:equipo, marcaeq:marcaeq, usuario:usuario}
					  }).done(function(respuesta){


						  if(respuesta.grupo != 0)
						  {

							   /**/
							 // cerrarVentana();

						  }

				});
			}
			
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
	  
		<table width="700" border="0">
            <thead style="display: table-header-group">
              <tr style="border-bottom: solid 1px; border-top: solid 1px;">
                  <td colspan="4" style="padding-bottom: 20px;">
                      <img src="images/logo-msp-labo.fw.png" style="width: 378px;">
                  </td>
              </tr>
              <tr style="font-size: 12px;">
                <td width="193" style="padding-top: 12px;padding-left: 20px;"><b>Tipo Examen:</b></td>
                <td width="218" style="padding-top: 12px;">CONTROL DE CALIDAD</td>
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

              <tr>
                <td colspan="4">&nbsp;</td>

              </tr>

              </thead>
			</table>

              <?php

              $usuario = "'".$usuario."'";

              echo '<tr><table id="example" class="table table-striped table-hover" width="100%">
                    <thead>
                      <tr>
                        <td scope="col" style="text-align: center;">Estudios</td>
                        <td scope="col" style="text-align: center;">Determinacion </td>
                        <td scope="col" style="text-align: center;">Resultado </td>
                        <td scope="col" style="text-align: center;">Metodo </td>
                        <td scope="col" style="text-align: center;">Reactivo </td>
                        <td scope="col" style="text-align: center;">Marca </td>
                        <td scope="col" style="text-align: center;">Lote </td>
                        <td scope="col" style="text-align: center;">Fecha Vencimiento </td>
                        <td scope="col" style="text-align: center;">Equipo </td>
                        <td scope="col" style="text-align: center;">Marca </td>
                      </tr>
                    </thead>
                    <tbody>';
			  $i = 1;
              while($row=pg_fetch_array($q))
              {
                  $codestudio   = $row['codestudio'];
                  $coddetermina = $row['coddetermina'];
				  
				  $fechaven     = date("d/m/Y", strtotime($row["fechaven"]));

                  $sql1 = "select *
                          from estudios
                          where codestudio = '$codestudio'";

                  $res1 = pg_query($con,$sql1);
                  $rowp1 = pg_fetch_assoc($res1);

                  $nomestudio = $rowp1["nomestudio"];

                  $q2=pg_query($con,"SELECT * FROM evaluaciondeterminacion WHERE nroeval='$nroeval' and codestudio = '$codestudio' order by codestudio, coddetermina" );

                  $i = $i + 1;
				  
                  while($row2=pg_fetch_array($q2) )
                  {
                      $coddetermina1= $row2['coddetermina'];

                      $sql = "select *
                              from determinaciones
                              where codestudio = '$codestudio'
                              and   coddetermina = '$coddetermina1'";

                      $res = pg_query($con,$sql);
                      $rowp = pg_fetch_assoc($res);

                      $nomdetermina = $rowp["nomdetermina"];

                      if($coddetermina1 == $coddetermina)
                      {
                          echo "<tr>";

                          echo "<td>" . $nomestudio . "</td>";
                          echo "<td>" . $nomdetermina. "</td>";
                          echo "<td>" . '<input type="text" value="'.$row['respuesta'].'" name="respuesta'.$i.'" id="respuesta'.$i.'" required>' . "</td>";
                          echo "<td>" . '<input type="text" value="'.$row['metodo'].'" name="metodo'.$i.'" id="metodo'.$i.'" required>' . "</td>";
                          echo "<td>" . '<input type="text" value="'.$row['reactivo'].'" name="reactivo'.$i.'" id="reactivo'.$i.'" required>' . "</td>";
						  echo "<td>" . '<input type="text" value="'.$row['marcalo'].'" name="marcalo'.$i.'" id="marcalo'.$i.'" required>' . "</td>";
						  echo "<td>" . '<input type="text" value="'.$row['lote'].'" name="lote'.$i.'" id="lote'.$i.'" required>' . "</td>";
						  echo "<td>" . '<input type="date" value="'.$row['fechaven'].'" name="fechaven'.$i.'" id="fechaven'.$i.'" required>' . "</td>";
                          echo "<td>" . '<input type="text" value="'.$row['equipo'].'" name="equipo'.$i.'" id="equipo'.$i.'" required>' . "</td>";
                          echo "<td>" . '<input type="text" value="'.$row['marcaeq'].'" name="marcaeq'.$i.'" id="marcaeq'.$i.'" required>' . "</td>";
                          echo "<td style='display:none;'>" . $codestudio. "</td>";
                          echo "<td style='display:none;'>" . $coddetermina. "</td>";
                          echo "<td style='display:none;'>" . $nroeval. "</td>";
                          echo "<td style='display:none;'>" . $usuario. "</td>";

                          echo "</tr>";
                      }


                  }

              }

              echo '</tbody></table>';
               echo'<br /><button  class="btn btn-primary" onClick= "volver()"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true" ></span>&nbsp;Volver</button>';

              echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  class="btn btn-primary" onClick= "GenerarAgrupamiento()"><span class="glyphicon glyphicon-lock" aria-hidden="true" ></span>&nbsp;Enviar</button>';

            ?>
							
</body>
</html>
