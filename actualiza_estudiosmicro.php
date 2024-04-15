<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codestudiobio']=$_POST['codestudiobio'];
   $_SESSION['nomestudiobio']=$_POST['nomestudiobio'];
   $_SESSION['obsestudio']=$_POST['obsestudio'];
   $_SESSION['obsrecep']=$_POST['obsrecep'];
   $_SESSION['obsmedico']=$_POST['obsmedico'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codestudiobio  = trim($_POST['codestudiobio']);
	$nomestudiobio  = trim($_POST['nomestudiobio']);
   $obsestudio = trim($_POST['obsestudio']);
   $obsrecep = trim($_POST['obsrecep']);
   $obsmedico = trim($_POST['obsmedico']);
   $nomestudiobiox = trim($_POST['nomestudiobiox']);
/*	
echo $codestudiobio;
echo'<br>';
echo $nomestudiobio;
echo'<br>';
echo $nomestudiobiox;
*/   
	$query2 = "select * from emicrobiologia where nomestudiobio = '$nomestudiobio'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomestudiobio==$nomestudiobiox))
	   {
        $result = pg_query($conn,"UPDATE emicrobiologia SET nomestudiobio='$nomestudiobio', obsestudio='$obsestudio', obsrecep='$obsrecep', obsmedico='$obsmedico' WHERE codestudiobio='$codestudiobio'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_431";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Estudios Microbiologia: Modifica-Reg.: ".$codestudiobio."-".$nomestudiobio;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: estudiosmicro.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_estudiosmicro.php?id=$codestudiobio&mensage2=2"); 
       }  

?>
