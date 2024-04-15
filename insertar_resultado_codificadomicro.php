<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codresultado']=$_POST['codresultado'];
   $_SESSION['nomresultado']=$_POST['nomresultado'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codresultado = trim($_POST['codresultado']);
   $nomresultado = trim($_POST['nomresultado']);
	
   
	$query1 = "select * from resultadocodificadobio where codresultado = '$codresultado'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from resultadocodificadobio where nomresultado = '$nomresultado'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into resultadocodificadobio( codresultado, nomresultado) values ('$codresultado', '$nomresultado')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4317";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Resultados Microbiologia Posibles: Inserta-Reg.: ".$codresultado."-".$nomresultado;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: resultado_codificadomicro.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_resultado_codificadomicro.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_resultado_codificadomicro.php?mensage2=2"); 
           }
       }
?>
