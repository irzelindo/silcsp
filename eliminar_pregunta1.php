<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_GET['nroeval']; 
   $codestudio	=	$_GET['codestudio'];

  pg_query($con,"DELETE FROM evaluaciondetestu WHERE nroeval = '$nroeval' and codestudio = '$codestudio'");

  pg_query($con,"DELETE FROM evaluaciondeterminacion WHERE codestudio = '$codestudio'");



   // Bitacora
  include("bitacora.php");
  $codopc = "V_13";
  $fecha=date("Y-n-j", time());
  $hora=date("G:i:s",time());
  $accion="Evaluacion: Elimina-Reg.: Nro. Orden: ".$nroeval.$codestudio;
  $terminal = $_SERVER['REMOTE_ADDR'];
  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

  // Fin grabacion de registro de auditoria
  header("Location: modifica_examen.php?nroeval=$nroeval");
    
?>