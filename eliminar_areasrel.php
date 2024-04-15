<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
    
   $codservicio = trim($_GET['codservicio']);
   $codarea = trim($_GET['codarea']);
     
   $sql1 = "select * from estrealizar where codservicio = '$codservicio' and codarea='$codarea'";
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);

   $sql2 = "select * from tiposturnos where codservicio = '$codservicio' and codarea='$codarea'";
   $res2=pg_query($con,$sql2);
   $numeroRegistros2=pg_num_rows($res2);

   $sql3 = "select * from turnos where codservicio = '$codservicio' and codarea='$codarea'";
   $res3=pg_query($con,$sql3);
   $numeroRegistros3=pg_num_rows($res3);

   $sql4 = "select * from plantrabajo where codservicio = '$codservicio' and codarea='$codarea'";
   $res4=pg_query($con,$sql4);
   $numeroRegistros4=pg_num_rows($res4);
  
   $numeroRegistros=$numeroRegistros1; 


   $resultado1=pg_query($con,"DELETE FROM areasest WHERE codservicio = '$codservicio'  and codarea = '$codarea' ");  

   if($resultado1==true)
       {
          // Bitacora
          include("bitacora.php");
          $codopc = "V_416";
          $fecha=date("Y-n-j", time());
          $hora=date("G:i:s",time());
          $accion="Areas de Establecimientos: Elimina-Reg.: ".$codservicio.", Area: ".$codarea;
          $terminal = $_SERVER['REMOTE_ADDR'];
          $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
          
          // Fin grabacion de registro de auditoria
          header("Location:  modifica_establecimientossa.php?mensage=1&id=".$codservicio."#areas");	
       }
	 else
	   {
    	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
    	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
    	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
    	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
	   }

?>