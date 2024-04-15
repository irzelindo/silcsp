<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codsintoma']=$_POST['codsintoma'];
   $_SESSION['nomsintoma']=$_POST['nomsintoma'];
   $_SESSION['tipo']=$_POST['tipo'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codsintoma = trim($_POST['codsintoma']);		
   $nomsintoma = trim($_POST['nomsintoma']);
   $tipo = $_POST['tipo'];
	
   
	$query1 = "select * from sintomas where codsintoma = '$codsintoma' and tipo=$tipo"; 
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from sintomas where nomsintoma = '$nomsintoma'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into sintomas( codsintoma, nomsintoma, tipo) values ('$codsintoma', '$nomsintoma', '$tipo')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_422";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Sintomas: Inserta-Reg.: ".$codsintoma."-".$nomsintoma;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: sintomas.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_sintomas.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_sintomas.php?mensage2=2"); 
           }
       }
?>
