<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

if(isset($_GET["ci"]))
{
    $ci = $_GET['ci'];
    $_SESSION['ci'] = $_GET['ci'];
}
else
{
    $ci = "";
    $_SESSION['ci'] = "";
}

if(isset($_GET["coddgvs"]) && $_GET["coddgvs"] != '')
{
    $coddgvs     = $_GET['coddgvs'];
    $_SESSION['coddgvs'] = $_GET['coddgvs'];
}
else
{
    $coddgvs	 = "";
    $_SESSION['coddgvs'] = "";
}

if(isset($_GET["nomyape"]) && $_GET["nomyape"] != '')
{
    $nomyapes = $_GET['nomyape'];
    $_SESSION['nomyape'] = $_GET['nomyape'];
}
else
{
    $nomyapes	 = "";
    $_SESSION['nomyape'] = "";
}

if(isset($_GET["desde"]) && $_GET["desde"] != 'null')
{
    $desde	 = $_GET['desde'];
    $_SESSION['desde'] = $_GET['desde'];
}
else
{
    $desde	 = "";
    $_SESSION['desde'] = "";
}


if($ci!= '')
{
    $w=$w." and p.cedula = '$ci'";

}

if($coddgvs != '')
{
    $w=$w." and t.cod_dgvs= '$coddgvs'";

}

if($nomyapes!= '')
{
    $nomyapef = str_replace(' ', '%', $nomyapes);

    $w=$w." and upper(p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido) like upper('%$nomyapef%')";
}

if($desde != '')
{
    $w=$w." and p.fechanac = '$desde'";

    $reportfecha = '<div style="font-size: 16px; text-align:left"><b>Fecha Nacimiento:</b> '.$desde.'</div>';
}

$sql1 = "
select distinct t.nordentra,
p.cedula,
p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
t.fecharec,
(select nomservicio from establecimientos where codservicio = t.codservicio) as establecimiento
from paciente p, ordtrabajo t
where p.nropaciente = t.nropaciente
".$w."
order by t.nordentra";

$result1 = pg_query($link,$sql1);
$countlc = pg_num_rows($result1);

$sql = "
select distinct t.nordentra,
p.cedula,
p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
p.sexo,
p.edada,
t.cod_dgvs,
t.codusu
from paciente p, ordtrabajo t
where p.nropaciente = t.nropaciente
".$w;

$result = pg_query($link,$sql);

$row = pg_fetch_assoc($result);

$nordentra  = $row["nordentra"];
$cedula     = $row["cedula"];
$nomyape    = $row["nomyape"];
$coddgvs    = $row["cod_dgvs"];
$edada      = $row["edada"];

if($row["sexo"] == 1)
{
	$sexo  = "Masculino";
}
else
{
	$sexo  = "Femenino";
}

if($countlc != 0)
{
  $reportdatos = '<div style="font-size: 16px; text-align:left"><b>Nro. Doc:</b> '.$cedula.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Apellido y nombre:</b> '.$nomyape.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Sexo:</b> '.$sexo.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Edad:</b> '.$edada.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Id DGVS:</b> '.$coddgvs.'</div>';
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
	$(document).ready(function(){
			$("#Button102").click(function(){
					$("#myModal").modal("hide");
			});

	});

  function obtener_datos(nordentra)
  {

      $.ajax({
        url:'mostrar_resultado.php',
        type:'POST',
        dataType: "html",
        data: "nordentra="+nordentra,
        success: function(resp){

           $("#result").html(resp);

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
<?php
  if($countlc != 0)
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
              if($reportdatos != ''){ echo $reportdatos; }
              if($reportfecha != ''){ echo $reportfecha; }

          ?>

    </div>
   <br>

      <table class="table table-striped table-hover">
        <thead class="thead-green">
          <tr>
            <th>Item</th>
            <th>Nro. Orden</th>
            <th>Fecha</th>
            <th>Establecimiento</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;

      		while ($row1 = pg_fetch_array($result1))
      		{
                $i++;

                $fecha  = date("d/m/Y", strtotime($row1[fecharec]));

          			 print '<tr>'
                     .'<td>'.$i.'</td>'
          				   .'<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="obtener_datos('.$row1["nordentra"].')">'.$row1["nordentra"].'</a></td>'
          				   .'<td>'.$fecha.'</td>'
          				   .'<td>'.$row1["establecimiento"].'</td>'
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
?>
<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
   <div class="modal-dialog modal-lg" role="document" style="width: 900px;">
     <div class="modal-content"  style="width: 800px;">

       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <br>
         <h4 class="modal-title" id="myModalLabel"></h4>
       </div>

       <div class="modal-body">
         <?php
           echo '<button type="button" class="btn btn-primary btn-lg" id="Button102" style="float: left;">Salir</button>';

           echo '<br><br><br>';
           //echo '<input type="button" id="pacientes_detallesButton1" name="agregar" value="Confirmar env&iacute;o" onclick="xajax_ConfirmarEnvio(xajax.getFormValues(formu));" disabled>';
         ?>
         <div class="jqGrid">
           <br/>
           <div id="result">

           </div>
           <div id="perpage1"></div>
         </div>
           <br />

       </div>

       <div class="modal-footer">

       </div>

     </div>
   </div>
</div>

</body>
</html>
