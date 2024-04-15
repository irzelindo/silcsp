<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse(); 
   
   $id=$_GET['id']; 

/*   $sql1 = "select * from respeducacioncontinua where norden = '$id'";
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);*/

   $numeroRegistros=0; //$numeroRegistros1;

   if($numeroRegistros<=0)
      {
      $resultado1=pg_query($con,"DELETE FROM anuncios WHERE norden = '$id'"); 

	  $nomarchivo1 = "anuncio".$id.".jpg";
	
	  if (file_exists ("fotos/".$nomarchivo1))
	     {
	     unlink("fotos/$nomarchivo1");
	     }
         
      if($resultado1==true)
           {
              // Bitacora
              include("bitacora.php");
              $codopc = "V_54";
              $fecha=date("Y-n-j", time());
              $hora=date("G:i:s",time());
              $accion="Anuncios: Elimina-Reg.: ".$id;
              $terminal = $_SERVER['REMOTE_ADDR'];
              $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
              
              // Fin grabacion de registro de auditoria
              header("Location: anuncios.php?mensage=1");	
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
      header("Location: anuncios.php?mensage=4"); //no se puede borrar
      }
?>
