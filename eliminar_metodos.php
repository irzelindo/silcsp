<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $id=$_GET['id']; 

   $sql1 = "select * from resultados where codmetodo = '$id'";
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);

   $sql2 = "select * from resultadosmicro where codmetodo = '$id'";
   $res2=pg_query($con,$sql2);
   $numeroRegistros2=pg_num_rows($res2);

   $sql3 = "select * from determinacionequipo where codmetodo = '$id'";
   $res3=pg_query($con,$sql3);
   $numeroRegistros3=pg_num_rows($res3);

   $sql4 = "select * from resultadomicroorganismo where codmetodo = '$id'";
   $res4=pg_query($con,$sql4);
   $numeroRegistros4=pg_num_rows($res4);

   $sql5 = "select * from resultadoantibiotico where codmetodo = '$id'";
   $res5=pg_query($con,$sql5);
   $numeroRegistros5=pg_num_rows($res5);

   $sql6 = "select * from resultadorepeticion where codmetodo = '$id'";
   $res6=pg_query($con,$sql6);
   $numeroRegistros6=pg_num_rows($res6);

   $numeroRegistros=$numeroRegistros1+$numeroRegistros2+$numeroRegistros3+$numeroRegistros4+$numeroRegistros5+$numeroRegistros6;

   if($numeroRegistros<=0)
      {
      $resultado1=pg_query($con,"DELETE FROM metodos WHERE codmetodo = '$id'"); 

      if($resultado1==true)
           {
              // Bitacora
              include("bitacora.php");
              $codopc = "V_436";
              $fecha=date("Y-n-j", time());
              $hora=date("G:i:s",time());
              $accion="Metodos: Elimina-Reg.: ".$id;
              $terminal = $_SERVER['REMOTE_ADDR'];
              $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
              
              // Fin grabacion de registro de auditoria
              header("Location: metodos.php?mensage=1");	 
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
      header("Location: metodos.php?mensage=4"); //no se puede borrar
      }
?>