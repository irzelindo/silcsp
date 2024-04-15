<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codantibiogr']=$_POST['codantibiogr'];
   $_SESSION['codantibiot']=$_POST['codantibiot'];
   $_SESSION['codantibiotx']=$_POST['codantibiotx'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codantibiogr = trim($_POST['codantibiogr']);
   $codantibiot = trim($_POST['codantibiot']);
   $codantibiotx = trim($_POST['codantibiotx']);
	
   
	$query1 = "select * from antibioticoantibiograma where codantibiogr = '$codantibiogr' and codantibiot = '$codantibiot'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 


    if ($nroreg1==0 || ($nroreg1>0 && $codantibiot==$codantibiotx))
	   {
	 	$result = pg_query($conn, "UPDATE antibioticoantibiograma set codantibiot='$codantibiot' 
                                           where codantibiogr = '$codantibiogr' and codantibiot = '$codantibiotx'"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4315";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Antibiotico de Antibiogramas: Modifica-Reg.: ".$codantibiogr.', Cod.Antibiotico: '.$codantibiot;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_antibiogramas.php?mensage=7&id=".$codantibiogr);
       }
	else
       {
   		header("Location: modifica_antibioticosrel.php?mensage2=1&codantibiogr=$codantibiogr&codantibiot=$codantibiotx"); 
       }
?>
