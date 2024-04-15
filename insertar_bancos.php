<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codbco']=$_POST['codbco'];
   $_SESSION['nombco']=$_POST['nombco'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codbco = trim($_POST['codbco']);
   $nombco = trim($_POST['nombco']);
	
   
	$query1 = "select * from bancos where codbco = '$codbco'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from bancos where nombco = '$nombco'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into bancos( codbco, nombco) values ('$codbco', '$nombco')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_443";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Bancos: Inserta-Reg.: ".$codbco."-".$nombco;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: bancos.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_bancos.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_bancos.php?mensage2=2"); 
           }
       }
?>
