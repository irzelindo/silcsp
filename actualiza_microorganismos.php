<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codmicroorg']=$_POST['codmicroorg'];
   $_SESSION['nommicroorg']=$_POST['nommicroorg'];
   $_SESSION['codexterno']=$_POST['codexterno'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	$codmicroorg  = trim($_POST['codmicroorg']);
	$nommicroorg  = trim($_POST['nommicroorg']);
	$codexterno   = trim($_POST['codexterno']);
	$nommicroorgx = trim($_POST['nommicroorgx']);
/*	
echo $codmicroorg;
echo'<br>';
echo $nommicroorg;
echo'<br>';
echo $nommicroorgx;
*/   
	$query2 = "select * from microorganismos where nommicroorg = '$nommicroorg'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nommicroorg==$nommicroorgx))
	   {
        $result = pg_query($conn,"UPDATE microorganismos SET nommicroorg='$nommicroorg', codexterno='$codexterno' WHERE codmicroorg='$codmicroorg'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4314";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Microorganismos: Modifica-Reg.: ".$codmicroorg."-".$nommicroorg;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: microorganismos.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_microorganismos.php?id=$codmicroorg&mensage2=2"); 
       }  

?>
