<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nordentra	=	$_GET['nordentra'];
   $nroestudio	=	$_GET['nroestudio'];
   $nroturno	=	$_GET['nroturno'];
   $codservicio	=	$_GET['codservicio'];

   pg_query($con,"DELETE FROM estrealizar WHERE nroestudio = '$nroestudio' and nroturno = '$nroturno' and codservicio = '$codservicio'");

   pg_query($con,"DELETE FROM ordtrabajo WHERE nroturno = '$nroturno' and codservicio = '$codservicio'");

   pg_query($con,"DELETE FROM resultados WHERE nroestudio = '$nroestudio' and nordentra = '$nordentra' and codservicio = '$codservicio'");

   // Bitacora
  include("bitacora.php");
  $codopc = "V_12";
  $fecha=date("Y-n-j", time());
  $hora=date("G:i:s",time());
  $accion="Turnos-Estudios: Elimina-Reg.: Nro. Orden: ".$codservicio.$nordentra;
  $terminal = $_SERVER['REMOTE_ADDR'];
  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

  // Fin grabacion de registro de auditoria
  header("Location: modifica_turnos.php?nroturno=$nroturno&codservicio=$codservicio");
?>