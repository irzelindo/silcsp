<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
    
   $codestudio = trim($_GET['codestudio']);
   $coddetermina = trim($_GET['coddetermina']);
     
   $numeroRegistros=0; 


   $resultado1=pg_query($con,"DELETE FROM determinaciones WHERE codestudio = '$codestudio'  and coddetermina = '$coddetermina' ");  
   $resultado2=pg_query($con,"DELETE FROM determinacionrango WHERE codestudio = '$codestudio'  and coddetermina = '$coddetermina' ");  
   $resultado3=pg_query($con,"DELETE FROM resultadoposible WHERE codestudio = '$codestudio'  and coddetermina = '$coddetermina' ");  

   if($resultado1==true && $resultado2==true && $resultado3==true)
       {
          // Bitacora
          include("bitacora.php");
          $codopc = "V_431";
          $fecha=date("Y-n-j", time());
          $hora=date("G:i:s",time());
          $accion="Determinaciones de Estudios: Elimina-Reg.: ".$codestudio.", Determinacion: ".$coddetermina;
          $terminal = $_SERVER['REMOTE_ADDR'];
          $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
          
          // Fin grabacion de registro de auditoria
          header("Location:  modifica_estudios.php?mensage=1&id=".$codestudio);	
       }
	 else
	   {
    	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
    	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
    	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
    	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
	   }

?>