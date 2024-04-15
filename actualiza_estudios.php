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
			
	   
	$codestudio  = trim($_POST['codestudio']);
	$nomestudio  = trim($_POST['nomestudio']);
	$nomestudiox = trim($_POST['nomestudiox']);
    
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
/*	
echo $codestudio;
echo'<br>';
echo $nomestudio;
echo'<br>';
echo $nomestudiox;
*/   

	if($posicion == '')
	{
		$posicion  = 0;
	}

	$query2 = "select * from estudios where nomestudio = '$nomestudio'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomestudio==$nomestudiox))
	   {
        $result = pg_query($conn,"UPDATE estudios SET nomestudio='$nomestudio',
                                                      codexterno='$codexterno', 
                                                      abreviatura='$abreviatura', 
                                                      dias=$dias, 
                                                      codsector='$codsector', 
                                                      codtmuestra='$codtmuestra', 
                                                      cantetiq=$cantetiq, 
                                                      factor=$factor, 
                                                      microbiologia=$microbiologia, 
                                                      codestudiobio='$codestudiobio', 
                                                      estado=$estado, 
                                                      enviarec=$enviarec, 
                                                      obs='$obs', 
                                                      codmetodo='$codmetodo',
													  posicion='$posicion'
                                                      WHERE codestudio='$codestudio'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_431"; 
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Estudios: Modifica-Reg.: ".$codestudio."-".$nomestudio;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: estudios.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_estudios.php?id=$codestudio&mensage2=2"); 
       }  

?>
