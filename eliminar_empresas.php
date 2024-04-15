<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $id=$_GET['id']; 
   $coddist=$_GET['coddist']; 

   $sql1 = "select * from homebanking where codempresa = '$id' ";
   $res1=pg_query($con,$sql1);
   $numeroRegistros1=pg_num_rows($res1);

   $sql2 = "select * from matdengue where codempresa = '$id'";
   $res2=pg_query($con,$sql2);
   $numeroRegistros2=pg_num_rows($res2);

   $sql18 = "select * from respeducacioncontinua where codempresa = '$id'";
   $res18=pg_query($con,$sql18);
   $numeroRegistros18=pg_num_rows($res18);

   $sql3 = "select * from matinfluenza where codempresa = '$id'";
   $res3=pg_query($con,$sql3);
   $numeroRegistros3=pg_num_rows($res3);

   $sql4 = "select * from resulsifilis where codempresa = '$id'";
   $res4=pg_query($con,$sql4);
   $numeroRegistros4=pg_num_rows($res4);

   $sql5 = "select * from evalanalitos where codempresa = '$id'";
   $res5=pg_query($con,$sql5);
   $numeroRegistros5=pg_num_rows($res5);

   $sql6 = "select * from evalbioquimica where codempresa = '$id'";
   $res6=pg_query($con,$sql6);
   $numeroRegistros6=pg_num_rows($res6);

   $sql7 = "select * from evaldengue where codempresa = '$id'";
   $res7=pg_query($con,$sql7);
   $numeroRegistros7=pg_num_rows($res7);

   $sql8 = "select * from evaleducacioncontinua where codempresa = '$id'";
   $res8=pg_query($con,$sql8);
   $numeroRegistros8=pg_num_rows($res8);

   $sql9 = "select * from evalhematologia where codempresa = '$id'";
   $res9=pg_query($con,$sql9);
   $numeroRegistros9=pg_num_rows($res9);

   $sql10 = "select * from evalinfluenza where codempresa = '$id'";
   $res10=pg_query($con,$sql10);
   $numeroRegistros10=pg_num_rows($res10);

   $sql11 = "select * from evalrotavirus where codempresa = '$id'";
   $res11=pg_query($con,$sql11);
   $numeroRegistros11=pg_num_rows($res11);

   $sql12 = "select * from evalpintestinal where codempresa = '$id'";
   $res12=pg_query($con,$sql12);
   $numeroRegistros12=pg_num_rows($res12);

   $sql13 = "select * from evalsifilis where codempresa = '$id'";
   $res13=pg_query($con,$sql13);
   $numeroRegistros13=pg_num_rows($res13);

   $sql14 = "select * from matrotavirus where codempresa = '$id'";
   $res14=pg_query($con,$sql14);
   $numeroRegistros14=pg_num_rows($res14);

   $sql15 = "select * from notifmalaria where codempresa = '$id'";
   $res15=pg_query($con,$sql15);
   $numeroRegistros15=pg_num_rows($res15);

   $sql16 = "select * from evalmalaria where codempresa = '$id'";
   $res16=pg_query($con,$sql16);
   $numeroRegistros16=pg_num_rows($res16);

   $sql17 = "select * from lamimalaria where codempresa = '$id'";
   $res17=pg_query($con,$sql17);
   $numeroRegistros17=pg_num_rows($res17);


   $numeroRegistros=$numeroRegistros1+$numeroRegistros2+$numeroRegistros3+$numeroRegistros4+$numeroRegistros5+$numeroRegistros6+$numeroRegistros7+$numeroRegistros8+$numeroRegistros9+$numeroRegistros10+$numeroRegistros11+$numeroRegistros12+$numeroRegistros13+$numeroRegistros14+$numeroRegistros15+$numeroRegistros16+$numeroRegistros17+$numeroRegistros18;

   if($numeroRegistros<=0)
      {
      $resultado1=pg_query($con,"DELETE FROM empresas WHERE codempresa = '$id'"); 

      if($resultado1==true)
           {
              // Bitacora
              include("bitacora.php");
              $codopc = "V_441";
              $fecha=date("Y-n-j", time());
              $hora=date("G:i:s",time());
              $accion="Empresas/Laboratorios: Elimina-Reg.: ".$id;
              $terminal = $_SERVER['REMOTE_ADDR'];
              $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
              
              // Fin grabacion de registro de auditoria
              header("Location: empresas.php?mensage=1");	 
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
      header("Location: empresas.php?mensage=4"); //no se puede borrar
      }
?>
