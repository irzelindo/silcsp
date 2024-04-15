<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
    
   $codantibiogr = trim($_GET['codantibiogr']);
   $codantibiot = trim($_GET['codantibiot']);
     
   $numeroRegistros=0; 


   $resultado1=pg_query($con,"DELETE FROM antibioticoantibiograma WHERE codantibiogr = '$codantibiogr'  and codantibiot = '$codantibiot' ");  

   if($resultado1==true)
       {
          // Bitacora
          include("bitacora.php");
          $codopc = "V_4315";
          $fecha=date("Y-n-j", time());
          $hora=date("G:i:s",time());
          $accion="Antibiotico de Antibiogramas: Elimina-Reg.: ".$codantibiogr.", Antibiotico: ".$codantibiot;
          $terminal = $_SERVER['REMOTE_ADDR'];
          $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
          
          // Fin grabacion de registro de auditoria
          header("Location:  modifica_antibiogramas.php?mensage=1&id=".$codantibiogr);	
       }
	 else
	   {
    	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
    	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
    	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
    	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
	   }

?>