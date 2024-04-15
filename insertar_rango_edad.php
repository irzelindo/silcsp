<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['cgrupoedad']=$_POST['cgrupoedad'];
   $_SESSION['ngrupoedad']=$_POST['ngrupoedad'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $cgrupoedad = trim($_POST['cgrupoedad']);
   $ngrupoedad = trim($_POST['ngrupoedad']);
	
   
	$query1 = "select * from tiporangoedad where cgrupoedad = '$cgrupoedad'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from tiporangoedad where ngrupoedad = '$ngrupoedad'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into tiporangoedad( cgrupoedad, ngrupoedad) values ('$cgrupoedad', '$ngrupoedad')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4114";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Rango de Edades: Inserta-Reg.: ".$cgrupoedad."-".$ngrupoedad;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_rango_edad.php?id=".$cgrupoedad);
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_rango_edad.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_rango_edad.php?mensage2=2"); 
           }
       }
?>
