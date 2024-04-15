<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codarancel']=$_POST['codarancel'];
   $_SESSION['nomarancel']=$_POST['nomarancel'];
   $_SESSION['monto']=$_POST['monto'];
   $_SESSION['tipo']=$_POST['tipo'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codarancel = trim($_POST['codarancel']);		
   $nomarancel = trim($_POST['nomarancel']);
   $monto = $_POST['monto'];
   $tipo = $_POST['tipo'];	
   
	$query1 = "select * from aranceles where codarancel = '$codarancel'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from aranceles where nomarancel = '$nomarancel'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=0; //pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into aranceles( codarancel, nomarancel, monto, tipo) values ('$codarancel', '$nomarancel', '$monto', '$tipo')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_442";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Aranceles: Inserta-Reg.: ".$codarancel."-".$nomarancel;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: aranceles.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_aranceles.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_aranceles.php?mensage2=2"); 
           }
       }
?>
