<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codantibiogr']=$_POST['codantibiogr'];
   $_SESSION['nomantibiogr']=$_POST['nomantibiogr'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codantibiogr = trim($_POST['codantibiogr']);
   $nomantibiogr = trim($_POST['nomantibiogr']);
	
   
	$query1 = "select * from antibiogramas where codantibiogr = '$codantibiogr'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from antibiogramas where nomantibiogr = '$nomantibiogr'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into antibiogramas( codantibiogr, nomantibiogr) values ('$codantibiogr', '$nomantibiogr')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4315";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Antibiogramas: Inserta-Reg.: ".$codantibiogr."-".$nomantibiogr;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_antibiogramas.php?id=".$codantibiogr);
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_antibiogramas.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_antibiogramas.php?mensage2=2"); 
           }
       }
?>
