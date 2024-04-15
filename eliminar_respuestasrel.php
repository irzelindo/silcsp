<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
    
   $coddetermina = trim($_GET['coddetermina']);
   $codresultado = trim($_GET['codresultado']);
     
   $numeroRegistros=0; 


   $resultado1=pg_query($con,"DELETE FROM resultadoposiblemaster WHERE coddetermina = '$coddetermina'  and codresultado = '$codresultado' ");  

   $resultado2=pg_query($con,"DELETE FROM resultadoposible WHERE coddetermina = '$coddetermina' and codresultado = '$codresultado' ");  

   if($resultado1==true && $resultado2==true)
       {
          // Bitacora
          include("bitacora.php");
          $codopc = "V_433";
          $fecha=date("Y-n-j", time());
          $hora=date("G:i:s",time());
          $accion="Respuestas de Determinaciones: Elimina-Reg.: ".$coddetermina.", Posicion: ".$codresultado;
          $terminal = $_SERVER['REMOTE_ADDR'];
          $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
          
          // Fin grabacion de registro de auditoria
          header("Location:  modifica_determinaciones.php?mensage=1&id=".$coddetermina);	
       }
	 else
	   {
    	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
    	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
    	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
    	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
	   }

?>