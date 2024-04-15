<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codestudio']=$_POST['codestudio'];
   $_SESSION['nomestudio']=$_POST['nomestudio'];
   
   $_SESSION['codexterno']    = $_POST['codexterno'];  
   $_SESSION['abreviatura']   = $_POST['abreviatura'];  
   $_SESSION['dias']          = $_POST['dias'];  
   $_SESSION['codsector']     = $_POST['codsector'];  
   $_SESSION['codtmuestra']   = $_POST['codtmuestra'];  
   $_SESSION['cantetiq']      = $_POST['cantetiq'];  
   $_SESSION['factor']        = $_POST['factor'];  
   $_SESSION['microbiologia'] = $_POST['microbiologia'];  
   $_SESSION['codestudiobio'] = $_POST['codestudiobio'];  
   $_SESSION['estado']        = $_POST['estado'];  
   $_SESSION['enviarec']      = $_POST['enviarec'];  
   $_SESSION['codmetodo']     = $_POST['codmetodo'];  
   $_SESSION['obs']           = $_POST['obs'];
   $_SESSION['posicion']      = $_POST['posicion'];
     
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codestudio = trim($_POST['codestudio']);
   $nomestudio = trim($_POST['nomestudio']);

   $codexterno    = $_POST['codexterno'];  
   $abreviatura   = $_POST['abreviatura'];  
   $dias          = 1*$_POST['dias'];  
   $codsector     = $_POST['codsector'];  
   $codtmuestra   = $_POST['codtmuestra'];  
   $cantetiq      = 1*$_POST['cantetiq'];  
   $factor        = 1*$_POST['factor'];  
   $microbiologia = 1*$_POST['microbiologia'];  
   $codestudiobio = $_POST['codestudiobio'];  
   $estado        = 1*$_POST['estado'];  
   $enviarec      = 1*$_POST['enviarec'];  
   $codmetodo     = $_POST['codmetodo'];  
   $obs           = $_POST['obs'];	
   $posicion      = $_POST['posicion'];

	if($posicion == '')
	{
		$posicion  = 0;
	}
   
	$query1 = "select * from estudios where codestudio = '$codestudio'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from estudios where nomestudio = '$nomestudio'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into estudios( codestudio, nomestudio, codexterno, abreviatura, dias, codsector, codtmuestra, cantetiq, factor, microbiologia, codestudiobio, estado, enviarec, obs, codmetodo, posicion) values ('$codestudio', '$nomestudio', '$codexterno', '$abreviatura', $dias, '$codsector', '$codtmuestra', $cantetiq, $factor, $microbiologia, '$codestudiobio', $estado, $enviarec, '$obs', '$codmetodo', '$posicion')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_431";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Estudios: Inserta-Reg.: ".$codestudio."-".$nomestudio;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_estudios.php?id=".$codestudio);
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_estudios.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_estudios.php?mensage2=2"); 
           }
       }
?>
