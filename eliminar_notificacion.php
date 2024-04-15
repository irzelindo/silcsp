<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nordentra	=	$_GET['nordentra'];
   $codservicio	=	$_GET['codservicio'];
   $nronotif	=	$_GET['nronotif'];

   $sql1 = "select * from ordtrabajo where nordentra = '$nordentra' and codservicio = '$codservicio'";
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);

   
   if($numeroRegistros1<=0)
   {
      pg_query($con,"DELETE FROM nobligatorias WHERE nronotif = '$nronotif'");
	
	   // Bitacora
	  include("bitacora.php");
	  $codopc = "V_14";
	  $fecha=date("Y-n-j", time());
	  $hora=date("G:i:s",time());
	  $accion="Notificacion: Elimina-Reg.: Nro. Notificacion: ".$nronotif;
	  $terminal = $_SERVER['REMOTE_ADDR'];
	  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

	  // Fin grabacion de registro de auditoria
	  header("Location: notificacion.php");
    
   }
   else 
   {		
      header("Location: notificacion.php?mensage=4"); //no se puede borrar
   }
?>