<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse(); 
   
   $fecha=$_GET['fecha']; 
   $hora =$_GET['hora']; 

   $resultado1=pg_query($con,"DELETE FROM arqueo WHERE fecha = '$fecha' and hora = '$hora'");
   
	if($resultado1==true)
   {		
	  // Bitacora
	  include("bitacora.php");
	  $codopc = "V_154";
	  $fecha=date("Y-n-j", time());
	  $hora=date("G:i:s",time());
	  $accion="Arqueo: Elimina-Reg.: Fecha: ".$fecha;
	  $terminal = $_SERVER['REMOTE_ADDR'];
	  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

	  // Fin grabacion de registro de auditoria
	  header("Location: arqueo.php?mensage=1");	
   }
else
  {
	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
  }
?>