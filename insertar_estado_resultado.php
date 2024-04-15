<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codestado']=$_POST['codestado'];
   $_SESSION['nomestado']=$_POST['nomestado'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codestado = trim($_POST['codestado']);
   $nomestado = trim($_POST['nomestado']);
	
   
	$query1 = "select * from estadoresultado where codestado = '$codestado'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from estadoresultado where nomestado = '$nomestado'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into estadoresultado( codestado, nomestado) values ('$codestado', '$nomestado')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4311";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Estados de Resultados: Inserta-Reg.: ".$codestado."-".$nomestado;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: estado_resultado.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_estado_resultado.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_estado_resultado.php?mensage2=2"); 
           }
       }
?>
