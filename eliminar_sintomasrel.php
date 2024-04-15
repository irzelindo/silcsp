<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
    
   $codenferm = trim($_GET['codenferm']);
   $norden = trim($_GET['norden']);


/*   $sql1 = "select * from sintomasnob where codenferm = '$codenferm' and codsintoma='$codsintoma' and tipo='$tipo'";
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);     
  */ 
   $numeroRegistros=0; 


   $resultado1=pg_query($con,"DELETE FROM enfsintomas WHERE codenferm = '$codenferm'  and norden = '$norden' ");  

   if($resultado1==true)
       {
          // Bitacora
          include("bitacora.php");
          $codopc = "V_421";
          $fecha=date("Y-n-j", time());
          $hora=date("G:i:s",time());
          $accion="Sintomas de Enfermedades: Elimina-Reg.: ".$codenferm.", N.Orden: ".$norden;
          $terminal = $_SERVER['REMOTE_ADDR'];
          $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
          
          // Fin grabacion de registro de auditoria
          header("Location:  modifica_enfermedades.php?mensage=1&id=".$codenferm);	
       }
	 else
	   {
    	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
    	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
    	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
    	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
	   }

?>