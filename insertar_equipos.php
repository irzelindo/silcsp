<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codequipo']=$_POST['codequipo'];
   $_SESSION['tipo']=$_POST['tipo'];
   $_SESSION['descripcion']=$_POST['descripcion'];
   $_SESSION['tipodato']=$_POST['tipodato'];
   $_SESSION['programa']=$_POST['programa'];
   $_SESSION['crc']=$_POST['crc'];
   $_SESSION['confirmares']=$_POST['confirmares'];
   $_SESSION['comport']=$_POST['comport'];
   $_SESSION['hasdshking']=$_POST['hasdshking'];
   $_SESSION['baudrate']=$_POST['baudrate'];
   $_SESSION['stopbit']=$_POST['stopbit'];
   $_SESSION['parity']=$_POST['parity'];
   $_SESSION['bits']=$_POST['bits'];
   $_SESSION['recsenial']=$_POST['recsenial'];
   $_SESSION['visualres']=$_POST['visualres'];
   $_SESSION['envioautom']=$_POST['envioautom'];
   $_SESSION['posidcol']=$_POST['posidcol'];
   $_SESSION['separadec']=$_POST['separadec'];
   $_SESSION['escrres']=$_POST['escrres'];
   $_SESSION['rutalog']=$_POST['rutalog'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codequipo = trim($_POST['codequipo']);
   $tipo = trim($_POST['tipo']);
   $descripcion = trim($_POST['descripcion']);
   $tipodato = trim($_POST['tipodato']);
   $programa = trim($_POST['programa']);
   $crc=1*$_POST['crc'];
   $confirmares=1*$_POST['confirmares'];
   $comport=1*$_POST['comport'];
   $hasdshking=1*$_POST['hasdshking'];
   $baudrate=1*$_POST['baudrate'];
   $stopbit=1*$_POST['stopbit'];
   $parity=1*$_POST['parity'];
   $bits=1*$_POST['bits'];
   $recsenial=1*$_POST['recsenial'];
   $visualres=1*$_POST['visualres'];
   $envioautom=1*$_POST['envioautom'];
   $posidcol=1*$_POST['posidcol'];
   $separadec=1*$_POST['separadec'];
   $escrres=1*$_POST['escrres'];
   $rutalog = trim($_POST['rutalog']);
	

	$query1 = "select * from equipos where codequipo = '$codequipo'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from equipos where descripcion = '$descripcion'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into equipos(codequipo, tipo, descripcion, tipodato, programa, crc, confirmares, comport, hasdshking, baudrate, stopbit, parity,
  bits, recsenial, visualres, envioautom, posidcol, separadec, escrres, rutalog ) values ('$codequipo', '$tipo', '$descripcion', '$tipodato', '$programa', $crc, $confirmares, $comport, $hasdshking, $baudrate, $stopbit, $parity,  $bits, $recsenial, $visualres, $envioautom, $posidcol, $separadec, $escrres, '$rutalog')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4312";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Equipos Analizadores: Inserta-Reg.: ".$codequipo."-".$descripcion;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: equipos.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_equipos.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_equipos.php?mensage2=2"); 
           }
       }
?>
