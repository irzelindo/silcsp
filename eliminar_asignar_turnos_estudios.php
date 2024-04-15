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

   $sql1 = "select * from ordtrabajo where nordentra = '$nordentra' and codservicio = '$codservicio'";
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);

   
   if($numeroRegistros1<=0)
   {
      pg_query($con,"DELETE FROM estrealizar WHERE nroestudio = '$nroestudio'");
	
	   // Bitacora
	  include("bitacora.php");
	  $codopc = "V_12";
	  $fecha=date("Y-n-j", time());
	  $hora=date("G:i:s",time());
	  $accion="Turnos-Estudios: Elimina-Reg.: Nro. Orden: ".$codservicio.$nordentra;
	  $terminal = $_SERVER['REMOTE_ADDR'];
	  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

	  // Fin grabacion de registro de auditoria
	  header("Location: modifica_asignar_turnos_pacientes.php?nroturno=$nroturno&codservicio=$codservicio");
    
   }
   else 
   {		
      header("Location: modifica_asignar_turnos_pacientes.php?nroturno=$nroturno&codservicio=$codservicio&mensage=4"); //no se puede borrar
   }
?>