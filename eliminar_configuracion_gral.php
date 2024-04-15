<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse(); 
   
   $id=trim($_GET['id']); 

   $sql1 = "select * from ingresocaja where codservicio = '$id'";
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);

   $sql2 = "select * from arqueo where codservicio = '$id'";
   $res2=pg_query($con,$sql2);
   $numeroRegistros2=pg_num_rows($res2);

   $numeroRegistros=$numeroRegistros1+$numeroRegistros2;

   if($numeroRegistros<=0)
      {
      $resultado1=pg_query($con,"DELETE FROM config_gral WHERE codservicio = '$id'"); 
      
      // borro firma principal  
	  $nomarchivo1 = $id."firma1".".jpg";
	
	  if (file_exists ("firmas/".$nomarchivo1))
	     {
	     unlink("firmas/$nomarchivo1");
	     }
         
      // borro firma secundaria   
	  $nomarchivo2 = $id."firma2".".jpg";
	
	  if (file_exists ("firmas/".$nomarchivo2))
	     {
	     unlink("firmas/$nomarchivo2");
	     }

      if($resultado1==true)
           {
              // Bitacora
              include("bitacora.php");
              $codopc = "V_4115";
              $fecha=date("Y-n-j", time());
              $hora=date("G:i:s",time());
              $accion="Config. Gral: Elimina-Reg. de Servicio: ".$id;
              $terminal = $_SERVER['REMOTE_ADDR'];
              $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
              
              // Fin grabacion de registro de auditoria
              header("Location: configuracion_gral.php?mensage=1");	
           }
    	else
    	  {
        	   echo "<br/>NO SE GRAB&Oacute; ESTE REGISTRO.. ";
        	   echo "<br/>VUELVA A LA P&Aacute;GINA ANTERIOR E INTENTE NUEVAMENTE..";	
        	   echo "<br/>TAMBI&Eacute;N VERIFIQUE SI EST&Aacute; EXPERIMENTANDO PROBLEMAS DE VELOCIDAD DE CONEXI&Oacute;N";
        	   echo "<br/><br/><a href='javascript:window.history.back();'>&nbsp;&nbsp;&laquo; &nbsp;&nbsp;Volver atr&aacute;s</a>"; 	  	
    	  }
      }
   else 
      {		
      header("Location: configuracion_gral.php?mensage=4"); //no se puede borrar
      }
?>
