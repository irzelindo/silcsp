<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
    $nordentra=$_GET['nordentra'];
	$codestudio=$_GET['codestudio'];
	$nroresul=$_GET['nroresul'];
	$codservicio=$_GET['codservicio'];
	$nroorden=$_GET['nroorden'];

   $resultado1=pg_query($con,"DELETE FROM resultadomicroorganismo WHERE nordentra = '$nordentra' and codservicio = '$codservicio' and  codestudio = '$codestudio' and nroresul = '$nroresul'"); 

      if($resultado1==true)
           {
              // Bitacora
              include("bitacora.php");
              $codopc = "V_163";
              $fecha=date("Y-n-j", time());
              $hora=date("G:i:s",time());
              $accion="Carga y Validacion Microorganismos: Elimina-Reg.: Nro. Orden: ".$codservicio.$nordentra;
              $terminal = $_SERVER['REMOTE_ADDR'];
              $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
              
              // Fin grabacion de registro de auditoria
              header("Location: resultados_detallem.php?nordentra=$nordentra&codservicio=$codservicio&codestudio=$codestudio&nroorden=$nroorden&mensage=1");	 
           }
    	else
    	  {
        	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
        	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
        	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
        	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
    	  }
?>
