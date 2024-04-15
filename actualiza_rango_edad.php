<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['cgrupoedad']=$_POST['cgrupoedad'];
   $_SESSION['ngrupoedad']=$_POST['ngrupoedad'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$cgrupoedad  = trim($_POST['cgrupoedad']);
	$ngrupoedad  = trim($_POST['ngrupoedad']);
	$ngrupoedadx = trim($_POST['ngrupoedadx']);
/*	
echo $cgrupoedad;
echo'<br>';
echo $ngrupoedad;
echo'<br>';
echo $ngrupoedadx;
*/   
	$query2 = "select * from tiporangoedad where ngrupoedad = '$ngrupoedad'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $ngrupoedad==$ngrupoedadx))
	   {
        $result = pg_query($conn,"UPDATE tiporangoedad SET ngrupoedad='$ngrupoedad' WHERE cgrupoedad='$cgrupoedad'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4114";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Rango de Edades: Modifica-Reg.: ".$cgrupoedad."-".$ngrupoedad;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: rango_edad.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_rango_edad.php?id=$cgrupoedad&mensage2=2"); 
       }  

?>
