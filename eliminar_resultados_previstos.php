<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
    $nroeval	= $_GET['nroeval'];
	$codempresa	= $_GET['codempresa'];
    $nropregunta= $_GET['nropregunta'];

	$query   = "select * from evaleducacioncontinua where nroeval = '$nroeval' and codempresa = '$codempresa'";
	$result  = pg_query($con,$query);

	$row     = pg_fetch_assoc($result);

	$permes  = $row["permes"];
	$peranio = $row["peranio"];

    $resultado1=pg_query($con,"DELETE FROM respeducacioncontinua WHERE nroeval = '$nroeval' and codempresa = '$codempresa' and nropregunta = '$nropregunta'"); 

      if($resultado1==true)
           {
              // Bitacora
              include("bitacora.php");
              $codopc = "V_189";
              $fecha=date("Y-n-j", time());
              $hora=date("G:i:s",time());
              $accion="Resultados Previstos: Elimina-Reg.: ".$nroeval;
              $terminal = $_SERVER['REMOTE_ADDR'];
              $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
              
              // Fin grabacion de registro de auditoria
              header("Location: modifica_resultados_previstos.php?mensage=1&nroeval=$nroeval&codempresa=$codempresa&texamen=9&permes=$permes&peranio=$peranio");	
           }
    	else
    	  {
        	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
        	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
        	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
        	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
    	  }
?>
