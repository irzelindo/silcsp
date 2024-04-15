<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_GET['nroeval']; 
   $codempresa	=	$_GET['codempresa'];
   $texamen		=	$_GET['texamen'];

   switch ($texamen ) {
			case '1':	
				$tabla = 'evalbioquimica';
			    break;
			case '2':
				$tabla = 'evaldengue';
			    break;
			case '3':	
				$tabla = 'evalhematologia';
			    break;
			case '4':	
				$tabla = 'evalinfluenza';
			    break;
			case '5':	
				$tabla = 'evalpintestinal';
			    break;
			case '6':
				$tabla = 'evalrotavirus';
			    break;
			case '7':
				$tabla = 'evalsifilis';
			    break;
			case '8':
				$tabla = 'evalmalaria';
			    break;
			case '9':
				$tabla = 'evaleducacioncontinua';
			    break;
			}

  pg_query($con,"DELETE FROM ".$tabla." WHERE nroeval = '$nroeval' and codempresa = '$codempresa'");

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