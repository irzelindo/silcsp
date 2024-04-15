<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

if(isset($_GET["nroeval"]))
{
    $nroeval = $_GET['nroeval'];
    $_SESSION['nroeval'] = $_GET['nroeval'];
}
else
{
    $nroeval = "";
    $_SESSION['nroeval'] = "";
}

if($nroeval!= '')
{
    $w= " where a.nroeval = '$nroeval'";

	$reportnordentra = '<div style="font-size: 16px; text-align:left"><b>Nro. Evaluacion:</b> '.$nroeval.'</div>';
}


$sql1 = "
WITH a AS (
        SELECT e.nroeval,
			   ev.codusu,
			   count(e.item) cantpregunta
		FROM evaluaciondet e, evalucionparticipante ev
		WHERE e.nroeval  = ev.nroeval
		group by e.nroeval,
			     ev.codusu
     ), b AS (
        SELECT e.nroeval,
			   r.codusu,
		       r.fechaenviado,
           round(sum(CASE
  				   WHEN cast(e.respuesta as integer) = r.respuesta THEN e.puntaje
  				   ELSE
  		 				0
  			   END), 0) puntaje,
			   count(r.item) determinacion
		FROM evaluaciondet e
		LEFT JOIN respuestaparticipante r
		ON  e.nroeval = r.nroeval
		and e.item    = r.item
		group by e.nroeval,
			     r.codusu,
		 		 r.fechaenviado
     )
SELECT COALESCE (a.nroeval, b.nroeval) nroeval,
       COALESCE (a.codusu, b.codusu) codusu,
       COALESCE (a.cantpregunta, 0) cantpregunta,
       COALESCE (b.determinacion, 0) determinacion,
	   COALESCE (b.puntaje, 0) puntaje,
	   COALESCE (b.fechaenviado, cast(now() as date)) fechaenviado
FROM a
LEFT JOIN b
ON  a.nroeval = b.nroeval
and a.codusu  = b.codusu
".$w."
order by a.codusu";

$result1 = pg_query($link,$sql1);
$countlc = pg_num_rows($result1);

$sql2 = "
WITH a AS (
        SELECT e.nroeval,
			   ev.codusu,
			   count(e.coddetermina) cantpregunta
		FROM evaluaciondeterminacion e, evalucionparticipante ev
		WHERE e.nroeval  = ev.nroeval
		group by e.nroeval,
			     ev.codusu
     ), b AS (
        SELECT e.nroeval,
			   r.codusu,
		       r.fechaenviado,
		 	   sum(CASE
				   WHEN e.correcta = r.respuesta THEN 1
				   ELSE
		 				0
			   END) puntaje,
			   count(distinct r.codusu || r.codestudio || r.coddetermina || r.nroeval) determinacion
		FROM evaluaciondeterminacion e, respuestaparti r
		WHERE  e.nroeval      = r.nroeval
		and e.codestudio   = r.codestudio
		and e.coddetermina = r.coddetermina
		and codusu is not null
		and r.respuesta != ''
		group by e.nroeval,
			     r.codusu,
		 		 r.fechaenviado
     )
SELECT COALESCE (a.nroeval, b.nroeval) nroeval,
       COALESCE (a.codusu, b.codusu) codusu,
       COALESCE (a.cantpregunta, 0) cantpregunta,
       COALESCE (b.determinacion, 0) determinacion,
	   COALESCE (b.puntaje, 0) puntaje,
	   COALESCE (b.fechaenviado, cast(now() as date)) fechaenviado
FROM a
LEFT JOIN b
ON  a.nroeval = b.nroeval
and a.codusu  = b.codusu
".$w."
order by a.codusu";

$result2 = pg_query($link,$sql2);
$countlp = pg_num_rows($result2);


$sql = "select *
from evaluacion a ".$w;

$result = pg_query($link,$sql);

$row = pg_fetch_assoc($result);

$codsector     = $row["codsector"];
$subprograma     = $row["subprograma"];
$fechainicio   = date("d/m/Y", strtotime($row[fechainicio]));
$fecharcierre  = date("d/m/Y", strtotime($row[fecharcierre]));

$querysector = "select * from sectores where codsector = '$codsector'";
$resultsector = pg_query( $link, $querysector );

$rowsector = pg_fetch_assoc( $resultsector );

$nomsector = $rowsector[ "nomsector" ];

