<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codmedico']=$_POST['codmedico'];
   $_SESSION['nomyapex']=$_POST['nomyapex'];
   $_SESSION['tipoprof']=$_POST['tipoprof'];
   $_SESSION['nroregistro']=$_POST['nroregistro'];
   $_SESSION['estado']=$_POST['estado'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codmedico = trim($_POST['codmedico']);		
   $nomyapex = trim($_POST['nomyapex']);
   $tipoprof = trim($_POST['tipoprof']);
   $nroregistro = trim($_POST['nroregistro']);
   $estado = 1*$_POST['estado'];
   
   if (isset($_POST['indica']))
	{
		$indica = $_POST['indica'];
	}
   else
    {
        $indica =0;  
    }  

	
   
	$query1 = "select * from medicos where codmedico = '$codmedico'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from medicos where nomyape = '$nomyapex'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into medicos( codmedico, nomyape, tipoprof, nroregistro, estado) values ('$codmedico', '$nomyapex', '$tipoprof', '$nroregistro', $estado)"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_424";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Medicos: Inserta-Reg.: ".$codmedico."-".$nomyapex;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		 
		    if($indica == 1)
			{
				header("Location: medicos_orden.php?indica=$indica'");
			}
			else
			{
				header("Location: medicos.php?mensage=9");
			}
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_medicos.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_medicos.php?mensage2=2"); 
           }
       }
?>
