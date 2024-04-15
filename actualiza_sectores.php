<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codsector']=$_POST['codsector'];
   $_SESSION['nomsector']=$_POST['nomsector'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	$codsector  = trim($_POST['codsector']);
	$nomsector  = trim($_POST['nomsector']);
	$nomsectorx = trim($_POST['nomsectorx']);
	$posicion  = $_POST['posicion'];

	   if($posicion == '')
	   {
		   $posicion = 0;
	   }

/*	
echo $codsector;
echo'<br>';
echo $nomsector;
echo'<br>';
echo $nomsectorx;
*/   
	$query2 = "select * from sectores where nomsector = '$nomsector'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomsector==$nomsectorx))
	   {
        $result = pg_query($conn,"UPDATE sectores SET nomsector='$nomsector', posicion='$posicion' WHERE codsector='$codsector'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4110";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Sectores Laboratoriales: Modifica-Reg.: ".$codsector."-".$nomsector;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: sectores.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_sectores.php?id=$codsector&mensage2=2"); 
       }  

?>