if(($countlc != 0 && $nroeval!= '') || ($countlp != 0 && $nroeval!= ''))
{
  $reportnordentra = '<div style="font-size: 16px; text-align:left"><b>Nro. Evaluacion:</b> '.$nroeval.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Sector:</b> '.$nomsector.'</div>'.
                       '<div style="font-size: 16px; text-align:left"><b>Sub-Programa:</b> '.$subprograma.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Periodo:</b> '.$fechainicio.' al '.$fecharcierre.'</div>';
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

<!----------- PARA ALERTAS  ---------->
<script src="js/sweetalert2.all.min.js" type="text/javascript"></script>

<!----------- PARA MODAL  ---------->
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

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
<?php
  if($countlc != 0 && $nroeval!= '')
  {
?>
  <div class="container">
    <div style="font-size: 24px; padding-bottom: 5px; margin-top: 5px; text-align:left; height: 150px; border: 1px #000000 solid;">
        <div style="float: left; margin-left: 150px; margin-top: 15px;margin-right:20px;">
          <img src="images/logo-msp-labo.fw.png" width="673">
        </div>
    </div>
    <div style="border-bottom: 1px #000000 solid; border-left: 1px #000000 solid; border-right: 1px #000000 solid; padding-bottom: 10px; padding-left: 10px;">

          <?php

              header("Pragma: public");
              header("Expires: 0");
              $filename = "resumenevaluacion.xls";
              header("Content-type: application/x-msdownload");
              header("Content-Disposition: attachment; filename=$filename");
              header("Pragma: no-cache");
              header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

              if($reportnordentra != ''){ echo $reportnordentra; }

          ?>

    </div>
   <br>

      <table class="table table-striped table-hover">
        <thead class="thead-green">
          <tr>
            <th style="text-align: center;">Participante</th>
            <th style="text-align: center;">Cant. Preguntas</th>
            <th style="text-align: center;">Determinacion Lab.</th>
			<th style="text-align: center;">Rendimiento</th>
            <th style="text-align: center;">Fecha de Envio</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;

      		while ($row1 = pg_fetch_array($result1))
      		{
                $fechaenviado  = date("d/m/Y", strtotime($row1[fechaenviado]));


                print '<tr>'
          			 .'<td style="text-align: center;">'.$row1["codusu"].'</td>'
                     .'<td style="text-align: center;">'.$row1["cantpregunta"].'</td>'
					 .'<td style="text-align: center;">'.$row1["determinacion"].'</td>'
                     .'<td style="text-align: center;">'.$row1["puntaje"].'</td>'
                     .'<td style="text-align: center;">'.$fechaenviado.'</td>'
          			.'</tr>';
      		}
      	  ?>
        </tbody>
      </table>
    </div>
<?php
  }
  else
  {

	  if($countlp != 0 && $nroeval!= '')
	  {
?>
		<div class="container">
    <div style="font-size: 24px; padding-bottom: 5px; margin-top: 5px; text-align:left; height: 150px; border: 1px #000000 solid;">
        <div style="float: left; margin-left: 150px; margin-top: 15px;margin-right:20px;">
          <img src="images/logo-msp-labo.fw.png" width="673">
        </div>
    </div>
    <div style="border-bottom: 1px #000000 solid; border-left: 1px #000000 solid; border-right: 1px #000000 solid; padding-bottom: 10px; padding-left: 10px;">

          <?php

              header("Pragma: public");
              header("Expires: 0");
              $filename = "resumenevaluacion.xls";
              header("Content-type: application/x-msdownload");
              header("Content-Disposition: attachment; filename=$filename");
              header("Pragma: no-cache");
              header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

              if($reportnordentra != ''){ echo $reportnordentra; }

          ?>

    </div>
   <br>

      <table class="table table-striped table-hover">
        <thead class="thead-green">
          <tr>
            <th style="text-align: center;">Participante</th>
            <th style="text-align: center;">Cant. Preguntas</th>
            <th style="text-align: center;">Determinacion Lab.</th>
			<th style="text-align: center;">Rendimiento</th>
            <th style="text-align: center;">Fecha de Envio</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;

      		while ($row2 = pg_fetch_array($result2))
      		{
                $fechaenviado  = date("d/m/Y", strtotime($row2[fechaenviado]));


                print '<tr>'
          			 .'<td style="text-align: center;">'.$row2["codusu"].'</td>'
                     .'<td style="text-align: center;">'.$row2["cantpregunta"].'</td>'
					 .'<td style="text-align: center;">'.$row2["determinacion"].'</td>'
                     .'<td style="text-align: center;">'.$row2["puntaje"].'</td>'
                     .'<td style="text-align: center;">'.$fechaenviado.'</td>'
          			.'</tr>';
      		}
      	  ?>
        </tbody>
      </table>
    </div>
<?php
	  }
	  else
	  {
			echo '<script type="text/javascript">
				  let timerInterval
				  swal({
					title: "No posee registro con los parametros elegidos !",
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
 }
?>
</body>
</html>
