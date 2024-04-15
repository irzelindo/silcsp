<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codsintoma']=$_POST['codsintoma'];
   $_SESSION['nomsintoma']=$_POST['nomsintoma'];
   $_SESSION['tipo']=$_POST['tipo'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
				   
	$codsintoma  = trim($_POST['codsintoma']);
	$nomsintoma  = trim($_POST['nomsintoma']);
	$tipo        = trim($_POST['tipox']);
	$nomsintomax = trim($_POST['nomsintomax']);

/*	
echo $codsintoma;
echo'<br>';
echo $nomsintoma;
echo'<br>';
echo $nomsintomax;
*/   
	$query2 = "select * from sintomas where nomsintoma = '$nomsintoma'";
    $result2 = pg_query($conn,$query2); 
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomsintoma==$nomsintomax))
	   {
        $result = pg_query($conn,"UPDATE sintomas SET nomsintoma='$nomsintoma' WHERE codsintoma='$codsintoma'  and tipo=$tipo"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_422";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Sintomas: Modifica-Reg.: ".$codsintoma."-".$nomsintoma;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: sintomas.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_sintomas.php?id=$codsintoma&tipo=$tipo&mensage2=2"); 
       }  
?>
