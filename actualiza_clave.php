<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();
include("conexion.php");
$con=Conectarse();

$passactual = utf8_encode($_POST['passactual']);
$passactual1 =$passactual; //md5($passactual);

$passnew1 = utf8_encode($_POST['passnew1']);
$passnew2 = utf8_encode($_POST['passnew2']);

$passnew11=$passnew1; //md5($passnew1);
$passnew21=$passnew2; //md5($passnew2);

$codusu   = $_SESSION['codusu'];

/*echo "<br/>passactual : ".$passactual;
echo "<br/>passnew1 : ".$passnew1;
echo "<br/>passnew2 : ".$passnew2;
*/
$query2 = "select * from usuarios where codusu = '$codusu'";
$result2 = pg_query($con,$query2);  
$row = pg_fetch_array($result2);
$nroreg2=pg_num_rows($result2);

//echo $row["clave"]; 

if ($nroreg2>0)
   {
   $clave = $row["clave"]; 	
   if ($passactual!="" && $passactual1==$clave && $passnew1==$passnew2 && $passnew1!="")
      {
       pg_query($con,"UPDATE usuarios SET clave='$passnew11' where codusu = '$codusu'");
       $_SESSION["clave"]=$passnew1;
       
       // Registro de auditoria
       include("bitacora.php");
	   $codopc = "V_51";
       $fecha=date("Y-n-j", time());
       $hora=date("G:i:s",time());
       $accion="Usuario: ".$codusu." Cambia de Clave";
       $terminal = $_SERVER['REMOTE_ADDR'];

       $result = pg_query($con, "insert into contrasenias( codusu, fecha, hora, claveant, clavenueva) values ('$codusu', '$fecha', '$hora', '$passactual1', '$passnew11')");

       $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);
       // Fin grabacion de registro de auditoria
       
       header("Location: cambiar_clave.php?mensage=99");
	   }
   else 
       { 
   	   if (($passactual=="" || $passactual1!=$clave) && ($passnew1!=$passnew2 || $passnew1=="" || $passnew2==""))
   	      {
          header("Location: cambiar_clave.php?mensage=1&mensage2=2");
   	      } 
	      else 
	      {
          if ($passactual=="" || $passactual1!=$clave)
             {
             header("Location: cambiar_clave.php?mensage=1");
             }
          else
		     {
             if ($passnew1!=$passnew2 || $passnew1=="" || $passnew2=="")
             {
             header("Location: cambiar_clave.php?mensage2=2");	
             }
		     }   
		  }
       }
   }
?>