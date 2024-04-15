<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
    
   $codplatilla = trim($_GET['codplatilla']);
   $posicion = trim($_GET['posicion']);
     
   $numeroRegistros=0; 


   $resultado1=pg_query($con,"DELETE FROM plantillaplandet WHERE codplatilla = '$codplatilla'  and posicion = '$posicion' ");  

   if($resultado1==true)
       {
          // Bitacora
          include("bitacora.php");
          $codopc = "V_4318";
          $fecha=date("Y-n-j", time());
          $hora=date("G:i:s",time());
          $accion="Columnas de plantillas: Elimina-Reg.: ".$codplatilla.", Posicion: ".$posicion;
          $terminal = $_SERVER['REMOTE_ADDR'];
          $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
          
          // Fin grabacion de registro de auditoria
          header("Location:  modifica_plantillas_plan_trabajo.php?mensage=1&id=".$codplatilla);	
       }
	 else
	   {
    	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
    	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
    	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
    	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
	   }

?>