<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();
   include("conexion.php");
   $con=Conectarse();

   	$passactual = $_POST['passactual'];
	$passnew1 = $_POST['passnew1'];
	$passnew2 = $_POST['passnew2'];
	$codusu   = $_SESSION['codusu'];
	
       if ($passactual!="" && $passnew1==$passnew2 && $passnew1!="")
	       {
	       	// se actualizan las tablas
// 	       pg_query($con, "UPDATE estrealizar SET cedula='$passnew1' where cedula='$passactual'");

// 	       pg_query($con, "UPDATE ordtrabajo SET cedula='$passnew1' where cedula='$passactual'");

 	       pg_query($con, "UPDATE paciente SET cedula='$passnew1' where cedula='$passactual'");

 	       pg_query($con, "UPDATE usuarios SET cedula='$passnew1' where cedula='$passactual'");

// 	       pg_query($con, "UPDATE nobligatorias SET cedula='$passnew1' where cedula='$passactual'");

 	       pg_query($con, "UPDATE histocompatibilidad1 SET cedula='$passnew1' where cedula='$passactual'");

 	       pg_query($con, "UPDATE leishmaniosismucosa SET cedula='$passnew1' where cedula='$passactual'");

 	       pg_query($con, "UPDATE leishmaniosisvh SET cedula='$passnew1' where cedula='$passactual'");
           
 	       pg_query($con, "UPDATE toscoquetos SET cedula='$passnew1' where cedula='$passactual'");

 	       pg_query($con, "UPDATE chagas SET cedula='$passnew1' where cedula='$passactual'");

 	       pg_query($con, "UPDATE ingresocaja SET cedula='$passnew1' where cedula='$passactual'");

// 	       pg_query($con, "UPDATE turnos SET cedula='$passnew1' where cedula='$passactual'");

 	       pg_query($con, "UPDATE histocompatibilidad3 SET cedula='$passnew1' where cedula='$passactual'");

 	       pg_query($con, "UPDATE febrilagudo SET cedula='$passnew1' where cedula='$passactual'");

           // SE BORRAN LOS REGISTROS QUE TENGAN EL CODIGO ANTERIOR, POR SI ESTE DUPLICADO

  //	       pg_query($con, "DELETE FROM estrealizar where cedula='$passactual'");

 	//       pg_query($con, "DELETE FROM ordtrabajo where cedula='$passactual'");

 	       pg_query($con, "DELETE FROM paciente where cedula='$passactual'");

 	       pg_query($con, "DELETE FROM usuarios where cedula='$passactual'");

 	 //      pg_query($con, "DELETE FROM nobligatorias where cedula='$passactual'");

 	       pg_query($con, "DELETE FROM histocompatibilidad1 where cedula='$passactual'");

 	       pg_query($con, "DELETE FROM leishmaniosismucosa where cedula='$passactual'");

 	       pg_query($con, "DELETE FROM leishmaniosisvh where cedula='$passactual'");
           
 	       pg_query($con, "DELETE FROM toscoquetos where cedula='$passactual'");

 	       pg_query($con, "DELETE FROM chagas where cedula='$passactual'");

 	       pg_query($con, "DELETE FROM ingresocaja where cedula='$passactual'");

 	  //     pg_query($con, "DELETE FROM turnos where cedula='$passactual'");

 	       pg_query($con, "DELETE FROM histocompatibilidad3 where cedula='$passactual'");

 	       pg_query($con, "DELETE FROM febrilagudo where cedula='$passactual'");
           
           // Registro de auditoria
           include("bitacora.php");
           $codusu=$_SESSION['codusu'];
	       $codopc = "V_52";
	       $fecha=date("Y-n-j", time());
           $hora=date("G:i:s",time());
           $accion="Usuario: ".$codusu." Cambio de Cedula".$passactual." por ".$passnew1;
           $terminal = $_SERVER['REMOTE_ADDR'];
           $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
           // Fin grabacion de registro de auditoria
           
	       header("Location: cambiar_cedula.php?mensage=99");
           }
       else 
	       { 
       	   if (($passactual=="") && ($passnew1!=$passnew2 || $passnew1=="" || $passnew2==""))
       	      {
              header("Location: cambiar_cedula.php?mensage=1&mensage2=2");
       	      } 
		      else 
		      {
 	          if ($passactual=="" || $passactual!=$passusu)
 	             {
                 header("Location: cambiar_cedula.php?mensage=1");
 	             }
 	          else
			     {
                 if ($passnew1!=$passnew2 || $passnew1=="" || $passnew2=="")
                 {
                 header("Location: cambiar_cedula.php?mensage2=2");	
                 }
			     }   
			  }
           }
?>
