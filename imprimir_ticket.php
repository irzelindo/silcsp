<?php
header("Content-type: text/html; charset=UTF-8");
session_start();

$nomyape=$_SESSION["nomyape"];
$codusu=$_SESSION['codusu'];

include("conexion.php");
include("bitacora.php");

include("numerosALetras.class.php");

$con=Conectarse();	

$nroingreso = $_GET['nroingreso'];

function acentos($cadena) 
{
   $search = explode(",","Í,�,�,�,�,�,�,�,�,�,�,�,�,á,é,í,ó,ú,ñ,�á,�é,�í,�ó,�ú,�ñ,Ó,� ,É,� ,Ú,“,� ,¿,Ñ,Á,�");
   $replace = explode(",","�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,\",\",�,�,�,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);
 
   return $cadena;
}

// Bitacora
	$codopc = "V_151";
	$fecha1 = date( "Y-n-j", time() );
	$hora = date( "G:i:s", time() );
	$accion = "Imprecion de Recibo: Nro. Ingreso: " . $nroingreso;
	$terminal = $_SERVER[ 'REMOTE_ADDR' ];
	$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
//


$sql 	= "select *
		  from ingresocaja
		  where nroingreso = '$nroingreso'";
			  
$tab	=  pg_query($con, $sql);
$row 	=  pg_fetch_array($tab);

$sql1 	= "select r.norden, 
				  a.nomarancel, 
				  r.monto,
				  r.cantidad
		  from recibos r, aranceles a
		  where r.codarancel = a.codarancel
		  and   r.nroingreso = '$nroingreso' 
		  order by r.norden";
			  
$tab1	  =  pg_query($con, $sql1);

$sql2 	= "select sum(monto*cantidad) as total
		  from recibos
		  where nroingreso = '$nroingreso'";
			  
$tab2	=  pg_query($con, $sql2);
$row1 	=  pg_fetch_array($tab2);

$total 		= $row1['total'];

$estado      = $row['estado'];

$codcaja     = $row["codcaja"];
$codservicio = $row["codservicio"];
$hora 		 = $row["hora"];
$nropaciente = $row["nropaciente"];
$nomyape 	 = $row["nomyape"];
$nrecibo 	 = $row["nrorecibo"];
$nserie      = $row["nroreciboser"];
$cajero      = $row["codusu"];
$formapago   = $row["formapago"];

$dia  = substr($row["fecha"],8,2);
$mes  = substr($row["fecha"],5,2);
$anio = substr($row["fecha"],0,4);

$fecha = $dia.'/'.$mes.'/'.$anio;

if($estado != 2)
{
	pg_query( $con, "UPDATE ingresocaja
							SET estado='3'
							WHERE nroingreso= '$nroingreso'" );
}


$querye = "select * from empresas where codempresa = '$nropaciente' ";
$resulte = pg_query($con,$querye);

$rowe = pg_fetch_assoc($resulte);

$razonsocial = $rowe["razonsocial"];
$ruc 		 = $rowe['ruc'];
$dccion 	 = $rowe['dccion'];

$queryc = "select * from cajas where codservicio = '$codservicio' and codcaja = '$codcaja'";
$resultc = pg_query($con,$queryc);

$rowc = pg_fetch_assoc($resultc);

$nomcaja = $rowc["nomcaja"];

$queryca = "select * from usuarios where codusu = '$cajero'";
$resultca = pg_query($con,$queryca);

$rowca = pg_fetch_assoc($resultca);

$nomcajero = $rowca["nomyape"];

if($formapago == 6)
{
	$queryhb = "select * from homebanking where nroingreso = '$nroingreso'";
	$resulthb = pg_query($con,$queryhb);

	$rowhb = pg_fetch_assoc($resulthb);

	$id 		   = $rowhb["id"];
	$nroexpediente = $rowhb["nroexpediente"];
	$fechapago	   = date("d/m/Y", strtotime($rowhb["fechapago"]));
}

if($formapago == 7)
{
	$titulo = 'RECIBO DE EXONERACION';
}
else
{
	$titulo = 'RECIBO DE INGRESOS';
}

$letra = numtoletras($total);
?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
	<meta charset="utf-8">
 	<!-- Para ICONOS -->
    <meta name="theme-color" content="#ffffff">
	<link rel="shortcut icon" href="favicon.ico"/>
    	
	<link href="css/bootstrap.min.css" rel="stylesheet">	
	
	<!--hoja de estilos para vista en pantalla-->
	<style type="text/css">		
		body {
			margin: 10px;
			padding: 0;	
			background-repeat: repeat;
			padding-bottom: 1px;				
		}
		body, td, th {
			font-family: sans-serif;
			font-size:11px;
		}	
		.table{
			margin-bottom: 5px;
		}
		.table>thead>tr>th {
    		padding: 0px;									
		}		
		.areaDeImpresion{
		width: 340px;
		padding:10px 5px 10px 5px;
		float:left;
		margin-left:00px;
		border-style: solid;
		border:1px solid  #999;
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.4); 
		}
		#botones{
			position: absolute;
			left: 400;
    		top: 25;	
		}
	</style>	
	<!--hoja de estilos para imprimir-->
	<style type="text/css" media="print">
		@media print {
			#botones {display:none;} /*definimos lo que no vamos a imprimir*/
			 html, body {	 
				 top: 0;
				 left: 0;
				 float: none !important;
				 width: auto !important;
				 margin:  0 !important;
				 padding: 0 !important;
				 @page {
					size:A4;
					/*size: 800mm 297mm; tamaño del papel ancho x alto*/
				  }
			}	
			.areaDeImpresion{						
				border-style:hidden;					
			}	
		}
	</style>	
	
