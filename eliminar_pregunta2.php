<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_GET['nroeval']; 
   $idpregunta	=	$_GET['idpregunta'];

  pg_query($con,"DELETE FROM pregunta WHERE nroeval = '$nroeval' and idpregunta = '$idpregunta'");
  pg_query($con,"DELETE FROM respuesta WHERE idpregunta = '$idpregunta'");

   // Bitacora
  include("bitacora.php");
  $codopc = "V_13";
  $fecha=date("Y-n-j", time());
  $hora=date("G:i:s",time());
  $accion="Evaluacion: Elimina-Reg.: ".$nroeval.$idpregunta;
  $terminal = $_SERVER['REMOTE_ADDR'];
  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

  // Fin grabacion de registro de auditoria
  header("Location: modifica_examen.php?nroeval=$nroeval");
    
?>