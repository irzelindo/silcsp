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
			
   $codestudiobio = trim($_POST['codestudiobio']);
   $nomestudiobio = trim($_POST['nomestudiobio']);
   $obsestudio = trim($_POST['obsestudio']);
   $obsrecep = trim($_POST['obsrecep']);
   $obsmedico = trim($_POST['obsmedico']);
	
	$query1 = "select * from emicrobiologia where codestudiobio = '$codestudiobio'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from emicrobiologia where nomestudiobio = '$nomestudiobio'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into emicrobiologia( codestudiobio, nomestudiobio, obsestudio, obsrecep, obsmedico) values ('$codestudiobio', '$nomestudiobio', '$obsestudio', '$obsrecep', '$obsmedico')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_431";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Estudios Microbiologia: Inserta-Reg.: ".$codestudiobio."-".$nomestudiobio;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: estudiosmicro.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_estudiosmicro.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_estudiosmicro.php?mensage2=2"); 
           }
       }
?>
