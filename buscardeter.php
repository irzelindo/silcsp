<?php
include("conexion.php"); 
$con=Conectarse();

$codestudio = $_POST['codestudio'];

$sql = "select *
		from determinaciones
		where codestudio = '$codestudio'";

$res = pg_query($con,$sql);

if(!$res)
{
       echo "Ocurrio un error en la consulta"; /* Si ocurre verifica todo lo tengas bien */
}
else
{
	   $i = 0;
	
	   $tabla = '<option data-value = "" value = ""></option>';
	
       while ($data = pg_fetch_assoc($res) ) 
	   {
		  $i = $i + 1;
		   
		  $coddetermina = $data["coddetermina"];
		  $nomdetermina = $data["nomdetermina"];
		   
          $tabla .='<option data-value = "'.$coddetermina.'" value = "'.$coddetermina."- ".$nomdetermina.'"></option>';
       }

       echo $tabla;
	
}

pg_close($con);
?>