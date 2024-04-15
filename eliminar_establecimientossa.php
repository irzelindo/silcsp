<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $id=$_GET['id']; 

   $sql1 = "select * from estrealizar where codservicio = '$id' or codservicior = '$id' or codserviciod = '$id'"; 
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);

   $sql2 = "select * from ordtrabajo where codservicio = '$id'";
   $res2=pg_query($con,$sql2);
   $numeroRegistros2=pg_num_rows($res2);

   $sql3 = "select * from mensajes where codservicio = '$id'";
   $res3=pg_query($con,$sql3);
   $numeroRegistros3=pg_num_rows($res3);

   $sql4 = "select * from nobligatorias where codservicio = '$id'";
   $res4=pg_query($con,$sql4);
   $numeroRegistros4=pg_num_rows($res4);

   $sql5 = "select * from ingresocaja where codservicio = '$id'";
   $res5=pg_query($con,$sql5);
   $numeroRegistros5=pg_num_rows($res5);

   $sql6 = "select * from cajas where codservicio = '$id'";
   $res6=pg_query($con,$sql6);
   $numeroRegistros6=pg_num_rows($res6);

   $sql7 = "select * from arqueo where codservicio = '$id'";
   $res7=pg_query($con,$sql7);
   $numeroRegistros7=pg_num_rows($res7);

   $sql8 = "select * from tiposturnos where codservicio = '$id'";
   $res8=pg_query($con,$sql8);
   $numeroRegistros8=pg_num_rows($res8);

   $sql9 = "select * from turnos where codservicio = '$id'";
   $res9=pg_query($con,$sql9);
   $numeroRegistros9=pg_num_rows($res9);

   $sql10 = "select * from plantrabajo where codservicio = '$id'";
   $res10=pg_query($con,$sql10);
   $numeroRegistros10=pg_num_rows($res10);

   $sql11 = "select * from datoagrupado where codservicioe = '$id' or codservicior = '$id'"; 
   $res11=pg_query($con,$sql11);
   $numeroRegistros11=pg_num_rows($res11);

   $sql12 = "select * from evalbioquimica where codservicio = '$id'";
   $res12=pg_query($con,$sql12);
   $numeroRegistros12=pg_num_rows($res12);
   
   $sql13 = "select * from evaldengue where codservicio = '$id'";
   $res13=pg_query($con,$sql13);
   $numeroRegistros13=pg_num_rows($res13);
   
   $sql14 = "select * from evaleducacioncontinua where codservicio = '$id'";
   $res14=pg_query($con,$sql14);
   $numeroRegistros14=pg_num_rows($res14);

   $sql15 = "select * from evalhematologia where codservicio = '$id'";
   $res15=pg_query($con,$sql15);
   $numeroRegistros15=pg_num_rows($res15);         

   $sql16 = "select * from evalinfluenza where codservicio = '$id'";
   $res16=pg_query($con,$sql16);
   $numeroRegistros16=pg_num_rows($res16);

   $sql17 = "select * from evalrotavirus where codservicio = '$id'";
   $res17=pg_query($con,$sql17);
   $numeroRegistros17=pg_num_rows($res17);

   $sql18 = "select * from evalpintestinal where codservicio = '$id'";
   $res18=pg_query($con,$sql18);
   $numeroRegistros18=pg_num_rows($res18);

   $sql19 = "select * from evalsifilis where codservicio = '$id'";
   $res19=pg_query($con,$sql19);
   $numeroRegistros19=pg_num_rows($res19);

   $sql20 = "select * from evalmalaria where codservicio = '$id'";
   $res20=pg_query($con,$sql20);
   $numeroRegistros20=pg_num_rows($res20);

  
   $numeroRegistros=$numeroRegistros1+$numeroRegistros2+$numeroRegistros3+$numeroRegistros4+$numeroRegistros5+$numeroRegistros6+$numeroRegistros7+$numeroRegistros8+$numeroRegistros9+$numeroRegistros10+$numeroRegistros11+$numeroRegistros12+$numeroRegistros13+$numeroRegistros14+$numeroRegistros15+$numeroRegistros16+$numeroRegistros17+$numeroRegistros18+$numeroRegistros19+$numeroRegistros20;

   if($numeroRegistros<=0)
      {
      $resultado1=pg_query($con,"DELETE FROM establecimientos WHERE codservicio = '$id'"); 

      $resultado2=pg_query($con,"DELETE FROM areasest WHERE codservicio = '$id'"); 

      if($resultado1==true && $resultado2==true)
           {
              // Bitacora
              include("bitacora.php");
              $codopc = "V_416";
              $fecha=date("Y-n-j", time());
              $hora=date("G:i:s",time());
              $accion="Establecimientos: Elimina-Reg.: ".$id;
              $terminal = $_SERVER['REMOTE_ADDR'];
              $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
              
              // Fin grabacion de registro de auditoria
              header("Location: establecimientossa.php?mensage=1");	
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
      header("Location: establecimientossa.php?mensage=4"); //no se puede borrar
      }
?>
