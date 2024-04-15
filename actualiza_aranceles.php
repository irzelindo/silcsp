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
			
	$codarancel  = trim($_POST['codarancel']);
	$nomarancel  = trim($_POST['nomarancel']);
	$monto       = $_POST['monto'];
	$tipo        = trim($_POST['tipo']);
	$nomarancelx = trim($_POST['nomarancelx']);
/*	
echo $codarancel;
echo'<br>';
echo $nomarancel;
echo'<br>';
echo $nomarancelx;
*/   
	$query2 = "select * from aranceles where nomarancel = '$nomarancel'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=0; //pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomarancel==$nomarancelx))
	   {
        $result = pg_query($conn,"UPDATE aranceles SET nomarancel='$nomarancel', monto='$monto', tipo='$tipo' WHERE codarancel='$codarancel'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_442";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Aranceles: Modifica-Reg.: ".$codarancel."-".$nomarancel;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: aranceles.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_aranceles.php?id=$codarancel&mensage2=2"); 
       }  

?>
