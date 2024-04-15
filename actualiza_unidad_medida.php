<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codumedida']=$_POST['codumedida'];
   $_SESSION['nomumedida']=$_POST['nomumedida'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codumedida  = trim($_POST['codumedida']);
	$nomumedida  = trim($_POST['nomumedida']);
	$nomumedidax = trim($_POST['nomumedidax']);

/*	
echo $codumedida;
echo'<br>';
echo $nomumedida;
echo'<br>';
echo $nomumedidax;
*/   
	$query2 = "select * from unidadmedida where nomumedida = '$nomumedida'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomumedida==$nomumedidax))
	   {
        $result = pg_query($conn,"UPDATE unidadmedida SET nomumedida='$nomumedida' WHERE codumedida='$codumedida'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_439";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Unidades de Medida: Modifica-Reg.: ".$codumedida."-".$nomumedida;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: unidad_medida.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_unidad_medida.php?id=$codumedida&mensage2=2"); 
       }  

?>
