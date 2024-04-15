<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_GET['nroeval']; 

   
   pg_query($con,"DELETE FROM evaluacion WHERE nroeval = '$nroeval'");
   pg_query($con,"DELETE FROM evaluaciondet WHERE nroeval = '$nroeval'");
   pg_query($con,"DELETE FROM evalucionparticipante WHERE nroeval = '$nroeval'");
   pg_query($con,"DELETE FROM respuestaparticipante WHERE nroeval = '$nroeval'");

   // Bitacora
  include("bitacora.php");
  $codopc = "V_171";
  $fecha=date("Y-n-j", time());
  $hora=date("G:i:s",time());
  $accion="Control Calidad: Elimina-Reg.: Nro. Evaluacion: " . $nroeval;
  $terminal = $_SERVER['REMOTE_ADDR'];
  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

  // Fin grabacion de registro de auditoria
  header("Location: elegir_examen.php?mensage=1");
    
?>