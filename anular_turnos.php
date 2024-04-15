<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroturno=$_GET['nroturno'];
   $codservicio=$_GET['codservicio'];

	pg_query( $con, "UPDATE turnos
   							SET suspendido='1'
		 					WHERE nroturno = '$nroturno' and codservicio = '$codservicio'" );

   // Bitacora
  include("bitacora.php");
  $codopc = "V_12";
  $fecha=date("Y-n-j", time());
  $hora=date("G:i:s",time());
  $accion="Turnos: Anulado-Reg.: Nro. Turno: ".$codservicio.$nroturno;
  $terminal = $_SERVER['REMOTE_ADDR'];
  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

  // Fin grabacion de registro de auditoria
  header("Location: turnos.php?mensage=3");
?>