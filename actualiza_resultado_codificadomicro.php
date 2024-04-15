<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codresultado']=$_POST['codresultado'];
   $_SESSION['nomresultado']=$_POST['nomresultado'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codresultado  = trim($_POST['codresultado']);
	$nomresultado  = trim($_POST['nomresultado']);
	$nomresultadox = trim($_POST['nomresultadox']);
/*	
echo $codresultado;
echo'<br>';
echo $nomresultado;
echo'<br>';
echo $nomresultadox;
*/   
	$query2 = "select * from resultadocodificadobio where nomresultado = '$nomresultado'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomresultado==$nomresultadox))
	   {
        $result = pg_query($conn,"UPDATE resultadocodificadobio SET nomresultado='$nomresultado' WHERE codresultado='$codresultado'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4317";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Resultados Microbiologia Posibles: Modifica-Reg.: ".$codresultado."-".$nomresultado;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: resultado_codificadomicro.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_resultado_codificadomicro.php?id=$codresultado&mensage2=2"); 
       }  

?>
