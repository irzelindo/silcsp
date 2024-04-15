<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codrechazo']=$_POST['codrechazo'];
   $_SESSION['nomrechazo']=$_POST['nomrechazo'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codrechazo = trim($_POST['codrechazo']);
   $nomrechazo = trim($_POST['nomrechazo']);
	
   
	$query1 = "select * from motivorechazo where codrechazo = '$codrechazo'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from motivorechazo where nomrechazo = '$nomrechazo'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into motivorechazo( codrechazo, nomrechazo) values ('$codrechazo', '$nomrechazo')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4310";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Motivos de Rechazo: Inserta-Reg.: ".$codrechazo."-".$nomrechazo;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: motivo_rechazo.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_motivo_rechazo.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_motivo_rechazo.php?mensage2=2"); 
           }
       }
?>
