<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codempresa']=$_POST['codempresa'];
   $_SESSION['razonsocial']=$_POST['razonsocial'];
   $_SESSION['coddist']=$_POST['coddist'];
   $_SESSION['coddpto']=$_POST['coddpto'];

   $_SESSION['laboratorio']=$_POST['laboratorio'];
   $_SESSION['ruc']=$_POST['ruc'];
   $_SESSION['responsable']=$_POST['responsable'];
   $_SESSION['cargoresp']=$_POST['cargoresp'];
   $_SESSION['dccion']=$_POST['dccion'];
   $_SESSION['barrio']=$_POST['barrio'];
   $_SESSION['zona']=$_POST['zona'];
   $_SESSION['telefono']=$_POST['telefono'];
   $_SESSION['celular']=$_POST['celular'];
   $_SESSION['email']=$_POST['email'];
   $_SESSION['obs']=$_POST['obs'];
   $_SESSION['estado']=$_POST['estado'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codempresa = $_POST['codempresa'];		
   $razonsocial = trim($_POST['razonsocial']);
   $coddist = $_POST['coddist'];
   $coddpto = $_POST['coddpto'];

   $laboratorio = 1*$_POST['laboratorio'];
   $ruc = trim($_POST['ruc']);
   $responsable = trim($_POST['responsable']);
   $cargoresp = trim($_POST['cargoresp']);
   $dccion = trim($_POST['dccion']);
   $barrio = trim($_POST['barrio']);
   $zona = 1*$_POST['zona'];
   $telefono = trim($_POST['telefono']);
   $celular = trim($_POST['celular']);
   $email = trim($_POST['email']);
   $obs = trim($_POST['obs']);
   $estado = 1*$_POST['estado'];
   
	$query1 = "select * from empresas where codempresa = '$codempresa'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from empresas where razonsocial = '$razonsocial' ";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into empresas( codempresa, razonsocial, laboratorio, ruc, responsable, cargoresp, dccion, coddpto, coddist, barrio, zona, telefono, celular, email, obs, estado) values ('$codempresa', '$razonsocial', $laboratorio, '$ruc', '$responsable', '$cargoresp', '$dccion', '$coddpto', '$coddist', '$barrio', $zona, '$telefono', '$celular', '$email', '$obs', $estado)"); 

		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_441";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Empresas/Laboratorios: Inserta-Reg.: ".$codempresa."-".$razonsocial;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: empresas.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_empresas.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_empresas.php?mensage2=2"); 
           }
       }
?>