</head>
<body id="cuerpoPagina">
<div class="areaDeImpresion">        
<br>
<table width="300px" border="0" align="center">
    <tbody>
      <tr>
        <td><img src="images/logo-msp-labo.fw.png" width="312" height="52"></td>
      </tr>
      <tr>
        <td>
        <strong><center>LABORATORIO CENTRAL DE SALUD P&Uacute;BICA</center></strong>
		<strong><center>Av. Venezuela c/ Tte. Escurra</center></strong>
		<strong><center>Telefax: 021-292653 Asunci&oacute;n - Paraguay</center></strong><br><br>
		<strong><center><font size="4"><?php echo $titulo; ?></php></font></center></strong>
		<strong><center>Decreto Ley Nro. 21376/98</center></strong>
		<strong><center>RUC: 80000905-3</center></strong><br>
		<strong><center>Acta DGTP Nro. 242/2019</center></strong>
        <strong><center>Serie: <?php echo $nserie; ?> &nbsp;&nbsp;&nbsp;&nbsp;Nro.:<font size="3"> <?php echo $nrecibo; ?></font></center></strong>		
		</td>
    </tr>
	<tr><td><hr style="border:1px dotted; width:300px; margin:3;"></td></tr>
	<tr>
        <td>
        Fecha: <?php echo $fecha; ?> Hora: <?php echo $hora; ?><br>	
		Cajero: <?php echo $nomcajero; ?><br>
		Caja Nro. <?php echo $nomcaja; ?>
		</td>
    </tr>
	<tr><td><hr style="border:1px dotted; width:300px; margin:3;"></td></tr>
	<tr>
		<td>Instituci&oacute;n: <strong style="font-size: 9px">MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</strong></td>
    </tr>
	<tr>
		<td>Dependencia: <strong style="font-size: 9px">LABORATORIO CENTRAL DE SALUD PUBLICA</strong></td>
    </tr>
	<tr>
		<td>Recib&iacute; de: <strong style="font-size: 9px"><?php echo $razonsocial; ?></strong></td>
    </tr>
	<tr>
		<td>RUC Nro.: <strong style="font-size: 9px"><?php echo $ruc; ?></strong></td>
    </tr>
	<tr>
		<td>Domicilio: <strong style="font-size: 9px"><?php echo $dccion; ?></strong></td>
    </tr>
	<tr><td><hr style="border:1px dotted; width:300px; margin:3;"></td></tr>
<!--	Datos del cliente - Opcional-->				
    <!--<tr>
		        <td>Cliente: &nbsp;Cliente NN</td>
    </tr>
    <tr>
        <td>CUIT: 1</td>
    </tr>-->        
</tbody></table>
<br>

<!--Tabla con los productos/servicio --> 
<table class="table">
		<thead>
			<tr>			
				<th>Cantidad </th>
				<th style="text-align: center">Producto</th>											
				<th class="text-right">Importe</th>
			</tr>
		</thead>
		<tbody>
			
				<?php
					while ($row2 = pg_fetch_array($tab1))
					{
						$monto = $row2['monto']*$row2['cantidad'];
						
						echo '<tr>';
						echo '<td>'.$row2['cantidad'].'</td>';
						echo '<td>'.$row2['nomarancel'].'</td>';
						echo '<td class="text-right">'.number_format($monto, 0, ",", ".").'</td>';
						echo '</tr>';
					}
				?>
						
						
		</tbody>
</table>     	
	
<table class="table">	
		<tbody>
			<tr class="text-right">
				<td class="text-left" style="font-size:16px;">Total a Pagar: </td>
				<td class="text-right" style="font-size:16px;"><strong><?php echo number_format($total, 0, ",", "."); ?></strong></td>
			</tr>
		</tbody>
</table>
			
		<!--Datos de forma de pago-->
		<strong>Son Guaraies:</strong> <?php echo $letra; ?><br>
		


	<table width="300px" border="0" align="center">
    <tbody>
		<tr><td><hr style="border:1px dotted; width:300px; margin:3;"></td></tr>

	<tr>
		<td style="font-size: 10px;">HomeBanking ID: <?php echo $id; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br> Nro. Expediente: <?php echo $nroexpediente; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Pago: <?php echo $fechapago; ?></td>
    </tr>
	<tr>
		<td style="font-size: 7px; text-align: right">Original: Cliente</td>
    </tr>
	<tr>
		<td style="font-size: 7px; text-align: right">Duplicado: LCSP</td>
    </tr>
    <tr>
		<td style="font-size: 7px; text-align: right">Triplicado: Contabilidad</td>
    </tr>
       
</tbody></table>
	
	
	
</div>
	
<div class="btn-group-vertical" id="botones">
<!--	<button id="botonPrint" class="btn btn-primary" onClick="printPantalla();" aria-label="Left Align"><span class="glyphicon glyphicon-print" aria-hidden="true" type="button"></span> Imprimir</button>-->
	
  <button id="btnImprimir" class="btn btn-primary" aria-label="Left Align"><span class="glyphicon glyphicon-print" aria-hidden="true" type="button"></span> Imprimir</button>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>	
	
<script type="text/javascript">
	$(document).ready(function() { 	
		$("#btnImprimir").click(function (){
				window.print();
		});	
	});		
</script>
	
	

</body></html>