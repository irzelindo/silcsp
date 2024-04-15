<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codmicroorg']=$_POST['codmicroorg'];
   $_SESSION['nommicroorg']=$_POST['nommicroorg'];
   $_SESSION['codexterno']=$_POST['codexterno'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codmicroorg = trim($_POST['codmicroorg']);		
   $nommicroorg = trim($_POST['nommicroorg']);
   $codexterno = trim($_POST['codexterno']);
   
	$query1 = "select * from microorganismos where codmicroorg = '$codmicroorg'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from microorganismos where nommicroorg = '$nommicroorg'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into microorganismos( codmicroorg, nommicroorg, codexterno) values ($codmicroorg, '$nommicroorg', '$codexterno')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4314";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Microorganismos: Inserta-Reg.: ".$codmicroorg."-".$nommicroorg;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: microorganismos.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_microorganismos.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_microorganismos.php?mensage2=2"); 
           }
       }
?>
