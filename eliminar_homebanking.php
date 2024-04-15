<?php
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse(); 
   
   $nroingreso=$_GET['nroingreso']; 

   $resultado1=pg_query($con,"DELETE FROM homebanking WHERE nroingreso = '$nroingreso'");
   
	if($resultado1==true)
   {
	  pg_query( $con, "UPDATE formapago='1'
							WHERE nroingreso= '$nroingreso'" );
		
	  // Bitacora
	  include("bitacora.php");
	  $codopc = "V_152";
	  $fecha=date("Y-n-j", time());
	  $hora=date("G:i:s",time());
	  $accion="Ingreso por Homebanking o Cheque: Elimina-Reg.: Nro. Ingreso: ".$id;
	  $terminal = $_SERVER['REMOTE_ADDR'];
	  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

	  // Fin grabacion de registro de auditoria
	  header("Location: homebanking.php?mensage=1");	
   }
else
  {
	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
  }
?>
