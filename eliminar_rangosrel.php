<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
    
   $coddetermina = trim($_GET['coddetermina']);
   $tipo = trim($_GET['tipo']);
     
   $numeroRegistros=0; 


   $resultado1=pg_query($con,"DELETE FROM determinacionrangomaster WHERE coddetermina = '$coddetermina'  and tipo = $tipo ");  

   $resultado2=pg_query($con,"DELETE FROM determinacionrango WHERE coddetermina = '$coddetermina' and tipo = $tipo ");  

   if($resultado1==true && $resultado2==true)
       {
          // Bitacora
          include("bitacora.php");
          $codopc = "V_433";
          $fecha=date("Y-n-j", time());
          $hora=date("G:i:s",time());
          $accion="Rangos de Determinaciones: Elimina-Reg.: ".$coddetermina.", Posicion: ".$tipo;
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