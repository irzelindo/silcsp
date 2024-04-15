<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $id=$_GET['id']; 

   $sql1 = "select * from estrealizar where codestudio = '$id'";
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);

/*   $sql2 = "select * from turnos where codestudio = '$id'";
   $res2=pg_query($con,$sql2);
   $numeroRegistros2=pg_num_rows($res2);
*/
   $numeroRegistros2=0;

   $sql3 = "select * from textosestudios where codestudio = '$id'";
   $res3=pg_query($con,$sql3);
   $numeroRegistros3=pg_num_rows($res3);

   $sql4 = "select * from tmuestraestudio where codestudio = '$id'";
   $res4=pg_query($con,$sql4);
   $numeroRegistros4=pg_num_rows($res4);

   $sql5 = "select * from resultados where codestudio = '$id'";
   $res5=pg_query($con,$sql5);
   $numeroRegistros5=pg_num_rows($res5);

   $sql6 = "select * from resultadosmicro where codestudio = '$id'";
   $res6=pg_query($con,$sql6);
   $numeroRegistros6=pg_num_rows($res6);

   $sql7 = "select * from resultadomicroorganismo where codestudio = '$id'";
   $res7=pg_query($con,$sql7);
   $numeroRegistros7=pg_num_rows($res7);

   $sql8 = "select * from resultadoantibiotico where codestudio = '$id'";
   $res8=pg_query($con,$sql8);
   $numeroRegistros8=pg_num_rows($res8);

   $sql9 = "select * from resultadorepeticion where codestudio = '$id'";
   $res9=pg_query($con,$sql9);
   $numeroRegistros9=pg_num_rows($res9);

   $sql10 = "select * from resultadoequipo where codestudio = '$id'";
   $res10=pg_query($con,$sql10);
   $numeroRegistros10=pg_num_rows($res10);

  
   $numeroRegistros=$numeroRegistros1+$numeroRegistros2+$numeroRegistros3+$numeroRegistros4+$numeroRegistros5+$numeroRegistros6+$numeroRegistros7+$numeroRegistros8+$numeroRegistros9+$numeroRegistros10;

   if($numeroRegistros<=0)
      {
      $resultado1=pg_query($con,"DELETE FROM estudios WHERE codestudio = '$id'"); 

      $resultado2=pg_query($con,"DELETE FROM determinaciones WHERE codestudio = '$id'"); 
      $resultado3=pg_query($con,"DELETE FROM determinacionrango WHERE codestudio = '$id'"); 
      $resultado4=pg_query($con,"DELETE FROM resultadoposible WHERE codestudio = '$id'"); 

      if($resultado1==true && $resultado2==true)
           {
              // Bitacora
              include("bitacora.php");
              $codopc = "V_431";
              $fecha=date("Y-n-j", time());
              $hora=date("G:i:s",time());
              $accion="Estudios: Elimina-Reg.: ".$id;
              $terminal = $_SERVER['REMOTE_ADDR'];
              $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
              
              // Fin grabacion de registro de auditoria
              header("Location: estudios.php?mensage=1");	
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
      header("Location: estudios.php?mensage=4"); //no se puede borrar
      }
?>
