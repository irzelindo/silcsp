<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codtmuestra']=$_POST['codtmuestra'];
   $_SESSION['nomtmuestra']=$_POST['nomtmuestra'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codtmuestra = trim($_POST['codtmuestra']);
   $nomtmuestra = trim($_POST['nomtmuestra']);
	
   
	$query1 = "select * from tipomuestra where codtmuestra = '$codtmuestra'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from tipomuestra where nomtmuestra = '$nomtmuestra'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into tipomuestra( codtmuestra, nomtmuestra) values ('$codtmuestra', '$nomtmuestra')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_437";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Tipo de Muestras Inserta-Reg.: ".$codtmuestra."-".$nomtmuestra;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: tipo_muestra.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_tipo_muestra.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_tipo_muestra.php?mensage2=2"); 
           }
       }
?>
