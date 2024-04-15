<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
    
   $cgrupoedad = trim($_GET['cgrupoedad']);
   $posicion = trim($_GET['posicion']);
     
   $numeroRegistros=0; 


   $resultado1=pg_query($con,"DELETE FROM rangoedad WHERE cgrupoedad = '$cgrupoedad'  and posicion = '$posicion' ");  

   if($resultado1==true)
       {
          // Bitacora
          include("bitacora.php");
          $codopc = "V_4114";
          $fecha=date("Y-n-j", time());
          $hora=date("G:i:s",time());
          $accion="Rango de Edades: Elimina-Reg.Rango: ".$cgrupoedad.", Posicion: ".$posicion;
          $terminal = $_SERVER['REMOTE_ADDR'];
          $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
          
          // Fin grabacion de registro de auditoria
          header("Location:  modifica_rango_edad.php?mensage=1&id=".$cgrupoedad);	
       }
	 else
	   {
    	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
    	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
    	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
    	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
	   }

?>