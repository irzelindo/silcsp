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
   $descripcionx = trim($_POST['descripcionx']);
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

/*	
echo $codequipo;
echo'<br>';
echo $dia;
echo'<br>';
echo $diax;
*/   
	$query2 = "select * from equipos where descripcion = '$descripcion'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $descripcion==$descripcionx))
	   {
        $result = pg_query($conn,"UPDATE equipos SET tipo='$tipo', 
                                                     descripcion='$descripcion', 
                                                     tipodato='$tipodato', 
                                                     programa='$programa', 
                                                     crc=$crc, 
                                                     confirmares=$confirmares, 
                                                     comport=$comport, 
                                                     hasdshking=$hasdshking, 
                                                     baudrate=$baudrate, 
                                                     stopbit=$stopbit, 
                                                     parity=$parity,  
                                                     bits=$bits, 
                                                     recsenial=$recsenial, 
                                                     visualres=$visualres, 
                                                     envioautom=$envioautom, 
                                                     posidcol=$posidcol, 
                                                     separadec=$separadec, 
                                                     escrres=$escrres, 
                                                     rutalog='$rutalog' 
                                        WHERE codequipo='$codequipo'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4312";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Equipos Analizadores: Modifica-Reg.: ".$codequipo."-".$descripcion;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: equipos.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_equipos.php?id=$codequipo&mensage2=2"); 
       }  

?>
