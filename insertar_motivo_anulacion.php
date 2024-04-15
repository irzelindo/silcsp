<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codanula']=$_POST['codanula'];
   $_SESSION['nomanula']=$_POST['nomanula'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codanula = trim($_POST['codanula']);
   $nomanula = trim($_POST['nomanula']);
	
   
	$query1 = "select * from motivoanulacion where codanula = '$codanula'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from motivoanulacion where nomanula = '$nomanula'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into motivoanulacion( codanula, nomanula) values ('$codanula', '$nomanula')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_443";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Motivos de Anulacion de ingresos: Inserta-Reg.: ".$codanula."-".$nomanula;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: motivo_anulacion.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_motivo_anulacion.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_motivo_anulacion.php?mensage2=2"); 
           }
       }
?>
