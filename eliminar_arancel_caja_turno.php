<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
    $nroingreso   = $_GET['nroingreso'];
	$nrorecibo    = $_GET['nrorecibo'];
	$nroreciboser = $_GET['nroreciboser'];
	$norden       = $_GET['norden'];
	$nroturno     = $_GET['nroturno'];
	$codarea      = $_GET['codarea'];
	$codturno     = $_GET['codturno'];
	$codservicio  = $_GET['codservicio'];

   $resultado1=pg_query($con,"DELETE FROM recibos WHERE nroingreso = '$nroingreso' and nrorecibo = '$nrorecibo' and nroreciboser = '$nroreciboser' and norden = '$norden'"); 

      if($resultado1==true)
           {
              // Bitacora
              include("bitacora.php");
              $codopc = "V_151";
              $fecha=date("Y-n-j", time());
              $hora=date("G:i:s",time());
              $accion="Ingreso por Caja-Detalle: Elimina-Reg.: Nro. Ingreso: ".$nroingreso;
              $terminal = $_SERVER['REMOTE_ADDR'];
              $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
              
              // Fin grabacion de registro de auditoria
              header("Location: modifica_ingresos_caja_turno.php?nroingreso=$nroingreso&nroturno=$nroturno&codarea=$codarea&codturno=$codturno&codservicio=$codservicio&mensage=1");	 
           }
    	else
    	  {
        	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
        	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
        	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
        	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
    	  }
?>
