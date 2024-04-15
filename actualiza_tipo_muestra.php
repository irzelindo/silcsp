<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codtmuestra']=$_POST['codtmuestra'];
   $_SESSION['nomtmuestra']=$_POST['nomtmuestra'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	$codtmuestra  = trim($_POST['codtmuestra']);
	$nomtmuestra  = trim($_POST['nomtmuestra']);
	$nomtmuestrax = trim($_POST['nomtmuestrax']);

/*	
echo $codtmuestra;
echo'<br>';
echo $nomtmuestra;
echo'<br>';
echo $nomtmuestrax;
*/   
	$query2 = "select * from tipomuestra where nomtmuestra = '$nomtmuestra'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomtmuestra==$nomtmuestrax))
	   {
        $result = pg_query($conn,"UPDATE tipomuestra SET nomtmuestra='$nomtmuestra' WHERE codtmuestra='$codtmuestra'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_437";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Tipo de Muestras Modifica-Reg.: ".$codtmuestra."-".$nomtmuestra;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: tipo_muestra.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_tipo_muestra.php?id=$codtmuestra&mensage2=2"); 
       }  

?>
